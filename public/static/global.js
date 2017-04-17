/**

 layui官网

*/

layui.define(['layer', 'code', 'form', 'element', 'util'], function(exports){
    var $ = layui.jquery,
        layer = layui.layer,
        form = layui.form(),
        util = layui.util,
        device = layui.device();

    //阻止IE7以下访问
    if(device.ie && device.ie < 8){
        layer.alert('Layui最低支持ie8，您当前使用的是古老的 IE'+ device.ie + '，你丫的肯定不是程序猿！');
    }
  
    //窗口scroll
    $(function(){
        var main = $('.site-tree').parent(), scroll = function(){
            var stop = $(window).scrollTop();
            if($(window).width() <= 750) return;
            var bottom = $('.footer').offset().top - $(window).height();
            if(stop > 61 && stop < bottom){
                if(!main.hasClass('site-fix')){
                    main.addClass('site-fix');
                }
                if(main.hasClass('site-fix-footer')){
                    main.removeClass('site-fix-footer');
                }
            } else if(stop >= bottom) {
                if(!main.hasClass('site-fix-footer')){
                    main.addClass('site-fix site-fix-footer');
                }
            } else {
                if(main.hasClass('site-fix')){
                    main.removeClass('site-fix').removeClass('site-fix-footer');
                }
            }
            stop = null;
        };
        scroll();
        $(window).on('scroll', scroll);
    });

    //在textarea焦点处插入字符
    var focusInsert = function(str){
        var start = this.selectionStart,
            end = this.selectionEnd,
            offset = start + str.length;

        this.value = this.value.substring(0, start) + str + this.value.substring(end);
        this.setSelectionRange(offset, offset);
    };

    //演示页面
    //手机设备的简单适配
    var treeMobile = $('.site-tree-mobile'),shadeMobile = $('.site-mobile-shade');

    treeMobile.on('click', function(){
        $('body').addClass('site-mobile');
    });

    shadeMobile.on('click', function(){
        $('body').removeClass('site-mobile');
    });

    $(".layui-icon[lay-type='bar1']").hide();

    exports('global', {});
});

/* ajax提交*/
function sendAjax(url, vars, callback) {
    return $.ajax({
        type : "POST",
        url : url,
        data : vars + "&ajax=1",
        dataType : "json",
        success : callback
    });
}

//cookie前缀
var cookie_prefix = 'wei';

/*设置 cookie*/
function set_cookie(key, value, time, path, domain, secure) {
	key = cookie_prefix + key;
	path = "/";
	var cookie_string = key + "=" + escape(value);
	if (!time) {
		time = 'h24';
	}
	var strsec = getsec(time);
	var exp = new Date();
	exp.setTime(exp.getTime() + strsec*1);
	cookie_string += "; expires=" + exp.toGMTString();
		
	if (path)
		cookie_string += "; path=" + escape(path);
	if (domain)
		cookie_string += "; domain=" + escape(domain);
	if (secure)
		cookie_string += "; secure";
	document.cookie = cookie_string;
}

/*读取 cookie*/
function get_cookie(cookie_name) {
	cookie_name = cookie_prefix + cookie_name;
	var results = document.cookie.match('(^|;) ?' + cookie_name + '=([^;]*)(;|$)');
	if (results)
		return (unescape(results[2]));
	else
		return null;
}

/*删除 cookie*/
function del_cookie(cookie_name) {
	cookie_name = cookie_prefix + cookie_name;
	var cookie_date = new Date();
	//current date & time
	cookie_date.setTime(cookie_date.getTime() - 1);
	document.cookie = cookie_name += "=; expires=" + cookie_date.toGMTString();
}

/*cookie专用时间转换*/
function getsec(str){
	//alert(str);
	var str1=str.substring(1,str.length)*1;
	var str2=str.substring(0,1);
	if (str2=="s"){
		return str1*1000;
	}else if (str2=="h"){
		return str1*60*60*1000;
	}else if (str2=="d"){
		return str1*24*60*60*1000;
	}
}

/*页面加载中菜单处理*/
function setSelectMenu(){
	var data_id1 = get_cookie('data_id1');
	var data_id2 = get_cookie('data_id2');
	var data_id3 = get_cookie('data_id3');

	if(data_id1){
		//$("#top-nav li[data-id="+ data_id1 +"]").addClass('layui-this');
		if(data_id3){
			$(".layui-nav-tree dd[data-id="+ data_id3 +"]").addClass('layui-this');
			$(".layui-nav-tree li[data-id="+ data_id2 +"]").addClass('layui-nav-itemed');
		}else{
			$(".layui-nav-tree li[data-id="+ data_id2 +"]").addClass('layui-this');
		}
	}
}

function buildListener(){
	/*左侧菜单点击时 cookie处理*/
	$(".layui-nav-tree a,.layui-nav-tree dd a").bind('click',function(){
		var data_id1 = $(this).attr('data-id1');
		var data_id2 = $(this).attr('data-id2');
		var data_id3 = $(this).attr('data-id3');
		var data_href = $(this).attr('data-href');
		
		set_cookie("data_id1", data_id1);
		set_cookie("data_id2", data_id2);
		set_cookie("data_id3", data_id3);
		console.info(data_href);
		
		location.href = data_href;
	});
}

/*赋值*/

function set_val(name, val) {

	if ($("#" + name + " option").length > 0) {
		if (val == "") {
			$("#" + name + " option:first").attr('selected', 'selected');
		} else {
			$("#" + name + " [value=" + val + "]").attr('selected', 'selected');
		}
		return;
	}
	if (($("#" + name).attr("type")) === "checkbox") {
		if (val == 1) {
			$("#" + name).attr("checked", true);
			return;
		}
	}

	if ($("." + name).length > 0) {
		if (($("." + name).first().attr("type")) === "checkbox") {
			var arr_val = val.split(",");
			for (var s in arr_val) {
				$("input." + name + "[value=" + arr_val[s] + "]").attr("checked", true);
			}
		}
	}

	if (($("#" + name).attr("type")) === "text") {
		$("#" + name).val(val);
		return;
	}
	if (($("#" + name).attr("type")) === "hidden") {
		$("#" + name).val(val);
		return;
	}
	if (($("#" + name).attr("rows")) > 0) {
		$("#" + name).text(val);
		return;
	}
}
