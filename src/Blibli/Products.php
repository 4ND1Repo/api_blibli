<?php

namespace Blibli;

use Blibli\Auths;
use Blibli\Helpers\Rest;

class Products extends Auths {

    public function __construct(){
        parent::__construct();
    }

    public static function productList(){
        $uri = '/mtaapi'.(explode('/mta',self::URIproductList()))[1];
        $signature = self::signature(self::$milisecond,self::$secretKey,'GET','','',$uri);

        $param = [
            'requestId' => self::$channelId."-".self::uuid(),
            'businessPartnerCode' => self::$merchantId,
            'gdnSku' => '',
            'productName' => '',
            'categoryCode' => '',
            'salePrice' => '',
            'pickupPointCode' => '',
            'page' => '0',
            'size' => '50'
        ];
        // merge with request
        $param = self::mergeBody($param);

        $res = Rest::header([
            'x-blibli-mta-authorization' => "BMA ".self::$username.":".$signature,
            'x-blibli-mta-date-milis' => self::$milisecond,
            'Content-Type' => 'application/json',
            'requestId' => self::$uuid,
            'sessionId' => self::$uuid,
            'username' => self::$username
        ]);
        $res = Rest::get(self::URIproductList(),$param,self::$token->token_type." ".self::$token->access_token);

        if($res['status'] == 200)
            return $res['data'];

        return;
    }

    public static function productListV2(){
        $param = [
            'raw' => [
                "gdnSku" => "",
                "merchantSkus" => [], //max 50 items
                "productName" => "",
                "categoryCode" => "",
                "pickupPointCode" => "",
                "displayable" => true,
                "buyable" => true,
                "isArchive" => false,
                "page" => 0, 
                "size" => 10
            ]
        ];
        // merge with request
        $param['raw'] = self::mergeBody($param['raw']);

        $uri = '/mtaapi'.(explode('/mta',self::URIproductListV2()))[1];
        $signature = self::signature(self::$milisecond,self::$secretKey,'POST',json_encode($param['raw']),"application/json",$uri);

        $res = Rest::header([
            'x-blibli-mta-authorization' => "BMA ".self::$username.":".$signature,
            'x-blibli-mta-date-milis' => self::$milisecond,
            'Content-Type' => 'application/json',
            'requestId' => self::$channelId."-".self::$uuid,
            'sessionId' => self::$uuid,
            'username' => self::$username
        ]);

        $url = "?requestId=".self::$channelId."-".self::$uuid.
            "&businessPartnerCode=".self::$merchantId.
            "&username=".self::$username.
            "&channelId=".self::$channelId;
        $res = Rest::post(self::URIproductListv2().$url,$param,self::$token->token_type." ".self::$token->access_token);

        if($res['status'] == 200)
            return $res['data'];

        return;
    }

    public static function productDetail(){
        $uri = '/mtaapi'.(explode('/mta',self::URIproductDetail()))[1];
        $signature = self::signature(self::$milisecond,self::$secretKey,'GET','','',$uri);

        $param = [
            'requestId' => self::$channelId."-".self::uuid(),
            'businessPartnerCode' => self::$merchantId,
            'gdnSku' => 'PTK-60110-00079-00001',
            'channelId' => self::$channelId
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
        $res = Rest::get(self::URIproductDetail(),$param,self::$token->token_type." ".self::$token->access_token);

        if($res['status'] == 200)
            return $res['data'];

        return;
    }

    public static function productCategoryTree(){
        $uri = '/mtaapi'.(explode('/mta',self::URIproductCategoryTree()))[1];
        $signature = self::signature(self::$milisecond,self::$secretKey,'GET','','',$uri);

        $param = [
            'requestId' => self::$channelId."-".self::uuid(),
            'businessPartnerCode' => self::$merchantId,
            'channelId' => self::$channelId
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
        $res = Rest::get(self::URIproductCategoryTree(),$param,self::$token->token_type." ".self::$token->access_token);

        if($res['status'] == 200)
            return $res['data'];

        return;
    }

    public static function productCategoryAttribute(){
        $uri = '/mtaapi'.(explode('/mta',self::URIproductCategoryAttribute()))[1];
        $signature = self::signature(self::$milisecond,self::$secretKey,'GET','','',$uri);

        $param = [
            'requestId' => self::$channelId."-".self::uuid(),
            'businessPartnerCode' => self::$merchantId,
            'categoryCode' => 'BL-1000030',
            'channelId' => self::$channelId
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
        $res = Rest::get(self::URIproductCategoryAttribute(),$param,self::$token->token_type." ".self::$token->access_token);

        if($res['status'] == 200)
            return $res['data'];

        return;
    }

    public static function productBrand(){
        $uri = '/mtaapi'.(explode('/mta',self::URIproductBrand()))[1];
        $signature = self::signature(self::$milisecond,self::$secretKey,'GET','','',$uri);

        $param = [
            'requestId' => self::$channelId."-".self::uuid(),
            'businessPartnerCode' => self::$merchantId,
            'masterCategoryCode' => 'BL-1000030',
            'brands' => "",
            'channelId' => self::$channelId,
            'page' => 0,
            'size' => 10
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
        $res = Rest::get(self::URIproductBrand(),$param,self::$token->token_type." ".self::$token->access_token);

        if($res['status'] == 200)
            return $res['data'];

        return;
    }

    public static function productPickupPoint(){
        $uri = '/mtaapi'.(explode('/mta',self::URIproductPickupPoint()))[1];
        $signature = self::signature(self::$milisecond,self::$secretKey,'GET','','',$uri);

        $param = [
            'requestId' => self::$channelId."-".self::uuid(),
            'businessPartnerCode' => self::$merchantId,
            'channelId' => self::$channelId
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
        $res = Rest::get(self::URIproductPickupPoint(),$param,self::$token->token_type." ".self::$token->access_token);

        if($res['status'] == 200)
            return $res['data'];

        return;
    }

    public static function productInProcess(){
        $uri = '/mtaapi'.(explode('/mta',self::URIproductInProcess()))[1];
        $signature = self::signature(self::$milisecond,self::$secretKey,'GET','','',$uri);

        $param = [
            'requestId' => self::$channelId."-".self::uuid(),
            'businessPartnerCode' => self::$merchantId,
            'channelId' => self::$channelId,
            'page' => 0,
            'size' => 10
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
        $res = Rest::get(self::URIproductInProcess(),$param,self::$token->token_type." ".self::$token->access_token);

        if($res['status'] == 200)
            return $res['data'];

        return;
    }

    public static function productRejectList(){
        $uri = '/mtaapi'.(explode('/mta',self::URIproductRejectList()))[1];
        $signature = self::signature(self::$milisecond,self::$secretKey,'GET','','',$uri);

        $param = [
            'requestId' => self::$channelId."-".self::uuid(),
            'businessPartnerCode' => self::$merchantId,
            'channelId' => self::$channelId,
            'page' => 0,
            'size' => 10
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
        $res = Rest::get(self::URIproductRejectList(),$param,self::$token->token_type." ".self::$token->access_token);

        if($res['status'] == 200)
            return $res['data'];

        return;
    }

    public static function productRejectListByMerchant(){
        $uri = '/mtaapi'.(explode('/mta',self::URIproductRejectListByMerchant()))[1];
        $signature = self::signature(self::$milisecond,self::$secretKey,'GET','','',$uri);

        $param = [
            'requestId' => self::$channelId."-".self::uuid(),
            'businessPartnerCode' => self::$merchantId,
            'channelId' => self::$channelId,
            'merchantSku' => "",
            'username' => self::$username,
            'storeId' => 10001
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
        $res = Rest::get(self::URIproductRejectListByMerchant(),$param,self::$token->token_type." ".self::$token->access_token);

        if($res['status'] == 200)
            return $res['data'];

        return;
    }

    public static function productHistory(){
        $uri = '/mtaapi'.(explode('/mta',self::URIproductHistory()))[1];
        $signature = self::signature(self::$milisecond,self::$secretKey,'GET','','',$uri);

        $param = [
            'requestId' => self::$channelId."-".self::uuid(),
            'businessPartnerCode' => self::$merchantId,
            'username' => self::$username,
            'storeId' => 10001,
            'gdnSku' => "PTK-60110-00079-00001",
            'page' => 0,
            'size' => 10
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
        $res = Rest::get(self::URIproductHistory(),$param,self::$token->token_type." ".self::$token->access_token);

        if($res['status'] == 200)
            return $res['data'];

        return;
    }

    public static function productUpdate(){
        $param = [
            'raw' => [
                "merchantCode" => "TOQ-15126",
                "productRequests" => [
                    [
                        "gdnSku" => "TOQ-15126-00411-00001",
                        "stock" => 20,
                        "minimumStock" => 1,
                        "price" => 20000,
                        "salePrice" => 15000,
                        "buyable" => true,
                        "displayable" => false
                    ],
                    [
                        "gdnSku" => "TOQ-15126-00411-00001",
                        "stock" => -5,
                        "minimumStock" => 1,
                        "price" => null,
                        "salePrice" => null,
                        "buyable" => null,
                        "displayable" => null
                    ]
                ]
            ]
        ];
        // merge with request
        $param['raw'] = self::mergeBody($param['raw']);

        $uri = '/mtaapi'.(explode('/mta',self::URIproductUpdate()))[1];
        $signature = self::signature(self::$milisecond,self::$secretKey,'POST',json_encode($param['raw']),"application/json",$uri);

        $res = Rest::header([
            'x-blibli-mta-authorization' => "BMA ".self::$username.":".$signature,
            'x-blibli-mta-date-milis' => self::$milisecond,
            'Content-Type' => 'application/json',
            'requestId' => self::$channelId."-".self::$uuid,
            'sessionId' => self::$uuid,
            'username' => self::$username
        ]);

        $url = "?channelId=".self::$channelId;
        $res = Rest::post(self::URIproductUpdate().$url,$param,self::$token->token_type." ".self::$token->access_token);

        if($res['status'] == 200)
            return $res['data'];

        return;
    }

    public static function productUpdateItem(){
        $param = [
            'raw' => [
                "merchantCode" => "TOS-16005",
                "productDetailRequests" => [
                    [
                        "productSku" => "TOS-16005-00009",
                        "productCode" => "MTA-0306263",
                        "businessPartnerCode" => "TOS-16005",
                        "synchronize" => false,
                        "productName" => "Merchant Product",
                        "productType" => 1,
                        "categoryCode" => "10249",
                        "categoryName" => "Android",
                        "categoryHierarchy" => "Handphone & Tablet > Handphone > Android",
                        "brand" => "Samsung",
                        "description" => "<p>Product description </p>",
                        "specificationDetail" => "<ul><li>Outlet<ul><li>Jakarta Pusat - Plaza Indonesia</li></ul></ul>",
                        "uniqueSellingPoint" => "<p>product unique selling point</p>",
                        "productStory" => "<p>This product is release at 26 Des 2016</p>",
                        "items" => [
                            [
                                "itemSku" => "TOS-16005-00009-00001",
                                "skuCode" => "MTA-0306263-00001",
                                "merchantSku" => "MY-SKU-001",
                                "upcCode" => "1231230010123",
                                "itemName" => "Merchant Product Jakarta Pusat - Plaza Indonesia Black",
                                "length" => 1,
                                "width" => 2,
                                "height" => 1,
                                "weight" => 0.01,
                                "shippingWeight" => 0.02,
                                "dangerousGoodsLevel" => 0,
                                "lateFulfillment" => true,
                                "pickupPointCode" => "PP-3000408",
                                "pickupPointName" => "Haneda Store",
                                "deltaStock" => 0,
                                "synchronizeStock" => false,
                                "prices" => [
                                    [
                                        "channelId" => "DEFAULT",
                                        "price" => 10000,
                                        "salePrice" => 8000,
                                        "discountAmount" => null,
                                        "discountStartDate" => null,
                                        "discountEndDate" => null,
                                        "promotionName" => null
                                    ]
                                ],
                                "viewConfigs" => [
                                    [
                                        "channelId" => "DEFAULT",
                                        "display" => true,
                                        "buyable" => true
                                    ]
                                ],
                                "images" => [
                                    [
                                        "mainImage" => true,
                                        "sequence" => 0,
                                        "locationPath" => "/535/samsung_merchant-product_full01.jpg"
                                    ],
                                    [
                                        "mainImage" => false,
                                        "sequence" => 1,
                                        "locationPath" => "/534/samsung_merchant-product_full02.jpg"
                                    ]
                                ],
                                "off2OnActiveFlag" => false
                            ]
                        ],
                        "attributes" => [
                            [
                                "attributeCode" => "BR-M036969",
                                "attributeType" => "PREDEFINED_ATTRIBUTE",
                                "values" => [
                                    "Samsung"
                                ],
                                "skuValue" => false,
                                "attributeName" => "Brand",
                                "itemSku" => null
                            ],
                            [
                                "attributeCode" => "KA-0000001",
                                "attributeType" => "DESCRIPTIVE_ATTRIBUTE",
                                "values" => [
                                    "4 MP"
                                ],
                                "skuValue" => false,
                                "attributeName" => "Kamera",
                                "itemSku" => null
                            ]
                        ],
                        "images" => [
                            [
                                "mainImage" => true,
                                "sequence" => 0,
                                "locationPath" => "/535/samsung_merchant-product_full01.jpg"
                            ],
                            [
                                "mainImage" => false,
                                "sequence" => 1,
                                "locationPath" => "/534/samsung_merchant-product_full02.jpg"
                            ]
                        ],
                        "url" => "https://www.youtube.com/merchant-video",
                        "installationRequired" => false
                    ]
                ]
            ]
        ];
        // merge with request
        $param['raw'] = self::mergeBody($param['raw']);

        $uri = '/mtaapi'.(explode('/mta',self::URIproductUpdateItem()))[1];
        $signature = self::signature(self::$milisecond,self::$secretKey,'POST',json_encode($param['raw']),"application/json",$uri);

        $res = Rest::header([
            'x-blibli-mta-authorization' => "BMA ".self::$username.":".$signature,
            'x-blibli-mta-date-milis' => self::$milisecond,
            'Content-Type' => 'application/json',
            'requestId' => self::$channelId."-".self::$uuid,
            'sessionId' => self::$uuid,
            'username' => self::$username
        ]);

        $url = "?channelId=".self::$channelId;
        $res = Rest::post(self::URIproductUpdateItem().$url,$param,self::$token->token_type." ".self::$token->access_token);

        if($res['status'] == 200)
            return $res['data'];

        return;
    }

    public static function productCreateV2(){
        $param = [
            'raw' => [
                "name" => "Samsung Galaxy S9 API.1",
                "brand" => "Samsung",
                "url" => "youtube.com",
                "categoryCode" => "10249",
                "productType" => 1,
                "pickupPointCode" => "PP-3000188",
                "length" => 10,
                "width" => 10,
                "height" => 10,
                "weight" => 100,
                "description" => "eyJBdXRob3JpemF0aW9uIiA6ICJ7YmFzaWMuYXV0aH0iLCJDb250ZW50LVR5cGUiIDogImFwcGxpY2F0aW9uL3gtd3d3LWZvcm0tdXJsZW5jb2RlZCIsIkFjY2VwdCIgOiAiYXBwbGljYXRpb24vanNvbiJ9",
                "uniqueSellingPoint" => "eyJBdXRob3JpemF0aW9uIiA6ICJ7YmFzaWMuYXV0aH0iLCJDb250ZW50LVR5cGUiIDogImFwcGxpY2F0aW9uL3gtd3d3LWZvcm0tdXJsZW5jb2RlZCIsIkFjY2VwdCIgOiAiYXBwbGljYXRpb24vanNvbiJ9",
                "productStory" => "eyJBdXRob3JpemF0aW9uIiA6ICJ7YmFzaWMuYXV0aH0iLCJDb250ZW50LVR5cGUiIDogImFwcGxpY2F0aW9uL3gtd3d3LWZvcm0tdXJsZW5jb2RlZCIsIkFjY2VwdCIgOiAiYXBwbGljYXRpb24vanNvbiJ9",
                "productNonDefiningAttributes" => [
                    "GA-0036802" => "1 tahun garansi",
                    "CH-0036989" => "snapdragon",
                    "SL-0037089" => "64 GB",
                    "ME-0036591" => "16 GB",
                    "UK-0036791" => "6 inch",
                    "SI-0036984" => "dual sim card",
                    "OP-0036593" => "android oreo",
                    "ME-M000001" => "164 GB",
                    "KA-0037042" => "50000 mAh",
                    "KA-0000001" => "32 px"
                ],
                "productDefiningAttributes" => [
                    "WA-M000319" => ["Black", "Blue"],
                    "OU-2000004" => ["Bali - Lippo Plaza Sunset"]
                ],
                "productItems" => [
                    [  
                        "upcCode" => "upc 1",
                        "merchantSku" => "sku black",
                        "price" => "100000",
                        "salePrice" => 150000,
                        "stock" => 5,
                        "minimumStock" => 1,
                        "displayable" => false,
                        "buyable" => false,
                        "images" => ["image-1"],
                        "dangerousGoodsLevel" => 0,
                        "attributesMap" => [
                        "WA-M000319" => "Black",
                        "OU-2000004" => "Bali - Lippo Plaza Sunset"
                        ]
                    ],
                    [  
                        "upcCode" => "upc 2",
                        "merchantSku" => "sku blue",
                        "price" => "50000",
                        "salePrice" => 75000,
                        "stock" => 2,
                        "minimumStock" => 1,
                        "displayable" => false,
                        "buyable" => false,
                        "images" => ["image-1", "image-2", "image-3"],
                        "dangerousGoodsLevel" => 0,
                        "attributesMap" => [
                        "WA-M000319" => "Blue",
                        "OU-2000004" => "Bali - Lippo Plaza Sunset"
                        ]
                    ]
                ],
                "imageMap" => [
                    "image-1" => "https://images.samsung.com/is/image/samsung/au-protective-standing-cover-for-galaxy-s9-ef-rg960cbegww-frontblack-93145715?$PD_GALLERY_L_JPG",
                    "image-2" => "/9j/4QAYRXhpZgAASUkqAAgAAAAAAAAAAAAAAP/sABFEdWNreQABAAQAAAAyAAD/4QPYaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wLwA8P3hwYWNrZXQgYmVnaW49Iu+7vyIgaWQ9Ilc1TTBNcENlaGlIenJlU3pOVGN6a2M5ZCI/PiA8eDp4bXBtZXRhIHhtbG5zOng9ImFkb2JlOm5zOm1ldGEvIiB4OnhtcHRrPSJBZG9iZSBYTVAgQ29yZSA1LjYtYzAxNCA3OS4xNTY3OTcsIDIwMTQvMDgvMjAtMDk6NTM6MDIgICAgICAgICI+IDxyZGY6UkRGIHhtbG5zOnJkZj0iaHR0cDovL3d3dy53My5vcmcvMTk5OS8wMi8yMi1yZGYtc3ludGF4LW5zIyI+IDxyZGY6RGVzY3JpcHRpb24gcmRmOmFib3V0PSIiIHhtbG5zOnhtcFJpZ2h0cz0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL3JpZ2h0cy8iIHhtbG5zOnhtcE1NPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvbW0vIiB4bWxuczpzdFJlZj0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL3NUeXBlL1Jlc291cmNlUmVmIyIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bXBSaWdodHM6TWFya2VkPSJGYWxzZSIgeG1wTU06T3JpZ2luYWxEb2N1bWVudElEPSJ4bXAuZGlkOjc4N0JGNjc3Qjc4MkUxMTE4RkI3OTIwNDM4ODlFQTJEIiB4bXBNTTpEb2N1bWVudElEPSJ4bXAuZGlkOjA5OEUyNzU2RkQ5QjExRTVCM0ZBOEI2RUMwNTMwNTdDIiB4bXBNTTpJbnN0YW5jZUlEPSJ4bXAuaWlkOjA5OEUyNzU1RkQ5QjExRTVCM0ZBOEI2RUMwNTMwNTdDIiB4bXA6Q3JlYXRvclRvb2w9IkFkb2JlIFBob3Rvc2hvcCBDQyAyMDE0IChXaW5kb3dzKSI+IDx4bXBNTTpEZXJpdmVkRnJvbSBzdFJlZjppbnN0YW5jZUlEPSJ4bXAuaWlkOjYxMDc5MGJmLTAyODAtNGY0NS04MTFmLTg2NTZhNTI3NDQ3MiIgc3RSZWY6ZG9jdW1lbnRJRD0iYWRvYmU6ZG9jaWQ6cGhvdG9zaG9wOjVlM2I4NWM0LWZkNjMtMTFlNS1iOWJhLWFmZjNhY2M5YWZkZCIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/Pv/uAA5BZG9iZQBkwAAAAAH/2wCEAAgGBgYGBggGBggMCAcIDA4KCAgKDhANDQ4NDRARDA4NDQ4MEQ8SExQTEg8YGBoaGBgjIiIiIycnJycnJycnJycBCQgICQoJCwkJCw4LDQsOEQ4ODg4REw0NDg0NExgRDw8PDxEYFhcUFBQXFhoaGBgaGiEhICEhJycnJycnJycnJ//AABEIAyADIAMBIgACEQEDEQH/xACsAAEAAQUBAQAAAAAAAAAAAAAAAQIDBAUGCAcBAQEBAQEBAQAAAAAAAAAAAAABAgMEBQYQAAEDAgQDAwcHCwMDAwUBAQEAAgMRBCExEgVBURNhIgZxMlIUVQcXgZFCkiNTFqGx0WKyM3N0FTU2wXJDgkRU4SQ08KJjRQjxJREBAQACAQQBAwQCAQMFAQAAAAERAgMhMRIEQVFhE3EiMgWBQhSRoSTwscFSYjT/2gAMAwEAAhEDEQA/APv6IiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIoLg0FziABmTgEEouY3r3heD9gkEW57rDHKf+Nrg92HY2q0x99Pu9H/7Ov8A0FB9ARfPvjV7vfaR+oU+NXu99pH6hQfQUXz741e732kfqFPjV7vfaR+oUH0FF8++NXu99pH6hT41e732kfqFB9BRfPvjV7vfaR+oU+NXu99pH6hQfQUXz741e732kfqFPjV7vfaR+oUH0FF8++NXu99pH6hT41e732kfqFB9BRfPvjV7vfaR+oU+NXu99pH6hQfQUXz741e732kfqFPjV7vfaR+oUH0FF8++NXu99pH6hT41e732kfqFB9BRfPvjV7vfaR+oU+NXu99pH6hQfQUXz741e732kfqFPjV7vfaR+oUH0FF8++NXu99pH6hT41e732kfqFB9BRfPvjV7vfaR+oU+NXu99pH6hQfQUXz741e732kfqFPjV7vfaR+oUH0FF8++NXu99pH6hT41e732kfqFB9BRfPvjV7vfaR+oU+NXu99pH6hQfQUXz741e732kfqFPjV7vfaR+oUH0FF8++NXu99pH6hT41e732kfqFB9BRfPvjV7vfaR+oU+NXu99pH6hQfQUXz741e732kfqFPjV7vfaR+oUH0FF8++NXu99pH6hT41e732kfqFB9BRfPvjV7vfaR+oU+NXu99pH6hQfQUXz741e732kfqFPjV7vfaR+oUH0FF8++NXu99pH6hT41e732kfqFB9BRfPvjV7vfaR+oU+NXu99pH6hQfQUXz741e732kfqFPjV7vfaR+oUH0FF8++NXu99pH6hT41e732kfqFB9BRfPvjV7vfaR+oU+NXu99pH6hQfQUXz741e732kfqFPjV7vfaR+oUH0FF8++NXu99pH6hT41e732kfqFB9BRfPvjV7vfaR+oU+NXu99pH6hQfQUXz741e732kfqFPjV7vfaR+oUH0FF8++NXu99pH6hT41e732kfqFB9BRfPvjV7vfaR+oU+NXu99pH6hQfQUXz741e732kfqFPjV7vfaR+oUH0FF8++NXu99pH6hT41e732kfqFB9BRfPvjV7vfaR+oU+NXu99pH6hQfQUXz741e732kfqFPjV7vfaR+oUH0FFwUfvl93sjwz+qtaTxe0gfOur2vxBsu9RCba76G5Y7LpvaT81UGyREQEREBERAREQEREBERAREQEREBERAJAFTkM15q97HvXvr/cLjYNinMFjA4xzSsNDI4YOFeVV968YXkm3+F91vIjpkht3uY7kaUXh973SPMshLnPJc9xzJPFAcS9xc4lzjmTjVU07FKIIoEoEUoIoEoERAoEoExRAoE0hTVExQoOSjSFKJ+ojSE0hSiCNITSFKII0hNIUogjSE0hSiCNITSFKII0hNIUogjSE0hSiCNITSFKII0hNIUogigSgUogjSE0hSiCNITSFKII0hKBSiCKBS1hf5jSfIFFBksqzvXWZd3A/UKYoMWgBoRklAqnuL3ueRTUclHYgigSgUooIoEoFKIIoEoFKiqBQJQKUQRQJpClFRGkJpClEEUCUClFBFAmkKUVEaQmkKUQRpCaQpRBGkJQKUQRQJQKUUEUCaQpRURpCaQpSqCKBKBTVEEUCaQpRBGkJpClEEaQlApRBFAD+lZm37hd7ZdMu7Gd9vMw1Y+MkEFYaqFKY5HAdhQep/dD7y5PFlu/Z93e3+q2ratkyMzBm6nMcV9UXi33c7xPsvjTaruIgapejJyLH90r2kgIiICIiAiIgIiICIiAiIgIiICIiDmP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IiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiICIiAiIgIiIP/9k=",
                    "image-3" => "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"
                ]
            ]
        ];
        // merge with request
        $param['raw'] = self::mergeBody($param['raw']);

        $uri = '/mtaapi'.(explode('/mta',self::URIproductCreateV2()))[1];
        $signature = self::signature(self::$milisecond,self::$secretKey,'POST',json_encode($param['raw']),"application/json",$uri);

        $res = Rest::header([
            'x-blibli-mta-authorization' => "BMA ".self::$username.":".$signature,
            'x-blibli-mta-date-milis' => self::$milisecond,
            'Content-Type' => 'application/json',
            'requestId' => self::$channelId."-".self::$uuid,
            'sessionId' => self::$uuid,
            'username' => self::$username
        ]);

        $url = "?requestId=".self::$channelId."-".self::$uuid.
            "&businessPartnerCode=".self::$merchantId.
            "&username=".self::$username.
            "&channelId=".self::$channelId;
        $res = Rest::post(self::URIproductCreateV2().$url,$param,self::$token->token_type." ".self::$token->access_token);

        if($res['status'] == 200)
            return $res['data'];

        return;
    }

    public static function productArchive() {
        $param = [
            'raw' => [
                "gdnSkus" => [
                    "TOQ-15130-01158-00001"
                ]
            ]
        ];
        // merge with request
        $param['raw'] = self::mergeBody($param['raw']);

        $uri = '/mtaapi'.(explode('/mta',self::URIproductArchive()))[1];
        $signature = self::signature(self::$milisecond,self::$secretKey,'POST',json_encode($param['raw']),"application/json",$uri);

        $res = Rest::header([
            'x-blibli-mta-authorization' => "BMA ".self::$username.":".$signature,
            'x-blibli-mta-date-milis' => self::$milisecond,
            'Content-Type' => 'application/json',
            'requestId' => self::$channelId."-".self::$uuid,
            'sessionId' => self::$uuid,
            'username' => self::$username
        ]);

        $url = "?requestId=".self::$channelId."-".self::$uuid.
            "&businessPartnerCode=".self::$merchantId.
            "&username=".self::$username.
            "&channelId=".self::$channelId.
            "&storeId=10001";
        $res = Rest::post(self::URIproductArchive().$url,$param,self::$token->token_type." ".self::$token->access_token);

        if($res['status'] == 200)
            return $res['data'];

        return;
    }

    public static function productUnarchive() {
        $param = [
            'raw' => [
                "gdnSkus" => [
                    "TOQ-15130-01158-00001"
                ]
            ]
        ];
        // merge with request
        $param['raw'] = self::mergeBody($param['raw']);

        $uri = '/mtaapi'.(explode('/mta',self::URIproductUnarchive()))[1];
        $signature = self::signature(self::$milisecond,self::$secretKey,'POST',json_encode($param['raw']),"application/json",$uri);

        $res = Rest::header([
            'x-blibli-mta-authorization' => "BMA ".self::$username.":".$signature,
            'x-blibli-mta-date-milis' => self::$milisecond,
            'Content-Type' => 'application/json',
            'requestId' => self::$channelId."-".self::$uuid,
            'sessionId' => self::$uuid,
            'username' => self::$username
        ]);

        $url = "?requestId=".self::$channelId."-".self::$uuid.
            "&businessPartnerCode=".self::$merchantId.
            "&username=".self::$username.
            "&channelId=".self::$channelId.
            "&storeId=10001";
        $res = Rest::post(self::URIproductUnarchive().$url,$param,self::$token->token_type." ".self::$token->access_token);

        if($res['status'] == 200)
            return $res['data'];

        return;
    }
}