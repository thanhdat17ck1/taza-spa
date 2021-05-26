<?php

namespace App\Helpers;

use GuzzleHttp\Client;
use Illuminate\Support\Arr;

class Api
{
    
    const API = "https://tazagroup.vn/api/index.php/v1/content/";
    
    const API_TOKEN = "c2hhMjU2OjUyOmY0MTQ5NzQ4MDk4NWRmZGE1YzJhMjRjMzBkODBjNDg1NTEyYTdmODU0MzM5OWY0MDA0ZDJkZGFiYmUxMGQ0NWU=";
    // const API = "http://192.168.1.25/tool-marketing/public/api/";
    // public static function connect($uri, $data, $method, $isMultipart = false, $isJson = true, $token = '', $customHeader = [])
    // {
 
    //     // session()->put('user_token','c2hhMjU2OjUyOmY0MTQ5NzQ4MDk4NWRmZGE1YzJhMjRjMzBkODBjNDg1NTEyYTdmODU0MzM5OWY0MDA0ZDJkZGFiYmUxMGQ0NWU=');
    //     try {
    //         $client = new Client(['base_uri' => self::API, 'verify' => true]);
            
    //         $arrHeader = array();
        
    //         if ($method == 'POST' || $method == 'PUT') {
    //             if ($isMultipart) {
    //                 $arrHeader['Authorization'] = 'Bearer' . " " . self::API_TOKEN;
    //                 $arrHeader['fcode'] = 1;
                
    //                 if (!empty($customHeader)) {
    //                     $arrHeader = array_merge($arrHeader, $customHeader);
    //                 }
    //                 $res = $client->request($method, $uri, [
    //                     'headers' => $arrHeader,
    //                     'multipart' => $data
    //                 ]);
    //             } else {
    //                 $arrHeader = [
    //                     'Content-Type' => 'application/json',
    //                     'Accept' => 'application/json'
    //                 ];
    //                 $arrHeader['Authorization'] = 'Bearer' . " " . self::API_TOKEN;
    //                 $arrHeader['fcode'] = 1;
                    
    //                 if (!empty($customHeader)) {
    //                     $arrHeader = array_merge($arrHeader, $customHeader);
    //                 }
    //                 $res = $client->request($method, $uri, [
    //                     'headers' => $arrHeader,
    //                     'body' => json_encode($data)
    //                 ]);
    //             }
    //         } else {
    //             $arrHeader = [
    //                 'Authorization' => 'Bearer '. self::API_TOKEN,
    //                 "connection" => 'keep-alive',
    //             ];
                
    //             if (!empty($customHeader)) {
    //                 $arrHeader = array_merge($arrHeader, $customHeader);
    //             }
               
    //             $res = $client->request($method, $uri, [
    //                 'headers' => $arrHeader
    //             ]);
                
    //         }

    //         if ($isJson == true) {
    //             return json_decode($res->getBody()->getContents(), true);
    //         } else {
    //             return $res->getBody()->getContents();
    //         }

    //     } catch (\Exception $ex) {
    //         dd($ex);
    //     }
    // }

    public static function connect($path ='',$data = [],$method = 'GET',$headers = []){

        $url = self::API .$path;
        $curl = curl_init();

        if($method =='GET'){
            $url = $url ."?".Arr::query($data);
        }

        $bearerHeaderToken = [
            'Authorization: Bearer c2hhMjU2OjUyOmY0MTQ5NzQ4MDk4NWRmZGE1YzJhMjRjMzBkODBjNDg1NTEyYTdmODU0MzM5OWY0MDA0ZDJkZGFiYmUxMGQ0NWU='
        ];
        $requestHeader = array_merge($headers,$bearerHeaderToken);
        
        if($method =='POST'){
            $requestHeader = array_merge($requestHeader,[
                'Content-Type: application/json'
            ]);
        }
        
       
        curl_setopt($curl,CURLOPT_URL,$url);
        curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);
        curl_setopt($curl,CURLOPT_ENCODING,'');
        curl_setopt($curl,CURLOPT_MAXREDIRS,10);
        curl_setopt($curl,CURLOPT_TIMEOUT,0);
        curl_setopt($curl,CURLOPT_FOLLOWLOCATION,true);
        curl_setopt($curl,CURLOPT_HTTP_VERSION,CURL_HTTP_VERSION_1_1);
        curl_setopt($curl,CURLOPT_CUSTOMREQUEST,$method);
        curl_setopt($curl,CURLOPT_HTTPHEADER,$requestHeader);
        if($method == 'POST'){
            curl_setopt($curl,CURLOPT_POST,1);
            curl_setopt($curl,CURLOPT_POSTFIELDS,json_encode($data));
        }

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }
}
