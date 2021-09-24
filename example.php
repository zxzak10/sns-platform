<?php
/**
 * 使用示例
 * @Author  W.J.Wei
 */

require_once __DIR__ . '/vendor/autoload.php';

use Wutong\Sns\SnsService;

//配置信息数组，根据实际应用场景进行选择存放位置
$config = [
    'platform'      => '',
    'client_id'     => '',
    'client_secret' => '',
    'redirect_uri'  => ''
];

//获取实例化对象
$cc = SnsService::initialize($config);


//授权
$cc->authorize();

//通过授权码获取access_token信息
//$token = $cc->getAccessToken('code');
//print_r($token);

//通过access_token获取用户信息
//$userInfo = $cc->getUserInfo('access_token');
//print_r($userInfo);

//授权信息查询
//$tokenInfo = $cc->getTokenInfo('2.00rcnjTFcgG8BD08eb8421c5');
//var_dump($tokenInfo);


