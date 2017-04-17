<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:62:"D:\www\weioa\public/../application/index\view\index\login.html";i:1484810294;}*/ ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Language" content="zh-cn" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<meta name="author" content="Fhua" />
<meta name="Copyright" content="BLIT" />
<meta name="viewport" content="width=device-width, maximum-scale=1.0, initial-scale=1.0,initial-scale=1.0,user-scalable=no" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<title>登录--<?php echo $default_title; ?></title>
<link href="__CSS__layui.css" rel="stylesheet" />
<link href="__CSS__global.css" rel="stylesheet" />
<script src="__PUBLIC__layui.js?t=1484130829910"></script>
<style>
/*登录样式*/
.login-header { margin-bottom: 0px; }
.login-header .login-top-bg { display: block; /*background: #e9f1f5 url("../img/dj-content-wrap-after-index-tit.png") no-repeat 5% 0px;*/ height: 66px; }
.login-header .login-top-menu { right: 20px; }
.login-header .sitename { width: 300px; float: left; }
.login-header .sitename h2 { display: block; margin-left: 50px; height: 66px; line-height: 66px; font-size: 20px; font-weight: 300; }
.login_content { margin-top: -15px; padding-top: 65px; min-height: 360px; vertical-align: middle; width: 100%; padding-bottom: 90px; background: #e9f1f5 url("__IMAGES__bg-regist-main2.jpg") no-repeat 50% 100%; border-bottom: 1px solid #E5E5E5; }
.login_content #login-banner { float: left; padding-left: 10px; }
#regist { width: 960px; margin: 0 auto; }
.login_content #login-banner { float: left; padding-left: 10px; }
#login-banner img { max-width: 100%; width: 600px; height: 348px; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2); }
#login { float: left; min-height: 360px; max-width: 320px; padding: 0 10px 0px 20px; }
#login form { margin-left: 0px; padding: 26px 24px 72px; font-weight: normal; border: none; -moz-box-shadow: none; -webkit-box-shadow: none; box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.2); }
#login .layui-btn { padding: 0px 30px 1px; width: 100%; }
#login a.send { display: inline-block; border: 1px solid #E8E8E8; border-radius: 3px; width: 158px; height: 40px; line-height: 40px; color: #333; font-size: 14px; text-align: center; background: #FFF none repeat scroll 0% 0%; vertical-align: middle; margin-top: 10px; }
#login #nav { text-shadow: #FFF 0 0 5px,#FFF 0 0 10px; float: right; margin: 0 2px 0 0px; padding: 16px 0px 0 0px; }
.footer { padding: 20px 0; }
</style>
</head>
<body>
		<div class="layui-header header login-header">
        <div class="layui-main login-top-bg">
            <div class="sitename">
                <h2><?php echo $default_title; ?></h2>
            </div>
            <ul class="layui-nav login-top-menu">
                <li class="layui-nav-item site-nav-layim"><a href="">首页</a></li>
                <li class="layui-nav-item site-nav-layim"><a href="">使用手册</a></li>
            </ul>
        </div>
    </div>
    <div class="login_content">
        <div id="regist">
            <div id="login-banner">
                <a href="#" target="_blank">
                    <img src="__IMAGES__mhdcity.jpg">
                </a>
            </div>
            <div id="login">
                <form action="<?php echo url('Index/login'); ?>" class="layui-form layui-form-pane" id="sign-in" method="post" role="form">
										<input type="hidden" name="bsinfo" id="bsinfo" value="" />
                    <p>
                        <div class="layui-form-item">
                            <label class="layui-form-label">账号</label>
                            <div class="layui-input-block">
                                <input name="user_name" lay-verify="required" autocomplete="off" value="admin" placeholder="请输入账号" class="layui-input" type="text">
                            </div>
                        </div>
                    </p>
                    <p>
                        <div class="layui-form-item">
                            <label class="layui-form-label">密码</label>
                            <div class="layui-input-block">
                                <input name="password" lay-verify="required" autocomplete="off" value="admin"  placeholder="请输入密码" class="layui-input" type="password">
                            </div>
                        </div>
                    </p>
                    <!--
                    <p>
                        <div class="layui-form-item">
                            <label class="layui-form-label">验证码</label>
                            <div class="layui-input-block">
                                <input id="user_code" class="layui-input input" value="" size="4" onpaste="return false" maxlength="4" onkeyup="value=value.replace(/[^\w\.\/]/ig,'')" type="text">
                                <a class="send" title="点击切换验证码" href="javascript:;" data-url="/RegCom/get_verify_code">
                                    <img src="/RegCom/get_verify_code" width="80" height="22">
                                </a>
                            </div>
                        </div>
                    </p>
                    <p class="forgetmenot">
                        <div class="layui-form-item">
                            <div class="layui-input-block">
                                <input name="ck" title="记住密码" type="checkbox">
                            </div>
                        </div>
                    </p>-->
                    <p class="submit">
                        <div class="layui-form-item">
                            <a class="layui-btn" lay-submit="" lay-filter="btnsubmit">登　陆</a>
                        </div>
                    </p>
                    <p id="nav">
                        忘记密码 or 没有账号？请联系管理修改。
                    </p>
                </form>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <div class="layui-footer footer footer-doc">
        <div class="layui-main">
            <p>COPYRIGHT &#169; 2017 Fhua. ALL RIGHTS WEIOA.CMS1.0  技术支持：Ghfhaifeng </p>
            <p>
                <a id="pay" href="javascript:;">捐赠作者</a>
                <a id="git" href="javascript:;">Git仓库</a>
                <a id="weixin" href="javascript:;">微信公众号</a>
            </p>
        </div>
    </div>
    <script src="__PUBLIC__global.js"></script>
    <script type="text/javascript">
				layui.config({
  				base: '__PUBLIC__lay/modules/',
					version: '1484130829910'
				}).use(['layer', 'form', 'browser'], function () {
            var $ = layui.jquery,
								layer = layui.layer,
								form = layui.form(),
								bsinfo = layui.browser;

						$("#bsinfo").val(bsinfo.browser + '|' + bsinfo.version + '|' + bsinfo.os + '|' + bsinfo.device);

            //提交
            form.on('submit(btnsubmit)', function (formdata) {
								console.info(formdata.field);
                $.ajax({
                    type: 'POST',
                    url: '<?php echo url("Index/login"); ?>',
                    data: formdata.field,
                    dataType: 'json',
										beforeSend:function(){
												$(".submit a").html("登录中...");
												$(".submit a").attr({ disabled: "disabled" });
										},
                    success: function (Result) {
												console.info(Result);
                        if (Result.errcode == 0) {
                            //$("#sign-in").attr("action", "/");
                            //$("#sign-in").submit();
														location.href = '<?php echo url("Index/index"); ?>';
                        }else {
														$(".submit a").removeAttr("disabled");
														layer.msg(Result.errmsg + "错误代码：" + Result.errcode, {icon: 2});
                        }
                    },
                    error: function (Result, type) {
                        //console.info(Result);
												//console.info(type);
												layer.msg('error', { icon: 2 });
                    }
                });
                return false;
            });

            //切换验证码
            $(".send").click(function () {
                var $this = $(this);
                var url = $this.data('url');
                $this.children("img").eq(0).attr("src", url + "?time=" + Math.random());
                return false;
            });

        });
    </script>
</body>
</html>