<?php
/*--------------------------------------------------------------------
  微企OA系统 - 让工作更轻松快乐 

  Copyright (c) 2017 http://www.weioa.com All rights reserved.                                             

  Author:  ghfhaifeng<ghfhaifeng@163.com>                         

  Support: https://git.oschina.net/weioa           
--------------------------------------------------------------*/

//日志模型

namespace app\index\model;

use think\Model;
use think\Session;

class Log extends Model
{
    //自定义初始化
    protected function initialize()
    {
        //需要调用`Model`的`initialize`方法
        parent::initialize();
        //TODO:自定义的初始化
    }
    /**
    * 添加日志
    * @param type:类型，table_name:操作的表名，intro:日志内容, user_os:用户浏览器信息，可为空
    */
    public function addLog($type, $table_name, $intro, $user_os){
        //客户端IP
        $client_ip = getIp(); 
        //用户ID
        $user_id = Session::get('user.user_id');

        if(isEmpty($user_os)){
            $user_os = get_os() . " | " . get_broswer();
        }

        $data = [
            'type' => $type,
            'table_name' => $table_name,
            'user_id' => $user_id,
            'intro' => $intro,
            'user_os' => $user_os,
            'user_ip' => $client_ip,
            'create_time' => date("Y-m-d H:i:s"),
        ];

        \think\Db::name('log')->insert($data);
    }
}