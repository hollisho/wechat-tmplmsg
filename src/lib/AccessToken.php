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
        $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );
        $res = file_get_contents($tokenAccessUrl, false, stream_context_create($arrContextOptions));
        $result = json_decode($res, true);
        return $result['access_token'];
    }
}
