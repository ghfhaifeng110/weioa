<?php
/*--------------------------------------------------------------------
  微企OA系统 - 让工作更轻松快乐 

  Copyright (c) 2017 http://www.weioa.com All rights reserved.                                             

  Author:  ghfhaifeng<ghfhaifeng@163.com>                         

  Support: https://git.oschina.net/weioa           
--------------------------------------------------------------*/

//公司信息

namespace app\index\controller;

use think\Controller;
use think\Request;
use app\index\model\User;
use app\index\model\Dept;

class Company extends Base
{

    public function _initialize(){
    	parent::_initialize();
    }
    /**
     * 组织结构
     * */
    public function dept(){
        $list = obj_array( Dept::where("is_del", 0) -> select() );
        $tree = list_to_tree($list);

        $this -> assign('dept', popup_tree_menu($tree));
    	
        return $this->fetch('company/dept');
    }
}

/*生成菜单树结构*/
function popup_tree_menu($tree, $level = 0) {
	$level++;
	$html = "";
	if (is_array($tree)) {
		$html = "<ul class=\"tree_menu\">\r\n";
		foreach ($tree as $val) {
			if (isset($val["name"])) {
				$title = $val["name"];
				$id = $val["id"];
				if (empty($val["id"])) {
					$id = $val["name"];
				}
				if (!empty($val["is_del"])) {
					$del_class = "is_del";
				} else {
					$del_class = "";
				}
				if (isset($val['_child'])) {
					$html = $html . "<li>\r\n<a class=\"$del_class\" node=\"$id\" ><i class=\"layui-icon level$level\">&#xe74e;</i><span>$title</span></a>\r\n";
					$html = $html . popup_tree_menu($val['_child'], $level);
					$html = $html . "</li>\r\n";
				} else {
					$html = $html . "<li>\r\n<a class=\"$del_class\" node=\"$id\" ><i class=\"layui-icon level$level\">&#xe74e;</i><span>$title</span></a>\r\n</li>\r\n";
				}
			}
		}
		$html = $html . "</ul>\r\n";
	}
	return $html;
}