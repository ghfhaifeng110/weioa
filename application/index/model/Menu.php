<?php
/*--------------------------------------------------------------------
  微企OA系统 - 让工作更轻松快乐 

  Copyright (c) 2017 http://www.weioa.com All rights reserved.                                             

  Author:  ghfhaifeng<ghfhaifeng@163.com>                         

  Support: https://git.oschina.net/weioa           
--------------------------------------------------------------*/

//菜单模型

namespace app\index\model;

use think\Model;

class Menu extends Model
{
    // 设置当前模型对应的完整数据表名称
    //protected $table = 'wei_menu';

    //自定义初始化
    protected function initialize()
    {
        //需要调用`Model`的`initialize`方法
        parent::initialize();
        //TODO:自定义的初始化
    }
    /**
    * 获取菜单
    * @param 
    */
    public function getMenu(){
        $menu = obj_array($this -> where("parent_id", 0) -> where("is_del", 0) -> order("sort desc") -> select());

        return $menu;
    }

    /**
    * 获取子菜单
    * @param menu_id:top菜单ID
    */
    public function getMenuChild($menu_id){
        $child_menu1 = obj_array( $this->where("is_del", 0) -> where("parent_id", $menu_id) -> order("sort desc") -> select() );

        if($child_menu1){
            foreach($child_menu1 as $k=>$v){
                $child_menu2 = obj_array( $this->where("is_del", 0)->where("parent_id", $v['id'])->order("sort desc")->select() );
                if($child_menu2){
                    $child_menu1[$k]['child'] = $child_menu2;
                }else{
                    $child_menu1[$k]['child'] = "";
                }
            }
        }else{
            $child_menu1 = "";
        }

        return $child_menu1;
    }
}