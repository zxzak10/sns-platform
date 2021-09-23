<?php

namespace Wutong\Sns;

use Wutong\Sns\Platform\Weibo;

class SnsService
{
    /**
     * 社交平台
     *
     * @var string[]
     */
    protected static $platform = [
        'weibo',
        'qq',
        'weixin'
    ];

    /**
     * 配置数组
     *
     * @var array
     */
    protected static $config = [
        'client_id'     => '',
        'redirect_uri'  => '',
        'client_secret' => '',
    ];

    /**
     * 服务初始化
     *
     * @param $platform
     * @param array $config
     * @return false|object|Weibo
     */
    public static function initialize($platform, array $config)
    {
        if (!in_array($platform, self::$platform)) {
            return false;
        }

        $config = array_merge(self::$config, $config);
        switch ($platform) {
            case 'weibo':
                return Weibo::getInstance($config);
                break;
        }
    }

}
