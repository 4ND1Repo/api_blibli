<?php

namespace Blibli\Helpers;

use Exception;

Class Rest {
    public static $head = [];
    public static $header = ['Accept: application/json','Content-Type: application/x-www-form-urlencoded'];

    public static function exec($method, $url, $obj = [], $token = '', $auth=[]) {
        $header = self::$header;
        // merge header
        $header = array_merge($header, self::$head);

        if(!empty($token) && !is_null($token)){
            $authorization = 'Authorization: '.$token;
            array_push($header, $authorization);
        } else if((empty($token) || is_null($token)) && (count($auth) > 0)){
            $authorization = 'Authorization: Basic '. base64_encode($auth['username'].":".$auth['password']);
            array_push($header, $authorization);
        }
        $curl = curl_init();

        switch($method) {
            case 'GET':
                if(count($obj) > 0){
                    if(strrpos($url, "?") === FALSE) {
                        $url .= '?' . http_build_query($obj);
                    }
                }
                break;

            case 'POST': 
                curl_setopt($curl, CURLOPT_POST, TRUE);
                if(isset($obj['raw'])){
                    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($obj['raw']));
                } else
                    curl_setopt($curl, CURLOPT_POSTFIELDS, self::generateFormData($obj));
                break;

            case 'PUT':
            case 'DELETE':
            default:
                curl_setopt($curl, CURLOPT_CUSTOMREQUEST, strtoupper($method));
                if(isset($obj['raw'])){
                    curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($obj['raw']));
                } else
                    curl_setopt($curl, CURLOPT_POSTFIELDS, self::generateFormData($obj));
        }

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header); 
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, TRUE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, TRUE);

        // Exec
        $response = curl_exec($curl);
        $info     = curl_getinfo($curl);
        if(curl_errno($curl)){
            throw new Exception('Request Error: ' . curl_error($curl), $info['http_code']);   
        }

        curl_close($curl);

        // Data
        $header = trim(substr($response, 0, $info['header_size']));
        $body = substr($response, $info['header_size']);

        return array('status' => $info['http_code'], 'header' => $header, 'data' => json_decode($body));
    }

    public static function get($url, $obj = [], $token = '', $auth=[]) {
        return Rest::exec("GET", $url, $obj, $token, $auth);
    }

    public static function post($url, $obj = [], $token = '', $auth=[]) {
        return Rest::exec("POST", $url, $obj, $token, $auth);
    }

    public static function put($url, $obj = [], $token = '', $auth=[]) {
        return Rest::exec("PUT", $url, $obj, $token, $auth);
    }

    public static function delete($url, $obj = [], $token = '', $auth=[]) {
        return Rest::exec("DELETE", $url, $obj, $token, $auth);
    }

    public static function header($h=[]){
        self::$head = [];
        if(isset($h['Content-Type'])) self::$header = preg_grep("/Content-Type/", self::$header, PREG_GREP_INVERT);
        if(count($h) > 0){
            foreach($h AS $k => $v){
                self::$head[] = $k.": ".$v;
            }
        }
    }

    public static function generateFormData($arr=[]){
        if(count($arr) > 0){
            $tmp = [];
            foreach($arr AS $k => $v){
                $tmp[] = $k."=".$v;
            }
            return implode("&", $tmp);
        }

        return $arr;
    }

}