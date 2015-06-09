<?php
namespace hoho\admin;

use hoho\fwk as Fwk;
use hoho\models as Models;
use hoho\admin as Controllers;
use hoho\helpers as Helpers;

class Controllers_LinkedIn extends Controllers_AdminBase {

    public function authCodeRequest() {
        $url = Models\Models_LinkedIn::getAuthCodeUrl();
        $result = array('result' => 'OK', 'redirectUrl' => $url);
        $this->response->setResponseCode("200");
        $this->response->setHeader("Content-Type", "application/json; charset=utf-8");
        $this->response->setBody(json_encode($result));
    }

    public function authCodeCallback($params="") {
        $code = isset($params['code']) ? $params['code'] : "";
        $state = isset($params['state']) ? $params['state'] : "";
        $error = isset($params['error']) ? $params['error'] : "";
        $errorDesc = isset($params['error_description']) ? $params['error_description'] : "";

        // Authorization Code gotten
        if ($code) {
            // Check 'state' value to prevent CSRF attacks.
            if (Models\Models_LinkedIn::equalState($state)) {
                $linkedInUserInfo = $this->handleAuthTokenResponse($this->authTokenRequest($code));
                if ($linkedInUserInfo) {
                    $this->logInLinkedInUser($linkedInUserInfo);
                    $returnTo = '/user/myaccount';
                    $result = array('result' => 'OK', 'redirectUrl' => $returnTo);
                } else {
                    $errorDesc = 'LinkedIn login error';
                    $result = array('result' => 'Error', 'message' => _($errorDesc));
                }
            }
        } else if ($error) {
            $result = array('result' => 'Error', 'message' => _($errorDesc));
        } else {
            $result = array('result' => 'Error', 'message' => _('Unknown error'));
        }

        header("Location: " . $returnTo);
        die();
    }

    private function authTokenRequest($code) {
        $postfields = "grant_type=authorization_code" .
                      "&code={$code}".
                      "&redirect_uri=" . Models\Models_LinkedIn::getRedirectUri() .
                      "&client_id=" . Models\Models_LinkedIn::getClientId() .
                      "&client_secret=" . Models\Models_LinkedIn::getClientSecret();

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.linkedin.com/uas/oauth2/accessToken');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/x-www-form-urlencoded'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);

        return $result;
    }

/*
Array
(
    [email] => juanperez@mail.com
    [firstName] => Juan
    [lastName] => Perez
    [createdAt] => 2015-05-24 06:48:37
    [userStatus] => Active
    [linkedIn] => 1
    [expires_in] => 5183999
    [access_token] => AQUO9lHkCheJ1ggV_tJMdGnOGgOUaFM3bXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXtsEtO5N7avc6fh7VxKyRdOM5FgrD4WLverrTI-kMJPiPd77WJDSv8uKxSbfTgJ-HSl0AkDqFrAlBJjvuv4UEnZzjfBR1tNri91s19fO2mPI
)
*/
    /* The previous array is an example of the output of this method
    * With the access_token, do a request to get the LinkedIn user info.
    */
    private function handleAuthTokenResponse($authTokenRequest = "") {
        $userInfo = array();
        $authToken = json_decode($authTokenRequest, true);
        $accessToken = isset($authToken['access_token']) ? $authToken['access_token'] : "";

        if ($accessToken) {
            $userInfo = Models\Models_LinkedIn::getLinkedInUserInfo($accessToken);
            $userInfo['expires_in'] = $authToken['expires_in'];
            $userInfo['access_token'] = $accessToken;
        }

        return $userInfo;
    }

    private function logInLinkedInUser($linkedInUserInfo) {
        // Check if there is a user with this email
        $user = Models\Models_LinkedIn::getUserByEmail($linkedInUserInfo['email']);
        if ( ! empty($user)) {
            // Check if there is a token for this email.
            $token = Models\Models_LinkedIn::getTokenByEmailId($user['EMAIL_ID']);

            if ($token) {
                $expirationDate = $linkedInUserInfo['expires_in'] + time();
                // Update token
                $params = array(
                            'email_id' => $user['EMAIL_ID'],
                            'access_token' => $linkedInUserInfo['access_token'],
                            'expiration_date' => $expirationDate,
                            );

                $updated = Models\Models_LinkedIn::updateToken($params);
            } else {
                // User exists, but doesn't have an accessToken
                $id = $this->saveToken($linkedInUserInfo);
            }
        } else {
            $this->signUpLinkedUser($linkedInUserInfo);
        }

        $loginParams = $this->wrapLoginParams($linkedInUserInfo);
        Controllers\Controllers_login::dologin($loginParams);
    }

    public function signUpLinkedUser($params) {
        $params['firstname'] = $params['firstName'];
        $params['lastname'] = $params['lastName'];
        $params['pass1'] = $this->generateRandomString();

        $userId = Controllers\Controllers_Signup::adduser($params);
        $id = $this->saveToken($params);
    }

    public function saveToken($params) {
        // Get user by email
        $user = Models\Models_LinkedIn::getUserByEmail($params['email']);

        if (empty($user)) {
            return false;
        }

        $emailId = $user['EMAIL_ID'];
        $expirationDate = $params['expires_in'] + time();

        $tokenParams = array();
        $tokenParams['email_id'] = $emailId;
        $tokenParams['access_token'] = $params['access_token'];
        $tokenParams['expiration_date'] = $expirationDate;

        $save = Models\Models_LinkedIn::saveToken($tokenParams);
    }

    private function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    private function wrapLoginParams($linkedInValues) {
        $params = array();
        $params['txtEmail'] = $linkedInValues['email'];
        $params['txtPassword'] = ""; // Not needed for LinkedIn login
        $params['returnTo'] = Models\Models_LinkedIn::getRedirectUri();
        $params['linkedIn'] = true;

        return $params;
    }
}
