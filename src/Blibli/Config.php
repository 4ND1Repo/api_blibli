<?php

namespace Blibli;

use Blibli\Auths;

class Config {

    public static $env;
    public static $links = [
        'staging' => 'https://apisandbox.blibli.com',
        'production' => 'https://api.blibli.com',
        'child' => [
            'token' => 'v2/oauth/token',
            'sasCreateOrder' => 'v2/proxy/sas/create-order',
            'sasApprovalOrder' => 'v2/proxy/sas/order-approve',
            'sasApprovalProduct' => 'v2/proxy/sas/product-approve',
            'sasApprovalProductByCode' => 'v2/proxy/sas/product-approve',
            'sasApprovalProductByName' => 'v2/proxy/sas/product-approve-v2',
            'productList' => 'v2/proxy/mta/api/businesspartner/v1/product/getProductSummary',
            'productListV2' => 'v2/proxy/mta/api/businesspartner/v2/product/getProductList',
            'productDetail' => 'v2/proxy/mta/api/businesspartner/v1/product/detailProduct',
            'productCategoryTree' => 'v2/proxy/mta/api/businesspartner/v1/product/getCategory',
            'productCategoryAttribute' => 'v2/proxy/mta/api/businesspartner/v1/product/getCategoryAttributes',
            'productBrand' => 'v2/proxy/mta/api/businesspartner/v1/product/getBrands',
            'productPickupPoint' => 'v2/proxy/mta/api/businesspartner/v1/product/getPickupPoint',
            'productInProcess' => 'v2/proxy/mta/api/businesspartner/v2/product/inProcessProduct',
            'productRejectList' => 'v2/proxy/mta/api/businesspartner/v1/product/rejectedProduct',
            'productRejectListByMerchant' => 'v2/proxy/mta/api/businesspartner/v2/product/rejectedProductByMerchantSku',
            'productHistory' => 'v2/proxy/mta/api/businesspartner/v1/product/history',
            'productUpdate' => 'v2/proxy/mta/api/businesspartner/v1/product/updateProduct',
            'productUpdateItem' => 'v2/proxy/mta/api/businesspartner/v1/product/updateDetailProduct',
            'productCreate' => 'v2/proxy/mta/api/businesspartner/v1/product/createProduct',
            'productCreateV2' => 'v2/proxy/mta/api/businesspartner/v2/product/createProduct',
            'productArchive' => 'v2/proxy/mta/api/businesspartner/v1/product/archive',
            'productUnarchive' => 'v2/proxy/mta/api/businesspartner/v1/product/unarchive',
            'orderList' => 'v2/proxy/mta/api/businesspartner/v1/order/orderList',
            'orderDetail' => 'v2/proxy/mta/api/businesspartner/v1/order/orderDetail',
            'orderDownloadShipping' => 'v2/proxy/mta/api/businesspartner/v1/order/downloadShippingLabel',
            'orderAirwayBill' => 'v2/proxy/mta/api/businesspartner/v1/order/getAirwayBill',
            'orderCombineShippingList' => 'v2/proxy/mta/api/businesspartner/v1/order/getCombineShipping',
            'orderReturnList' => 'v2/proxy/mta/api/businesspartner/v1/order/getReturnedOrderSummary',
            'orderReturnDetail' => 'v2/proxy/mta/api/businesspartner/v1/order/getReturnedOrderDetail',
            'orderCreatePackage' => 'v2/proxy/mta/api/businesspartner/v1/order/createPackage',
            'orderFullfillRegular' => 'v2/proxy/mta/api/businesspartner/v1/order/fulfillRegular',
            'orderFullfillBig' => 'v2/proxy/mta/api/businesspartner/v1/order/fulfillBigProduct',
            'orderFullfillBopis' => 'v2/proxy/mta/api/businesspartner/v1/order/fulfillBopis',
            'orderFullfillPartial' => 'v2/proxy/mta/api/businesspartner/v1/order/partialFulfill',
            'orderUpdateDropship' => 'v2/proxy/mta/api/businesspartner/v1/order/updateDropshipAwb',
            'orderSettle' => 'v2/proxy/mta/api/businesspartner/v1/order/settleOrder',
            'queueList' => 'v2/proxy/mta/api/businesspartner/v1/feed/list',
            'queueStatus' => 'v2/proxy/mta/api/businesspartner/v1/feed/status',
            'queueDetail' => 'v2/proxy/mta/api/businesspartner/v1/feed/detail',
            'discussList' => 'v2/proxy/mta/api/businesspartner/v1/product/discussion/questions',
            'discussAnswer' => 'v2/proxy/mta/api/businesspartner/v1/product/discussion/answers',
            'discussGetAnswer' => 'v2/proxy/mta/api/businesspartner/v1/product/discussion/answers',
            'discussReport' => 'v2/proxy/mta/api/businesspartner/v1/product/discussion/questions',
            'productUploadImage' => 'v2/proxy/mta/api/businesspartner/v2/product/postImage',
            'downloadAirwayBill' => 'v2/proxy/mta/api/businesspartner/v1/order/downloadAirwayBill'
        ]
    ];
    public static $secretKey;
    public static $channelId;
    public static $merchantId;
    public static $username;
    public static $password;
    public static $clientID;
    public static $clientPass;

    public static $bodyParam = [];

    public static function domain($uri=null){
        // set default domain
        self::set_domain();
        // return domain
        return (isset(self::$links[self::$env])?self::$links[self::$env]:self::$links['staging']).($uri?"/".$uri:"");
    }

    public static function set_domain(){
        self::$env = env('BLIBLI_ENV');

        $uri = env('BLIBLI_URI_PRODUCTION');
        $type = env('BLIBLI_URI_PRODUCTION')?"production":null;
        self::_setDomain($type,$uri);

        $uri = env('BLIBLI_URI_STAGING');
        $type = env('BLIBLI_URI_STAGING')?"staging":null;
        self::_setDomain($type,$uri);
    }

    public static function _setDomain($type=null, $uri=null){
        if($uri && $type){
            if(preg_match("/https\:\/\//i", $uri) || preg_match("/http\:\/\//i", $uri)){
                self::$links[$type] = $uri;
            }
        }
    }

    public static function account(){
        if(env('BLIBLI_CHANNELID') && env('BLIBLI_USERNAME') && env('BLIBLI_PASSWORD') && env('BLIBLI_CLIENTID_USERNAME') && env('BLIBLI_CLIENTID_PASSWORD') && env('BLIBLI_SECRETKEY') && env('BLIBLI_MERCHANTID')){
            self::$secretKey = env('BLIBLI_SECRETKEY');
            self::$channelId = env('BLIBLI_CHANNELID');
            self::$username = env('BLIBLI_USERNAME');
            self::$password = env('BLIBLI_PASSWORD');
            self::$clientID = env('BLIBLI_CLIENTID_USERNAME');
            self::$clientPass = env('BLIBLI_CLIENTID_PASSWORD');
            self::$merchantId = env('BLIBLI_MERCHANTID');
            return true;
        } else
            return;
    }

    public static function setBody($p){
        self::$bodyParam = [];
        if(is_array($p) || is_object($p))
            self::$bodyParam = $p;
    }

    public static function mergeBody($body, $p=null){
        if(!is_null($p)){
            if(is_array($p) && is_object($p))
                foreach($p AS $k => $v) {
                    if(isset($body[$k])) $body[$k] = $v;
                }
        } else {
            foreach(self::$bodyParam AS $k => $v) {
                if(isset($body[$k])) $body[$k] = $v;
            }
        }
        return $body;
    }

    // get URI
    public static function URItoken(){ return self::domain(self::$links['child']['token']); }
    public static function URIsasCreateOrder(){ return self::domain(self::$links['child']['sasCreateOrder']); }
    public static function URIsasApprovalOrder(){ return self::domain(self::$links['child']['sasApprovalOrder']); }
    public static function URIsasApprovalProduct(){ return self::domain(self::$links['child']['sasApprovalProduct']); }
    public static function URIsasApprovalProductByName(){ return self::domain(self::$links['child']['sasApprovalProductByName']); }
    public static function URIproductList(){ return self::domain(self::$links['child']['productList']); }
    public static function URIproductListV2(){ return self::domain(self::$links['child']['productListV2']); }
    public static function URIproductDetail(){ return self::domain(self::$links['child']['productDetail']); }
    public static function URIproductCategoryTree(){ return self::domain(self::$links['child']['productCategoryTree']); }
    public static function URIproductCategoryAttribute(){ return self::domain(self::$links['child']['productCategoryAttribute']); }
    public static function URIproductBrand(){ return self::domain(self::$links['child']['productBrand']); }
    public static function URIproductPickupPoint(){ return self::domain(self::$links['child']['productPickupPoint']); }
    public static function URIproductInProcess(){ return self::domain(self::$links['child']['productInProcess']); }
    public static function URIproductRejectList(){ return self::domain(self::$links['child']['productRejectList']); }
    public static function URIproductRejectListByMerchant(){ return self::domain(self::$links['child']['productRejectListByMerchant']); }
    public static function URIproductHistory(){ return self::domain(self::$links['child']['productHistory']); }
    public static function URIproductUpdate(){ return self::domain(self::$links['child']['productUpdate']); }
    public static function URIproductUpdateItem(){ return self::domain(self::$links['child']['productUpdateItem']); }
    public static function URIproductCreate(){ return self::domain(self::$links['child']['productCreate']); }
    public static function URIproductCreateV2(){ return self::domain(self::$links['child']['productCreateV2']); }
    public static function URIproductArchive(){ return self::domain(self::$links['child']['productArchive']); }
    public static function URIproductUnarchive(){ return self::domain(self::$links['child']['productUnarchive']); }
    public static function URIorderList(){ return self::domain(self::$links['child']['orderList']); }
    public static function URIorderDetail(){ return self::domain(self::$links['child']['orderDetail']); }
    public static function URIorderDownloadShipping(){ return self::domain(self::$links['child']['orderDownloadShipping']); }
    public static function URIorderAirwayBill(){ return self::domain(self::$links['child']['orderAirwayBill']); }
    public static function URIorderCombineShippingList(){ return self::domain(self::$links['child']['orderCombineShippingList']); }
    public static function URIorderReturnList(){ return self::domain(self::$links['child']['orderReturnList']); }
    public static function URIorderReturnDetail(){ return self::domain(self::$links['child']['orderReturnDetail']); }
    public static function URIorderCreatePackage(){ return self::domain(self::$links['child']['orderCreatePackage']); }
    public static function URIorderFullfillRegular(){ return self::domain(self::$links['child']['orderFullfillRegular']); }
    public static function URIorderFullfillBig(){ return self::domain(self::$links['child']['orderFullfillBig']); }
    public static function URIorderFullfillBopis(){ return self::domain(self::$links['child']['orderFullfillBopis']); }
    public static function URIorderFullfillPartial(){ return self::domain(self::$links['child']['orderFullfillPartial']); }
    public static function URIorderUpdateDropship(){ return self::domain(self::$links['child']['orderUpdateDropship']); }
    public static function URIorderSettle(){ return self::domain(self::$links['child']['orderSettle']); }
    public static function URIqueueList(){ return self::domain(self::$links['child']['queueList']); }
    public static function URIqueueStatus(){ return self::domain(self::$links['child']['queueStatus']); }
    public static function URIqueueDetail(){ return self::domain(self::$links['child']['queueDetail']); }
    public static function URIdiscussList(){ return self::domain(self::$links['child']['discussList']); }
    public static function URIdiscussAnswer(){ return self::domain(self::$links['child']['discussAnswer']); }
    public static function URIdiscussGetAnswer(){ return self::domain(self::$links['child']['discussGetAnswer']); }
    public static function URIdiscussReport(){ return self::domain(self::$links['child']['discussReport']); }
    public static function URIproductUploadImage(){ return self::domain(self::$links['child']['productUploadImage']); }
    public static function URIdownloadAirwayBill(){ return self::domain(self::$links['child']['downloadAirwayBill']); }

}