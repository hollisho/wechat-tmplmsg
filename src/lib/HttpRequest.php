<?php

namespace WechatPush\lib;


/**
 * Http请求类
 * Class HttpRequest
 * @package WechatPush
 * @author Hollis Ho
 */
class HttpRequest
{
    /**
     * 发送post请求
     * @author Hollis Ho <he_wenzhi@126.com>
     * @param $url
     * @param null $data
     * @return mixed
     */
    public static function http_post($url, $data = null)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (!empty($data)){
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }

    /**
     * 发送get请求
     * @author Hollis Ho <he_wenzhi@126.com>
     * @param string $url
     * @return bool|mixed
     */
    public static function http_get($url = '')
    {
        if (empty($url)) {
            return false;
        }
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $data = curl_exec($ch);
        curl_close($ch);
        return $data;
    }
}