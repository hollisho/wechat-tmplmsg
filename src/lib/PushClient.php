<?php

namespace hollisho\wechatmsg\lib;

/**
 * Class PushClient
 * @package hollisho\wechatmsg\lib
 * @author Hollis Ho
 */
class PushClient
{
    protected $appId;
    protected $appSecret;
    public $accessToken;

    public function __construct($appId, $appSecret)
    {
        if ($appId && $appSecret) {
            $this->appId = $appId;
            $this->appSecret = $appSecret;
        }

    }
    
    public function getAccessToken() {
        return $this->accessToken ? $this->accessToken : AccessToken::getMpToken($this->appId, $this->appSecret);
    }

    /**
     * @author Hollis Ho <he_wenzhi@126.com>
     * @param $appId
     * @param $appSecret
     * @return null|static
     */
    public static function getInstance($appId, $appSecret)
    {
        static $obj = null;
        if ($obj == null) {
            $obj = new static($appId, $appSecret);
        }
        return $obj;
    }
}
