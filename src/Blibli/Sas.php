<?php

namespace Blibli;

use Blibli\Auths;

class Sas extends Auths {

    public function __construct(){
        parent::__construct();
    }

    public static function sasReqToken(){
        $param = [
            'grant_type' => 'client_credentials'
        ];
        $res = Rest::post(self::URItoken(),$param,self::$token->token_type." ".self::$token->access_token);
    }

    public static function sasCreateOrder(){
        $param = [
            'raw' => [
                "merchantCode" =>"AAA-60001",
                "items" => [
                    [
                        "itemSku" => "AAA-60001-00001-00001",
                        "quantity" => 1
                    ]
                ]
            ]
        ];
        $res = Rest::header([
            'Content-Type' => 'application/json',
            'requestId' => self::$uuid,
            'sessionId' => self::$uuid,
            'username' => self::$username
        ]);
        $res = Rest::post(self::URIsasCreateOrder(),$param,self::$token->token_type." ".self::$token->access_token);
    }

    public static function sasApprovalOrder() {
        $param = [
            'raw' => [
                "orderIdList" => ["123456"]
            ]
        ];
        $res = Rest::header([
            'Content-Type' => 'application/json',
            'requestId' => self::$uuid,
            'sessionId' => self::$uuid,
            'username' => self::$username
        ]);
        $res = Rest::post(self::URIsasApprovalOrder(),$param,self::$token->token_type." ".self::$token->access_token);
    }

    public static function sasApprovalProductByCode(){
        $param = [
            'raw' => [
                "productCodes" => ["MTA-0315456"]
            ]
        ];
        $res = Rest::header([
            'Content-Type' => 'application/json',
            'requestId' => self::$uuid,
            'sessionId' => self::$uuid,
            'username' => self::$username
        ]);
        $res = Rest::post(self::URIsasApprovalOrderByCode(),$param,self::$token->token_type." ".self::$token->access_token);
    }

    public static function sasApprovalProductByName(){
        $param = [
            'raw' => [
                "businessPartnerCode" => "TOQ-15130",
	            "productNames" => ["Automation 2019-06-13 14:23:10"]
            ]
        ];
        $res = Rest::header([
            'Content-Type' => 'application/json',
            'requestId' => self::$uuid,
            'sessionId' => self::$uuid,
            'username' => self::$username
        ]);
        $res = Rest::post(self::URIsasApprovalOrderByName(),$param,self::$token->token_type." ".self::$token->access_token);
    }
}