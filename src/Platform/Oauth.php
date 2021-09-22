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
     * @return mixed
     */
    public function getAccessToken($code);

    /**
     * 获取用户个人信息接口
     *
     * @return mixed
     */
    public function getUserInfo($access_token);
}
