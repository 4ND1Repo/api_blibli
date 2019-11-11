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

        Rest::header([
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

        Rest::header([
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

    public static function orderDownloadShipping() {
        $uri = '/mtaapi'.(explode('/mta',self::URIorderDownloadShipping()))[1];
        $signature = self::signature(self::$milisecond,self::$secretKey,'GET','','',$uri);

        $param = [
            'requestId' => self::$channelId."-".self::uuid(),
            'channelId' => self::$channelId,
            'storeId' => 10001,
            'orderItemId' => 12039420378
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
        $res = Rest::get(self::URIorderDownloadShipping(),$param,self::$token->token_type." ".self::$token->access_token);

        if($res['status'] == 200)
            return $res['data'];
        else if($res['status'] == 401){
            self::refreshToken();
            return self::orderDownloadShipping();
        }

        return;
    }

    public static function orderAirwayBill() {
        $uri = '/mtaapi'.(explode('/mta',self::URIorderAirwayBill()))[1];
        $signature = self::signature(self::$milisecond,self::$secretKey,'GET','','',$uri);

        $param = [
            'requestId' => self::$channelId."-".self::uuid(),
            'channelId' => self::$channelId,
            'storeId' => 10001,
            'orderItemNo' => 12056279554
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
        $res = Rest::get(self::URIorderAirwayBill(),$param,self::$token->token_type." ".self::$token->access_token);

        if($res['status'] == 200)
            return $res['data'];
        else if($res['status'] == 401){
            self::refreshToken();
            return self::orderAirwayBill();
        }

        return;
    }

    public static function orderCombineShippingList() {
        $uri = '/mtaapi'.(explode('/mta',self::URIorderCombineShippingList()))[1];
        $signature = self::signature(self::$milisecond,self::$secretKey,'GET','','',$uri);

        $param = [
            'businessPartnerCode' => self::$merchantId,
            'requestId' => self::$channelId."-".self::uuid(),
            'channelId' => self::$channelId,
            'storeId' => 10001,
            'orderItemNo' => 12056279554
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
        $res = Rest::get(self::URIorderCombineShippingList(),$param,self::$token->token_type." ".self::$token->access_token);

        if($res['status'] == 200)
            return $res['data'];
        else if($res['status'] == 401){
            self::refreshToken();
            return self::orderCombineShippingList();
        }

        return;
    }

    public static function orderReturnList() {
        $uri = '/mtaapi'.(explode('/mta',self::URIorderReturnList()))[1];
        $signature = self::signature(self::$milisecond,self::$secretKey,'GET','','',$uri);

        $param = [
            'businessPartnerCode' => self::$merchantId,
            'requestId' => self::$channelId."-".self::uuid(),
            'channelId' => self::$channelId,
            'orderIdOrItemId' => 12056279554,
            'returDate' => "",
            'rmaResolution' => "",
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
        $res = Rest::get(self::URIorderReturnList(),$param,self::$token->token_type." ".self::$token->access_token);

        if($res['status'] == 200)
            return $res['data'];
        else if($res['status'] == 401){
            self::refreshToken();
            return self::orderReturnList();
        }

        return;
    }

    public static function orderReturnDetail() {
        $uri = '/mtaapi'.(explode('/mta',self::URIorderReturnDetail()))[1];
        $signature = self::signature(self::$milisecond,self::$secretKey,'GET','','',$uri);

        $param = [
            'businessPartnerCode' => self::$merchantId,
            'requestId' => self::$channelId."-".self::uuid(),
            'channelId' => self::$channelId,
            'rmaId' => "",
            'orderNo' => "",
            'orderItemNo' => 12056279554,
            'storeId' => 10001
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
        $res = Rest::get(self::URIorderReturnDetail(),$param,self::$token->token_type." ".self::$token->access_token);

        if($res['status'] == 200)
            return $res['data'];
        else if($res['status'] == 401){
            self::refreshToken();
            return self::orderReturnDetail();
        }

        return;
    }
}