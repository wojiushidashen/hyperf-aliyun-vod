<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 *​
 * AliyunVodTest.php
 *
 * User：YM
 * Date：2020/4/21
 * Time：5:38 PM
 */


namespace YmTest\AliyunVod;

require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\TestCase;
use Ym\AliyunVod\MediaRead;
use Ym\AliyunVod\MediaUpload;
use Mockery;

/**
 * AliyunVodTest
 * 视频点播测试
 * @package Ym\AliyunCore
 * User：YM
 * Date：2020/4/21
 * Time：5:38 PM
 */
class AliyunVodTest extends TestCase
{
    public $mediaRead;
    public $mediaUpload;

    public function setUp()
    {
        try {
            $config = [
                'access_key' => '',
                'secret_key' => '',
                // 回调鉴权，签名所使用的key
                'private_key' => '',
                // 类型:access|sts 如果是sts 实例化对象时候需要传入$securityToken
                'type' => 'access',
                // 返回数据格式
                'accept_format' => 'JSON',
                // 阿里云jssdk的请求参数
                // 账号ID
                'account_id' => '',
                // 点播的接入区域
                'region_id' => 'cn-shanghai',
                // 超时
                'timeout' => 3600,
                // 分片大小1M
                'part_size' => 1024*1024*0.5,
                // 并行上传分片个数
                'parallel' => 5,
                // 网络故障重传次数
                'retry_count' => 3,
                // 网络故障，重传间隔
                'retry_duration' => 2,
            ];

            $this->mediaRead = new MediaRead($config);
            $this->mediaUpload = new MediaUpload($config);
        } catch (\Exception $e) {
            $err = "Error : 错误：" . $e->getMessage();
            echo $err . PHP_EOL;
        }
    }

    public function testPush()
    {
        echo PHP_EOL . "阿里云点播测试中...." . PHP_EOL;

        try {
            $data = [
                'title' => 'title',
                'filename' => 'filename.mp4',
                'description' => 'filename.mp4',
                'cover' => 'http://www.pptbz.com/pptpic/UploadFiles_6909/201203/2012031220134655.jpg',
                'tags' => ['标签1','标签2']
            ];
            // 获取视频上传地址和凭证
//            $result = $this->mediaUpload->createUploadVideo($data);
            // 刷新视频上传凭证
            $videoId = '4b3d76bf31664f9d8c85f77be5349e7b';
            $result =  $this->mediaUpload->refreshUploadVideo($videoId);
//            $result = $this->mediaUpload->uploadMediaByURL($url,$title);  //url 拉去视屏上传
//            获取播放权限参数
//            $result =  $this->mediaRead->getPlayAuth(['video_id'=>$videoId]);
            // 获取播放信息
//            $result =  $this->mediaRead->getPlayInfo(['video_id'=>$videoId]);

            var_dump($result);
            return $result;
        } catch (\Exception $e) {
            $err = sprintf('ERROR：%s,%s[%s] in %s',$e->getCode(), $e->getMessage(), $e->getLine(), $e->getFile());
            echo $err . PHP_EOL;
        }
    }
}