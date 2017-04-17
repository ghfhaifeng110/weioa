<?php
/*--------------------------------------------------------------------
  微企OA系统 - 让工作更轻松快乐 

  Copyright (c) 2017 http://www.weioa.com All rights reserved.                                             

  Author:  ghfhaifeng<ghfhaifeng@163.com>                         

  Support: https://git.oschina.net/weioa           
--------------------------------------------------------------*/

//首页，登录

namespace app\index\controller;

use think\Controller;
use think\Session;
use think\Request;
use think\Config;
use app\index\model\User;
use app\index\model\Menu;

class Index extends Controller
{
    private $default_title; //系统标题

    public function _initialize(){
        $this->default_title = config('DEFAULT_TITLE');
        $this->assign('default_title', $this->default_title);
    }

    /**
    * 首页，判断用户是否登录，否：跳转到登录页面，是：首页
    */
    public function index(){
        //判断用户是否登录
        if(isEmpty(Session::has("user.user_id"))){
            $this->redirect('Index/login');
        }else{
            //获取菜单
            $menu_list = new Menu();
            $menu = $menu_list->getMenu();

            $this->assign('menu', $menu);
            $this->assign('menu_child', $menu_list->getMenuChild($menu[0]['id']));
            $this->assign('mid', $menu[0]['id']);
            return view("index/index");
        }
    }

    /**
    * 登录页
    */
    public function login(){
        //如果是前端AJAX请求
        if (Request::instance()->isAjax()){
            $user_name  = input("post.user_name");
            $password   = input("post.password");
            $bsinfo     = input("post.bsinfo");
            
            //判断用户是否存在
            $user = User::where("user_name", $user_name)->where("is_del",0)->find();
            if($user){
                //判断用户状态
                if($user['password'] != $password){
                    //用户密码错误
                    echo json_encode( array('errcode' => 1001, 'errmsg' => Conf('code')['1001']) );
                }else{
                    if($user['type'] == 6){
                        //用户已离职
                        echo json_encode( array('errcode' => 1002, 'errmsg' => Conf('code')['1002']) );
                    }else{
                        //用户存在
                        Session::set("user.user_id", $user['id']);
                        Session::set("user.user_name", $user_name);
                        Session::set("user.dept_id", $user['dept_id']);
                        Session::set("user.position_id", $user['position_id']);

                        //添加日志
                        model('Log')->addLog('select', 'user', '用户：'. $user_name . " 登录", null);

                        //登录成功
                        echo json_encode( array('errcode' => 0, 'errmsg' => Config('code')['0']) );
                    }
                }
            }else{
                echo json_encode( array('errcode' => 1000,'errmsg' => Config('code')['1000']) );
            }
        }else{
            return view("index/login");
        }
    }

    /**
    * 默认右侧页
    */
    public function right(){

        return view("index/right");
    }

    /**
    * 退出
    */
    public function logout(){
        Session::delete('user');

        $this->redirect('Index/login');
    }

    /**
    * AJAX获取指定左侧菜单
    * @param data_id:菜单父ID
    */
    public function getMenu(){
        //父ID
        $data_id = input("post.data_id");

        $menu = obj_array( Menu::where("parent_id = " . $data_id)->order("sort desc")->select() );

        //下级分类
        foreach($menu as $k=>$v){
            $child_menu = obj_array( Menu::where("parent_id= " . $v['id'])->order("sort desc")->select() );
            if($child_menu){
                $menu[$k]['child'] = $child_menu;
            }else{
                $menu[$k]['child'] = '';
            }
        }

        echo json_encode($menu);
    }
	
	/**
    * 公共跳转处理
    */
    public function jump(){
        $this->assign('go_url', url('Index/login'));
        
        return view("public/jump");
    }
}
