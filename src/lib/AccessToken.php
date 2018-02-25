<?php

namespace hollisho\wechatmsg\lib;

/**
 * Class AccessToken
 * @package hollisho\wechatmsg\lib
 * @author Hollis Ho
 */
class AccessToken
{
    /**
     * 获取token
     * @author Hollis Ho <he_wenzhi@126.com>
     * @param $appId
     * @param $appSecret
     * @return mixed
     */
    public static function getMpToken($appId, $appSecret)
    {
        $tokenAccessUrl = sprintf("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=%s&secret=%s", $appId, $appSecret);
        $res = file_get_contents($tokenAccessUrl);
        $result = json_decode($res, true);
        return $result['access_token'];
    }
}
