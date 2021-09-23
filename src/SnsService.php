<?php

namespace Wutong\Sns;

use Wutong\Sns\Platform\Weibo;
use Wutong\Sns\Platform\Google;

class SnsService
{
    /**
     * 社交平台
     *
     * @var string[]
     */
    protected static $platform = [
        'weibo',
        'google'
    ];

    /**
     * 配置数组
     *
     * @var array
     */
    protected static $config = [
        'platform'      => '',
        'client_id'     => '',
        'client_secret' => '',
        'redirect_uri'  => ''
    ];

    /**
     * 服务初始化
     *
     * @param array $config 配置信息数组
     * @return false|object|Weibo|Google
     */
    public static function initialize(array $config)
    {
        $config = array_filter(array_merge(self::$config, $config));

        $checkOption = ['platform', 'client_id', 'client_secret', 'redirect_uri'];
        $configOption = array_keys($config);
        $diff = array_diff($checkOption, $configOption);
        if ($diff) {
            return false;
        }

        $platform = strtolower($config['platform']);
        if (!in_array($platform, self::$platform)) {
            return false;
        }

        switch ($platform) {
            case 'weibo':
                return Weibo::getInstance($config);
                break;

            case 'google':
                return Google::getInstance($config);
                break;
        }
    }

}
