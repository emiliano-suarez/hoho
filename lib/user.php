<?php
namespace hoho\admin\lib;

use hoho\models as Models;

class Lib_User {

  public static function validatePinner($user, $pinner) {
    $errors = self::validate($user);

    if (($pinner->gender != "male") && ($pinner->gender != "female")) {
      $errors[] = array('field' => 'gender', 'msg' => 'Invalid gender value');
    }

    if ($pinner->birthday != "") {
      $strBirth = strtotime($pinner->birthday);
      if (! $strBirth) {
        $errors[] = array('field' => 'birthday', 'msg' => 'Invalid birthday date');
      } elseif ($strBirth > time()) {
        $errors[] = array('field' => 'birthday', 'msg' => 'Birthday cannot be in the future');
      }
    }

    if (($pinner->pinValue == "") || (! is_numeric($pinner->pinValue)) || ($pinner->pinValue < 0)) {
      $errors[] = array('field' => 'PinValue', 'msg' => 'Invalid pin value');
    }

    if (($pinner->real != 0) && ($pinner->real != 1)) {
      $errors[] = array('field' => 'real', 'msg' => 'Invalid value for real');
    }
    
    if (($pinner->pin != "") && ((! is_numeric($pinner->pin)) || ($pinner->pin < 0))) {
      $errors[] = array('field' => 'Pin', 'msg' => 'Invalid value for Pins');
    }
    
    if (($pinner->repin != "") && ((! is_numeric($pinner->repin)) || ($pinner->repin < 0))) {
      $errors[] = array('field' => 'repin', 'msg' => 'Invalid value for Repins');
    }

    if (($pinner->likes != "") && ((! is_numeric($pinner->likes)) || ($pinner->likes < 0))) {
      $errors[] = array('field' => 'likes', 'msg' => 'Invalid value for likes');
    }

    if (($pinner->liked != "") && ((! is_numeric($pinner->liked)) || ($pinner->liked < 0))) {
      $errors[] = array('field' => 'liked', 'msg' => 'Invalid value for liked');
    }
    
    if (($pinner->followers != "") && ((! is_numeric($pinner->followers)) || ($pinner->followers < 0))) {
      $errors[] = array('field' => 'followers', 'msg' => 'Invalid value for followers');
    }
    
    if (($pinner->following != "") && ((! is_numeric($pinner->following)) || ($pinner->following < 0))) {
      $errors[] = array('field' => 'liked', 'msg' => 'Invalid value for following');
    }

    if (($pinner->boards != "") && ((! is_numeric($pinner->boards)) || ($pinner->boards < 0))) {
      $errors[] = array('field' => 'boards', 'msg' => 'Invalid value for boards');
    }

    if (($pinner->comments != "") && ((! is_numeric($pinner->comments)) || ($pinner->comments < 0))) {
      $errors[] = array('field' => 'comments', 'msg' => 'Invalid value for comments');
    }
    
    return $errors;
  }

  public static function validateAdvertiser($user, $advertiser) {
    $errors = self::validate($user);
    
    if (($advertiser->bankAvailable == "") || (! is_numeric($advertiser->bankAvailable)) || ($advertiser->bankAvailable < 0)) {
      $errors[] = array('field' => 'bankAvailable', 'msg' => 'Invalid Bank Available value');
    }
    
    return $errors;
  }
  
  
  private static function validate($user) {
    $errors = array();

    if ($user->username == "") {
      $errors[] = array('field' => 'username', 'msg' => 'Username cannot be empty');
    } else {
      $otherUser = Models\Models_User::getByUsername($user->username);
      if (($otherUser->loaded) && ($otherUser->id != $user->id)) {
        $errors[] = array('field' => 'username', 'msg' => 'Username is already in use!');
      }
    }
    if ($user->email == "") {
      $errors[] = array('field' => 'email', 'msg' => 'Email cannot be empty');
    } elseif (! preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $user->email)) {
        $errors[] = array('field' => 'email', 'msg' => 'Email is invalid');
    } else {
      $otherUser = Models\Models_User::getByEmail($user->email);
      if (($otherUser->loaded) && ($otherUser->id != $user->id)) {
        $errors[] = array('field' => 'email', 'msg' => 'Email is already in use!');
      }
    }
    
    if (($user->bankBalance == "") || (! is_numeric($user->bankBalance)) || ($user->bankBalance < 0)) {
      $errors[] = array('field' => 'bankBalance', 'msg' => 'Invalid Bank Balance');
    }

    return $errors;
  }

}