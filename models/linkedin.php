<?php
namespace hoho\models;

use hoho\dataaccess as data;

require_once($_SERVER["DOCUMENT_ROOT"]."/config/linkedinconf.php");

class Models_LinkedIn extends Models_Base {

    public function getAuthCodeUrl() {
        return "https://www.linkedin.com/uas/oauth2/authorization"
                . "?response_type=code"
                . "&client_id=" . CLIENT_ID
                . "&redirect_uri=" . REDIRECT_URI
                . "&state=" . STATE
                . "&scope=r_emailaddress";

    }

    public static function getClientId() {
        return CLIENT_ID;
    }

    public static function getClientSecret() {
        return CLIENT_SECRET;
    }

    public static function getClientState() {
        return STATE;
    }

    public static function getRedirectUri() {
        return REDIRECT_URI;
    }


    public static function equalState($state) {
        return (STATE === $state);
    }

    public static function getTokenByEmailId($emailId) {
        return data\Dataaccess_Linkedin::getTokenByEmailId($emailId);
    }

    public function saveToken($params) {
        $emailId = $params['email_id'];
        $token = $params['access_token'];
        $expirationDate = $params['expiration_date'];
        return data\Dataaccess_LinkedIn::insertToken($emailId, $token, $expirationDate);
    }

    public function updateToken($params) {
        $emailId = $params['email_id'];
        $token = $params['access_token'];
        $expirationDate = $params['expiration_date'];
        return data\Dataaccess_LinkedIn::updateToken($emailId, $token, $expirationDate);
    }

    public function getUserByEmail($email) {
        $user = data\Dataaccess_User::getUserByEmail($email);
        return $user ? $user[0] : null;
    }

    public function getLinkedInUserInfo($accessToken) {

        $userInfo = array();

        $url = "https://api.linkedin.com/v1/people/"
             . "~:(id,first-name,last-name,headline,location,public-profile-url,email-address)?oauth2_access_token={$accessToken}&format=json";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        $result = curl_exec($ch);
        curl_close($ch);
        $result = json_decode($result, true);

        if ($result) {
            $userInfo['email'] = $result['emailAddress'];
            $userInfo['firstName'] = $result['firstName'];
            $userInfo['lastName'] = $result['lastName'];
            $userInfo['createdAt'] = date('Y-m-d H:i:s');
            $userInfo['userStatus'] = 'Active';
            $userInfo['linkedIn'] = true;
        }

        return $userInfo;
    }
}
