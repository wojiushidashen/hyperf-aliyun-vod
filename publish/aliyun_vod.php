<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 *​
 * aliyun_sls.php
 *
 * 阿里云日志配置
 *
 * User：YM
 * Date：2019/12/23
 * Time：下午5:05
 */

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
