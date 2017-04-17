<?php
/*--------------------------------------------------------------------
  微企OA系统 - 让工作更轻松快乐 

  Copyright (c) 2017 http://www.weioa.com All rights reserved.                                             

  Author:  ghfhaifeng<ghfhaifeng@163.com>                         

  Support: https://git.oschina.net/weioa           
--------------------------------------------------------------*/

//基础控制器

namespace app\index\controller;

use think\Controller;
use think\Session;
use think\Request;
use app\index\model\Menu;

class Base extends Controller
{
    private $default_title; //系统标题

    public function _initialize()
    {
        
        // $menu_list = new Menu();
        // $menu = $menu_list->getMenu();
        // print_r($menu);
        // die;
    	//判读用户是否登录
        if(isEmpty(Session::has("user.user_id"))){
           	$this->redirect(url('Index/jump'));
        }
		
        $this->default_title = config('DEFAULT_TITLE');
        $this->assign('default_title', $this->default_title);
        
        //获取菜单
        Session::init([
            'prefix'         => 'menu',
            'type'           => '',
            'auto_start'     => true,
            //有效期,默认1小时
            'expire'         => 3600,
        ]);
        //判断缓存数据是否存在，存在取缓存，不存在从数据库取
        $menu_list = new Menu();
        if(session::has('menu')){
            $menu = session::get('menu');
        }else{
            $menu = $menu_list->getMenu();
        }
        $this->assign('menu', $menu);

        /*top 菜单key*/
        if(input('mid')){
            $this->menu_id = input('mid');
        }else{
            $this->menu_id = $menu[0]['id'];
        }

        $this->assign('mid', $this->menu_id);

        $menu_child = $menu_list->getMenuChild($this->menu_id);
        $this->assign('menu_child', $menu_child);        

        return view("index/index");
    }
}