<?php

namespace Ym\AliyunVod;


use Ym\AliyunVod\Request\GetPlayInfoRequest;
use Ym\AliyunVod\Request\GetVideoPlayAuthRequest;

class MediaRead extends Client
{

    /**
     * getPlayInfo
     * 获取视频播放详细信息
     * User：YM
     * Date：2020/4/21
     * Time：2:24 PM
     * @param array $data = [
     *      'video_id' => 'string 必须',
     *      'formats' => 'string',
     *      'timeout' => 'long',
     *      'stream_type' => 'string',
     *      'definition' => 'string',
     *      'result_type' => 'string',
     *      'output_type' => 'string',
     *      'play_config' => 'json',
     *      're_auth_info' => 'json'
     * ]
     * @return mixed|\Ym\AliyunCore\SimpleXMLElement
     */
    function getPlayInfo(array $data)
    {
        $req = new GetPlayInfoRequest();
        $req->setVideoId($data['video_id']);
        // 播放地址过期时间
        if (isset($data['timeout']) && $data['timeout']) {
            $req->setAuthTimeout($data['timeout']);
        } else {
            $req->setAuthTimeout($this->timeout);
        }
        if (isset($data['formats']) && $data['formats']) {
            $req->setFormats($data['formats']);
        }
        if (isset($data['stream_type']) && $data['stream_type']) {
            $req->setStreamType($data['stream_type']);
        }
        if (isset($data['definition']) && $data['definition']) {
            $req->setDefinition($data['definition']);
        }
        if (isset($data['result_type']) && $data['result_type']) {
            $req->setResultType($data['result_type']);
        }
        if (isset($data['output_type']) && $data['output_type']) {
            $req->setOutputType($data['output_type']);
        }
        if (isset($data['play_config']) && $data['play_config']) {
            $req->setPlayConfig($data['play_config']);
        }
        if (isset($data['re_auth_info']) && $data['re_auth_info']) {
            $req->setReAuthInfo($data['re_auth_info']);
        }
        $req->setAcceptFormat($this->acceptFormat);
        $playInfo = $this->client->getAcsResponse($req);
        return $playInfo;
    }

    /**
     * getPlayAuth
     * 获取播放凭证
     * User：YM
     * Date：2020/4/21
     * Time：3:10 PM
     * @param array $data = [
     *      'video_id' => 'string 必须',
     *      'timeout' => 'long',
     *      're_auth_info' => 'json'
     * ]
     * @return mixed|\Ym\AliyunCore\SimpleXMLElement
     */
    function getPlayAuth(array $data)
    {
        $req = new GetVideoPlayAuthRequest();
        $req->setVideoId($data['video_id']);
        if (isset($data['timeout']) && $data['timeout']) {
            $req->setAuthTimeout($data['timeout']);
        }
        if (isset($data['re_auth_info']) && $data['re_auth_info']) {
            $req->setReAuthInfo($data['re_auth_info']);
        }
        $playAuth = $this->client->getAcsResponse($req);
        return $playAuth;
    }
}
