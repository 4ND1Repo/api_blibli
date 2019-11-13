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

    public static function orderCreatePackage() {
        $uri = '/mtaapi'.(explode('/mta',self::URIorderCreatePackage()))[1];

        $param = [
            'raw' => [
                "orderItemIds" => [
                    "25000025943",
                    "25000025942"
                ]
            ]
        ];
        // merge with request
        $param['raw'] = self::mergeBody($param['raw']);
        $signature = self::signature(self::$milisecond,self::$secretKey,'POST',json_encode($param['raw']),'application/json',$uri);

        Rest::header([
            'x-blibli-mta-authorization' => "BMA ".self::$username.":".$signature,
            'x-blibli-mta-date-milis' => self::$milisecond,
            'Content-Type' => 'application/json',
            'requestId' => self::$channelId."-".self::$uuid,
            'sessionId' => self::$uuid,
            'username' => self::$username
        ]);
        $url = "?requestId=".self::$channelId."-".self::$uuid.
            "&businessPartnerCode=".self::$merchantId.
            "&channelId=".self::$channelId.
            "&storeId=10001";
        $res = Rest::post(self::URIorderCreatePackage().$url,$param,self::$token->token_type." ".self::$token->access_token);

        if($res['status'] == 200)
            return $res['data'];
        else if($res['status'] == 401){
            self::refreshToken();
            return self::orderCreatePackage();
        }

        return;
    }

    public static function orderFullfillRegular() {
        $uri = '/mtaapi'.(explode('/mta',self::URIorderFullfillRegular()))[1];

        $param = [
            'raw' => [
                "type" => 1,
                "awbNo" => "only for dropship fulfillment, sample value => 12345678910",
                "orderNo" => "25000087062",
                "orderItemNo" => "25000102616",
                "combineShipping" => [
                    [
                        "orderNo" => "25000087062",
                        "orderItemNo" => "25000102616"
                    ]
                ]
            ]
        ];
        // merge with request
        $param['raw'] = self::mergeBody($param['raw']);
        $signature = self::signature(self::$milisecond,self::$secretKey,'POST',json_encode($param['raw']),'application/json',$uri);

        Rest::header([
            'x-blibli-mta-authorization' => "BMA ".self::$username.":".$signature,
            'x-blibli-mta-date-milis' => self::$milisecond,
            'Content-Type' => 'application/json',
            'requestId' => self::$channelId."-".self::$uuid,
            'sessionId' => self::$uuid,
            'username' => self::$username
        ]);
        $url = "?requestId=".self::$channelId."-".self::$uuid.
            "&channelId=".self::$channelId.
            "&storeId=10001";
        $res = Rest::post(self::URIorderFullfillRegular().$url,$param,self::$token->token_type." ".self::$token->access_token);

        if($res['status'] == 200)
            return $res['data'];
        else if($res['status'] == 401){
            self::refreshToken();
            return self::orderFullfillRegular();
        }

        return;
    }

    public static function orderFullfillBig() {
        $uri = '/mtaapi'.(explode('/mta',self::URIorderFullfillBig()))[1];

        $param = [
            'raw' => [
                "orderItemId" => "25000026164",
                "itemSkuCode" => "TOS-16005-00001-00001",
                "settlementCode" => "4567",
                "isDeliveredByMerchant" => true,
                "merchantCourier" => "Merchant courier name",
                "merchantCourierType" => "Merchant courier",
                "merchantDeliveryDateStart" => 1479166599946,
                "merchantDeliveryDateEnd" => 1479166599946,
                "isInstallationRequired" => true,
                "merchantInstallationDateStart" => 1479166599946,
                "merchantInstallationDateEnd" => 1479166599946,
                "merchantInstallationOfficer" => "Agung Prasetyo",
                "merchantInstallationMobile" => "085456987123",
                "merchantInstallationNote" => "Please handle with care"
            ]
        ];
        // merge with request
        $param['raw'] = self::mergeBody($param['raw']);
        $signature = self::signature(self::$milisecond,self::$secretKey,'POST',json_encode($param['raw']),'application/json',$uri);

        Rest::header([
            'x-blibli-mta-authorization' => "BMA ".self::$username.":".$signature,
            'x-blibli-mta-date-milis' => self::$milisecond,
            'Content-Type' => 'application/json',
            'requestId' => self::$channelId."-".self::$uuid,
            'sessionId' => self::$uuid,
            'username' => self::$username
        ]);
        $url = "?requestId=".self::$channelId."-".self::$uuid.
            "&channelId=".self::$channelId.
            "&storeId=10001";
        $res = Rest::post(self::URIorderFullfillBig().$url,$param,self::$token->token_type." ".self::$token->access_token);

        if($res['status'] == 200)
            return $res['data'];
        else if($res['status'] == 401){
            self::refreshToken();
            return self::orderFullfillBig();
        }

        return;
    }

    public static function orderFullfillBopis() {
        $uri = '/mtaapi'.(explode('/mta',self::URIorderFullfillBopis()))[1];

        $param = [
            'raw' => [
                "orderItemId" => "25000025943",
  	            "itemSkuCode" => "TOQ-15130-00001-00001"
            ]
        ];
        // merge with request
        $param['raw'] = self::mergeBody($param['raw']);
        $signature = self::signature(self::$milisecond,self::$secretKey,'POST',json_encode($param['raw']),'application/json',$uri);

        Rest::header([
            'x-blibli-mta-authorization' => "BMA ".self::$username.":".$signature,
            'x-blibli-mta-date-milis' => self::$milisecond,
            'Content-Type' => 'application/json',
            'requestId' => self::$channelId."-".self::$uuid,
            'sessionId' => self::$uuid,
            'username' => self::$username
        ]);
        $url = "?requestId=".self::$channelId."-".self::$uuid.
            "&channelId=".self::$channelId.
            "&storeId=10001";
        $res = Rest::post(self::URIorderFullfillBopis().$url,$param,self::$token->token_type." ".self::$token->access_token);

        if($res['status'] == 200)
            return $res['data'];
        else if($res['status'] == 401){
            self::refreshToken();
            return self::orderFullfillBopis();
        }

        return;
    }

    public static function orderFullfillPartial() {
        $uri = '/mtaapi'.(explode('/mta',self::URIorderFullfillPartial()))[1];

        $param = [
            'raw' => [
                "orderNo" => "25000013286",
                "orderItemNo" => "25000013313",
                "completeQuantity" => 0,
                "reason" => "Out of stock reason"
            ]
        ];
        // merge with request
        $param['raw'] = self::mergeBody($param['raw']);
        $signature = self::signature(self::$milisecond,self::$secretKey,'POST',json_encode($param['raw']),'application/json',$uri);

        Rest::header([
            'x-blibli-mta-authorization' => "BMA ".self::$username.":".$signature,
            'x-blibli-mta-date-milis' => self::$milisecond,
            'Content-Type' => 'application/json',
            'requestId' => self::$channelId."-".self::$uuid,
            'sessionId' => self::$uuid,
            'username' => self::$username
        ]);
        $url = "?requestId=".self::$channelId."-".self::$uuid.
            "&channelId=".self::$channelId.
            "&storeId=10001";
        $res = Rest::post(self::URIorderFullfillPartial().$url,$param,self::$token->token_type." ".self::$token->access_token);

        if($res['status'] == 200)
            return $res['data'];
        else if($res['status'] == 401){
            self::refreshToken();
            return self::orderFullfillPartial();
        }

        return;
    }

    public static function orderUpdateDropship() {
        $uri = '/mtaapi'.(explode('/mta',self::URIorderUpdateDropship()))[1];

        $param = [
            'businessPartnerCode' => self::$merchantId,
            'requestId' => self::$channelId."-".self::uuid(),
            'channelId' => self::$channelId,
            'storeId' => 10001,
            'awbNo' => "",
            'orderNo' => "",
            'orderItemNo' => 12056279554
        ];
        // merge with request
        $param['raw'] = self::mergeBody($param['raw']);
        $signature = self::signature(self::$milisecond,self::$secretKey,'GET','','',$uri);

        Rest::header([
            'x-blibli-mta-authorization' => "BMA ".self::$username.":".$signature,
            'x-blibli-mta-date-milis' => self::$milisecond,
            'Content-Type' => 'application/json',
            'requestId' => self::$channelId."-".self::$uuid,
            'sessionId' => self::$uuid,
            'username' => self::$username
        ]);
        $res = Rest::get(self::URIorderUpdateDropship(),$param,self::$token->token_type." ".self::$token->access_token);

        if($res['status'] == 200)
            return $res['data'];
        else if($res['status'] == 401){
            self::refreshToken();
            return self::orderUpdateDropship();
        }

        return;
    }

    public static function orderSettle() {
        $uri = '/mtaapi'.(explode('/mta',self::URIorderSettle()))[1];

        $param = [
            'raw' => [
                "type" => 2,
                "orderNo" => "15000026173",
                "orderItemNo" => "25000026173",
                "deliveredDate" => 1500023472449,
                "recipientName" => "argo triwidodo",
                "recipientStatus" => "friend"
            ]
        ];
        // merge with request
        $param['raw'] = self::mergeBody($param['raw']);
        $signature = self::signature(self::$milisecond,self::$secretKey,'POST',json_encode($param['raw']),'application/json',$uri);

        Rest::header([
            'x-blibli-mta-authorization' => "BMA ".self::$username.":".$signature,
            'x-blibli-mta-date-milis' => self::$milisecond,
            'Content-Type' => 'application/json',
            'requestId' => self::$channelId."-".self::$uuid,
            'sessionId' => self::$uuid,
            'username' => self::$username
        ]);
        $url = "?requestId=".self::$channelId."-".self::$uuid.
            "&businessPartnerCode=".self::$merchantId.
            "&channelId=".self::$channelId.
            "&storeId=10001";
        $res = Rest::post(self::URIorderSettle().$url,$param,self::$token->token_type." ".self::$token->access_token);

        if($res['status'] == 200)
            return $res['data'];
        else if($res['status'] == 401){
            self::refreshToken();
            return self::orderSettle();
        }

        return;
    }

    // Obsolete API
    public static function downloadAirwayBill() {
        $uri = '/mtaapi'.(explode('/mta',self::URIdownloadAirwayBill()))[1];
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
        $res = Rest::get(self::URIdownloadAirwayBill(),$param,self::$token->token_type." ".self::$token->access_token);

        if($res['status'] == 200)
            return $res['data'];
        else if($res['status'] == 401){
            self::refreshToken();
            return self::downloadAirwayBill();
        }

        return;
    }

}