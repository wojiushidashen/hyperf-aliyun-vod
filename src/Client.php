<?php

namespace Ym\AliyunVod;


use Ym\AliyunCore\DefaultAcsClient;
use Ym\AliyunCore\Profile\DefaultProfile;
use Hyperf\Contract\ConfigInterface;
use Hyperf\Utils\ApplicationContext;

class Client
{


    public $client;

    /**
     * @var
     */
    public $accessKeyID;
    /**
     * @var
     */
    public $accessKeySecret;

    /**
     * @var
     */
    public $regionId;

    /**
     * @var
     */
    public $timeout;

    /**
     * @var
     */
    public $type;

    /**
     * @var
     */
    public $acceptFormat;

    /**
     * BaseService constructor.
     * @param null $config
     * @param string $securityToken 如果是设置了sts模式，传入这个参数
     */
    public function __construct($config=null,$securityToken='')
    {
        $this->setConfig($config);
        if ($this->type == 'sts') {
            $this->client = $this->initVodSTSClient($securityToken);
        } else {
            $this->client = $this->initVodClient();
        }

    }

    /**
     * initVodClient
     * User：YM
     * Date：2020/4/20
     * Time：10:09 AM
     * @return DefaultAcsClient
     */
    public function initVodClient()
    {

        $profile = DefaultProfile::getProfile($this->regionId, $this->accessKeyID, $this->accessKeySecret);
        return new DefaultAcsClient($profile);
    }


    /**
     * initVodSTSClient
     * User：YM
     * Date：2020/4/20
     * Time：10:09 AM
     * @param $securityToken
     * @return DefaultAcsClient
     */
    public function initVodSTSClient($securityToken)
    {
        $profile = DefaultProfile::getProfile($this->regionId, $this->accessKeyID, $this->accessKeySecret, $securityToken);
        return new DefaultAcsClient($profile);
    }

    /**
     * setConfig
     * User：YM
     * Date：2020/4/20
     * Time：10:09 AM
     * @param null $config
     */
    public function setConfig($config = null)
    {
        if (!$config) {
            $container = ApplicationContext::getContainer();
            $config = $container->get(ConfigInterface::class)->get('aliyun_vod');
        }
        $this->accessKeyID = $config['access_key']??'';
        $this->accessKeySecret = $config['secret_key']??'';
        $this->regionId = $config['region_id']??'';
        $this->timeout = $config['timeout']??'';
        $this->type = $config['type']??'';
        $this->acceptFormat = $config['accept_format']??'';
    }

}
