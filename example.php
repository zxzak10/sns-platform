<?php
/**
 * 使用示例
 * @Author  W.J.Wei
 */

require_once __DIR__ . '/vendor/autoload.php';

use Wutong\Sns\SnsService;

$cc = SnsService::initialize('weibo', []);

//授权
//$cc->authorize();

//通过授权码获取access_token信息
/*$token = $cc->getAccessToken('f3c36664f452d01b5e245ce73445027a');
print_r($token);*/

//通过access_token获取用户信息
/*$info = $cc->getUserInfo('2.00rcnjTFcgG8BD08eb8421c5yI2RUD');
//print_r($info);*/

//授权信息查询
$tokenInfo = $cc->getTokenInfo('2.00rcnjTFcgG8BD08eb8421c5yI2RUD');
var_dump($tokenInfo);


