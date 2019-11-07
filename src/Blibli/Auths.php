<?php

namespace Blibli;

use Exception;
use Blibli\Config;
use Blibli\Helpers\Rest;

class Auths extends Config {

    public static $channelId;
    public static $username;
    public static $password;
    public static $uri;
    public static $token;

    public function __construct($c=null,$u=null,$p=null) {
        self::$channelId = !is_null($c)?$c:null;
        self::$username = !is_null($u)?$u:null;
        self::$password = !is_null($p)?$p:null;
        self::$uri = parent::domain();

        // validate config from ENV
        self::_validateEnv(parent::account());

        if(!self::$channelId && !self::$username && !self::$password) {throw new Exception('Please input BLIBLI_CHANNELID, BLIBLI_USERNAME AND BLIBLI_PASSWORD in your ENV file'); return;}
    }

    public function getToken() {
        var_dump(parent::uriToken()."?channelId=".self::$channelId);
        $res = Rest::post(parent::uriToken()."?channelId=".self::$channelId, [
            'username' => self::$username,
            'password' => self::$password,
            'grant_type' => 'password'
        ],'Basic eW91ci1hcGktdXNlcm5hbWU6eW91ci1hcGktcGFzc3dvcmQ=');

        var_dump($res);

        return $this;
    }

    // refer to getUser
    public static function getUsername(){
        return self::getUser();
    }

    public static function getUser() {
        return self::$username;
    }

    private static function _validateEnv($account){
        try{
            if($account){
                self::$channelId = parent::$channelId;
                self::$username = parent::$username;
                self::$password = parent::$password;

                return true;
            } else
                throw new Exception('Your Account are not initiate in ENV');
        } catch(Exception $e){
            return;
        }
    }
}