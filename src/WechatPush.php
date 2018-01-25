<?php

namespace WechatPush;

use WechatPush\lib\HttpRequest;
use WechatPush\lib\PushClient;

class WechatPush extends PushClient
{
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
    public function send($toUser, $templateId, $url, $data, $topcolor = '#7B68EE')
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