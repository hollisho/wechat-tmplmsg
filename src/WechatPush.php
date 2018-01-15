<?php

namespace WechatPush;

use WechatPush\lib\AccessToken;
use WechatPush\lib\HttpRequest;

class WechatPush
{
    protected $appId;
    protected $appSecret;
    protected $accessToken;

    public function __construct($appId, $appSecret)
    {
        if ($appId && $appSecret) {
            $this->appid = $appId;
            $this->secret = $appSecret;
            $this->accessToken = AccessToken::getMpToken($appId, $appSecret);
        }

    }

    /**
     * 单例
     * @author Hollis Ho <he_wenzhi@126.com>
     * @param $appId
     * @param $appSecret
     * @return null|WechatPush
     */
    public static function getInstance($appId, $appSecret)
    {
        static $obj = null;
        if ($obj == null) {
            $obj = new self($appId, $appSecret);
        }
        return $obj;
    }

    /**
     * 发送自定义的模板消息
     * @author Hollis Ho <he_wenzhi@126.com>
     * @param $toUser
     * @param $templateId
     * @param $url
     * @param $data
     * @param string $topcolor
     * @return bool
     */
    public function doSend($toUser, $templateId, $url, $data, $topcolor = '#7B68EE')
    {
        $template = [
            'touser' => $toUser,
            'template_id' => $templateId,
            'url' => $url,
            'topcolor' => $topcolor,
            'data' => $data
        ];
        $jsonTemplate = json_encode($template);
        $url = sprintf("https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=%s", $this->accessToken);
        $dataRes = HttpRequest::http_post($url, urldecode($jsonTemplate));
        if ($dataRes['errcode'] == 0) {
            return true;
        } else {
            return false;
        }
    }
}