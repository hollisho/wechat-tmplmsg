<?php

namespace hollisho\wechatmsg;


use hollisho\wechatmsg\lib\HttpRequest;
use hollisho\wechatmsg\lib\PushClient;


/**
 * Class AppletPush
 * @package hollisho\wechatmsg
 * @author Hollis Ho
 */
class AppletPush extends PushClient
{
    /**
     * 发送自定义的模板消息
     * @author Hollis Ho <he_wenzhi@126.com>
     * @param $toUser
     * @param $templateId
     * @param $url
     * @param $formId
     * @param $data
     * @param string $topcolor
     * @return bool
     */
    public function send($toUser, $templateId, $url, $formId, $data, $topcolor = '#7B68EE')
    {
        $template = [
            'touser' => $toUser,
            'template_id' => $templateId,
            'page' => $url,
            'form_id' => $formId,
            'color' => $topcolor,
            'data' => $data
        ];
        $jsonTemplate = json_encode($template);
        $url = sprintf("https://api.weixin.qq.com/cgi-bin/message/wxopen/template/send?access_token=%s", $this->accessToken);
        $dataRes = HttpRequest::http_post($url, urldecode($jsonTemplate));
        return json_decode($dataRes, true);
    }
}
