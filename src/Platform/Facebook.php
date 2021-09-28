<?php

namespace Wutong\Sns\Platform;

use GuzzleHttp\Client;

class Facebook implements Oauth
{
    /**
     * 静态私有的变量保存该类对象
     * @var object
     */
    private static $_instance;

    /**
     * HTTP客户端实例对象
     * @var Client
     */
    private static $http;

    /**
     * 配置数组
     * @var array
     */
    protected $config = [];

    /**
     * Weibo constructor.
     * @param array $config
     */
    private function __construct(array $config)
    {
        $this->config = $config;

        //判断HTTP客户端实例对象是否是Client实例
        if ((!self::$http instanceof Client)) {
            self::$http = new Client();
        }
    }

    /**
     * 定义一个空方法防止被外部克隆
     */
    private function __clone()
    {

    }

    /**
     * 获取实例对象的方法
     *
     * @param array $config
     * @return object|Google
     */
    public static function getInstance(array $config)
    {
        if (!(self::$_instance instanceof Facebook)) {
            self::$_instance = new self($config);
        }

        return self::$_instance;
    }

    /**
     * 授权
     */
    public function authorize()
    {
        $url = 'https://www.facebook.com/v12.0/dialog/oauth';

        $query = array_filter([
            'client_id'     => $this->config['client_id'],
            'response_type' => 'code',
            'redirect_uri'  => $this->config['redirect_uri'],
            'state'         => ''
        ]);

        $url = $url . '?' . http_build_query($query);
        header('Location:' . $url);
        exit();
    }

    /**
     * 通过授权码获取access_token信息
     *
     * @param string $code 授权码
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getAccessToken(string $code)
    {
        if (empty($code)) {
            return [];
        }

        $url = 'https://graph.facebook.com/v12.0/oauth/access_token';

        $params = array_filter([
            'client_id'     => $this->config['client_id'],
            'client_secret' => $this->config['client_secret'],
            'code'          => $code,
            'redirect_uri'  => $this->config['redirect_uri']
        ]);

        try {
            $res = self::$http->request('POST', $url, ['query' => $params]);
            $res = json_decode($res->getBody()->getContents(), true);
            return $res;

        } catch (\GuzzleHttp\Exception\RequestException $e) {
            return json_decode($e->getResponse()->getBody()->getContents(), true);
        }
    }

    /**
     * 通过access_token获取用户信息
     *
     * @param string $access_token 用户授权的唯一票据
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getUserInfo(string $access_token)
    {
        if (empty($access_token)) {
            return [];
        }

        $url = 'https://graph.facebook.com/v12.0/me';

        $params = array_filter([
            'access_token' => $access_token,
            'fields'       => 'id,name,picture',
        ]);

        try {
            $res = self::$http->request('GET', $url, ['query' => $params]);
            $res = json_decode($res->getBody()->getContents(), true);
            return $res;

        } catch (\GuzzleHttp\Exception\RequestException $e) {
            $res = json_decode($e->getResponse()->getBody()->getContents(), true);
            return $res;
        }
    }

}
