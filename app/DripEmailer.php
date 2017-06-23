<?php
/**
 * Created by PhpStorm.
 * User: xiaohongyang
 * Date: 2016/11/24
 * Time: 16:23
 */

namespace App;


class DripEmailer
{
    public function send(User $user){
        echo sprintf("send Email:发送邮件给%s", $user->name);
    }

}