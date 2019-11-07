<?php

namespace Blibli;

use Blibli\Auths;

class Config {

    public static $env;
    public static $links = [
        'staging' => 'https://api-perf.gdn-app.com',
        'production' => 'https://api.blibli.com',
        'child' => [
            'token' => 'v2/oauth/token',
            'orderList' => 'v2/proxy/mta/api/businesspartner/v1/order/orderList'
        ]
    ];
    public static $channelId;
    public static $username;
    public static $password;

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
        if(env('BLIBLI_CHANNELID') && env('BLIBLI_USERNAME') && env('BLIBLI_PASSWORD')){
            self::$channelId = env('BLIBLI_CHANNELID');
            self::$username = env('BLIBLI_USERNAME');
            self::$password = env('BLIBLI_PASSWORD');
            return true;
        } else
            return;
    }

    // get URI
    public static function uriToken(){ return self::domain(self::$links['child']['token']); }
    public static function uriOrderList(){ return self::domain(self::$links['child']['orderList']); }

}