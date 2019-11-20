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
    public static $uuid;
    public static $milisecond;
    public static $file_token = 'token.json';

    public function __construct($c=null,$u=null,$p=null) {
        parent::__construct();
        date_default_timezone_set("Asia/Jakarta");
        self::$channelId = !is_null($c)?$c:null;
        self::$username = !is_null($u)?$u:null;
        self::$password = !is_null($p)?$p:null;
        self::$uri = parent::domain();
        self::$milisecond = round(microtime(true) * 1000);
        self::$uuid = self::uuid();

        // validate config from ENV
        self::_validateEnv(parent::account());

        if(!self::$channelId && !self::$username && !self::$password) {throw new Exception('Please input BLIBLI_SECRETKEY, BLIBLI_CLIENTID_USERNAME, BLIBLI_CLIENTID_PASSWORD, BLIBLI_MERCHANTID, BLIBLI_CHANNELID, BLIBLI_USERNAME AND BLIBLI_PASSWORD in your ENV file'); return;}
        else
            self::getToken();
    }

    public static function getToken() {
        if(!self::existFile(self::$file_token)){
            $res = Rest::post(parent::URItoken().'?channelId='.self::$channelId, [
                'grant_type' => 'password',
                'username' => self::$username,
                'password' => self::$password
            ],null,['username'=>parent::$clientID,'password'=>parent::$clientPass]);

            self::$token = $res['status'] == 200?$res['data']:null;
            // saving token
            if(!is_null(self::$token))
                self::putFile(self::$file_token,json_encode(self::$token));
        } else {
            self::$token = json_decode(self::getFile(self::$file_token));
            if(!self::$token){
                self::deleteFile(self::$file_token);
                $res = Rest::post(parent::URItoken().'?channelId='.self::$channelId, [
                    'grant_type' => 'password',
                    'username' => self::$username,
                    'password' => self::$password
                ],null,['username'=>parent::$clientID,'password'=>parent::$clientPass]);

                self::$token = $res['status'] == 200?$res['data']:null;
                // saving token
                if(!is_null(self::$token))
                    self::putFile(self::$file_token,json_encode(self::$token));
            }
        }
    }

    public static function refreshToken(){
        $res = Rest::post(parent::URItoken().'?channelId='.self::$channelId, [
            'grant_type' => 'password',
            'client_id' => self::$clientID,
            'refresh_token' => self::$token->refresh_token
        ],null,['username'=>parent::$clientID,'password'=>parent::$clientPass]);

        if($res['status'] == 200){
            self::$token = $res['data'];
            self::putFile(self::$file_token,json_encode(self::$token));
        } else if($res['status'] == 400) {
            if($res['data']->error == 'invalid_grant'){
                self::deleteFile(self::$file_token);
                self::getToken();
            }
        }
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

    public static function signature($milliseconds, $reqSecret, $reqMethod, $reqBody, $reqContentType, $reqUrl){
        $milliseconds = $milliseconds / 1000;

        $patternDate = date("D M d H:i:s T Y", $milliseconds);

        $reqBody = str_replace("\r", "\\r", $reqBody);
        $reqBody = str_replace("\n", "\\n", $reqBody);
        $reqBody = $reqBody != "" ? md5($reqBody) : "";

        $apiKey = $reqMethod . "\n" . trim($reqBody) . "\n" . trim($reqContentType) . "\n" . $patternDate . "\n" .$reqUrl;

        $signature = hash_hmac('sha256', $apiKey, $reqSecret, true);
        $encodedSignature = base64_encode($signature);

        return $encodedSignature;
    }

    public static function uuid() {
        return sprintf( '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ),
            mt_rand( 0, 0xffff ),
            mt_rand( 0, 0x0fff ) | 0x4000,
            mt_rand( 0, 0x3fff ) | 0x8000,
            mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff ), mt_rand( 0, 0xffff )
        );
    }
}