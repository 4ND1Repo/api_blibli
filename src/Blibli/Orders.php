<?php

namespace Blibli;

use Blibli\Auths;
use Blibli\Helpers\Rest;

class Orders extends Auths {

    public function __construct(){
        parent::__construct();
    }

    public static function orderList(){
        $uri = '/mtaapi'.(explode('/mta',self::URIorderList()))[1];
        $signature = self::signature(self::$milisecond,self::$secretKey,'GET','','',$uri);

        $param = [
            'requestId' => self::$channelId."-".self::uuid(),
            'businessPartnerCode' => self::$merchantId,
            'channelId' => self::$channelId,
            'storeId' => 10001,
            'productTypeCode' => 1,
            'status' => "",
            'logisticCode' => "",
            'orderDate' => "",
            'page' => 0,
            'size' => 10,
            'filterStartDate' => "",
            'filterEndDate' => "",
            'orderBy' => "statusFPUpdatedTimestamp",
            'sortBy' => "desc"
        ];
        // merge with request
        $param = self::mergeBody($param);

        $res = Rest::header([
            'x-blibli-mta-authorization' => "BMA ".self::$username.":".$signature,
            'x-blibli-mta-date-milis' => self::$milisecond,
            'Content-Type' => 'application/json',
            'requestId' => self::$channelId."-".self::$uuid,
            'sessionId' => self::$uuid,
            'username' => self::$username
        ]);
        $res = Rest::get(self::URIorderList(),$param,self::$token->token_type." ".self::$token->access_token);

        if($res['status'] == 200)
            return $res['data'];
        else if($res['status'] == 401){
            self::refreshToken();
            return self::orderList();
        }

        return;
    }

    public static function orderDetail() {
        $uri = '/mtaapi'.(explode('/mta',self::URIorderDetail()))[1];
        $signature = self::signature(self::$milisecond,self::$secretKey,'GET','','',$uri);

        $param = [
            'requestId' => self::$channelId."-".self::uuid(),
            'channelId' => self::$channelId,
            'storeId' => 10001,
            'orderNo' => 12039420378,
            'orderItemNo' => 12056279554
        ];
        // merge with request
        $param = self::mergeBody($param);

        $res = Rest::header([
            'x-blibli-mta-authorization' => "BMA ".self::$username.":".$signature,
            'x-blibli-mta-date-milis' => self::$milisecond,
            'Content-Type' => 'application/json',
            'requestId' => self::$channelId."-".self::$uuid,
            'sessionId' => self::$uuid,
            'username' => self::$username
        ]);
        $res = Rest::get(self::URIorderDetail(),$param,self::$token->token_type." ".self::$token->access_token);

        if($res['status'] == 200)
            return $res['data'];
        else if($res['status'] == 401){
            self::refreshToken();
            return self::orderDetail();
        }

        return;
    }
}