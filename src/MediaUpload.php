<?php

namespace Ym\AliyunVod;


use Ym\AliyunVod\Request\CreateUploadVideoRequest;
use Ym\AliyunVod\Request\RefreshUploadVideoRequest;
use Ym\AliyunVod\Request\UploadMediaByURLRequest;

class MediaUpload extends Client
{
    /**
     * createUploadVideo
     * 获取视频上传凭证
     * User：YM
     * Date：2020/4/21
     * Time：9:20 AM
     * @param array $data = [
     *      'title' => 'string 必须',
     *      'filename' => 'string 必须',
     *      'size' => 'string',
     *      'description' => 'string',
     *      'cover' => 'string',
     *      'category_id' => 'long',
     *      'tags' => 'string',
     *      'transcode_id' => 'string',
     *      'user_data' => 'string',
     *      'store_address' => 'string',
     *      'app_id' => 'string',
     *      'workflow_id' => 'string',
     * ]
     * @return mixed|\Ym\AliyunCore\SimpleXMLElement
     */
    public function createUploadVideo($data)
    {
        $req = new CreateUploadVideoRequest();
        // 设置视频标题，必选
        $req->setTitle($data['title']);
        // 设置视频源文件名，必选，且必须带扩展名
        $req->setFileName($data['filename']);
        // 设置视频文件大小
        if (isset($data['size']) && $data['size']) {
            $req->setFileSize($data['size']);
        }
        // 设置视频描述
        if (isset($data['description']) && $data['description']) {
            $req->setDescription($data['description']);
        }
        // 设置视频自定义封面
        if (isset($data['cover']) && $data['cover']) {
            $req->setCoverURL($data['cover']);
        }
        // 设置视频分类id
        if (isset($data['category_id']) && $data['category_id']) {
            $req->setCateId($data['category_id']);
        }
        // 设置视频标签
        if (isset($data['tags']) && $data['tags']) {
            $tags = is_array($data['tags'])?implode(',',$data['tags']):$data['tags'];
            $req->setTags($tags);
        }
        // 设置转码组id
        if (isset($data['transcode_id']) && $data['transcode_id']) {
            $req->setTemplateGroupId($data['transcode_id']);
        }
        // 设置自定义数据，json字符串
        if (isset($data['user_data']) && $data['user_data']) {
            $userData = is_array($data['user_data'])?json_encode($data['user_data']):$data['user_data'];
            $req->setUserData($userData);
        }
        // 设置存储地址
        if (isset($data['store_address']) && $data['store_address']) {
            $req->setStorageLocation($data['store_address']);
        }
        // 应用ID
        if (isset($data['app_id']) && $data['app_id']) {
            $req->setAppId($data['app_id']);
        }
        // 工作流ID
        if (isset($data['workflow_id']) && $data['workflow_id']) {
            $req->setWorkflowId($data['workflow_id']);
        }
        $req->setAcceptFormat($this->acceptFormat);
        $res = $this->client->getAcsResponse($req);

        return $res;
    }

    /**
     * refreshUploadVideo
     * 刷新视频上传凭证
     * User：YM
     * Date：2020/4/21
     * Time：10:16 AM
     * @param string $videoId
     * @return mixed|\Ym\AliyunCore\SimpleXMLElement
     */
    public function refreshUploadVideo(string $videoId)
    {
        $req = new RefreshUploadVideoRequest();
        $req->setVideoId($videoId);
        $req->setAcceptFormat($this->acceptFormat);
        $res = $this->client->getAcsResponse($req);

        return $res;
    }

    /**
     * uploadMediaByURL
     * URL批量拉取上传
     * urls的每一个url与upload_metadatas的每一个数组组对应
     * User：YM
     * Date：2020/4/21
     * Time：11:37 AM
     * @param array $data = [
     *      'urls' => 'string/Array 必须',
     *      'transcode_id' => 'string',
     *      'workflow_id' => 'string',
     *      'store_address' => 'string',
     *      'user_data' => 'string',
     *      'app_id' => 'string',
     *      'upload_metadatas' => [
     *          [
     *              'title' => 'string 必须',
     *              'size' => 'string',
     *              'description' => 'string',
     *              'cover' => 'string',
     *              'category_id' => 0,
     *              'tags' => 'string',
     *              'transcode_id' => 'string',
     *              'workflow_id' => 'string',
     *              'extension' => 'string',
     *          ]
     *      ]
     * ]
     * @return mixed|\Ym\AliyunCore\SimpleXMLElement
     */
    public function uploadMediaByURL(array $data)
    {
        $req = new UploadMediaByURLRequest();
        if (is_array($data['urls'])) {
            $urls = implode(',',$data['urls']);
            $urlArr = $data['urls'];
        } else {
            $urls = $data['urls'];
            $urlArr = [$data['urls']];
        }

        $req->setUploadURLs($urls);
        // 设置转码组id
        if (isset($data['transcode_id']) && $data['transcode_id']) {
            $req->setTemplateGroupId($data['transcode_id']);
        }
        // 设置自定义数据，json字符串
        if (isset($data['user_data']) && $data['user_data']) {
            $userData = is_array($data['user_data'])?json_encode($data['user_data']):$data['user_data'];
            $req->setUserData($userData);
        }
        // 设置存储地址
        if (isset($data['store_address']) && $data['store_address']) {
            $req->setStorageLocation($data['store_address']);
        }
        // 应用ID
        if (isset($data['app_id']) && $data['app_id']) {
            $req->setAppId($data['app_id']);
        }
        // 工作流ID
        if (isset($data['workflow_id']) && $data['workflow_id']) {
            $req->setWorkflowId($data['workflow_id']);
        }

        // 构建UploadMetadatas
        $uploadMetadataList = [];
        foreach ($urlArr as $k => $v) {
            $tmp = [];
            $tmp["SourceUrl"] = $v;
            $tmp["Title"] = $data['upload_metadatas'][$k]['size']??$v;
            if (isset($data['upload_metadatas'][$k]['size'])) {
                $tmp["FileSize"] = $data['upload_metadatas'][$k]['size'];
            }
            if (isset($data['upload_metadatas'][$k]['description'])) {
                $tmp["Description"] = $data['upload_metadatas'][$k]['description'];
            }
            if (isset($data['upload_metadatas'][$k]['cover'])) {
                $tmp["CoverURL"] = $data['upload_metadatas'][$k]['cover'];
            }
            if (isset($data['upload_metadatas'][$k]['category_id'])) {
                $tmp["CateId"] = $data['upload_metadatas'][$k]['category_id'];
            }
            if (isset($data['upload_metadatas'][$k]['tags'])) {
                $tags = $data['upload_metadatas'][$k]['size'];
                $tmp["Tags"] = is_array($tags)?implode(',',$tags):$tags;
            }
            if (isset($data['upload_metadatas'][$k]['transcode_id'])) {
                $tmp["TemplateGroupId"] = $data['upload_metadatas'][$k]['transcode_id'];
            }
            if (isset($data['upload_metadatas'][$k]['workflow_id'])) {
                $tmp["WorkflowId"] = $data['upload_metadatas'][$k]['workflow_id'];
            }
            if (isset($data['upload_metadatas'][$k]['extension'])) {
                $tmp["FileExtension"] = $data['upload_metadatas'][$k]['extension'];
            }
            $uploadMetadataList[] = $tmp;
        }
        $req->setUploadMetadatas(json_encode($uploadMetadataList));
        $req->setAcceptFormat($this->acceptFormat);
        $res = $this->client->getAcsResponse($req);
        return $res;
    }
}
