<?php if (!defined('THINK_PATH')) exit(); /*a:5:{s:62:"D:\www\weioa\public/../application/index\view\index\index.html";i:1485088993;s:62:"D:\www\weioa\public/../application/index\view\public\head.html";i:1485073850;s:61:"D:\www\weioa\public/../application/index\view\public\top.html";i:1485154515;s:62:"D:\www\weioa\public/../application/index\view\index\right.html";i:1485073642;s:64:"D:\www\weioa\public/../application/index\view\public\footer.html";i:1485152387;}*/ ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo $default_title; ?></title>
<meta name="renderer" content="webkit">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta name="apple-mobile-web-app-status-bar-style" content="black"> 
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="format-detection" content="telephone=no">

<link rel="stylesheet" href="__CSS__layui.css"  media="all">
<link rel="stylesheet" href="__CSS__global.css" media="all">
</head>
<body>
    <div class="layui-layout layui-layout-admin">
        <div class="layui-header header header-demo">
    <div class="layui-main">
        <a class="logo" href="/"><?php echo $default_title; ?></a>
        <ul class="layui-nav" id="top-nav" style="right:180px;">
            <?php if(is_array($menu) || $menu instanceof \think\Collection): $k = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$m): $mod = ($k % 2 );++$k;?>
            <li class="layui-nav-item <?php if($mid == $m['id']): ?>layui-this<?php endif; ?>" data-id="<?php echo $m['id']; ?>"><a href="javascript:;"><?php echo $m['name']; ?></a></li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
        <ul class="layui-nav user-info">
            <li class="layui-nav-item">
                <a href="javascript:;"><img src="__IMAGES__tx04.jpg" class="layui-circle"><span>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo \think\Session::get('user.user_name'); ?></span><span class="layui-nav-more"></span></a>
                <dl class="layui-nav-child layui-anim layui-anim-upbit">
                    <dd><a href=""><i class="layui-icon">&#xe77b;</i>修改密码</a></dd>
                    <dd><a href=""><i class="layui-icon">&#xe799;</i>提醒信息</a></dd>
                    <dd><a href=""><i class="layui-icon">&#xe6d5;</i>账号信息</a></dd>
                    <dd><a href="<?php echo url('Index/logout'); ?>"><i class="layui-icon red">&#xe68e;</i>退出</a></dd>
                </dl>
            </li>
        </ul>
    </div>
</div>
<div class="layui-side layui-bg-black">
    <div class="layui-side-scroll">
        <ul class="layui-nav layui-nav-tree site-demo-nav">
            <?php if(is_array($menu_child) || $menu_child instanceof \think\Collection): $k = 0; $__LIST__ = $menu_child;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$mm): $mod = ($k % 2 );++$k;?>
            <li class="layui-nav-item" data-id="<?php echo $mm['id']; ?>">
                <a class="" data-id1="<?php echo $mm['parent_id']; ?>" data-id2="<?php echo $mm['id']; ?>" data-href='<?php if(($mm['child'] == '') or ($mm['child'] == 'null')): ?><?php echo Url($mm['url'],['mid'=>$mm['parent_id']]); else: ?>javascript:;<?php endif; ?>' href="javascript:;"><?php if($mm['icon']): ?><i class="layui-icon"><?php echo $mm['icon']; ?></i><?php endif; ?><?php echo $mm['name']; ?></a>
                <?php if($mm['child'] != ''): ?>
                <dl class="layui-nav-child">
                    <?php if(is_array($mm['child']) || $mm['child'] instanceof \think\Collection): $kn = 0; $__LIST__ = $mm['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$mn): $mod = ($kn % 2 );++$kn;?>
                    <dd class="" data-id="<?php echo $mn['id']; ?>"><a data-id1="<?php echo $mm['parent_id']; ?>" data-id2="<?php echo $mn['parent_id']; ?>" data-id3="<?php echo $mn['id']; ?>" data-href="<?php echo url($mn['url'],['mid'=>$mm['parent_id']]); ?>" href="javascript:;"><?php if($mn['icon']): ?><i class="layui-icon"><?php echo $mn['icon']; ?></i><?php endif; ?><?php echo $mn['name']; ?></a></dd>
                    <?php endforeach; endif; else: echo "" ;endif; ?>
                </dl>
                <?php endif; ?>
            </li>
            <?php endforeach; endif; else: echo "" ;endif; ?>
        </ul>
    </div>
</div>
        <div class="layui-body site-demo">
            <!--<iframe style="width:100%; min-height:700px; overflow:auto;" frameborder="0" src="<?php echo Url('Index/right'); ?>" name="main" id="main"></iframe>-->
            <div class="layui-layout layui-layout-admin">
   	right
</div>
        </div>
        <div class="layui-footer footer footer-demo" style="height:1px;"></div>
        <div class="site-tree-mobile layui-hide"><i class="layui-icon">&#xe602;</i></div>
        <div class="site-mobile-shade"></div>
    </div>
<script src="__PUBLIC__layui.js?t=1484130829910" charset="utf-8"></script>
<script src="__JS__jquery-2.1.2.min.js" charset="utf-8"></script>
<script>
layui.config({
    base: '__PUBLIC__',
    version: '1484130829910'
}).use(['global','element'],function(){
    var $ = layui.jquery;
    var element = layui.element();

    //顶部菜单点击
    $("#top-nav li").click(function(){
        var data_id = $(this).attr("data-id");
        var html = "";
        
        sendAjax('<?php echo url("Index/getMenu"); ?>',"data_id=" + data_id, function(res){
            console.info(res);
            $(".layui-nav-tree").html("");

            if(res){
                $.each(res,function(index,item){
                    html += '<li class="layui-nav-item" data-id="'+ item.id +'">';
                    html += '<a class="javascript:;" data-id1="'+ item.parent_id +'" data-id2="'+ item.id +'" data-id3="" href="javascript:;" data-href=';
                    if(item.url){
                        html += '/index/' + item.url + '/mid/' + item.parent_id;
                    }else{
                        html += 'javascript:;';
                    }
                    html += '><i class="layui-icon">';
                    if(item.icon){
                        html += item.icon;
                    }
                    html += '</i>' + item.name + '</a>';

                    //下级菜单内容
                    if(item.child){
                        html += '<dl class="layui-nav-child">';
                        $.each(item.child, function(i,m){
                            html += '<dd class="" data-id="'+ m.id +'"><a data-id1="'+ item.parent_id +'" data-id2="'+ m.parent_id +'" data-id3="'+ m.id +'" href="javascript:;" data-href="';
                            if(m.url){
                                html += '/index/' + m.url + '/mid/' + item.parent_id;
                            }else{
                                html += 'javascript:;';
                            }
                            html += '"><i class="layui-icon">';
                            if(m.icon){
                                html += m.icon;
                            }
                            html += '</i>'+ m.name +'</a></dd>';
                        });
                        html += '</dl>';
                    }

                    html += '</li>';
                });
                
                if(html){
                    $(".layui-nav-tree").append(html);
                    element.init();
                    buildListener();
                }else{
                    $(".layui-nav-tree").html("无数据!");
                }
            }
        });
    });

	/*左侧菜单点击时 cookie处理*/
	$(".layui-nav-tree a,.layui-nav-tree dd a").click(function(){
		var data_id1 = $(this).attr('data-id1');
		var data_id2 = $(this).attr('data-id2');
		var data_id3 = $(this).attr('data-id3');
		var data_href = $(this).attr('data-href');
		
		console.info(data_href);
		
		set_cookie("data_id1", data_id1);
		set_cookie("data_id2", data_id2);
		set_cookie("data_id3", data_id3);
		
		location.href = data_href;
	});
	
	/*页面加载中菜单处理*/
	setSelectMenu();
});
</script>
</body>
</html>