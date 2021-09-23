<?php

namespace Wutong\Sns\Platform;

interface Oauth
{
    /*
     * 授权接口
     */
    public function authorize();

    /**
     * 获取access_token接口
     *
     * @param string $code 授权码
     * @return mixed
     */
    public function getAccessToken(string $code);

    /**
     * 获取用户个人信息接口
     *
     * @param string $access_token 用户授权的唯一票据
     * @return mixed
     */
    public function getUserInfo(string $access_token);
}
