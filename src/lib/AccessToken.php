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
        if (!file_exists('./access_token.json')) fopen('./access_token.json', 'a+');
        $file = file_get_contents('./access_token.json', true);
        $result = json_decode($file, true);
        if (!$result || time() > $result['expires']) {
            $data = static::buildAccessToken($appId, $appSecret);
            $data['expires'] = time() + $data['expires_in'] - 200;
            $jsonStr =  json_encode($data);
            $fp = fopen('./access_token.json', 'w');
            fwrite($fp, $jsonStr);
            return $data['access_token'];
        } else {
            return $result['access_token'];
        }
    }

    /**
     * 重新请求access_token
     * @author Hollis Ho <he_wenzhi@126.com>
     * @param $appId
     * @param $appSecret
     * @return mixed
     */
    protected static function buildAccessToken($appId, $appSecret) {
        $tokenAccessUrl = sprintf("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=%s&secret=%s", $appId, $appSecret);
        $arrContextOptions=array(
            "ssl"=>array(
                "verify_peer"=>false,
                "verify_peer_name"=>false,
            ),
        );
        $res = file_get_contents($tokenAccessUrl, false, stream_context_create($arrContextOptions));
        return json_decode($res, true);
    }
}
