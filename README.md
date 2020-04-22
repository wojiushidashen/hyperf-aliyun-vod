# AliyunVod For Hyperf

#### README

> 因为项目驱动，目前只自定义了几个简单的方法，用于视频查询鉴权和视频上传系列接口，比较其他很多功能接口，我个人觉得直接去控制台更好管理。如果你执意要用，那我只能说你很棒棒哦，需要vod其他的api方法调用，可以参考官方SDK文档使用本包进行调用，本包包含官方所有接口文件，composer已自动载入官方SDK,可以参考 `MediaUpload.php` `MediaRead.php`


#### Installing

> composer require yoctometre/aliyun-vod -v


#### Configuration

生成配置文件，如下两个方案：
1.  拷贝项目下`publish/aliyun_vod.php`到你项目中`config/autoload/`目录下
2.  `php bin/hyperf.php vendor:publish yoctometre/aliyun-vod`

配置示例代码：

```
return [
    'access_key' => env('ALIYUN_VOD_AK', ''),
    'secret_key' => env('ALIYUN_VOD_SK', ''),
    // 回调鉴权，签名所使用的key
    'private_key' => env('ALIYUN_VOD_PK', ''),
    // 类型:access|sts 如果是sts 实例化对象时候需要传入$securityToken
    'type' => env('ALIYUN_SLS_PROJECT', 'access'),
    // 返回数据格式
    'accept_format' => 'JSON',
    // 阿里云jssdk的请求参数
    // 账号ID
    'account_id' => env('ALIYUN_VOD_ACCOUNT', ''),
    // 点播的接入区域
    'region_id' => env('ALIYUN_VOD_REGION', 'cn-shanghai'),
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
```

#### Example

```
use Ym\AliyunVod\MediaRead;
use Ym\AliyunVod\MediaUpload;

………………省略实例化等过程

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
```