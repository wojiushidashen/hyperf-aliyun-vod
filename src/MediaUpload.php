<?php

namespace Ym\AliyunVod;


use Ym\AliyunVod\Request\CreateUploadVideoRequest;
use Ym\AliyunVod\Request\RefreshUploadVideoRequest;
use Ym\AliyunVod\Request\UploadMediaByURLRequest;

class MediaUpload extends Client
{


    /**获取视频上传凭证
     * User: ZeMing Shao
     * Email: szm19920426@gmail.com
     * @param $title
     * @param $filename
     * @param $desc
     * @param $coverUrl
     * @param array $tags
     * @return mixed|\ShaoZeMing\Aliyun\Core\SimpleXMLElement
     * @throws \ShaoZeMing\Aliyun\Core\Exception\ClientException
     * @throws \ShaoZeMing\Aliyun\Core\Exception\ServerException
     */
    public function createUploadVideo($title, $filename, $desc, $coverUrl, array $tags = [])
    {
        $request = new CreateUploadVideoRequest();
        $request->setTitle($title);
        $request->setFileName($filename);
        $request->setDescription($desc);
        $request->setCoverURL($coverUrl);
        $tags = implode(',', $tags);
        $request->setTags($tags);
        $request->setAcceptFormat($this->acceptFormat);
        $uploadInfo = $this->client->getAcsResponse($request);

        return $uploadInfo;

        $req = new CreateUploadVideoRequest();

        // 设置视频标题，必选
        $req->setTitle($params['title']);
        // 设置视频源文件名，必选，且必须带扩展名
        $req->setFileName($params['filename']);
        // 设置视频文件大小
        if (isset($params['size']) && $params['size']) {
            $req->setFileSize($params['size']);
        }
        // 设置视频描述
        if (isset($params['description']) && $params['description']) {
            $req->setDescription($params['description']);
        }
        // 设置视频文件
        if (isset($params['size']) && $params['size']) {
            $req->setFileSize($params['size']);
        }
        // 设置视频自定义封面
        if (isset($params['cover']) && $params['cover']) {
            $req->setCoverURL($params['cover']);
        }
        // 设置视频分类id
        if (isset($params['category_id']) && $params['category_id']) {
            $req->setCateId($params['category_id']);
        }
        // 设置视频标签
        if (isset($params['tags']) && $params['tags']) {
            $tags = is_array($params['tags'])?implode(',',$params['tags']):$params['tags'];
            $req->setTags($tags);
        }
        // 设置转码组id
        if (isset($params['transcode_id']) && $params['transcode_id']) {
            $req->setTemplateGroupId($params['transcode_id']);
        }
        // 设置自定义数据，json字符串
        if (isset($params['user_data']) && $params['user_data']) {
            $userData = is_array($params['user_data'])?json_encode($params['user_data']):$params['user_data'];
            $req->setUserData($userData);
        }
        // 设置存储地址
        if (isset($params['store_address']) && $params['store_address']) {
            $req->setStorageLocation($params['store_address']);
        }
        // 应用ID
        if (isset($params['app_id']) && $params['app_id']) {
            $req->setStorageLocation($params['store_address']);
        }
        // 设置存储地址
        if (isset($params['store_address']) && $params['store_address']) {
            $req->setStorageLocation($params['store_address']);
        }


        $res = $this->client->getAcsResponse($req);

        return $res;
    }


    /**
     * 刷新视频上传凭证
     * User: ZeMing Shao
     * Email: szm19920426@gmail.com
     * @param $videoId
     * @return mixed|\ShaoZeMing\Aliyun\Core\SimpleXMLElement
     * @throws \ShaoZeMing\Aliyun\Core\Exception\ClientException
     * @throws \ShaoZeMing\Aliyun\Core\Exception\ServerException
     */
    public function refreshUploadVideo($videoId)
    {
        $request = new RefreshUploadVideoRequest();
        $request->setVideoId($videoId);
        $request->setAcceptFormat($this->acceptFormat);
        $refreshInfo = $this->client->getAcsResponse($request);

        return $refreshInfo;
    }


    /**
     * URL批量拉取上传
     * User: ZeMing Shao
     * Email: szm19920426@gmail.com
     * @param $url
     * @param $title
     * @return mixed|\ShaoZeMing\Aliyun\Core\SimpleXMLElement
     * @throws \ShaoZeMing\Aliyun\Core\Exception\ClientException
     * @throws \ShaoZeMing\Aliyun\Core\Exception\ServerException
     */
    public function uploadMediaByURL($url, $title)
    {

        $request = new UploadMediaByURLRequest();
        $request->setUploadURLs($url);
        $uploadMetadataList = array();
        $uploadMetadata = array();
        $uploadMetadata["SourceUrl"] = $url;
        $uploadMetadata["Title"] = $title;
        $uploadMetadataList[] = $uploadMetadata;
        $request->setUploadMetadatas(json_encode($uploadMetadataList));
        return $this->client->getAcsResponse($request);

    }


}
