<?php

/*  测试通过  */

session_start();

if (!isset($_COOKIE['username']) || !isset($_COOKIE['password'])) {
    header('Location: /bangke/manage/admin/login.php');
    exit(-1);
}

/* admin session */
if ($_COOKIE['PHPSESSID'] != session_id()) {
    header('Location: /bangke/manage/admin/login.php');
    exit(-1);
}

/* ---测试通过end--- */

?>

<html xmlns="http://www.w3.org/1999/xhtml" xmlns:bangke=""><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta http-equiv="Page-Enter" content="revealTrans(duration=5, transition=7)">
<meta name="keywords" content="邦客，琴行，管家，琴行管家，琴行软件，邦客琴行管家，琴行进销存，琴行发展，琴行扩张,琴行办公,琴行OA,琴行系统,广州琴行软件">
<meta name="description" content="琴行管家是广州骏睿信息科技有限公司，结合自身十年来对琴行需求的资深理解，将ERP的管理思想、管理流程同琴行的应用特点相结合，自主研发的一套贴身解决琴行管理问题的完整解决方案。">
<meta name="renderer" content="webkit">
<title>邦客琴行管家</title>
<!--客服固定框css-->
<link rel="icon" href="http://www.dsmake.com/bangke/Public/Static/images/main/icon.png" type="image/x-icon">
<link rel="stylesheet" type="text/css" href="register_files/bootstrap.css">
<link rel="stylesheet" type="text/css" href="register_files/formBuilder.css">
<link rel="stylesheet" type="text/css" href="register_files/fullcalendar.css">
<link rel="stylesheet" type="text/css" href="register_files/consult.css">
<link rel="stylesheet" type="text/css" href="register_files/component.css">
<link rel="stylesheet" type="text/css" href="register_files/global.css">
<link rel="stylesheet" type="text/css" href="register_files/style.css">
<link rel="stylesheet" type="text/css" href="register_files/jquery_002.css">
<link rel="stylesheet" type="text/css" href="register_files/jquery-ui.css">

<link rel="stylesheet" type="text/css" href="register_files/textext_003.css">
<link type="text/css" href="register_files/textext.css" rel="stylesheet">
<link type="text/css" href="register_files/textext_002.css" rel="stylesheet">
<link type="text/css" href="register_files/textext_004.css" rel="stylesheet">

<script type="text/javascript" src="register_files/jquery-1.js"></script>
<script type="text/javascript" src="register_files/json2.js"></script>
<script type="text/javascript" src="register_files/ajaxupload.js"></script>

<link rel="stylesheet" type="text/css" href="register_files/enjoyhint.css">
<script type="text/javascript" src="register_files/enjoyhint.js"></script>
<script type="text/javascript" src="register_files/enjoyhintData.js"></script>
<script type="text/javascript" src="register_files/sender.js"></script>
<script type="text/javascript" src="register_files/jquery_003.js"></script>

<script type="text/javascript" src="register_files/hotkeys.js"></script>
<link rel="stylesheet" type="text/css" href="register_files/jquery.css">
<script type="text/javascript" src="register_files/jquery_004.js"></script>
<script type="text/javascript" src="register_files/jquery_002.js"></script>
<link rel="stylesheet" type="text/css" href="register_files/default.css"><link rel="stylesheet" type="text/css" href="register_files/emoji.css">
<style type="text/css">
    button[disabled], input[type=button][disabled], input[type=submit][disabled]{
        background:#ddd !important;
        border:1px solid #ddd;
        color:#777;
        cursor: not-allowed;
        box-shadow: none;
    }
</style>
<script type="text/javascript">
    var editor;
    var BKGlobal={};
  	$(function(){
        var explorer = window.navigator.userAgent;
        if(explorer.indexOf('Firefox')<0&&explorer.indexOf('WebKit')<0&&explorer.indexOf('Chrome')<0&&explorer.indexOf('Safari')<0&&explorer.indexOf('Opera')<0){
            alert('本系统不支持您的浏览器，请下载360浏览器使用本系统');
            location.href="http://se.360.cn/";
        }

        $.jGrowl.defaults.pool = 5;
        $.jGrowl.defaults.closerTemplate = '<div>关闭所有</div>';

        if(getCookie('is_login_first')==1){  
          if(getCookie('isAd')==1){
            if(getCookie('Adnum')!=1){
               show_ad();
            }
          }else{
             show_welcome();
          }
        }

        startMission();
        htmlInitialize();
        webSenderInitialize();
        topSearchInitialize();
        
        createImageTip();
        skinInitialize();

        adInitialize();

        $('.leftmenu').hover(function(){
            $('.leftmenu .image_tip_div').toggle();
        }); 


        checkNewsInitialize(); 

        helperInitialize(); 

        checkQueueInitialize();

        if(getCookie('IN_HS')==1){
            showHostedSignZone();
        }

        allFuncBtnInitialize();

        hotKeysInitialize();

        callNotification();

        var currentRequests = {};
        $.ajaxPrefilter(function(options, originalOptions, jqXHR){
            if(options.abortOnRetry){ // 重复提交覆盖请求
                if(currentRequests[options.url]){
                    currentRequests[options.url].abort();
                }
                currentRequests[options.url] = jqXHR;
            }else if(options.prohibitRetry){ // 禁止重复提交
                if(currentRequests[options.url]){
                    jqXHR.abort();
                }else{
                    currentRequests[options.url] = jqXHR;
                }
            }else{ // 不限制
                currentRequests[options.url] = jqXHR;
            }
            console.log("currentRequests",currentRequests);
        });
        $(document).ajaxComplete(function(event, xhr, settings){
            delete currentRequests[settings.url];
        });
    });
    (function($) {
        var formSubmit=function(form,filter,handle){
            $form=$(form);
            var params=getFormJson($form);
            if(typeof handle == "undefined"){
                handle=filter;
                filter=null;
            }
            if(filter){
                var params=filter(params);
                if(!params){
                    return false;
                }
            }
            $.ajax({
                type:$form.attr('method'), 
                url:$form.attr('action'), 
                data:params,
                prohibitRetry:true,
                beforeSend: function(xhr) {
                    submit_before_info();
                    disableForm(form, true);
                },
                complete:function(xhr, ts){
                    window.setTimeout(disableForm, 800, form, false);
                },
                success:function(data){
                    submit_back_info(data);
                    if(typeof handle != "function"){
                        if(data.status==1){
                            location.reload();
                        }
                    }else{
                        handle(data);
                    }
                }
            });
            return false;
        };

        var disableForm=function(form, disable){
            if(disable){
                $(form).find("[type=submit]").attr("disabled", disable);
            }else{
                $(form).find("[type=submit]").removeAttr("disabled");
            }
        };
        $.fn.formSubmit=function(filter,handle){
            $(this).each(function(){
                if(!$(this).data("formSubmit")){
                    $(this).on("submit",function(){
                        formSubmit(this, filter, handle);
                        return false;
                    });
                    $(this).data("formSubmit",(new Date).getTime());
                }
            });
        }
        window.formSubmit=formSubmit;
    })(jQuery);

    function callNotification(options,callback){
        if (!window.Notification) {
            console.log('浏览器不支持Notification');
            return false;
        }
        var showNotification = function(){
            if (Notification.permission == "granted") {
                var _default = {
                    "title":"【邦客】系统消息",
                    "body":"",
                    "icon":"/bangke/Public/Static/images/main/icon.png",
                    "show":true,
                };
                options = $.extend(_default, typeof options === "string" ?{body:options}:options);
                if(typeof options.show=="function" && options.show()){
                    options.show=true;
                }
                if(!options.show) return false;
                var notification = new Notification(options.title, options);
                callback && callback(notification);
            }
        }
        if (Notification.permission == "granted") {
            options && showNotification();
        } else if (Notification.permission != "denied") {
            Notification.requestPermission(function (permission) {
                options && showNotification();
            });
        }
    }

    function callFunc(func, args, defaultValue) {
        if (typeof func === 'string') {
            // support obj.func1.func2
            var fs = func.split('.');

            if (fs.length > 1) {
                func = window;
                $.each(fs, function (i, f) {
                    func = func[f];
                });
            } else {
                func = window[func];
            }
        }
        if (typeof func === 'function') {
            return func.apply(null, args);
        }
        return defaultValue;
    }

    function allFuncBtnInitialize(){
        var isHover=0;
        $('#allFuncBtn').hover(function(){
            isHover=1;
            $('#allFunc_box').show();
        },function(){
            window.setTimeout(function(){
                isHover=0;
                if(!$('#allFunc_box').is(":hover")){
                    $('#allFunc_box').hide();
                }
            },500);
        });

        $('#allFunc_box').hover('',function(){
            if(!isHover){
                $(this).hide();
            }
        });
    }

    function hotKeysInitialize(){
        hotkeys('f', function(event,handler){
            $('#searchString').focus();
            return false;
        });

        hotkeys('f1', function(event,handler){
            $('#allFunc_box').toggle();
            return false;
        });
    }

    function kEditorInitialize(options){
        var _default={
            width:'600px',
            height:'300px',
            minWidth:300,
            uploadJson:"/bangke/manage/Upload/keUpload",
            allowFlashUpload:false,
            allowMediaUpload:false,
            allowFileUpload:false,
            allowFilemanager:false,
            afterChange: function() {
                this.sync();
            },
            items:['formatblock', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold','italic', 'underline', 'lineheight', 'removeformat', '|','justifyleft', 'justifycenter', 'justifyright','justifyfull', 'insertorderedlist', 'insertunorderedlist', '|',  'fullscreen', '/', 'image', 'emoticons', '|','clearhtml','source', 'preview']
        };

        var editor = KindEditor.create('.text_editor', $.extend(_default,options||{}));
        return editor;
    }

    function showHostedSignZone(){
        showTBox("TitleClose","/bangke/manage/Booking/hostedSign","100vw,100vh","","","","",{maskclose:0,close:0,class:"tbox_unlimit",top:0,left:0});
    }

    //cookie控制各个页面第一次访问时跳出新手指导，如果有的话。
    function helperInitialize(key,callback){
        var key=key||(getFCL('student')+'-'+getFCL('index'));
        if(getCookie('NewbieGuideDone')){
            var doneStr=getCookie('FirstGuideDone')||'';
            if(doneStr.indexOf(key)==-1){
                if(callback){
                    callback(doneStr,key);
                }else if(typeof(tutorial)=='function'){
                    doneStr+='#'+key;
                    setCookie('FirstGuideDone',doneStr,3600);
                    tutorial();
                }
            }
        }
    }

    //获得首中尾字符
    function getFCL(str){
        var l=str.length;
        if(l%2==0){
            return str.substr(0,1)+str.substr(l/2-1,2)+str.substr(-1,1);
        }else{
            return str.substr(0,1)+str.substr(l/2-0.5,1)+str.substr(-1,1);
        }
    }

    function checkQueueInitialize(){
        if(BKGlobal.delayQueue===undefined){
            BKGlobal.delayQueue=$.delayQueue({interval:20000});
        }
        BKGlobal.checkQueueTimer=$.timer(10000, function(){
            // if(document.domain!='119.23.230.118'){
                checkQueue();
            // }
        });
    }

    function queueLocalization(queue){
        if(queue){
            setCookie('queue',JSON.stringify(queue));
        }else{
            var t=getCookie('queue');
            t=t?JSON.parse(t):[];
            return t;
        }
    }

    function getQueue(){
        var queue=BKGlobal.queue;
        if(!queue){
            setQueue();
            queue=BKGlobal.queue;
        }
        var thing=queue.shift();
        if(!thing&&queue.length==0){
            if(setQueue()){
                return getQueue();
            }else{
                return '';
            }
        }
        return thing;
    }

    function setQueue(thing,delay){  
        if(!thing){
            if(BKGlobal.queue===undefined){
                BKGlobal.queue=queueLocalization();
                return true;
            }else{
                return false;
            }
        }else{
            if(delay>0){ //推迟
                BKGlobal.queue.push(delay+"#"+thing);
            }else if(delay==0){  //完成

            }
            queueLocalization(BKGlobal.queue);
        }
    }

    function checkQueue(thing){
        var thing=thing?thing:getQueue();
        if(!thing){
            BKGlobal.checkQueueTimer.pause(); //暂停
        }
        if(thing.indexOf('_')==-1){
            return ;
        }
        if(thing.indexOf('#')>0){
            var t=thing.split('#')[0];
            if(t==-1){  //-1为停止该任务
                return ;
            }
            thing=thing.split('#')[1];
            BKGlobal.delayQueue.add(t,"checkQueue('"+thing+"')");
            setQueue(thing,0); 
            return ;
        }
        BKGlobal.checkQueueTimer.pause(); //暂停
        window[thing.split("_")[0]](thing.split("_")[1],function(res){
            setQueue(thing,res);
            BKGlobal.checkQueueTimer.resume();  //恢复
        });
    }

    function queueFunc(type,callback){
        $.ajax({
            type:'GET',
            url:"/bangke/manage/BaseData/checkQueue",
            data:{type:type},
            error:function(XMLHttpRequest, textStatus, errorThrown){
                callback&&callback(1); //推迟一分钟执行
            },
            success:function(data){
                if(data.status==0){
                    callback&&callback(1);  //推迟一分钟执行
                }else{  //有任务，提醒用户
                    TINY.box.reset();
                    showTBox('待办事项','','500px',data,function(){
                        if(typeof(tboxPageInit)=='function'){
                            tboxPageInit(callback);
                        }else{
                            getResult(callback);
                        }
                    },function(){
                        callback&&callback(1);  //推迟一分钟
                    });
                }
            }
        });
    }

    function getPushedNotes(data){
        var args=$.parseJSON(data)||data;
        showNotification(args.msg,args);
    }

    function showNotification(msg,options){
        var _default={
            sticky: true,
            click: function(self) {
                log('..');
            }
        };
        if(options!==undefined&&options.url!==undefined){
            _default.click=function(self){
                location.href=options.url;
            }
        }
        var options = $.extend(_default, options||{});
        $.jGrowl(msg, options);
        callNotification({
            body:msg,
            tag:new Date().getTime(),
            vibrate:[200, 100, 200]
        },function(notification){
            notification.onclick=function(){
                notification.close();
            }
        });
    }

    function showShortMsg(type,args){
        var html,title;
        log(args);
        args=args?JSON.parse(args):{};
        switch(type){
            case "serviceOver":
                title="服务结束提醒";
                html="<p class='short_msg'>温馨提示："+args.stu_name+"签到的"+args.sv_name+"服务已经结束了！</p>";
                break;
            case "classOver":
                title="课程结束提醒";
                html="<p class='short_msg'>温馨提示："+args.stu_name+"签到的"+args.c_name+"课程已经结束了！</p>";
                break;
            default:;
        } 
        if(html){
            var time=nowDateTime();
            storageOperator('shortMsg',{'title':title,'html':html,'time':time});
            TINY.box.reset();
            showTBox(title,'','400px',html,'','','',{autohide:6});
            showNotification(html);
        }
    }

    function showShortMsgList(){
        var list=storageOperator('shortMsg');
        var html="<div class='short_msg_list'>";
        for(i in list){
            html+="<dl>"+list[i]['title']+"【"+list[i]['time']+"】："+list[i]['html']+"</dl>";
        }
        html+="</div>";
        showTBox('通知','','500px',html,'','');
    }

    function storageOperator(name,value,max){ //储存为list数组
        if(!window.localStorage){
            console.error('该浏览器不支持本地存储');
            return false;
        }
        var storage=window.localStorage;
        if(value){
            var o=storage.getItem(name);
            o=o?JSON.parse(o):[];
            if(value=='[remove]'){
                if(max){
                    o.splice(max,1);
                    storage.setItem(name,JSON.stringify(o));
                }else{
                    storage.removeItem(name);
                }
            }else{
                o.unshift(value);
                max=max||10;
                if(o.length>max){ //只保留max条记录
                    o.splice(0,o.length-max);
                }
                storage.setItem(name,JSON.stringify(o));
            }
        }else{
            var o=storage.getItem(name);
            return o?JSON.parse(o):[];
        }
    }

    function storageObjOperator(name,key,value){ //储存为对象
        if(!window.localStorage){
            console.error('该浏览器不支持本地存储');
            return false;
        }
        var storage=window.localStorage;
        if(key){
            var o=storage.getItem(name);
            o=o?JSON.parse(o):{};
            if(key=='[remove]'){
                storage.removeItem(name);
            }else{
                o[key]=value;
                storage.setItem(name,JSON.stringify(o));
            }
        }else{
            var o=storage.getItem(name);
            return o?JSON.parse(o):{};
        }
    }

    function logCallBack(str,callback){
        log(str);
        var r=prompt(str,'1');
        if(!r){
            var r=0;
        }
        callback&&callback(r);
    }

    function checkNewsInitialize(){
        BKGlobal.checkNewsTimer=$.timer(10000, function(){
            if(document.domain!='119.23.230.118'){
                checkNews();
            }
        });
    }

    function checkUrl($url){
        if($url.indexOf("http://")==-1&&$url.indexOf("https://")==-1){
            $url="/bangke/"+$url;
        }
        return $url;
    }

    function removeHTMLTag(str,_default) {
        str = str.replace(/<\/?[^>]*>/g,''); //去除HTML tag
        str = str.replace(/[ | ]*\n/g,'\n'); //去除行尾空白
        //str = str.replace(/\n[\s| | ]*\r/g,'\n'); //去除多余空行
        str=str.replace(/ /ig,'');//去掉 
        return str?str:(_default || '');
    }

    function showMsgBox(data){
        callNotification({
            title:data.nickname,
            body:data.value.type=='text'?removeHTMLTag(data.value.msg,'给你发来了新消息'):'给你发来了新消息',
            tag:'WECHAT_MSG',
            icon:data.headimgurl,
            data:data,
            vibrate:[200, 100, 200],
            renotify:true
        },function(notification){
            notification.onclick=function(){
                window.focus();
                notification.close();
            };
        });
        var html=$('#webMsg_box').html();
        if(data.value.type!==undefined){
            if(data.value.type=='image'){
                msg="<img src='"+checkUrl(data.value.msg)+"' alt='图片已过期' />";
            }else if(data.value.type=='video'){
                msg="<video preload='auto' src='"+checkUrl(data.value.msg)+"' controls></video>";
            }else if(data.value.type=='voice'){
                msg="<a href='"+checkUrl(data.value.msg)+"' target='_blank'><span class='glyphicon glyphicon-volume-up'></span>下载播放语音</a>";
            }else{
                msg=data.value.msg;
            }
        }else{
            msg=data.value.msg;
        }
        if("index"=='index'&&'student'=='Index'){
            return false;
        }
        html=html.replace('_HEADIMGURL_',data.headimgurl).replace('_NICKNAME_',data.nickname).replace('_MSG_',msg).replace('_DATE_',formatDateTime(data.value.time+'000').slice(0,-3));
        if($('.tbox_msg:visible').length>0){
            $('.tbox_msg .popwin_content').html(html);
            $('.tbox_msg .headImg').attr("src",$('.tbox_msg .headImg').attr("data-src"));
            $('.tbox_msg #reply_btn').off('click');
            $('.tbox_msg #reply_btn').on('click',function(){
                var reply=$('.tbox_msg #reply').val();
                var preMsg=JSON.stringify(data.value);
                $.ajax({
                    type:'POST', //表单提交类型
                    url:"/bangke/manage/WebMsg/replyToUser", //表单提交目标
                    data:{'reply':reply,'preMsg':preMsg},
                    success:function(data){
                        alertInfo(data.info);
                        if(data.status==1){
                            TINY.box.hide();
                        }
                    }
                });
            });  
        }else{
            if($('.tbox:visible').not(".tbox_msg").length>0){
                TINY.box.reset();
            }
            showTBox("微信信息",'','450px',html,function(){
                $('.tbox_msg .headImg').attr("src",$('.tbox_msg .headImg').attr("data-src"));
                $('.tbox_msg #reply_btn').on('click',function(){
                    var reply=$('.tbox_msg #reply').val();
                    var preMsg=JSON.stringify(data.value);
                    $.ajax({
                        type:'POST', //表单提交类型
                        url:"/bangke/manage/WebMsg/replyToUser", //表单提交目标
                        data:{'reply':reply,'preMsg':preMsg},
                        success:function(data){
                            alertInfo(data.info);
                            if(data.status==1||data.resultdata==1){
                                TINY.box.hide();
                            }
                        }
                    });
                });  
            },'','',{
                top:0,class:"tbox_msg",mask:0
            });
        }
    }

    function getPushedNews(data){
        player("/bangke/Public/Static/mp3/newMsg");
        // showMsgBox($.parseJSON(data));
        data=$.parseJSON(data)||data;
        showMsgBox(data);
        if(typeof(showMsgNote)=='function'){
            showMsgNote();
        }else{
            $('#wechatNewsCount').show();
            setCookie('__news',1);
            showNewsTitle();
        }
        BKGlobal.checkNewsTimer.reset(10000);
    }

    function player(musicSrc){
        var str="<audio controls autoplay class='muc'><source src="+musicSrc+".OGG type='audio/ogg'><source src="+musicSrc+".mp3 type='audio/mpeg'>Your browser does not support the audio element.</audio>"
        $('#player').html('');
        $('#player').html(str);  
    }

    function checkNews(){
        $.ajax({
            type:'POST',
            url:"/bangke/manage/WebMsg/checkNewMsg",
            success:function(data){
                if(data.status==1){
                    if(typeof(showMsgNote)=='function'){
                        showMsgNote();
                    }else{
                        $('#wechatNewsCount').show();
                        setCookie('__news',1);
                        showNewsTitle();
                    }
                    BKGlobal.checkNewsTimer.reset(10000);
                }else{
                    var t=2*BKGlobal.checkNewsTimer.interval;
                    BKGlobal.checkNewsTimer.reset(t<300000?t:300000);
                    $('#wechatNewsCount').hide();
                    setCookie('__news',0);
                }
            }
        });
    }

    function showNewsTitle(){
        if(BKGlobal.showNewsTimer){
            BKGlobal.showNewsTimer.stop();
        }
        BKGlobal.showNewsTimer=$.timer(1000, function(timer){
            var t="邦客琴行管家";
            if(getCookie('__news')==1){
                if(timer.runtimes==undefined){timer.runtimes=1}
                var k=timer.runtimes;
                document.title=(k%2==0? "【　　　】":"【新消息】")+t;
                timer.runtimes++;
            }else{
                timer.stop();
                document.title=t;
            }
        });
    }

    function showPrintBtn(type){
        if(type&&type.indexOf('tbox')!=-1){
            if($('.tbox').find('.list').length>0){
                if($('.tbox .popwin_title').find('.a_print').length>0){
                    return true;
                }else{
                    var str="<a class='a_print vip vip_func' style='margin-right: 40px;' href='javascript:void(0)' onclick=\"printPreview('.tbox .list',this)\">打印</a>";
                    $('.tbox .popwin_title').append(str);
                }
            }
        }else{
            if($('.right').find('.list').length>0){
                $('.right .list').each(function(){
                    if($(this).find('.a_print,.btn_print').length>0||$(this).find('table').length==0){
                        return true;
                    }
                    if($(this).find('.tableHead').length>0){
                        var str="<a class='a_print vip vip_func' href='javascript:void(0)' onclick=\"printPreview('body .list',this)\">打印</a>";
                        $(this).find('.tableHead').append(str);
                    }else if($(this).find('.tableOprate .left').length>0){
                        var str="<a class='button btn_blue vip vip_func btn_print' href='javascript:void(0)' onclick=\"printPreview('body .list',this)\">打印</a>";
                        $(this).find('.tableOprate .left').append(str);
                    }else if($(this).find('.tableOprate .th').length>0){
                        var str="<div class='left'><a class='button btn_blue vip vip_func btn_print' href='javascript:void(0)' onclick=\"printPreview('body .list',this)\">打印</a></div>";
                        $(this).find('.tableOprate .th').before(str);
                    }
                });
            }
        }
    }

    function htmlInitialize(selector){
        interceptA();
        showPrintBtn(selector);
        showVip();
        trHoverAndCheckAll();
        createDropBox(selector);
        $('.tableOprate .th,table .th').addClass('yahoo2');
    }

    function skinInitialize(){
        $('.dropSkinBox').find('#'+getCookie('bk_skin')).addClass('now_skin');
        $('.btn_skin').on('click',function(){
            $('.btn_skin').removeClass('now_skin');
            $(this).addClass('now_skin');
            setCookie('bk_skin',$(this).attr('id'));
            location.reload();
        });
    }

    function webSenderInitialize(){
        //实例化websend
        var pushurl=document.domain;
        var pushconfig=$('#pushconfig').text().split('##');
        newws(pushconfig[1],pushconfig[2],pushconfig[3],pushurl,pushconfig[0]);
        $('#pushconfig').text('');
    }

    function topSearchInitialize(){
        $('.top_search .inputlist li').on('hover',function(){
            $('.top_search .inputlist li').removeClass('activeobj');
            $(this).addClass('activeobj');
        });
        $('.top_search .inputlist li').on('click',function(){quickSearch();});
        $('.top_search #searchString').on('focus',function(){showInputlist(1);});
        $('.right').not('.top_search').on('click',function(){
            if(!$('.inputlist').is(':hidden')){
                showInputlist(0);
            }
        });
    }

    function adInitialize(){
        if(getCookie('isAd')==1){
           var lefttime=0;
            if(lefttime>3600){
                var interval=1000;
            }else{
                var interval=10;
            }
            getRemainTime(lefttime,interval,function(str){
                $('.tbox #remain h4,#remain_time').html(str);
            });
        }
    }

    function getRemainTime(lefttime,interval,callback){
        return $.timer(interval,function(timer){
            if(timer.runtimes==undefined){timer.runtimes=1}
            var nMS = lefttime*1000-timer.runtimes*interval;
            if (nMS>=0){
                var nD=Math.floor(nMS/(1000*60*60*24))%24;
                var nH=Math.floor(nMS/(1000*60*60))%24;
                var nM=Math.floor(nMS/(1000*60)) % 60;
                var nS=Math.floor(nMS/1000) % 60;
                if(nMS<=3600*1000){ //剩余一天出现毫秒
                   var nmS=nMS % 1000;
                }else{
                  var nmS=-1;
                }
                var str=(nD>0?nD+'天':'')+((nD>0||nH>=0)?nH+'时':'')+((nD||nH>0||nM>=0)?nM+'分':'')+((nD||nH||nM>0||nS>=0)?nS+'秒<br/>':'')+(nmS>=0?nmS+'毫秒':'');
                timer.runtimes++;
                callback&&callback(str);
            }else{
                timer.stop();
            }
        });
    }

    function trHoverAndCheckAll(){
        //选中列表行变色
        $(".list tr").mouseover(function(){
            $(this).addClass("currow");
        }).mouseout(function(){
            $(this).removeClass("currow");
        });
        //全选/取消
        $(".checkall,#check").click(function(){
            if($(this).attr("checked")=="checked"){
                setCheckbox(true,"");
                $('.checkall,#check').attr('checked','checked');
            }else{
                setCheckbox(false,"");
                $('.checkall,#check').attr('checked',false);
            }
        });      
    }

    function showVip(){
        //vip图标
        $('.vip').each(function(){
            if($(this).find('.vip_img').length==0){
                $(this).append('<img class="vip_img" title="VIP用户专享" align="bottom" src="/bangke/Public/Static/images/icon/vip.svg">');
            }
        });
        //vipFunc
        vipFunc();
    }

    function vipFunc(){
        if(''=='1'){
            return true;
        }
        $('.vip_func').each(function(){
            var _this=$(this);
            if(_this[0].tagName.toUpperCase()=='A'){
                _this.removeAttr('onclick');
                _this.attr('href','javascript:void(0)');
                _this.off();
                _this.on('click',function(){
                    alert('您是免费用户，暂未开通该功能，开通VIP增值服务即可使用该功能哦');
                    ToBuySpace();
                });
            }
        });
    }

    //启动任务定时器
    function startMission(){
        if(BKGlobal.mission){
           return false;
        }
        var bkMission=getCookie('bkMission');
        if(bkMission&&bkMission!=='stop'){
            BKGlobal.mission = $.timer(3000, window[bkMission]);
        }
    }

    function stopMission(){
        BKGlobal.mission.stop();
        $('.MissionBox').fadeOut();
    }

    function sendRedPack(){
        if($('.MissionBox').is(':hidden')){
            $('.MissionBox').find('.info').text('正在群发红包中').end().fadeIn();
        }
        $.ajax({
            type:'GET',
            url:"/bangke/manage/Personal/doSendRedPackMission",
            error:function(XMLHttpRequest, textStatus, errorThrown){
                stopMission();
            },
            success:function(data){
                if(getCookie('bkMission')=='stop'||data.status==0){
                    stopMission();
                }
            }
        });
    }

    //image_tip
    function createImageTip(selector){
        var str="<div class='image_tip_div'><img src='"+$('.image_tip').attr('data-url')+"' /></div>";
        selector=selector||'';
        $(selector+' .image_tip').each(function(){
            var a=$(this).position().top;
            var b=$(this).position().left;

            var w=$(this).outerWidth();
            if($(this).parent().find('.image_tip_div').length==0){
              $(this).parent().append(str);
            }
            
            $(this).parent().find('.image_tip_div').css({
              'position':'fixed',
              'top':(a-20)+'px',
              'left':(b+w)+'px',
              'z-index':100,
              'display':'none'
            });
        });
    }

    /**
     * 下拉框按钮添加class="dropdownBtn" data-res="dropDateBox" id为dropDateBox的元素的innerHtml为下拉框内容 data-res必须页面级唯一  
     * @return {[type]} [description]
     */
    function createDropBox(selector){
        selector=selector||'';
        $(selector+' .dropdownBtn').each(function(){
            if($(this).attr('data-status')=='true'){
                return true;
            }
            var id=$(this).attr('data-res');
            var html=$('#'+id).html();
            var str="<div class='dropdownZone "+id+"'>"+html+"</div>";
            
            if($(this).parent().find('.'+id).length==0){
                $(this).parent().append(str);
            }
            var _box=$(this).parent().find('.'+id);
            _box.css({
              'z-index':100,
              'display':''
            });
            $(this).attr('data-status','true');
            $(this).on('click',function(e){
                var a=$(this).position().top;
                var b=$(this).position().left;
                var h=$(this).outerHeight();
                var s=$('.right').scrollTop();
                var d=$(this).attr('data-direction');
                var c={'left':(b)+'px'};
                if(d=='up'){
                  c['bottom']=($(window).height()-(a+h+s))+'px';
                }else{
                  c['top']=(a+h+s)+'px';
                }
                _box.css(c);

                _box.toggle();
                e.stopPropagation();
            });
            _box.on('click',function(e){
                e.stopPropagation();
            });
            $('.right').on('click',function(){
                _box.hide();
            });
            _box.on('close.dropBox',function(){
                _box.hide();
            });
            // $('#'+id).html('');
        });
    }
    
    //拦截a
    function interceptA(){   
        $('table a[href]').each(function(){
            var url= $(this).attr('href');
            var id =$(this).closest('table').attr('id');

            if((url.indexOf('/p/')>-1||url.indexOf('/cbp/')>-1||url.indexOf('/sp/')>-1||url.indexOf('/ssp/')>-1||url.indexOf('/sr/')>-1||url.indexOf('/si/')>-1||url.indexOf('/bp/')>-1||url.indexOf('/cp/')>-1||url.indexOf('/mp/')>-1)&&id){  //分页
                $(this).attr('href','javascript:void(0)');
                $(this).attr('data-url',url);

                $(this).on('click',function(){
                    $(this).closest('.list').removeAttr('data-status');
                    var  url=$(this).attr('data-url');
                    $('<div class="loadding-mask"></div><div class="loadding"></div>').appendTo($('#'+id).parent());
                    $('#'+id).parent().load(url+" #"+id,'',function(){
                        htmlInitialize();
                        history.pushState(null, '', url);
                    });
                });
            }
        });
    }

    function show_ad(){
        setCookie('Adnum',1);
        $.ajax({
            type:'GET',
            url:"/bangke/manage/BaseData/showad", 
            success:function(data){
                $('.popwin_content').html(data);
                TINY.box.show({
                  html:$('.popwin_content').html(),
                  fixed:false,
                  close:0,
                  maskid:'blackmask',
                  maskopacity:40,
                  autohide:6,
                  maskclose:0,
                  openjs:function(){
                     
                  },
                  closejs:function(){
                    if(getCookie('is_login_first')==1){
                      show_welcome();
                    }
                  }
                });
                $('.popwin_content').html('');
            }
        });
    }

    function show_welcome(){
        var title="edogawap"+',欢迎您登陆邦客智能管家！当前门店：总店';
        showTBox(title,"/bangke/manage/BaseData/loginInfo",'700px','',function(){
          m_changeTab();
          setCookie('is_login_first',0);
        },function(){
          show_birthNote();
        });
    }

    function show_birthNote(){
        if(""=='1'){ //生日提醒
            showTBox('今天生日的学员',"/bangke/manage/student/showStuList/type/3",'500px');
        }
    }

    function m_changeTab(){
        var li = $('.tab li');
        var ul = $('.tabcontent ul');
              
        li.mouseover(function(){
            var _this = $(this);
            var t = _this.index();
            li.removeClass();
            li.addClass('unactivetab');
            _this.removeClass('unactivetab');
            _this.addClass('activetab');
            ul.css('display','none');
            ul.eq(t).css('display','block');
        });

        $('.tabtitle').on('click',function(){
          $(this).parent().children('.tabcont').toggle();
        });
    }
  
    //图片上传  
    function g_AjxUploadImg(btn, img, hidPut,type,callback) {  
        new AjaxUpload(btn, {  
            action: "/bangke/manage/Upload/upload",  
            data: {"type":type,"thumbWidth":btn.attr('data-width')||200,"thumbHeight":btn.attr('data-height')||200,"thumbType":btn.attr('data-type')||1},  
            name: 'userfile',  
            onSubmit: function(file, ext) {  
                if (!(ext && /^(jpg|JPG|png|PNG|gif|GIF)$/.test(ext))) {  
                  alert("您上传的图片格式不对，请重新选择！");  
                  return false;  
                }  
            },  
            onComplete: function(file, response) { 
                console.log(response); 
                response = JSON.parse(response);
                if (response&&response.error==0) {  //有文件路径，则上传成功
                    if(typeof(UploadImgCallBack)=="function"){
                        callback=UploadImgCallBack;
                    }
                    if(callback){
                        callback(response.url);
                    }else{
                        hidPut.val(response.url);  
                        img.attr("src",response.url); 
                    }

                    if($('.tbox:visible').length>0){
                        $(window).trigger('resize');
                    }
                }else {  
                    alert(response.message);
                }  
            }  
        });  
    }  


    //接收websender信息
    function show_msg(data){
        var url="/bangke/manage/WebMsg/index";
        $.ajax({
            type:'POST', //表单提交类型
            url:url, //表单提交目标
            data:data,
            success:function(data){
                if(check_before_load(data)){
                    if(!data.info){  //直接echo 信息
                        TINY.box.reset();
                        showTBox('推送信息','','400px',"<div style='padding:20px'>"+data+"</div>");
                    }else if(data.info=='Function'){  //调用js函数
                        try {
                            // eval(data.data.functype+"("+data.data.funcdata+")");
                            callFunc(data.data.functype,[data.data.funcdata]);
                        } catch (e) {
                            console.error(e);
                        }
                    }
                }
              
            }
        });
    }

    function ToBuySpace(){
        setCookie('isbuy',1);
        // window.open("/bangke/manage/Personal/index");
        window.open("/bangke/manage/AppMarket/index");
    }

    function log(s){
        console.log(s);
    }

    function getCookie(name){
        var arr,reg=new RegExp("(^| )"+name+"=([^;]*)(;|$)");
        if(arr=document.cookie.match(reg)){
            return unescape(arr[2]);
        }else{
            return null;
        }
    } 

    function setCookie(name,value,expiredays){
        if(!expiredays){
            document.cookie = name + "="+ escape (value) + ";path=/";
        }else{
            var exdate=new Date();
            exdate.setTime(exdate.getTime()+expiredays*24*3600*1000);
            document.cookie = name + "="+ value + ";expires="+exdate.toGMTString()+";path=/";
        }
        $(window).trigger("change."+name+".cookie");
    } 

    function Calendarset(obj,type){
        Calendar.setup({
          animation:false,
          weekNumbers: true,
          inputField : obj.id,
          trigger    : obj.id,
          dateFormat: type||"%Y-%m-%d",
          showTime: true,
          minuteStep: 1,
          onSelect   : function() {this.hide();}
        });
        obj.click();
    }

    function showConfirm(title,msg,btns,openjs,closejs,ajaxCallBack,options){
        var html="<div style='font-size:14px;padding:10px;'>"+msg+"</div><div style='text-align:center;'>";
        for(i in btns){
            TINY.box.callback={};
            TINY.box.callback.i=btns[i].func||'';
            html+="<a href='javascript:void(0)' class='button btn_blue' style='margin:5px;' id='"+btns[i].id+"' onclick="+(TINY.box.callback.i)+">"+btns[i].value+"</a>"
        }
        html+="</div>";
        showTBox(title,'',"500px",html,openjs,closejs,ajaxCallBack,options);
    }

    function showTBox(title,url,minWH,content,openjs,closejs,ajaxCallBack,options) {
        var width=minWH.split(',')[0];
        var height=minWH.split(',')[1];
        $('#popwin_box .popwin_content').css('min-width',width||'40vw');
        $('#popwin_box .popwin_content').css('min-height',height||"0");
        
        if(title=='TitleClose'){
            $('#popwin_box .popwin_title').css('display','none');
        }else{
            $('#popwin_box .popwin_title').css('display','block');
            $('#popwin_box .popwin_title').html(title);
        }
        var tag=1;
        tboxInit=undefined;
        if(content){
            $('#popwin_box .popwin_content').html(content);
        }else{
            //缓存url
            TINY.box.url=url;
            log(url);
            $.ajax({
                type:'GET', //表单提交类型
                url:url, //表单提交目标
                async:false,
                beforeSend: function(data) {
                    submit_before_info();
                },
                success:function(data){
                    if(ajaxCallBack){
                        tag=ajaxCallBack(data);
                    }else{
                        if(check_before_load(data,true)){
                            $('#popwin_box .popwin_content').html(data);
                        }else{
                            tag=0;
                        }
                    }
                }
            });
        }
        if(tag){
            var _default={
                html:$("#popwin_box").html(),
                fixed:false,
                maskid:'blackmask',
                maskopacity:40,
                openjs:function(){
                    openfunc();
                    openjs&&openjs();
                },
                closejs:function(){
                    tboxInit=undefined;
                    closejs&&closejs();
                }
            };
            var options = $.extend(_default, options||{});
            TINY.box.show(options);
            $('#popwin_box .popwin_content').html('');
        }
    }

    function showTboxPage(obj){
        var url=$(obj).attr('data-url');
        $('<div class="loadding-mask"></div><div class="loadding"></div>').appendTo($('.tbox .popwin_content'));
        $.ajax({
            type:'GET', //表单提交类型
            url:url, //表单提交目标
            beforeSend: function(data) {
                submit_before_info();
            },
            success:function(data){
                //data.url = location.href;
                if(check_before_load(data)){
                    TINY.box.url=url;
                    $('.tbox .popwin_content').html(data);
                    $('.tbox .popwin_content').scrollTop(0); 
                    openfunc();
                    if(typeof(showTboxPageCallBack)=="function"){
                        showTboxPageCallBack();
                    }
                    TINY.box.resize();
                }
            }
        });
        return false;
    }

    function reloadTbox(url,data,func){
        url=url?url:TINY.box.url;
        if(data){
            TINY.box.url=url+'?'+dataToUrl(data).substr(1);
        }
        $('<div class="loadding-mask"></div><div class="loadding"></div>').appendTo($('.tbox .popwin_content'));
        $.ajax({
                type:'GET', //表单提交类型
                url:url, //表单提交目标
                data:data,
                beforeSend: function(data) {
                    submit_before_info();
                },
                success:function(data){
                    if(check_before_load(data)){
                        $('.tbox .popwin_content').html(data);
                        $('.tbox .popwin_content').scrollTop(0); 
                        openfunc();
                        func&&func();
                        TINY.box.resize();
                    }
                }
        });
        return false;
    }

  /**
   * param 将要转为URL参数字符串的对象
   * key URL参数字符串的前缀
   * encode true/false 是否进行URL编码,默认为true
   * 
   * return URL参数字符串  &....
   */
    function dataToUrl(param, key, encode) {
        if(param==null) return '';
        var paramStr = '';
        var t = typeof (param);
        if (t == 'string' || t == 'number' || t == 'boolean') {
          paramStr += '&' + key + '=' + ((encode==null||encode) ? encodeURIComponent(param) : param);
        } else {
          for (var i in param) {
            var k = key == null ? i : key + (param instanceof Array ? '[' + i + ']' : '.' + i);
            paramStr += dataToUrl(param[i], k, encode);
          }
        }
        return paramStr;
    }

    function alertInfo(str,time,func){
        if(str){
            $('.globalLoading').fadeIn(300).find('.info').text(str);
            if(time!=-1){
                BKGlobal.tid=window.setTimeout(function(){
                    $('.globalLoading').fadeOut(300);
                    func&&func();
                    BKGlobal.tid=0;
                },time||1500);
            }
        }
    }

    function openfunc(){
        $('.tbox .tinner').css('height','auto');
        $(window).on('resize',function(){
            if($('.tbox .tinner').height()<0.8*$(window).height()){
                $('.tbox .tinner').css('height','auto');
            }
        });
        if($('.tbox_unlimit:visible').length>0){
            $('.tbox .tinner').css('width','auto');
        }
        $('.tbox img,.tbox vedio').on('load',function(){
            $(window).resize();
        });
        htmlInitialize('.tbox ');
        tboxInit&&tboxInit();
    }

    function isEnter(event){
        var cur_pos;
        if($('.inputlist').find('.activeobj').length>0){
            cur_pos=$('.inputlist').find('.activeobj').index();
        }else{
            cur_pos=-1;
        }

        var e = event || window.event || arguments.callee.caller.arguments[0];
        var max=$('.inputlist li').length-1;

        if(e && e.keyCode==38){ // up 
            if(cur_pos==-1||cur_pos==0){
                cur_pos=max;
            }else{
                cur_pos--;
            }     
                
            $('.inputlist li').removeClass('activeobj');       
            $('.inputlist').find('li').eq(cur_pos).addClass('activeobj');       
        }

        if(e && e.keyCode==40){ // down
            if(cur_pos==max){
                cur_pos=0;
            }else{
                cur_pos++;
            }   
            $('.inputlist li').removeClass('activeobj');       
            $('.inputlist').find('li').eq(cur_pos).addClass('activeobj'); 
        }

        if(e && e.keyCode==13){ // Enter
            quickSearch();
        }
    }

    function showInputlist(type){
        var str=$.trim($('#searchString').val());
        $('.searchstr').text(str);
        if(type&&str){
            $('.inputlist').show();
        }else{
            $('.inputlist').hide();
        }
    }

    var preSearchString='';
    var preSearchType='';
    function quickSearch(){
        var s=$.trim($('#searchString').val());
        if(!s){
            $('.searchBox').find('.searchResult').html('').end().hide();
            return false;
        }

        var t=$('.inputlist').find('.activeobj').attr('data-type');
        if(preSearchString==s&&preSearchType==t){
            return false;
        }
        if(!t){
            return false;
        }
        preSearchString=s;
        preSearchType=t;
        $.ajax({
            type:'GET', 
            url:"/bangke/manage/BaseData/searchEveryThing", 
            data:{'searchString':t+'##'+s},
            success:function(data){
                if(data.status==0){
                    $('.searchBox').find('.searchResult').html('').end().hide();
                    alertInfo(data.info);
                }else{
                    $('.searchBox').find('.searchResult').html(data).end().show();
                }
            }
        });
    }

    function printPreview(selector,obj){
        if($(selector).length>1){
          var _obj=$(obj).closest(selector);
        }else{
          var _obj=$(selector);
        }
        _obj.jqprint({
            handleHtml:function(html){
                var $html=$(html);
                $html.find('td>a').not('.btn_print,.a_print').each(function(){
                    if($(this).parent().children().length>1){
                        $(this).removeAttr("href");
                    }else{
                        $(this).parent().html($(this).parent().text());
                    }
                });
                $html.find('.tableOprate').hide();
                $html.find('.a_print,.btn_print').hide();
                return $html.prop('outerHTML');
            }
        });
    }

    function sendCode(btn,mobile,url,type) {
        if(mobile==''||mobile.length!=11){
            alertInfo('请输入正确的手机号');
            return false;
        }
        var wait=btn.getAttribute('data-wait');
        if(wait==60){
            $.ajax({
                type:'post', //表单提交类型
                url:url, //表单提交目标
                data:{'mobile':mobile,'type':type}, //表单数据
                success:function(data){
                    if(data.status==1){
                        changeBtn(btn);
                    }
                }
            });
        }
    }

    function changeBtn(btn){
        var wait=btn.getAttribute('data-wait');
        if (wait == 0) {
            btn.removeAttribute("disabled");
            btn.value = "重新获取";
            wait = 60;
        }else{
            btn.setAttribute("disabled", true);
            wait--;
            btn.setAttribute('data-wait',wait);
            btn.value = wait;
            setTimeout(function () {changeBtn(btn);},1000)//递归调用自身，刷新value
        } 
    }

    function form_ajax(obj,reload){
        $.ajax({
            type:$(obj).attr('method'), //表单提交类型
            url:$(obj).attr('action'), //表单提交目标
            data:$(obj).serialize(), //表单数据
            beforeSend: function(data) {
                submit_before_info();
            },
            success:function(data){
                submit_back_info(data);
                reload&&location.reload();
            }
        });
        return false;
    }

</script>

</head>
<body class="showmenu" style="overflow: hidden;">
<div class="searchBox" style="display:none">
  <div class="searchBoxClose" onclick="$('.searchBox').hide()"></div>
  <div class="searchResult"></div>
</div>
<div style="display:none" id="pushconfig"></div>

<!-- 弹窗——重要结果提示框 -->
<div class="popwin" id="popwin_resultForm">
    <p class="popwin_title">
        #title#
    </p>
    <div class="popwin_content" style="overflow-y:auto;padding:15px;max-height:500px;text-align:center">
        <p class="popwin_tips popwin_tips_confirm">#content#</p>
        <a class="button btn_green" onclick="TINY.box.hide();" style="margin:10px 0px">确认</a>
    </div>
</div>

<!-- 弹窗——确认框 -->
<div class="popwin" id="popwin_confirmForm">
    <p class="popwin_title">
        #title#
    </p>
    <div class="popwin_content" style="text-align:center;">
        <p class="popwin_tips popwin_tips_confirm">#content#</p>
        <a class="button btn_gray  popwin_confirm submit">确认</a>
        <a class="button btn_red  popwin_cancel" onclick="TINY.box.hide();">取消</a>
    </div>
</div>

<!-- 弹窗——删除确认 -->
<div class="popwin" id="popwin_deleteForm">
    <p class="popwin_title">
        #title#
    </p>
    <div class="popwin_content" style="text-align: center">
        <img class="mgb10" src="register_files/popwin_eroteme.png">
        <p class="popwin_tips popwin_tips_delete">#content#</p>
        <a class="button btn_red popwin_confirm submit">确认</a>
        <a class="button btn_gray popwin_cancel" onclick="TINY.box.hide();">取消</a>
    </div>
</div>

<div class="popwin" id="popwin_box">
    <p class="popwin_title" style="display: block;">添加学员</p>
    <div class="popwin_container">
        <div class="popwin_content" style="min-width: 780px; min-height: 0px;"></div>
    </div>
</div>
<div id="allFunc_box" style="display:none"> 
    <dl><dt>快捷键F1</dt></dl>  
    <dl>
        <dt>
            基础数据管理        </dt>
        <dd>
            <a href="http://www.dsmake.com/bangke/manage/student/index" target="_blank" title="学员管理">学员管理</a><a href="http://www.dsmake.com/bangke/manage/teacher/index" target="_blank" title="老师管理">老师管理</a><a href="http://www.dsmake.com/bangke/manage/salesman/index" target="_blank" title="销售员管理">销售员管理</a><a href="http://www.dsmake.com/bangke/manage/Store/index" target="_blank" title="门店管理">门店管理</a>        </dd>
    </dl><dl>
        <dt>
            教务管理        </dt>
        <dd>
            <a href="http://www.dsmake.com/bangke/manage/classroom/index" target="_blank" title="教室管理">教室管理</a><a href="http://www.dsmake.com/bangke/manage/course/index" target="_blank" title="课程管理">课程管理</a><a href="http://www.dsmake.com/bangke/manage/Booking/confirm" target="_blank" title="班级排课管理">班级排课管理</a><a href="http://www.dsmake.com/bangke/manage/Index/index" target="_blank" title="上课签到">上课签到</a><a href="http://www.dsmake.com/bangke/manage/Service/index" target="_blank" title="服务卡管理">服务卡管理</a>        </dd>
    </dl><dl>
        <dt>
            财务管理        </dt>
        <dd>
            <a href="http://www.dsmake.com/bangke/manage/teacher/settlement" target="_blank" title="老师工资结算">老师工资结算</a><a href="http://www.dsmake.com/bangke/manage/salesman/settlement" target="_blank" title="销售工资结算">销售工资结算</a><a href="http://www.dsmake.com/bangke/manage/Finance/allStatic" target="_blank" title="财务统计">财务统计</a><a href="http://www.dsmake.com/bangke/manage/Finance/in" target="_blank" title="收支记账">收支记账</a><a href="http://www.dsmake.com/bangke/manage/CheckStand/checkStand" target="_blank" title="收银台">收银台</a>        </dd>
    </dl><dl>
        <dt>
            招生管理        </dt>
        <dd>
            <a href="http://www.dsmake.com/bangke/manage/SignUp/index" target="_blank" title="招生统计">招生统计</a><a href="http://www.dsmake.com/bangke/manage/SignUp/storecourse" target="_blank" title="微招生设置">微招生设置</a><a href="http://www.dsmake.com/bangke/WeChat/AppMarket/addPoster" target="_blank" title="招生海报设置">招生海报设置</a><a href="http://www.dsmake.com/bangke/manage/Article/index" target="_blank" title="文章管理">文章管理</a>        </dd>
    </dl><dl>
        <dt>
            系统日志管理        </dt>
        <dd>
            <a href="http://www.dsmake.com/bangke/manage/Static/operationRecord" target="_blank" title="操作日志">操作日志</a><a href="http://www.dsmake.com/bangke/manage/Static/course_buy" target="_blank" title="课程购买记录">课程购买记录</a><a href="http://www.dsmake.com/bangke/manage/Static/service_buy" target="_blank" title="服务购买记录">服务购买记录</a><a href="http://www.dsmake.com/bangke/manage/Static/noticeList" target="_blank" title="通知记录">通知记录</a><a href="http://www.dsmake.com/bangke/manage/Static/studentStatic" target="_blank" title="报表">报表</a>        </dd>
    </dl><dl>
        <dt>
            商品进销存管理        </dt>
        <dd>
            <a href="http://www.dsmake.com/bangke/manage/Index/loginSmpss" target="_blank" title="商品管理系统">商品管理系统</a><a href="http://www.dsmake.com/bangke/manage/OLStoreGoods/index" target="_blank" title="微信商城">微信商城</a>        </dd>
    </dl></div>
<div id="webMsg_box" style="display:none">
    <div class="interactiveWallBox">
        <div class="headImgDiv">
            <img class="headImg" src="" data-src="_HEADIMGURL_" alt="">
        </div>
        <div class="msgDiv">
            <h4>_NICKNAME_ <span class="rightspan timestr" style="font-size:12px;">_DATE_</span></h4>
            <pre class="intropre">_MSG_</pre>
        </div> 
        <div class="reply">
            <textarea maxlength="100" id="reply"></textarea>
            <input class="button btn_blue" id="reply_btn" value="回复" type="button">
        </div>
    </div> 
</div>

<div id="player" style="display: none"></div>
<div class="globalLoading" style="display: none;"><span class="info">处理中...</span></div>

<div class="MissionBox"><div class="loading"></div><span class="info"></span></div>

<div class="pagemask"></div>
<div class="top_head">
    <div class="top_search">
        <input class="input_large" id="searchString" placeholder="搜点什么(F)" onkeydown="return isEnter(event)" onkeyup="showInputlist(1);" type="text">
        <div class="inputlist">
            <ul>
              <li class="activeobj" data-type="student">搜索<span class="searchstr"></span>相关的学员</li>
              <li data-type="teacher">搜索<span class="searchstr"></span>相关的老师</li>
              <li data-type="course">搜索<span class="searchstr"></span>相关的课程</li>
              <li data-type="store">搜索<span class="searchstr"></span>相关的门店</li>
              <li data-type="class">搜索<span class="searchstr"></span>相关的班级</li>
            </ul>
        </div>
    </div>
	  <div class="top_link">
      <ul>
                <li id="i_self"> 广外琴行1【总店】：你好！&nbsp;<?php if ($_COOKIE['PHPSESSID'] == session_id()) echo htmlspecialchars($_COOKIE['username']); ?></li>
        <li><a href="javascript:void(0)" onclick="showShortMsgList()"> <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></a></li>
        <li><a target="_blank" href="http://qinhang.dsmake.com/">官网首页</a></li>
        <li>|</li>
        <li><a target="_blank" href="http://bangkebbs.dsmake.com/">邦客问答百科</a></li>
		<li>|</li>
        <li id="i_exit"><a href="http://www.dsmake.com/bangke/manage/Login/logout">退出</a></li>		
      </ul>
    </div>
</div>
<!-- header end -->

<div class="leftmenu">
<div class="top_logo"> <img src="register_files/logo.png"> </div>
<!-- <div class="top_logo" onclick="ToBuySpace()"> <img src="/bangke/Public/Static/images/main/logo1111.png" /><span id="remain_time" style="color:white"></span> </div> -->
<div class="span"></div>
<div class="menu" id="menu">
<div>
	<img src="register_files/cygn.png">
</div>

<div id="items_usual">
    <ul>
        <li id="allFuncBtn"><a class="hollow_button" href="http://www.dsmake.com/bangke/manage/Index/allFunction">功能大全(F1)</a></li>

        <li><a class="hollow_button" href="http://www.dsmake.com/bangke/manage/Index/index">上课签到</a></li>

        <li><a class="hollow_button" href="http://www.dsmake.com/bangke/manage/Booking/confirm">班级排课</a></li>

        <li><a class="hollow_button" href="http://www.dsmake.com/bangke/manage/CheckStand/checkStand">收银台</a></li> 

        <li><a class="hollow_button" href="http://www.dsmake.com/bangke/manage/SignUp/index">招生</a>
        </li>
        <li>
          <a class="hollow_button" href="http://www.dsmake.com/bangke/manage/WebMsg/interactiveWall">微信互动<sup id="wechatNewsCount" style="display: none">&nbsp;<i class="redpoint"></i></sup></a>
        </li>
        <li><a class="hollow_button" href="http://www.dsmake.com/bangke/manage/AppMarket/index">应用市场</a></li>
    </ul>
</div>
<div id="items_other">
	<ul>
      <li><a class="hollow_button" id="Personal" href="http://www.dsmake.com/bangke/manage/Personal/index">我的账户</a></li>
  		  <li><a class="hollow_button" id="Personal" href="http://www.dsmake.com/bangke/manage/Personal/wallet">我的钱包</a></li>
    
        <li><a class="hollow_button" id="Rbac" href="http://www.dsmake.com/bangke/manage/Rbac/index">系统设置</a></li>        <li><a class="hollow_button" id="Guestbook" href="http://www.dsmake.com/bangke/manage/Guestbook/index">留言反馈</a></li>
    </ul>
</div>

</div>
</div>
<!-- leftmenu end -->

<!--客服固定框-->
  <div id="haiiskefu">
  <div class="kfleft" title="consult"></div>
	<ul>
		<li><a rel="nofollow" href="http://wpa.qq.com/msgrd?v=3&amp;uin=2244346598&amp;site=qq&amp;menu=yes" title="" target="_blank"></a></li>
		<li><a rel="nofollow" href="http://wpa.qq.com/msgrd?v=3&amp;uin=2244346598&amp;site=qq&amp;menu=yes" title="" target="_blank"></a></li>
		<li><a rel="nofollow" href="http://wpa.qq.com/msgrd?v=3&amp;uin=2244346598&amp;site=qq&amp;menu=yes" title="" target="_blank"></a></li>
	</ul>
  </div>
  <!--客服固定框 结束-->

<div class="right">
	<div class="rightContent">

<script charset="utf-8" type="text/javascript" src="register_files/textext_005.js"></script>
<script charset="utf-8" type="text/javascript" src="register_files/textext_004.js"></script>
<script charset="utf-8" type="text/javascript" src="register_files/textext_003.js"></script>
<script charset="utf-8" type="text/javascript" src="register_files/textext.js"></script>
<script charset="utf-8" type="text/javascript" src="register_files/textext_002.js"></script>

<link rel="stylesheet" type="text/css" href="register_files/jscal2.css">
<link rel="stylesheet" type="text/css" href="register_files/border-radius.css">
<link rel="stylesheet" type="text/css" href="register_files/win2k.css">
<script type="text/javascript" src="register_files/calendar.js"></script>
<script type="text/javascript" src="register_files/en.js"></script>
<style>
    .text-core .text-wrap textarea{
        border-color: #aaaaaa;
        border-style: solid;
        border-width: 1px;
    }
</style>
<div class="main">
<div class="stu_info_top">
    <a class="navigation_bar" href="http://www.dsmake.com/bangke/manage/Index/allFunction" id="allfunc">功能大全</a><span class="navigation_bar">&gt;&gt;</span><a class="navigation_bar" href="http://www.dsmake.com/bangke/manage/student/index">学员管理</a>
    </div>
    
<div class="pos">学员列表 | <a class="button btn_blue" onclick="show_studentregister_article('/bangke/manage/student/register')" id="studentAdd">学员登记</a> | <a class="button btn_blue" id="graduate" href="http://www.dsmake.com/bangke/manage/student/graduate">毕业学生列表</a><a class="tutorial_btn" href="javascript:void(0)" onclick="tutorial()" id="tutorial_btn">怎么用？</a>
</div>

<!--     <div class="bk-nav">
    <ul class="nav nav-tabs">
        <li class="nav-pos">    
            <a href="/bangke/manage/Index/allFunction" id="allfunc">功能大全</a>
        </li>
        <li class="nav-pos">
            <span>>></span>
        </li>
        <li class="nav-pos">    
            <a href="/bangke/manage/student/index" id="allfunc">学员管理</a>
        </li>
        <li class="nav-pos">
            <span>>></span>
        </li>
        <li class="nav-active">
            <a class="nav-tab" href="/bangke/manage/student/index">学员列表</a>    
        </li>
        <li>
            <span> | </span>
        </li>
        <li>
            <a class="nav-tab" onclick="show_studentregister_article('/bangke/manage/student/register')" id="studentAdd">学员登记</a>
        </li>
        <li>
            <span> | </span>
        </li>
        <li>
            <a class="nav-tab" id="graduate" href="/bangke/manage/student/graduate">毕业学生列表</a>
        </li>
    </ul>
    <div class="right-btns">
        <a class="tutorial_btn" href="javascript:void(0)" onclick="tutorial()" id="tutorial_btn">怎么用？</a>
    </div>
</div>
 -->
    <div class="operate" style="width:100%" id="searchstu">
        <div class="left">
            <div id="basesearch">
                <form method="get" id="search_form" action="/bangke/manage/student/index.php">
                    <select name="searchKey" class="select">
                        <option value="stu_name" selected="selected">姓名</option>
                        <option value="stu_id">学员ID</option>
                        <option value="stu_card_id">卡号</option>
                        <option value="stu_mobile">手机</option>
                        <option value="s_name">门店</option>
                    </select>
                    <input placeholder="请输入关键字" name="keyword" title="关键字" class="input" type="text"><span>&nbsp;&nbsp;</span>
                    <input class="button btn_blue" value="查  询" type="submit">
                    <a class="button btn_blue vip vip_func" id="highsearch" href="javascript:void(0)">高级查询<img class="vip_img" title="VIP用户专享" src="register_files/vip.svg" align="bottom"></a>
                </form>
            </div>
            <div id="advancedsearch" style="display:none">
            <form method="get" id="search_form" action="/bangke/manage/student/index">
                    <div class="row">
                        <div class="input-group" style="float:left;margin:5px 20px;width:260px;">
                            <span class="input-group-addon" id="basic-addon1">所属门店</span>
                            <select name="rs_id" class="select" style="padding:4px 25px 4px 10px">
                                <option value="" selected="selected">所有门店</option>
                                <option value="广外琴行">广外琴行</option>
                            </select>
                        </div>

                        <div class="input-group" style="float:left;margin:5px 20px;width:260px;">
                            <span class="input-group-addon" id="basic-addon1">标签查询</span>
                            <div style="float:left;">
                                <textarea id="stu_tag" name="stu_tag" rows="1" style="width: 168px;padding:6px;"></textarea>
                            </div>
                        </div>

                        <div class="input-group" style="float:left;margin:5px 20px;width:260px;">
                            <span class="input-group-addon" id="basic-addon1">入学时间</span>
                            <input placeholder="请输入开始时间" id="begintime" name="begintime" class="input" style="width:80px" value="2017-07-16" onclick="Calendarset(this)" type="text">--<input placeholder="请输入结束时间" id="endtime" name="endtime" class="input" style="width:80px" value="2017-07-22" onclick="Calendarset(this)" type="text">
                        </div>
                       

                        <div class="input-group" style="float:left;margin:5px 20px;width:260px;">
                            <span class="input-group-addon" id="basic-addon1">学员ID&nbsp;&nbsp;&nbsp;</span>
                            <input placeholder="请输入关键字" name="key_stu_id" class="input" type="text">
                        </div>
                        <div class="input-group" style="float:left;margin:5px 20px;width:260px;">
                            <span class="input-group-addon" id="basic-addon1">学员姓名</span>
                            <input placeholder="请输入关键字" name="key_stu_name" class="input" type="text">
                        </div>
                        <div class="input-group" style="float:left;margin:5px 20px;width:260px;">
                            <span class="input-group-addon" id="basic-addon1">学员卡号</span>
                            <input placeholder="请输入关键字" name="key_stu_card_id" class="input" type="text">
                        </div>
                        <div class="input-group" style="float:left;margin:5px 20px;width:260px;">
                            <span class="input-group-addon" id="basic-addon1">学员手机</span>
                            <input placeholder="请输入关键字" name="key_stu_mobile" class="input" type="text">
                        </div>

                        <div class="input-group" style="float:left;margin:5px 20px;width:260px;">
                            <span class="input-group-addon" id="basic-addon1">生日时间</span>
                            <input placeholder="请输入开始时间" id="birth_begin" name="birth_begin" class="input" style="width:80px" value="01-01" onclick="Calendarset(this,'%m-%d')" type="text">--<input placeholder="请输入结束时间" id="birth_end" name="birth_end" class="input" style="width:80px" value="12-31" onclick="Calendarset(this,'%m-%d')" type="text">
                        </div>
                    </div>
                    <div class="clear"></div>
                    <input name="advancedsearch" value="" type="hidden">
                    <input class="button btn_blue" value="查  询" type="submit">
                    <input class="button btn_blue" style="margin-left:20px;" onclick="click_show(0)" id="highsearch" value="基本查询" type="button">
                </form>            
            </div>
               
        </div>
    </div>

<form action="/bangke/manage/student/del" method="post" id="form_do" name="form_do">
    <div class="list">
        <div class="dropdownZone dropDateBox" style="z-index: 100; display: none;">
        
            查询区间：<input class="input" name="countBegin" id="countBegin" value="2017-07-01" style="width:80px" onclick="Calendarset(this)" type="text">-
            <input class="input" name="countEnd" id="countEnd" value="2017-07-31" style="width:80px" onclick="Calendarset(this)" type="text">
            <input class="button btn_blue" value="确定" type="submit">
        
    </div><table id="tableSL" width="100%">
            <thead>
                <tr id="stu_list" class="">
                    <th><input id="check" type="checkbox"></th>
                    <th>学员ID</th>
                    <th>姓名</th>
                    <th>门店</th>
                    <th>手机</th>
                    <!--<th>家长手机</th>-->
                    <th class="dropdownBtn" data-res="dropDateBox" data-status="true">本月消耗课时<span class="caret"></span></th>
                    <th>剩余课时</th>
                    <th>卡号</th>
                    <!--<th>学校</th>-->
                    <th>绑定微信</th>
                    <th>入学时间</th>
                    <th>备注</th>
                    <th>余额</th>
                    <th>是否购课</th>
                    <th>是否售后</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
    			                <tr class="tableOprate">
                                            <td colspan="20" style="text-align:center">没有数据</td>                </tr>
            </tbody>
        </table>  
    </div>


    <div class="article_absolute_content" style="display:none">
        <form method="post" action="/bangke/manage/SendMessage/sendstudent/batchFlag/1" onsubmit="return SendMsg(this);">
            <dl>
                标题：<textarea type="text" name="title" id="title" style="width: 500px;height: 30px;margin-bottom: 20px;"></textarea>
            </dl>
            <dl>
                内容：<textarea type="text" name="msg" id="msg" style="width: 500px;height: 100px;margin-bottom: 20px;"></textarea>
            </dl>
            <dl>
               发送对象：<input id="sms_to_stu" name="sms_to_stu" value="1" checked="checked" type="radio"><label for="sms_to_stu">学生</label>
                <input id="sms_to_stu_p" name="sms_to_stu" value="0" type="radio"><label for="sms_to_stu_p">家长</label>
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
                发送短信：<input id="typetrue" name="type" value="0" type="radio"><label for="typetrue">是</label><input id="typefalse" name="type" value="1" checked="checked" type="radio"><label for="typefalse">否</label>  <span class="glyphicon glyphicon-info-sign" aria-hidden="true" style="color:#666" title="默认只发送微信推送，若选择发送短信则发送短信+推送"></span>
            </dl>               
            <div style="text-align:center;margin-top:10px;">
                <input class="button btn_blue" value="发送" type="submit">
                <input class="button btn_green" onclick="TINY.box.hide()" value="取消" type="button">
            </div>
        </form>
    </div>
    <div id="dropDateBox" style="display: none">
        <form method="get" action="">
            查询区间：<input class="input" name="countBegin" id="countBegin" value="2017-07-01" style="width:80px" onclick="Calendarset(this)" type="text">-
            <input class="input" name="countEnd" id="countEnd" value="2017-07-31" style="width:80px" onclick="Calendarset(this)" type="text">
            <input class="button btn_blue" value="确定" type="submit">
        </form>
    </div>
    <div id="dropMoreBox" style="display: none">
        <input name="attendanceMRate" value="1" onclick="setCondition(this)" type="checkbox">本月出勤率
        <input name="stuNotBind" value="1" onclick="setCondition(this)" type="checkbox">未绑定微信
    </div>
    <div id="model" style="display: none">
        <div class="conditionZone">
            <span class="info_title">查询条件</span>
            <input placeholder="请输入关键字" name="keyword[]" title="关键字" class="input" type="text"><span>&nbsp;&nbsp;</span>
            <select name="searchKey[]" class="select">
                <option value="stu_id" selected="selected">学员ID</option>
                <option value="stu_name">姓名</option>
                <option value="stu_card_id">卡号</option>
                <option value="stu_mobile">手机</option>
            </select>

            <a href="javascript:void(0)" onclick="deleteRow(this)">删除</a>
        </div>
    </div>
</form></div>
<script type="text/javascript">
var isreload=0,isSetTag=0;
$(function(){
    $("select[name='searchKey']").each(function(){
        $(this).val('');
    });
    $("#form_do").formSubmit();

    if(''=='1'){
        var items='[]';
        tagSet(JSON.parse(items));
    }

    
    var enjoyhint_script_steps = 
enjoyhint_script_preset_steps.noviceGuide.noviceGuide_student;
    if('0'=='0'){
        isreload=1;
        var enjoyhint_instance = new EnjoyHint();
        var steps=[enjoyhint_script_steps[0]];
        //set script config
        enjoyhint_instance.set(steps);
        //run Enjoyhint script
        enjoyhint_instance.run();
    }
    if('0'=='1'&&'0'!='1'){
        isreload=1;
        var enjoyhint_instance = new EnjoyHint();
        var steps=[enjoyhint_script_steps[1]];
        //set script config
        enjoyhint_instance.set(steps);
        //run Enjoyhint script
        enjoyhint_instance.run();
    }
    if('0'=='1'&&'0'=='1'){
        var enjoyhint_instance = new EnjoyHint();
        var steps=[enjoyhint_script_steps[2]];
        //set script config
        enjoyhint_instance.set(steps);
        //run Enjoyhint script
        enjoyhint_instance.run();
    }
});
    function setCondition(obj){
        var c=obj.name;
        setCookie(c,obj.checked==true?1:0);
        location.reload();
    }

    function tagSet(items){
        if(!isSetTag){
            $('#stu_tag').textext({
                plugins : 'tags autocomplete ajax arrow',
                tagsItems : items||[],
                ajax : {
                    url : "/bangke/manage/student/sm_tags_stu",
                    dataType : 'json',
                    cacheResults : true
                }
            });
            isSetTag=1;
        }
    }

    //新手教程
    function tutorial(){
        var enjoyhint_instance = new EnjoyHint({});
        var enjoyhint_script_steps = [
            {
            selector:'.right' ,
            description: '欢迎使用学员管理功能，接下来将介绍本模块的基本操作。',
            showNext:true,
            justIntro:true,
            showSkip:true,
          },
          {
            selector:'#studentAdd' ,
            description: '点击此处可以添加学员',
            showNext:true,
            showSkip:true,
            disablecontent:true
          },
          {
            selector:'#searchstu' ,
            description: '此处为查询区域，在此处可以选择查询条件并输入查询关键字查询学员列表',
            showNext:true,
            showSkip:true,
            disablecontent:true
          },
          {
            selector:'#stu_list' ,
            description: 
'在此处可以浏览学员列表，并对其进行购买课程等相关操作，也可以点击学员姓名进入学员详情页面查看详情',
            showNext:true,
            showSkip:true,
            disablecontent:true,
            bottom:-40
          },
          {
            selector:'.tableOprate' ,
            description: "此处为列表操作区域，可对选中的学员进行删除、发送短信等操作,也可以快速翻页",
            showNext:true,
            showSkip:true,
            disablecontent:true
          },
          {
            selector:'#graduate' ,
            description: '点击此处可以浏览已毕业的学员列表',
            showNext:true,
            showSkip:true,
            disablecontent:true
          },
          {
            selector:'#tutorial_btn' ,
            description: '点击此处可以再次查看此教程',
            showNext:true,
            showSkip:true,
            disablecontent:true,
          },
          {
            selector:'.right' ,
            description: '教程引导完毕，如果您有任何问题请与我们的客服联系。',
            showNext:true,
            justIntro:true,
            showSkip:true,
          }
        ];
        var steps=enjoyhint_script_steps;
        enjoyhint_instance.set(steps);
        enjoyhint_instance.run();
    }

    function showSendMsg(type){
        
showTBox(type?'群发所有学员':'发送消息','','',$(".article_absolute_content").html(),function(){
            if(type){
                $('.tbox form').append("<input type='hidden' name='isAll' value='1'/>");
            }
        });
    }

    function SendMsg(obj){
        if (!getCheckboxNum("")&&$(".tbox input[name='isAll']").val()==0){
            alert('请选择项！');
            return false;
        }
        var msg=getFormJson(obj);
        var key=getFormJson($('#form_do'));

        $.ajax({
            type:$(obj).attr('method'), 
            url:$(obj).attr('action'),
            data:$.extend({},msg,key), 
            beforeSend: function(data) {
                submit_before_info();
            },
            success:function(data){
                submit_back_info(data);
                if(data.status==1){
                    TINY.box.hide();
                }
            }
        });
        return false;
    }

    function showBindCode(id,type,mobile,closejs){
        if(mobile==''){
            alert('请先填写学员或家长的手机');
            return;
        }
        TINY.box.show({
                        
url:"/bangke/manage/BaseData/tempCode/id/"+id+"/type/"+type,
                        width:500,
                        height:540,
                        fixed:false,
                        maskid:'blackmask',
                        maskopacity:40,
                        closejs:closejs
                    });
    }

    function show_course_article(url,content,title) {
        showTBox('购买课程',url,'825px','','',(isreload?function(){
            location.reload();
        }:''));
    }

    function show_recharge_article(url) {
        showTBox('充值',url,'450px','',function(){onchangstudent();});
    }

    function show_deduction_article(url,type) {
        if(type==1){
            var title="扣费<span style='color:red;margin-left:20px'>请务必填好备注</span>";
        }else{
            var title="退款";
        }
        showTBox(title,url,'450px','',function(){onchangstudent();});
    }

     function onchangstudent(){
        $('#pre_stu_id').typeahead({
            source: function (query, process) {

                $.ajax({
                    type:"POST", //表单提交类型
                    url:"/bangke/manage/CheckStand/searchstudent", 
//表单提交目标
                    data:{key:query}, //表单数据
                    success:function(data){
                        students = [];
                        map = {};
                        var studentList = data.data.studentList;
                        $.each(studentList, function (i, student) {
                                map[student.stu_id] = student;
                                students.push(student.stu_id);
                        });
                        process(students);
                    }
                });
            },
            items: 10,//最多显示个数
            matcher: function (item) {
                return item;
            },
            highlighter: function (item) {
               return 
"学生："+map[item].stu_name+"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;手机："+map[item].stu_mobile+"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;编号："+item;
            },
        });
    }

    function show_service_article(url) {
        showTBox('购买服务',url,'780px');
    }

    function tagssetup(){
        $('#tags').tagsInput({
           'height': 'auto', //设置高度
           'width': '200px',  //设置宽度
           'interactive':true, //是否允许添加标签，false为阻止
           'defaultText':'+', //默认文字
           'removeWithBackspace' : false, //是否允许使用退格键删除前面的标签，false为阻止
           'minChars' : 1, //每个标签的小最字符
           'maxChars' : 20, //每个标签的最大字符，如果不设置或者为0，就是无限大
           'placeholderColor' : '#666666' //设置defaultText的颜色
        });
    }
      
    function show_studentregister_article(url) {
        showTBox('添加学员',url,'780px','',function(){
            tagssetup();
            
g_AjxUploadImg($("#btn_uploadImg"),$("#stu_img"),$("#stu_picture"),"student");

        },(isreload?function(){location.reload();}:''));
    }

    function click_show(type){
        if(type==1){
            $('#advancedsearch').slideDown();
            $('#basesearch').slideUp();
            $("input[name='advancedsearch']").val(1);
        }else{
            $('#advancedsearch').slideUp();
            $('#basesearch').slideDown();
            $("input[name='advancedsearch']").val(0);
        }
        tagSet();
    }
</script>
</div>

	</div>    

<script type="text/javascript">
    $(function() {
      //实现客服固定框滑动效果
    $(".kfleft").click(function(){
		
    var i=$("#haiiskefu").css("right");
    if (i=='0px'){
      $('#haiiskefu').animate({right:-80}, 200);
	  $("#haiiskefu ul").fadeOut(200);
    } else {
      $('#haiiskefu').animate({right:0}, 200);
	  $("#haiiskefu ul").fadeIn(200);
    }
  });
  });

</script>
<script type="text/javascript" src="register_files/common.js"></script>
<script type="text/javascript" src="register_files/frame.js"></script>
<script type="text/javascript" src="register_files/ajax-submit.js"></script>
<script type="text/javascript" src="register_files/tinybox.js"></script>
<script type="text/javascript" src="register_files/jquery.js"></script>

<div class="tmask" id="blackmask" style="z-index: 800; height: 801px; width: 1600px; opacity: 0.7; display: block;"></div><div class="tbox " style="position: absolute; z-index: 900; top: 54px; left: 408.5px; opacity: 1; display: block;"><div class="tinner" id="" style="width: 783px; height: auto; background-image: none;"><div class="tcontent" style="display: block;">
    <p class="popwin_title" style="display: block;">添加学员</p>
    <div class="popwin_container">
        <div class="popwin_content" style="min-width: 780px; min-height: 0px;"><style>
	.form dt{
		width:90px;
	}
</style>
<div class="main" style="margin-left:40px">
	<div class="form">
		<form method="post" id="form_do" name="form_do" action="real_register.php">
		<dl>					
			<dt> 所属门店：</dt>
			<dd>
				<select name="stu_store" class="select">
                    <option value="广外琴行" selected="selected">广外琴行</option>
                    <option value="琴行2">琴行2</option>
                    <option value="琴行3">琴行3</option>
				</select>
			</dd>
			<dt style="margin-left:50px;"> 姓名：</dt>
			<dd>
				<input name="stu_name" placeholder="必填" class="input" autocomplete="off" maxlength="10" type="text">
			</dd>			
		</dl>
		<dl>			
			<dt>电话：</dt>
			<dd>
				<input name="stu_mobile" placeholder="必填" class="input" maxlength="15" type="text">				
			</dd>
			<dt style="margin-left:50px;">入学时间：</dt>
			<dd>
				<input class="input" name="stu_create_time" id="stu_create_time" value="2017-07-22" onclick="Calendarset(this)" type="text">
			</dd>
		</dl>

		<dl>			
			<dt>家长姓名：</dt>
			<dd>
				<input name="stu_parent_name" placeholder="必填" class="input" maxlength="10" type="text">				
			</dd>
			<dt style="margin-left:50px;">家长电话：</dt>
			<dd>
			<input name="stu_parent_mobile" placeholder="必填" class="input" maxlength="15" type="text">
			</dd>
		</dl>
	
		<dl>		
			<dt> 卡号：</dt>
			<dd>
				<input name="stu_card_id" placeholder="选填" class="input" maxlength="20" type="text">
			</dd>
			<dt style="margin-left:50px;">性别：</dt>
			<dd>
				<input name="stu_sex" checked="checked" value="男" type="radio">男
            	<input name="stu_sex" value="女" type="radio">女
			</dd>
		</dl>
		
		<dl>			
			<dt>生日：</dt>
			<dd>
				<input class="input" name="stu_birthday" id="stu_birthday" value="2017-07-22" onclick="Calendarset(this)" type="text">
			</dd>
			<dt style="margin-left:50px;">学校：</dt>
			<dd>
				<input name="stu_school" placeholder="必填" class="input" maxlength="50" type="text">				
			</dd>
		</dl>
		
		<dl>
            <dt>课程类别：</dt>
            <dd>
                <input name="stu_type" placeholder="必填(如钢琴)" class="input" maxlength="50" type="text">             
            </dd>
             
            <dt style="margin-left: 50px;"> 学员风采：</dt>
            <dd>
                <input class="button btn_blue" id="btn_uploadImg" value="上传图片" type="button">
            </dd>
            <dd><input name="s_picture" id="stu_picture" value="" type="hidden"></dd>
		</dl>
        <!--
		<dl>
			<dt></dt>
			<dd><img src="" alt="" id="stu_img"></dd>
		</dl>
	    -->
		<dl>
			<dt>地址：</dt>
			<dd>
				<input name="stu_address" placeholder="选填" class="input_large" maxlength="50" type="text">				
			</dd>
		</dl>

		
		<dl>			
			<dt>邮箱：</dt>
			<dd>
				<input name="stu_email" placeholder="必填" class="input" maxlength="20" type="text">				
			</dd>
			<dt style="margin-left:50px;">QQ：</dt>
			<dd>
				<input name="stu_qq" placeholder="必填" class="input" maxlength="20" type="text">
			</dd>
		</dl>
		
		<dl>			
			<dt>微信：</dt>
			<dd>
				<input name="stu_wechat" placeholder="必填" class="input" maxlength="20" type="text">
			</dd>
			<dt style="margin-left:50px;">分组：</dt>
			<dd>
				<input name="stu_group" placeholder="选填" class="input" maxlength="25" type="text">
			</dd>
		</dl>
		
		<dl>			
            <dt>备注：</dt>
			<dd>
				<input name="stu_remark" placeholder="选填" class="input" maxlength="__INPUT_XLL__" type="text">
			</dd>
			<dt style="margin-left:50px;">标签：</dt>
			<dd>
				<input id="tags" name="stu_tag" class="tags input" placeholder="选填,以英文逗号隔开" style="display: none;" type="text"><div id="tags_tagsinput" class="tagsinput" style="width: 200px; min-height: auto; height: auto;"><div id="tags_addTag"><input id="tags_tag" value="+" data-default="+" style="color: rgb(102, 102, 102); width: 135px;"></div><div class="tags_clear"></div></div>
			</dd>
		</dl>
				
		<div class="foot text-center">
			<input name="stu_customer_service" value="0" type="hidden">
			<input class="button btn_blue" id="submit" value="确定" type="submit">
			<input class="button btn_blue" onclick="TINY.box.hide();" value="返回" type="button">
		</div>
	   </form>
	</div>	
</div>
<div class="globalLoading" style="display:none;"><span class="info">载入中...</span></div></div>
    </div>
</div><div class="tclose"></div></div></div><tester style="position: absolute; top: -9999px; left: -9999px; width: auto; font-size: 12px; font-family: &quot;Microsoft Yahei&quot;,&quot;微软雅黑&quot;,Tahoma,Arial,Helvetica,STHeiti; font-weight: 700; letter-spacing: normal; white-space: nowrap;" id="tags_tag_autosize_tester"></tester></body></html>