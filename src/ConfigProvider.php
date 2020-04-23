<?php

declare(strict_types=1);
/**
 * Created by PhpStorm.
 *​
 * ConfigProvider.php
 *
 * Hyperf 组件的重要的机制
 *
 * User：YM
 * Date：2019/12/23
 * Time：下午5:20
 */


namespace Ym\AliyunVod;


/**
 * ConfigProvider
 * 类的介绍
 * @package Ym\AliyunSls
 * User：YM
 * Date：2019/12/23
 * Time：下午5:20
 */
class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => [
                ClientInterface::class => Client::class,
            ],
            'processes' => [
            ],
            'listeners' => [
            ],
            'annotations' => [
                'scan' => [
                    'paths' => [
                        __DIR__,
                    ],
                    'collectors' => [
                    ],
                ],
            ],
            'publish' => [
                [
                    'id' => 'config',
                    'description' => 'The config for aliyun vod.',
                    'source' => __DIR__ . '/../publish/aliyun_vod.php',
                    'destination' => BASE_PATH . '/config/autoload/aliyun_vod.php',
                ],
            ],
        ];
    }
}