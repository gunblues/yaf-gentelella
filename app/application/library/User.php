<?php

class User
{
	static public $started = false;
    static public $defaultPhotoURL = "/assets/images/Mike.ico";

    static private function init() {
        if(self::$started === false) {
            session_start();
            self::$started = true;
        }
    }

    static public function cleanData() {
        self::init();
        if (self::isLoggedIn()) {
            session_destroy();
        }
    }

    static public function isLoggedIn() { 
        self::init();

        return self::getUserData() !== false;
    }

    static public function getUserData() {
        self::init();

        if(isset($_SESSION['user']['sig'])
            && isset($_SESSION['user']['sn'])
            && isset($_SESSION['user']['sid'])
            && md5($_SERVER['HTTP_USER_AGENT'].$_SESSION['user']['sid']) == $_SESSION['user']['sig']
        ){
            return $_SESSION['user'];
        }

        return false;
    }

    static public function addUser($sn, $userProfile) { //{{{
		self::init();

        if (!isset($_SESSION['initialed'])) {
            session_regenerate_id();
            $_SESSION['initialed'] = true;
        }

        $_SESSION['user'] = array(
            "sn" => $sn,
            "sid" => $userProfile->identifier,
            "sig" => md5($_SERVER['HTTP_USER_AGENT'].$userProfile->identifier),
            "displayName" => $userProfile->displayName,
            "photoURL" => ($userProfile->photoURL ? $userProfile->photoURL : self::$defaultPhotoURL),
            "email" => $userProfile->email,
            "role" => "user",
        );

    } //}}}

    static public function getGuestData() { //{{{
        return array(
            "displayName" => "Guest",
            "photoURL" => self::$defaultPhotoURL,
            "email" => null,
            "role" => "guest",
        );
    } //}}}
}

// vim: expandtab softtabstop=4 tabstop=4 shiftwidth=4 ts=4 sw=4
