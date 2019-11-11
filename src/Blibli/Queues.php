<?php

namespace Blibli;

use Blibli\Auths;
use Blibli\Helpers\Rest;

class Queues extends Auths {

    public function __construct(){
        parent::__construct();
    }

    public static function queueList(){
        $uri = '/mtaapi'.(explode('/mta',self::URIqueueList()))[1];
        $signature = self::signature(self::$milisecond,self::$secretKey,'GET','','',$uri);

        $param = [
            'requestId' => self::$channelId."-".self::uuid(),
            'businessPartnerCode' => self::$merchantId,
            'channelId' => self::$channelId,
            'queueDate' => date('Y-m-d'),
            'queueAction' => "",
            'status' => "",
            'page' => 0,
            'size' => 10
        ];
        // merge with request
        $param = self::mergeBody($param);

        Rest::header([
            'x-blibli-mta-authorization' => "BMA ".self::$username.":".$signature,
            'x-blibli-mta-date-milis' => self::$milisecond,
            'Content-Type' => 'application/json',
            'requestId' => self::$channelId."-".self::$uuid,
            'sessionId' => self::$uuid,
            'username' => self::$username
        ]);

        $res = Rest::get(self::URIqueueList(),$param,self::$token->token_type." ".self::$token->access_token);

        if($res['status'] == 200)
            return $res['data'];
        else if($res['status'] == 401){
            self::refreshToken();
            return self::queueList();
        }

        return;
    }

    public static function queueStatus(){
        $uri = '/mtaapi'.(explode('/mta',self::URIqueueStatus()))[1];
        $signature = self::signature(self::$milisecond,self::$secretKey,'GET','','',$uri);

        $param = [
            'requestId' => self::uuid(),
            'channelId' => self::$channelId
        ];
        // merge with request
        $param = self::mergeBody($param);

        Rest::header([
            'x-blibli-mta-authorization' => "BMA ".self::$username.":".$signature,
            'x-blibli-mta-date-milis' => self::$milisecond,
            'Content-Type' => 'application/json',
            'requestId' => self::$channelId."-".self::$uuid,
            'sessionId' => self::$uuid,
            'username' => self::$username
        ]);

        $res = Rest::get(self::URIqueueStatus(),$param,self::$token->token_type." ".self::$token->access_token);

        if($res['status'] == 200)
            return $res['data'];
        else if($res['status'] == 401){
            self::refreshToken();
            return self::queueStatus();
        }

        return;
    }

    public static function queueDetail(){
        $uri = '/mtaapi'.(explode('/mta',self::URIqueueDetail()))[1];
        $signature = self::signature(self::$milisecond,self::$secretKey,'GET','','',$uri);

        $param = [
            'requestId' => self::uuid(),
            'businessPartnerCode' => self::$merchantId,
            'channelId' => self::$channelId
        ];
        // merge with request
        $param = self::mergeBody($param);

        Rest::header([
            'x-blibli-mta-authorization' => "BMA ".self::$username.":".$signature,
            'x-blibli-mta-date-milis' => self::$milisecond,
            'Content-Type' => 'application/json',
            'requestId' => self::$channelId."-".self::$uuid,
            'sessionId' => self::$uuid,
            'username' => self::$username
        ]);

        $res = Rest::get(self::URIqueueDetail(),$param,self::$token->token_type." ".self::$token->access_token);

        if($res['status'] == 200)
            return $res['data'];
        else if($res['status'] == 401){
            self::refreshToken();
            return self::queueDetail();
        }

        return;
    }

}