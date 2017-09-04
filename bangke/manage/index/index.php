<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:bangke=""><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta http-equiv="Page-Enter" content="revealTrans(duration=5, transition=7)">
<meta name="keywords" content="邦客，琴行，管家，琴行管家，琴行软件，邦客琴行管家，琴行进销存，琴行发展，琴行扩张,琴行办公,琴行OA,琴行系统,广州琴行软件">
<meta name="description" content="琴行管家是广州骏睿信息科技有限公司，结合自身十年来对琴行需求的资深理解，将ERP的管理思想、管理流程同琴行的应用特点相结合，自主研发的一套贴身解决琴行管理问题的完整解决方案。">
<meta name="renderer" content="webkit">
<title>邦客琴行管家</title>
<!--客服固定框css-->
<link rel="icon" href="http://119.23.230.118/bangke/Public/Static/images/main/icon.png" type="image/x-icon">
<link rel="stylesheet" type="text/css" href="index_files/bootstrap.css">
<link rel="stylesheet" type="text/css" href="index_files/formBuilder.css">
<link rel="stylesheet" type="text/css" href="index_files/fullcalendar.css">
<link rel="stylesheet" type="text/css" href="index_files/consult.css">
<link rel="stylesheet" type="text/css" href="index_files/component.css">
<link rel="stylesheet" type="text/css" href="index_files/global.css">
<link rel="stylesheet" type="text/css" href="index_files/style.css">
<link rel="stylesheet" type="text/css" href="index_files/jquery_002.css">
<link rel="stylesheet" type="text/css" href="index_files/jquery-ui.css">

<link rel="stylesheet" type="text/css" href="index_files/textext_003.css">
<link type="text/css" href="index_files/textext.css" rel="stylesheet">
<link type="text/css" href="index_files/textext_002.css" rel="stylesheet">
<link type="text/css" href="index_files/textext_004.css" rel="stylesheet">

<script type="text/javascript" src="index_files/jquery-1.js"></script>
<script type="text/javascript" src="index_files/json2.js"></script>
<script type="text/javascript" src="index_files/ajaxupload.js"></script>

<link rel="stylesheet" type="text/css" href="index_files/enjoyhint.css">
<script type="text/javascript" src="index_files/enjoyhint.js"></script>
<script type="text/javascript" src="index_files/enjoyhintData.js"></script>
<script type="text/javascript" src="index_files/sender.js"></script>
<script type="text/javascript" src="index_files/jquery_004.js"></script>

<script type="text/javascript" src="index_files/hotkeys.js"></script>
<link rel="stylesheet" type="text/css" href="index_files/jquery.css">
<script type="text/javascript" src="index_files/jquery_006.js"></script>
<script type="text/javascript" src="index_files/jquery_003.js"></script>
<link rel="stylesheet" type="text/css" href="index_files/default.css"><link rel="stylesheet" type="text/css" href="index_files/emoji.css">
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
            uploadJson:"/bangke/Manage/Upload/keUpload",
            allowFlashUpload:false,
            allowMediaUpload:false,
            allowFileUpload:false,
            allowFileManager:false,
            afterChange: function() {
                this.sync();
            },
            items:['formatblock', 'fontsize', '|', 'forecolor', 'hilitecolor', 'bold','italic', 'underline', 'lineheight', 'removeformat', '|','justifyleft', 'justifycenter', 'justifyright','justifyfull', 'insertorderedlist', 'insertunorderedlist', '|',  'fullscreen', '/', 'image', 'emoticons', '|','clearhtml','source', 'preview']
        };

        var editor = KindEditor.create('.text_editor', $.extend(_default,options||{}));
        return editor;
    }

    function showHostedSignZone(){
        showTBox("TitleClose","/bangke/Manage/Booking/hostedSign","100vw,100vh","","","","",{maskclose:0,close:0,class:"tbox_unlimit",top:0,left:0});
    }

    //cookie控制各个页面第一次访问时跳出新手指导，如果有的话。
    function helperInitialize(key,callback){
        var key=key||(getFCL('Index')+'-'+getFCL('index'));
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
            url:"/bangke/Manage/BaseData/checkQueue",
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
        if("index"=='index'&&'Index'=='Index'){
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
                    url:"/bangke/Manage/WebMsg/replyToUser", //表单提交目标
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
                        url:"/bangke/Manage/WebMsg/replyToUser", //表单提交目标
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
            url:"/bangke/Manage/WebMsg/checkNewMsg",
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
            url:"/bangke/Manage/Personal/doSendRedPackMission",
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
            url:"/bangke/Manage/BaseData/showad", 
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
        showTBox(title,"/bangke/Manage/BaseData/loginInfo",'700px','',function(){
          m_changeTab();
          setCookie('is_login_first',0);
        },function(){
          show_birthNote();
        });
    }

    function show_birthNote(){
        if(""=='1'){ //生日提醒
            showTBox('今天生日的学员',"/bangke/Manage/Student/showStuList/type/3",'500px');
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
            action: "/bangke/Manage/Upload/upload",  
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
        var url="/bangke/Manage/WebMsg/index";
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
        // window.open("/bangke/Manage/Personal/index");
        window.open("/bangke/Manage/AppMarket/index");
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
            url:"/bangke/Manage/BaseData/searchEveryThing", 
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
<body class="showmenu">
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
        <img class="mgb10" src="index_files/popwin_eroteme.png">
        <p class="popwin_tips popwin_tips_delete">#content#</p>
        <a class="button btn_red popwin_confirm submit">确认</a>
        <a class="button btn_gray popwin_cancel" onclick="TINY.box.hide();">取消</a>
    </div>
</div>

<div class="popwin" id="popwin_box">
    <p class="popwin_title">TITLE</p>
    <div class="popwin_container">
        <div class="popwin_content">
          正文
        </div>
    </div>
</div>
<div id="allFunc_box" style="display:none"> 
    <dl><dt>快捷键F1</dt></dl>  
    <dl>
        <dt>
            基础数据管理        </dt>
        <dd>
            <a href="http://119.23.230.118/bangke/manage/student/index.php" target="_blank" title="学员管理">学员管理</a><a href="http://119.23.230.118/bangke/Manage/teacher/index.php" target="_blank" title="老师管理">老师管理</a><a href="http://119.23.230.118/bangke/manage/salesman/index.php" target="_blank" title="销售员管理">销售员管理</a><a href="http://119.23.230.118/bangke/manage/store/index.php" target="_blank" title="门店管理">门店管理</a>        </dd>
    </dl><dl>
        <dt>
            教务管理        </dt>
        <dd>
            <a href="http://119.23.230.118/bangke/manage/classroom/index.php" target="_blank" title="教室管理">教室管理</a><a href="http://119.23.230.118/bangke/manage/course/index.php" target="_blank" title="课程管理">课程管理</a><a href="http://119.23.230.118/bangke/Manage/Booking/confirm" target="_blank" title="班级排课管理">班级排课管理</a><a href="http://119.23.230.118/bangke/Manage/Index/index" target="_blank" title="上课签到">上课签到</a><a href="http://119.23.230.118/bangke/Manage/Service/index" target="_blank" title="服务卡管理">服务卡管理</a>        </dd>
    </dl><dl>
        <dt>
            财务管理        </dt>
        <dd>
            <a href="http://119.23.230.118/bangke/Manage/Teacher/settlement" target="_blank" title="老师工资结算">老师工资结算</a><a href="http://119.23.230.118/bangke/Manage/Salesman/settlement" target="_blank" title="销售工资结算">销售工资结算</a><a href="http://119.23.230.118/bangke/Manage/Finance/allStatic" target="_blank" title="财务统计">财务统计</a><a href="http://119.23.230.118/bangke/Manage/Finance/in" target="_blank" title="收支记账">收支记账</a><a href="http://119.23.230.118/bangke/Manage/CheckStand/checkStand" target="_blank" title="收银台">收银台</a>        </dd>
    </dl><dl>
        <dt>
            招生管理        </dt>
        <dd>
            <a href="http://119.23.230.118/bangke/Manage/SignUp/index" target="_blank" title="招生统计">招生统计</a><a href="http://119.23.230.118/bangke/Manage/SignUp/storecourse" target="_blank" title="微招生设置">微招生设置</a><a href="http://119.23.230.118/bangke/WeChat/AppMarket/addPoster" target="_blank" title="招生海报设置">招生海报设置</a><a href="http://119.23.230.118/bangke/Manage/Article/index" target="_blank" title="文章管理">文章管理</a>        </dd>
    </dl><dl>
        <dt>
            系统日志管理        </dt>
        <dd>
            <a href="http://119.23.230.118/bangke/Manage/Static/operationRecord" target="_blank" title="操作日志">操作日志</a><a href="http://119.23.230.118/bangke/Manage/Static/course_buy" target="_blank" title="课程购买记录">课程购买记录</a><a href="http://119.23.230.118/bangke/Manage/Static/service_buy" target="_blank" title="服务购买记录">服务购买记录</a><a href="http://119.23.230.118/bangke/Manage/Static/noticeList" target="_blank" title="通知记录">通知记录</a><a href="http://119.23.230.118/bangke/Manage/Static/studentStatic" target="_blank" title="报表">报表</a>        </dd>
    </dl><dl>
        <dt>
            商品进销存管理        </dt>
        <dd>
            <a href="http://119.23.230.118/bangke/Manage/Index/loginSmpss" target="_blank" title="商品管理系统">商品管理系统</a><a href="http://119.23.230.118/bangke/Manage/OLStoreGoods/index" target="_blank" title="微信商城">微信商城</a>        </dd>
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
<div class="globalLoading" style="display:none;"><span class="info">载入中...</span></div>

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
                <li id="i_self"> 广外琴行1【总店】：你好！&nbsp;edogawap</li>
        <li><a href="javascript:void(0)" onclick="showShortMsgList()"> <span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></a></li>
        <li><a target="_blank" href="http://qinhang.dsmake.com/">官网首页</a></li>
        <li>|</li>
        <li><a target="_blank" href="http://bangkebbs.dsmake.com/">邦客问答百科</a></li>
		<li>|</li>
        <li id="i_exit"><a href="http://119.23.230.118/bangke/Manage/Login/logout">退出</a></li>		
      </ul>
    </div>
</div>
<!-- header end -->

<div class="leftmenu">
<div class="top_logo"> <img src="index_files/logo.png"> </div>
<!-- <div class="top_logo" onclick="ToBuySpace()"> <img src="/bangke/Public/Static/images/main/logo1111.png" /><span id="remain_time" style="color:white"></span> </div> -->
<div class="span"></div>
<div class="menu" id="menu">
<div>
	<img src="index_files/cygn.png">
</div>

<div id="items_usual">
    <ul>
        <li id="allFuncBtn"><a class="hollow_button" href="http://119.23.230.118/bangke/manage/index/allFunction.php">功能大全(F1)</a></li>

        <li><a class="hollow_button active" href="http://119.23.230.118/bangke/manage/index/index">上课签到</a></li>

        <li><a class="hollow_button" href="http://119.23.230.118/bangke/Manage/Booking/confirm">班级排课</a></li>

        <li><a class="hollow_button" href="http://119.23.230.118/bangke/Manage/CheckStand/checkStand">收银台</a></li> 

        <li><a class="hollow_button" href="http://119.23.230.118/bangke/Manage/SignUp/index">招生</a>
        </li>
        <li>
          <a class="hollow_button" href="http://119.23.230.118/bangke/Manage/WebMsg/interactiveWall">微信互动<sup id="wechatNewsCount" style="display: none">&nbsp;<i class="redpoint"></i></sup></a>
        </li>
        <li><a class="hollow_button" href="http://119.23.230.118/bangke/Manage/AppMarket/index">应用市场</a></li>
    </ul>
</div>
<div id="items_other">
	<ul>
      <li><a class="hollow_button" id="Personal" href="http://119.23.230.118/bangke/Manage/Personal/index">我的账户</a></li>
  		  <li><a class="hollow_button" id="Personal" href="http://119.23.230.118/bangke/Manage/Personal/wallet">我的钱包</a></li>
    
        <li><a class="hollow_button" id="Rbac" href="http://119.23.230.118/bangke/Manage/Rbac/index">系统设置</a></li>        <li><a class="hollow_button" id="Guestbook" href="http://119.23.230.118/bangke/Manage/Guestbook/index">留言反馈</a></li>
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

<link rel="stylesheet" type="text/css" href="index_files/jscal2.css">
<link rel="stylesheet" type="text/css" href="index_files/border-radius.css">
<link rel="stylesheet" type="text/css" href="index_files/win2k.css">
<script type="text/javascript" src="index_files/calendar.js"></script>
<script type="text/javascript" src="index_files/en.js"></script>
<script type="text/javascript" src="index_files/bootstrap3-typeahead.js"></script>

<link rel="stylesheet" type="text/css" href="index_files/bootstrap-clockpicker.css">
<script type="text/javascript" src="index_files/bootstrap-clockpicker.js"></script>
<div class="main">
    <div class="pos">
    <li>
        上课签到 | <a class="button btn_blue" style="font-size:16px" href="http://119.23.230.118/bangke/Manage/Service/stu_service">服务签到</a><a class="tutorial_btn" href="javascript:void(0)" onclick="tutorial()" id="tutorial_btn">怎么用？</a>
        <a class="button btn_blue" style="font-size:16px;float:right;margin-right:40px;" onclick="show_welcome();">系统公告</a></li>
        <div class="clear"></div>
    </div>

    
    <div class="border">
    <div style="margin:10px">
    <div class="stu_info_top">
        <span style="font-size:14px; margin-right:30px;">3步用好邦客智能管家</span>
    </div>

    <div class="width_33 right_border float_left" style="padding:0px 10px 0px 10px;margin:10px 0px 10px 0px;">
        <span class="simple_info" style="font-size:12px;">第一步</span>
        <br>
        <br>
        <span class="info_title" style="font-size:12px;">快速导入数据</span>
        <br>
        <span class="info_title" style="font-size:12px;">让系统运作起来</span>
        <br>
        <br>
        <a href="http://119.23.230.118/bangke/Manage/DataImport/index" style="font-size:12px;">导入数据</a>
        <span class="info_title" style="font-size:16px;color:red;">(请先导入数据)</span>    </div>
    <div class="width_33 right_border float_left" style="padding:0px 10px 0px 10px;margin:10px 0px 10px 0px;">
        <span class="simple_info" style="font-size:12px;">第二步</span>
        <br>
        <br>
        <span class="info_title" style="font-size:12px;">安排上课班级</span>
        <br>
        <span class="info_title" style="font-size:12px;">生成课程安排</span>
        <br>
        <br>
        <a href="http://119.23.230.118/bangke/Manage/Booking/confirm" style="font-size:12px;">班级排课</a>
    </div>
    <div class="width_33 float_left" style="padding:0px 10px 0px 10px;margin:10px 0px 10px 0px;">
        <span class="simple_info" style="font-size:12px;">第三步</span>
        <br>
        <br>
        <span class="info_title" style="font-size:12px;">上课打卡签到</span>
        <br>
        <span class="info_title" style="font-size:12px;">每天记录学员和老师上课情况</span>
        <br>
        <br>
        <a href="http://119.23.230.118/bangke/Manage/Booking/sign" style="font-size:12px;">上课签到</a>
    </div>
    <div class="clear"></div>
    </div>
    </div>
    <div class="two_part" style="border:1px solid #666;padding:20px;margin:20px 0px;">
        <li id="signinput" style="width:60%">
            <div style="border-left:5px solid #5aafe8">
                <span class="info_title" style="font-size:16px;">快速签到 | <a href="javascript:void(0)" onclick="showUnsignClass()"> 集体课签到</a> | <a href="javascript:void(0)" onclick="showHostedSignZone()"> 托管签<nobr>到<sup style="color:red">限时</sup></nobr></a></span>    <a style="margin-left:20px;" target="_blank" href="http://bangkebbs.dsmake.com/question/13">怎么刷卡？</a>
            </div> 
            <div style="padding-top:20px;">
                <input name="stu_id" class="input" id="sign_input" placeholder="输入卡号/学员ID/学员姓名签到/搜索" style="width:300px" autocomplete="off" onkeydown="return entersign(event)">
                <input class="button btn_blue" id="stu_sign" value="学员签到" onclick="stu_sign()" type="button"> 
                <input id="searchModel" value="1" autocomplete="off" type="checkbox">
                <label style="color:red" for="searchModel" title="启用搜索模式将会自动搜索相关学员，请点击搜索列表后签到!!  注意：搜索模式下Enter键已被屏蔽，防止误签">
                    搜索模式<span class="glyphicon glyphicon-info-sign" aria-hidden="true" style="color:red"></span>
                </label>

                <input id="leaveSchoolModel" value="1" autocomplete="off" type="checkbox">
                <label style="color:red" for="leaveSchoolModel" title="启用离校模式将会自动给学员家长发送离校通知,但不会签到任何课程">
                    离校模式<span class="glyphicon glyphicon-info-sign" aria-hidden="true" style="color:red"></span>
                </label>
            </div>
            <br>
            <div>
                <a style="font-size:16px;" onclick="showUnsignList()">补签&gt;&gt;</a><br><br>

                <a style="font-size:16px;" onclick="showSignNote()">发送上课通知&gt;&gt;</a> 
            </div>
        </li>
        <li id="signinfo" style="width:40%">
           <div style="border-left:5px solid #5aafe8">
                <span class="info_title" style="font-size:16px;">签到信息</span>
           </div> 
           <div style="padding:10px;font-size:14px;line-height:20px;width:70%;float:left">
                <p>学员姓名：<span id="stu_name"></span></p>
                <p>签到课程：<span id="c_name"></span></p>
                <p>签到班级：<span id="class_name"></span></p>
                <p>上课老师：<span id="teacher_name"></span></p>
                <p>上课教室：<span id="classroom"></span></p>
                <p>上课时间：<span id="class_time"></span></p>
                <p>当前课程剩余课时：<span id="remainNum"></span></p>
           </div>
           
        </li>
        <div class="clear"></div>
    </div>
	
    <div class="pos">课程安排 | <input class="button btn_blue" onclick="click_show(this)" value="签到统计与上课通知∨" id="signcount" type="button"></div>
    <div id="signStatic" style="display:none;">
        <div style="margin:20px 0;" id="counttype">
            <span id="month_sign" class="info_title chart_option pointer active" style="font-size:16px;">当月签到</span>
            <span id="year_sign" class="info_title chart_option pointer" style="font-size:16px;">当年签到</span>
        </div>
        <div id="container" style="min-width:100%;max-width:100%; height: 400px; margin: 0 auto" data-highcharts-chart="0"><div class="highcharts-container" id="highcharts-0" style="position: relative; overflow: hidden; width: 1429px; height: 400px; text-align: left; line-height: normal; z-index: 0; left: 0px; top: 0px;"><svg version="1.1" style="font-family:&quot;Lucida Grande&quot;, &quot;Lucida Sans Unicode&quot;, Arial, Helvetica, sans-serif;font-size:12px;" xmlns="http://www.w3.org/2000/svg" width="1429" height="400"><desc>Created with Highcharts 4.2.1</desc><defs><clipPath id="highcharts-1"><rect x="0" y="0" width="1387" height="263"></rect></clipPath></defs><rect x="0" y="0" width="1429" height="400" strokeWidth="0" fill="#FFFFFF" class=" highcharts-background"></rect><path fill="none" d="M 32 185.5 L 1419 185.5" stroke="#808080" stroke-width="1"></path><g class="highcharts-grid" zIndex="1"></g><g class="highcharts-grid" zIndex="1"><path fill="none" d="M 32 185.5 L 1419 185.5" stroke="#D8D8D8" stroke-width="1" zIndex="1" opacity="1"></path></g><g class="highcharts-axis" zIndex="2"><path fill="none" d="M 76.5 316 L 76.5 326" stroke="#C0D0E0" stroke-width="1" opacity="1"></path><path fill="none" d="M 120.5 316 L 120.5 326" stroke="#C0D0E0" stroke-width="1" opacity="1"></path><path fill="none" d="M 165.5 316 L 165.5 326" stroke="#C0D0E0" stroke-width="1" opacity="1"></path><path fill="none" d="M 210.5 316 L 210.5 326" stroke="#C0D0E0" stroke-width="1" opacity="1"></path><path fill="none" d="M 255.5 316 L 255.5 326" stroke="#C0D0E0" stroke-width="1" opacity="1"></path><path fill="none" d="M 299.5 316 L 299.5 326" stroke="#C0D0E0" stroke-width="1" opacity="1"></path><path fill="none" d="M 344.5 316 L 344.5 326" stroke="#C0D0E0" stroke-width="1" opacity="1"></path><path fill="none" d="M 389.5 316 L 389.5 326" stroke="#C0D0E0" stroke-width="1" opacity="1"></path><path fill="none" d="M 434.5 316 L 434.5 326" stroke="#C0D0E0" stroke-width="1" opacity="1"></path><path fill="none" d="M 478.5 316 L 478.5 326" stroke="#C0D0E0" stroke-width="1" opacity="1"></path><path fill="none" d="M 523.5 316 L 523.5 326" stroke="#C0D0E0" stroke-width="1" opacity="1"></path><path fill="none" d="M 568.5 316 L 568.5 326" stroke="#C0D0E0" stroke-width="1" opacity="1"></path><path fill="none" d="M 613.5 316 L 613.5 326" stroke="#C0D0E0" stroke-width="1" opacity="1"></path><path fill="none" d="M 657.5 316 L 657.5 326" stroke="#C0D0E0" stroke-width="1" opacity="1"></path><path fill="none" d="M 702.5 316 L 702.5 326" stroke="#C0D0E0" stroke-width="1" opacity="1"></path><path fill="none" d="M 747.5 316 L 747.5 326" stroke="#C0D0E0" stroke-width="1" opacity="1"></path><path fill="none" d="M 792.5 316 L 792.5 326" stroke="#C0D0E0" stroke-width="1" opacity="1"></path><path fill="none" d="M 836.5 316 L 836.5 326" stroke="#C0D0E0" stroke-width="1" opacity="1"></path><path fill="none" d="M 881.5 316 L 881.5 326" stroke="#C0D0E0" stroke-width="1" opacity="1"></path><path fill="none" d="M 926.5 316 L 926.5 326" stroke="#C0D0E0" stroke-width="1" opacity="1"></path><path fill="none" d="M 971.5 316 L 971.5 326" stroke="#C0D0E0" stroke-width="1" opacity="1"></path><path fill="none" d="M 1015.5 316 L 1015.5 326" stroke="#C0D0E0" stroke-width="1" opacity="1"></path><path fill="none" d="M 1060.5 316 L 1060.5 326" stroke="#C0D0E0" stroke-width="1" opacity="1"></path><path fill="none" d="M 1105.5 316 L 1105.5 326" stroke="#C0D0E0" stroke-width="1" opacity="1"></path><path fill="none" d="M 1150.5 316 L 1150.5 326" stroke="#C0D0E0" stroke-width="1" opacity="1"></path><path fill="none" d="M 1194.5 316 L 1194.5 326" stroke="#C0D0E0" stroke-width="1" opacity="1"></path><path fill="none" d="M 1239.5 316 L 1239.5 326" stroke="#C0D0E0" stroke-width="1" opacity="1"></path><path fill="none" d="M 1284.5 316 L 1284.5 326" stroke="#C0D0E0" stroke-width="1" opacity="1"></path><path fill="none" d="M 1329.5 316 L 1329.5 326" stroke="#C0D0E0" stroke-width="1" opacity="1"></path><path fill="none" d="M 1373.5 316 L 1373.5 326" stroke="#C0D0E0" stroke-width="1" opacity="1"></path><path fill="none" d="M 1419.5 316 L 1419.5 326" stroke="#C0D0E0" stroke-width="1" opacity="1"></path><path fill="none" d="M 31.5 316 L 31.5 326" stroke="#C0D0E0" stroke-width="1" opacity="1"></path><path fill="none" d="M 32 316.5 L 1419 316.5" stroke="#C0D0E0" stroke-width="1" zIndex="7"></path></g><g class="highcharts-axis" zIndex="2"></g><g class="highcharts-series-group" zIndex="3"><g class="highcharts-series highcharts-series-0" zIndex="0.1" transform="translate(32,53) scale(1 1)" clip-path="url(#highcharts-1)"><path fill="none" d="M 22.370967741935484 131.5 L 67.11290322580645 131.5 L 111.85483870967742 131.5 L 156.59677419354838 131.5 L 201.33870967741936 131.5 L 246.08064516129033 131.5 L 290.8225806451613 131.5 L 335.56451612903226 131.5 L 380.30645161290323 131.5 L 425.0483870967742 131.5 L 469.7903225806452 131.5 L 514.5322580645161 131.5 L 559.2741935483871 131.5 L 604.016129032258 131.5 L 648.758064516129 131.5 L 693.5 131.5 L 738.241935483871 131.5 L 782.983870967742 131.5 L 827.7258064516129 131.5 L 872.4677419354839 131.5 L 917.2096774193549 131.5 L 961.9516129032259 131.5 L 1006.6935483870968 131.5 L 1051.4354838709676 131.5 L 1096.1774193548385 131.5 L 1140.9193548387095 131.5 L 1185.6612903225805 131.5 L 1230.4032258064515 131.5 L 1275.1451612903224 131.5 L 1319.8870967741934 131.5 L 1364.6290322580644 131.5" stroke="#FB803B" stroke-width="2" zIndex="1" stroke-linejoin="round" stroke-linecap="round"></path><path fill="none" d="M 12.370967741935484 131.5 L 22.370967741935484 131.5 L 67.11290322580645 131.5 L 111.85483870967742 131.5 L 156.59677419354838 131.5 L 201.33870967741936 131.5 L 246.08064516129033 131.5 L 290.8225806451613 131.5 L 335.56451612903226 131.5 L 380.30645161290323 131.5 L 425.0483870967742 131.5 L 469.7903225806452 131.5 L 514.5322580645161 131.5 L 559.2741935483871 131.5 L 604.016129032258 131.5 L 648.758064516129 131.5 L 693.5 131.5 L 738.241935483871 131.5 L 782.983870967742 131.5 L 827.7258064516129 131.5 L 872.4677419354839 131.5 L 917.2096774193549 131.5 L 961.9516129032259 131.5 L 1006.6935483870968 131.5 L 1051.4354838709676 131.5 L 1096.1774193548385 131.5 L 1140.9193548387095 131.5 L 1185.6612903225805 131.5 L 1230.4032258064515 131.5 L 1275.1451612903224 131.5 L 1319.8870967741934 131.5 L 1364.6290322580644 131.5 L 1374.6290322580644 131.5" stroke-linejoin="round" visibility="visible" stroke="rgba(192,192,192,0.0001)" stroke-width="22" zIndex="2" class=" highcharts-tracker" style="cursor:pointer;"></path></g><g class="highcharts-markers highcharts-series-0 highcharts-tracker" zIndex="0.1" transform="translate(32,53) scale(1 1)" clip-path="url(#highcharts-2)" style="cursor:pointer;"><path fill="#FB803B" d="M 1364 127.5 C 1369.328 127.5 1369.328 135.5 1364 135.5 C 1358.672 135.5 1358.672 127.5 1364 127.5 Z"></path><path fill="#FB803B" d="M 1319 127.5 C 1324.328 127.5 1324.328 135.5 1319 135.5 C 1313.672 135.5 1313.672 127.5 1319 127.5 Z"></path><path fill="#FB803B" d="M 1275 127.5 C 1280.328 127.5 1280.328 135.5 1275 135.5 C 1269.672 135.5 1269.672 127.5 1275 127.5 Z"></path><path fill="#FB803B" d="M 1230 127.5 C 1235.328 127.5 1235.328 135.5 1230 135.5 C 1224.672 135.5 1224.672 127.5 1230 127.5 Z"></path><path fill="#FB803B" d="M 1185 127.5 C 1190.328 127.5 1190.328 135.5 1185 135.5 C 1179.672 135.5 1179.672 127.5 1185 127.5 Z"></path><path fill="#FB803B" d="M 1140 127.5 C 1145.328 127.5 1145.328 135.5 1140 135.5 C 1134.672 135.5 1134.672 127.5 1140 127.5 Z"></path><path fill="#FB803B" d="M 1096 127.5 C 1101.328 127.5 1101.328 135.5 1096 135.5 C 1090.672 135.5 1090.672 127.5 1096 127.5 Z"></path><path fill="#FB803B" d="M 1051 127.5 C 1056.328 127.5 1056.328 135.5 1051 135.5 C 1045.672 135.5 1045.672 127.5 1051 127.5 Z"></path><path fill="#FB803B" d="M 1006 127.5 C 1011.328 127.5 1011.328 135.5 1006 135.5 C 1000.672 135.5 1000.672 127.5 1006 127.5 Z"></path><path fill="#FB803B" d="M 961 127.5 C 966.328 127.5 966.328 135.5 961 135.5 C 955.672 135.5 955.672 127.5 961 127.5 Z"></path><path fill="#FB803B" d="M 917 127.5 C 922.328 127.5 922.328 135.5 917 135.5 C 911.672 135.5 911.672 127.5 917 127.5 Z"></path><path fill="#FB803B" d="M 872 127.5 C 877.328 127.5 877.328 135.5 872 135.5 C 866.672 135.5 866.672 127.5 872 127.5 Z"></path><path fill="#FB803B" d="M 827 127.5 C 832.328 127.5 832.328 135.5 827 135.5 C 821.672 135.5 821.672 127.5 827 127.5 Z"></path><path fill="#FB803B" d="M 782 127.5 C 787.328 127.5 787.328 135.5 782 135.5 C 776.672 135.5 776.672 127.5 782 127.5 Z"></path><path fill="#FB803B" d="M 738 127.5 C 743.328 127.5 743.328 135.5 738 135.5 C 732.672 135.5 732.672 127.5 738 127.5 Z"></path><path fill="#FB803B" d="M 693 127.5 C 698.328 127.5 698.328 135.5 693 135.5 C 687.672 135.5 687.672 127.5 693 127.5 Z"></path><path fill="#FB803B" d="M 648 127.5 C 653.328 127.5 653.328 135.5 648 135.5 C 642.672 135.5 642.672 127.5 648 127.5 Z"></path><path fill="#FB803B" d="M 604 127.5 C 609.328 127.5 609.328 135.5 604 135.5 C 598.672 135.5 598.672 127.5 604 127.5 Z"></path><path fill="#FB803B" d="M 559 127.5 C 564.328 127.5 564.328 135.5 559 135.5 C 553.672 135.5 553.672 127.5 559 127.5 Z"></path><path fill="#FB803B" d="M 514 127.5 C 519.328 127.5 519.328 135.5 514 135.5 C 508.672 135.5 508.672 127.5 514 127.5 Z"></path><path fill="#FB803B" d="M 469 127.5 C 474.328 127.5 474.328 135.5 469 135.5 C 463.672 135.5 463.672 127.5 469 127.5 Z"></path><path fill="#FB803B" d="M 425 127.5 C 430.328 127.5 430.328 135.5 425 135.5 C 419.672 135.5 419.672 127.5 425 127.5 Z"></path><path fill="#FB803B" d="M 380 127.5 C 385.328 127.5 385.328 135.5 380 135.5 C 374.672 135.5 374.672 127.5 380 127.5 Z"></path><path fill="#FB803B" d="M 335 127.5 C 340.328 127.5 340.328 135.5 335 135.5 C 329.672 135.5 329.672 127.5 335 127.5 Z"></path><path fill="#FB803B" d="M 290 127.5 C 295.328 127.5 295.328 135.5 290 135.5 C 284.672 135.5 284.672 127.5 290 127.5 Z"></path><path fill="#FB803B" d="M 246 127.5 C 251.328 127.5 251.328 135.5 246 135.5 C 240.672 135.5 240.672 127.5 246 127.5 Z"></path><path fill="#FB803B" d="M 201 127.5 C 206.328 127.5 206.328 135.5 201 135.5 C 195.672 135.5 195.672 127.5 201 127.5 Z"></path><path fill="#FB803B" d="M 156 127.5 C 161.328 127.5 161.328 135.5 156 135.5 C 150.672 135.5 150.672 127.5 156 127.5 Z"></path><path fill="#FB803B" d="M 111 127.5 C 116.328 127.5 116.328 135.5 111 135.5 C 105.672 135.5 105.672 127.5 111 127.5 Z"></path><path fill="#FB803B" d="M 67 127.5 C 72.328 127.5 72.328 135.5 67 135.5 C 61.672 135.5 61.672 127.5 67 127.5 Z"></path><path fill="#FB803B" d="M 22 127.5 C 27.328 127.5 27.328 135.5 22 135.5 C 16.672 135.5 16.672 127.5 22 127.5 Z"></path></g><g class="highcharts-series highcharts-series-1" zIndex="0.1" transform="translate(32,53) scale(1 1)" clip-path="url(#highcharts-1)"><path fill="none" d="M 22.370967741935484 131.5 L 67.11290322580645 131.5 L 111.85483870967742 131.5 L 156.59677419354838 131.5 L 201.33870967741936 131.5 L 246.08064516129033 131.5 L 290.8225806451613 131.5 L 335.56451612903226 131.5 L 380.30645161290323 131.5 L 425.0483870967742 131.5 L 469.7903225806452 131.5 L 514.5322580645161 131.5 L 559.2741935483871 131.5 L 604.016129032258 131.5 L 648.758064516129 131.5 L 693.5 131.5 L 738.241935483871 131.5 L 782.983870967742 131.5 L 827.7258064516129 131.5 L 872.4677419354839 131.5 L 917.2096774193549 131.5 L 961.9516129032259 131.5 L 1006.6935483870968 131.5 L 1051.4354838709676 131.5 L 1096.1774193548385 131.5 L 1140.9193548387095 131.5 L 1185.6612903225805 131.5 L 1230.4032258064515 131.5 L 1275.1451612903224 131.5 L 1319.8870967741934 131.5 L 1364.6290322580644 131.5" stroke="#6FA7CE" stroke-width="2" zIndex="1" stroke-linejoin="round" stroke-linecap="round"></path><path fill="none" d="M 12.370967741935484 131.5 L 22.370967741935484 131.5 L 67.11290322580645 131.5 L 111.85483870967742 131.5 L 156.59677419354838 131.5 L 201.33870967741936 131.5 L 246.08064516129033 131.5 L 290.8225806451613 131.5 L 335.56451612903226 131.5 L 380.30645161290323 131.5 L 425.0483870967742 131.5 L 469.7903225806452 131.5 L 514.5322580645161 131.5 L 559.2741935483871 131.5 L 604.016129032258 131.5 L 648.758064516129 131.5 L 693.5 131.5 L 738.241935483871 131.5 L 782.983870967742 131.5 L 827.7258064516129 131.5 L 872.4677419354839 131.5 L 917.2096774193549 131.5 L 961.9516129032259 131.5 L 1006.6935483870968 131.5 L 1051.4354838709676 131.5 L 1096.1774193548385 131.5 L 1140.9193548387095 131.5 L 1185.6612903225805 131.5 L 1230.4032258064515 131.5 L 1275.1451612903224 131.5 L 1319.8870967741934 131.5 L 1364.6290322580644 131.5 L 1374.6290322580644 131.5" stroke-linejoin="round" visibility="visible" stroke="rgba(192,192,192,0.0001)" stroke-width="22" zIndex="2" class=" highcharts-tracker" style="cursor:pointer;"></path></g><g class="highcharts-markers highcharts-series-1 highcharts-tracker" zIndex="0.1" transform="translate(32,53) scale(1 1)" clip-path="url(#highcharts-2)" style="cursor:pointer;"><path fill="#6FA7CE" d="M 1364 127.5 L 1368 131.5 1364 135.5 1360 131.5 Z"></path><path fill="#6FA7CE" d="M 1319 127.5 L 1323 131.5 1319 135.5 1315 131.5 Z"></path><path fill="#6FA7CE" d="M 1275 127.5 L 1279 131.5 1275 135.5 1271 131.5 Z"></path><path fill="#6FA7CE" d="M 1230 127.5 L 1234 131.5 1230 135.5 1226 131.5 Z"></path><path fill="#6FA7CE" d="M 1185 127.5 L 1189 131.5 1185 135.5 1181 131.5 Z"></path><path fill="#6FA7CE" d="M 1140 127.5 L 1144 131.5 1140 135.5 1136 131.5 Z"></path><path fill="#6FA7CE" d="M 1096 127.5 L 1100 131.5 1096 135.5 1092 131.5 Z"></path><path fill="#6FA7CE" d="M 1051 127.5 L 1055 131.5 1051 135.5 1047 131.5 Z"></path><path fill="#6FA7CE" d="M 1006 127.5 L 1010 131.5 1006 135.5 1002 131.5 Z"></path><path fill="#6FA7CE" d="M 961 127.5 L 965 131.5 961 135.5 957 131.5 Z"></path><path fill="#6FA7CE" d="M 917 127.5 L 921 131.5 917 135.5 913 131.5 Z"></path><path fill="#6FA7CE" d="M 872 127.5 L 876 131.5 872 135.5 868 131.5 Z"></path><path fill="#6FA7CE" d="M 827 127.5 L 831 131.5 827 135.5 823 131.5 Z"></path><path fill="#6FA7CE" d="M 782 127.5 L 786 131.5 782 135.5 778 131.5 Z"></path><path fill="#6FA7CE" d="M 738 127.5 L 742 131.5 738 135.5 734 131.5 Z"></path><path fill="#6FA7CE" d="M 693 127.5 L 697 131.5 693 135.5 689 131.5 Z"></path><path fill="#6FA7CE" d="M 648 127.5 L 652 131.5 648 135.5 644 131.5 Z"></path><path fill="#6FA7CE" d="M 604 127.5 L 608 131.5 604 135.5 600 131.5 Z"></path><path fill="#6FA7CE" d="M 559 127.5 L 563 131.5 559 135.5 555 131.5 Z"></path><path fill="#6FA7CE" d="M 514 127.5 L 518 131.5 514 135.5 510 131.5 Z"></path><path fill="#6FA7CE" d="M 469 127.5 L 473 131.5 469 135.5 465 131.5 Z"></path><path fill="#6FA7CE" d="M 425 127.5 L 429 131.5 425 135.5 421 131.5 Z"></path><path fill="#6FA7CE" d="M 380 127.5 L 384 131.5 380 135.5 376 131.5 Z"></path><path fill="#6FA7CE" d="M 335 127.5 L 339 131.5 335 135.5 331 131.5 Z"></path><path fill="#6FA7CE" d="M 290 127.5 L 294 131.5 290 135.5 286 131.5 Z"></path><path fill="#6FA7CE" d="M 246 127.5 L 250 131.5 246 135.5 242 131.5 Z"></path><path fill="#6FA7CE" d="M 201 127.5 L 205 131.5 201 135.5 197 131.5 Z"></path><path fill="#6FA7CE" d="M 156 127.5 L 160 131.5 156 135.5 152 131.5 Z"></path><path fill="#6FA7CE" d="M 111 127.5 L 115 131.5 111 135.5 107 131.5 Z"></path><path fill="#6FA7CE" d="M 67 127.5 L 71 131.5 67 135.5 63 131.5 Z"></path><path fill="#6FA7CE" d="M 22 127.5 L 26 131.5 22 135.5 18 131.5 Z"></path></g></g><g class="highcharts-legend" zIndex="7" transform="translate(1269,10)"><g zIndex="1"><g><g class="highcharts-legend-item" zIndex="1" transform="translate(8,3)"><path fill="none" d="M 0 11 L 16 11" stroke="#FB803B" stroke-width="2"></path><path fill="#FB803B" d="M 8 7 C 13.328 7 13.328 15 8 15 C 2.6719999999999997 15 2.6719999999999997 7 8 7 Z"></path><text x="21" style="color:#333333;font-size:12px;font-weight:bold;cursor:pointer;fill:#333333;" text-anchor="start" zIndex="2" y="15">日签到</text></g><g class="highcharts-legend-item" zIndex="1" transform="translate(85,3)"><path fill="none" d="M 0 11 L 16 11" stroke="#6FA7CE" stroke-width="2"></path><path fill="#6FA7CE" d="M 8 7 L 12 11 8 15 4 11 Z"></path><text x="21" y="15" style="color:#333333;font-size:12px;font-weight:bold;cursor:pointer;fill:#333333;" text-anchor="start" zIndex="2">日缺勤</text></g></g></g></g><g class="highcharts-axis-labels highcharts-xaxis-labels" zIndex="7"><text x="56.96369260628616" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:71;text-overflow:ellipsis;" text-anchor="end" transform="translate(0,0) rotate(-45 56.96369260628616 332)" y="332" opacity="1"><tspan>2017-07-01</tspan></text><text x="101.70562809015712" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:400px;text-overflow:ellipsis;" text-anchor="end" transform="translate(0,0) rotate(-45 101.70562809015712 332)" y="332" opacity="1"><tspan>2017-07-02</tspan></text><text x="146.4475635740281" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:400px;text-overflow:ellipsis;" text-anchor="end" transform="translate(0,0) rotate(-45 146.4475635740281 332)" y="332" opacity="1"><tspan>2017-07-03</tspan></text><text x="191.18949905789907" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:400px;text-overflow:ellipsis;" text-anchor="end" transform="translate(0,0) rotate(-45 191.18949905789907 332)" y="332" opacity="1"><tspan>2017-07-04</tspan></text><text x="235.93143454177005" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:400px;text-overflow:ellipsis;" text-anchor="end" transform="translate(0,0) rotate(-45 235.93143454177005 332)" y="332" opacity="1"><tspan>2017-07-05</tspan></text><text x="280.67337002564096" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:400px;text-overflow:ellipsis;" text-anchor="end" transform="translate(0,0) rotate(-45 280.67337002564096 332)" y="332" opacity="1"><tspan>2017-07-06</tspan></text><text x="325.41530550951194" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:400px;text-overflow:ellipsis;" text-anchor="end" transform="translate(0,0) rotate(-45 325.41530550951194 332)" y="332" opacity="1"><tspan>2017-07-07</tspan></text><text x="370.1572409933829" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:400px;text-overflow:ellipsis;" text-anchor="end" transform="translate(0,0) rotate(-45 370.1572409933829 332)" y="332" opacity="1"><tspan>2017-07-08</tspan></text><text x="414.8991764772539" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:400px;text-overflow:ellipsis;" text-anchor="end" transform="translate(0,0) rotate(-45 414.8991764772539 332)" y="332" opacity="1"><tspan>2017-07-09</tspan></text><text x="459.64111196112486" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:400px;text-overflow:ellipsis;" text-anchor="end" transform="translate(0,0) rotate(-45 459.64111196112486 332)" y="332" opacity="1"><tspan>2017-07-10</tspan></text><text x="504.3830474449959" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:400px;text-overflow:ellipsis;" text-anchor="end" transform="translate(0,0) rotate(-45 504.3830474449959 332)" y="332" opacity="1"><tspan>2017-07-11</tspan></text><text x="549.1249829288668" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:400px;text-overflow:ellipsis;" text-anchor="end" transform="translate(0,0) rotate(-45 549.1249829288668 332)" y="332" opacity="1"><tspan>2017-07-12</tspan></text><text x="593.8669184127377" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:400px;text-overflow:ellipsis;" text-anchor="end" transform="translate(0,0) rotate(-45 593.8669184127377 332)" y="332" opacity="1"><tspan>2017-07-13</tspan></text><text x="638.6088538966087" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:400px;text-overflow:ellipsis;" text-anchor="end" transform="translate(0,0) rotate(-45 638.6088538966087 332)" y="332" opacity="1"><tspan>2017-07-14</tspan></text><text x="683.3507893804797" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:400px;text-overflow:ellipsis;" text-anchor="end" transform="translate(0,0) rotate(-45 683.3507893804797 332)" y="332" opacity="1"><tspan>2017-07-15</tspan></text><text x="728.0927248643507" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:400px;text-overflow:ellipsis;" text-anchor="end" transform="translate(0,0) rotate(-45 728.0927248643507 332)" y="332" opacity="1"><tspan>2017-07-16</tspan></text><text x="772.8346603482216" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:400px;text-overflow:ellipsis;" text-anchor="end" transform="translate(0,0) rotate(-45 772.8346603482216 332)" y="332" opacity="1"><tspan>2017-07-17</tspan></text><text x="817.5765958320926" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:400px;text-overflow:ellipsis;" text-anchor="end" transform="translate(0,0) rotate(-45 817.5765958320926 332)" y="332" opacity="1"><tspan>2017-07-18</tspan></text><text x="862.3185313159636" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:400px;text-overflow:ellipsis;" text-anchor="end" transform="translate(0,0) rotate(-45 862.3185313159636 332)" y="332" opacity="1"><tspan>2017-07-19</tspan></text><text x="907.0604667998346" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:400px;text-overflow:ellipsis;" text-anchor="end" transform="translate(0,0) rotate(-45 907.0604667998346 332)" y="332" opacity="1"><tspan>2017-07-20</tspan></text><text x="951.8024022837055" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:400px;text-overflow:ellipsis;" text-anchor="end" transform="translate(0,0) rotate(-45 951.8024022837055 332)" y="332" opacity="1"><tspan>2017-07-21</tspan></text><text x="996.5443377675765" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:400px;text-overflow:ellipsis;" text-anchor="end" transform="translate(0,0) rotate(-45 996.5443377675765 332)" y="332" opacity="1"><tspan>2017-07-22</tspan></text><text x="1041.2862732514475" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:400px;text-overflow:ellipsis;" text-anchor="end" transform="translate(0,0) rotate(-45 1041.2862732514475 332)" y="332" opacity="1"><tspan>2017-07-23</tspan></text><text x="1086.0282087353185" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:400px;text-overflow:ellipsis;" text-anchor="end" transform="translate(0,0) rotate(-45 1086.0282087353185 332)" y="332" opacity="1"><tspan>2017-07-24</tspan></text><text x="1130.7701442191894" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:400px;text-overflow:ellipsis;" text-anchor="end" transform="translate(0,0) rotate(-45 1130.7701442191894 332)" y="332" opacity="1"><tspan>2017-07-25</tspan></text><text x="1175.5120797030604" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:400px;text-overflow:ellipsis;" text-anchor="end" transform="translate(0,0) rotate(-45 1175.5120797030604 332)" y="332" opacity="1"><tspan>2017-07-26</tspan></text><text x="1220.2540151869314" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:400px;text-overflow:ellipsis;" text-anchor="end" transform="translate(0,0) rotate(-45 1220.2540151869314 332)" y="332" opacity="1"><tspan>2017-07-27</tspan></text><text x="1264.9959506708024" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:400px;text-overflow:ellipsis;" text-anchor="end" transform="translate(0,0) rotate(-45 1264.9959506708024 332)" y="332" opacity="1"><tspan>2017-07-28</tspan></text><text x="1309.7378861546733" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:400px;text-overflow:ellipsis;" text-anchor="end" transform="translate(0,0) rotate(-45 1309.7378861546733 332)" y="332" opacity="1"><tspan>2017-07-29</tspan></text><text x="1354.4798216385443" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:400px;text-overflow:ellipsis;" text-anchor="end" transform="translate(0,0) rotate(-45 1354.4798216385443 332)" y="332" opacity="1"><tspan>2017-07-30</tspan></text><text x="1399.2217571224153" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:400px;text-overflow:ellipsis;" text-anchor="end" transform="translate(0,0) rotate(-45 1399.2217571224153 332)" y="332" opacity="1"><tspan>2017-07-31</tspan></text></g><g class="highcharts-axis-labels highcharts-yaxis-labels" zIndex="7"><text x="17" style="color:#606060;cursor:default;font-size:11px;fill:#606060;width:462px;text-overflow:clip;" text-anchor="end" transform="translate(0,0)" y="187" opacity="1">0</text></g><g class="highcharts-tooltip" zIndex="8" style="cursor:default;padding:0;pointer-events:none;white-space:nowrap;" transform="translate(0,-9999)"><path fill="none" d="M 3.5 0.5 L 13.5 0.5 C 16.5 0.5 16.5 0.5 16.5 3.5 L 16.5 13.5 C 16.5 16.5 16.5 16.5 13.5 16.5 L 3.5 16.5 C 0.5 16.5 0.5 16.5 0.5 13.5 L 0.5 3.5 C 0.5 0.5 0.5 0.5 3.5 0.5" isShadow="true" stroke="black" stroke-opacity="0.049999999999999996" stroke-width="5" transform="translate(1, 1)"></path><path fill="none" d="M 3.5 0.5 L 13.5 0.5 C 16.5 0.5 16.5 0.5 16.5 3.5 L 16.5 13.5 C 16.5 16.5 16.5 16.5 13.5 16.5 L 3.5 16.5 C 0.5 16.5 0.5 16.5 0.5 13.5 L 0.5 3.5 C 0.5 0.5 0.5 0.5 3.5 0.5" isShadow="true" stroke="black" stroke-opacity="0.09999999999999999" stroke-width="3" transform="translate(1, 1)"></path><path fill="none" d="M 3.5 0.5 L 13.5 0.5 C 16.5 0.5 16.5 0.5 16.5 3.5 L 16.5 13.5 C 16.5 16.5 16.5 16.5 13.5 16.5 L 3.5 16.5 C 0.5 16.5 0.5 16.5 0.5 13.5 L 0.5 3.5 C 0.5 0.5 0.5 0.5 3.5 0.5" isShadow="true" stroke="black" stroke-opacity="0.15" stroke-width="1" transform="translate(1, 1)"></path><path fill="rgba(249, 249, 249, .85)" d="M 3.5 0.5 L 13.5 0.5 C 16.5 0.5 16.5 0.5 16.5 3.5 L 16.5 13.5 C 16.5 16.5 16.5 16.5 13.5 16.5 L 3.5 16.5 C 0.5 16.5 0.5 16.5 0.5 13.5 L 0.5 3.5 C 0.5 0.5 0.5 0.5 3.5 0.5"></path><text x="8" zIndex="1" style="font-size:12px;color:#333333;fill:#333333;" y="20"></text></g></svg><span style="position: absolute; font-family: &quot;Lucida Grande&quot;,&quot;Lucida Sans Unicode&quot;,Arial,Helvetica,sans-serif; font-size: 18px; white-space: nowrap; color: rgb(51, 51, 51); margin-left: 0px; margin-top: 0px; left: 558.5px; top: 7px;" class="highcharts-title" zindex="4" transform="translate(0,0)"><a href="javascript:void(0);" onclick="preData()">上一月</a> | 2017-07月签到统计 | <a href="javascript:void(0);" onclick="nextData()">下一月</a> </span></div></div>
    </div>

    <div id="calendar" class="fc fc-ltr"><table class="fc-header" style="width:100%"><tbody><tr><td class="fc-header-left"><span class="fc-button fc-button-prev fc-state-default fc-corner-left" unselectable="on" style="-moz-user-select: none;"><span class="fc-text-arrow">‹</span></span><span class="fc-button fc-button-next fc-state-default fc-corner-right" unselectable="on" style="-moz-user-select: none;"><span class="fc-text-arrow">›</span></span><span class="fc-header-space"></span><span class="fc-button fc-button-today fc-state-default fc-corner-left fc-corner-right fc-state-disabled" unselectable="on" style="-moz-user-select: none;">今天</span></td><td class="fc-header-center"><span class="fc-header-title"><h2>2017年07月10日—2017年07月16日 <b>【点击红色/蓝色方框可查看班级签到】</b></h2></span></td><td class="fc-header-right"><span class="fc-button fc-button-month fc-state-default fc-corner-left" unselectable="on" style="-moz-user-select: none;">月</span><span class="fc-button fc-button-agendaWeek fc-state-default fc-state-active" unselectable="on" style="-moz-user-select: none;">周</span><span class="fc-button fc-button-agendaDay fc-state-default fc-corner-right" unselectable="on" style="-moz-user-select: none;">日</span><span class="fc-button fc-state-default fc-corner-left" unselectable="on" style="-moz-user-select: none;" onclick="calendarFullScreen()">全屏</span><span class="fc-button fc-state-default fc-corner-left" unselectable="on" style="-moz-user-select: none;" onclick="setEventSettting()">设置</span></td></tr></tbody></table><div class="fc-content" style="position: relative; min-height: 1px;"><div class="fc-view fc-view-agendaWeek fc-agenda" style="position: relative; -moz-user-select: none;" unselectable="on"><table style="width:100%" class="fc-agenda-days fc-border-separate" cellspacing="0"><thead><tr class="fc-first fc-last"><th class="fc-agenda-axis fc-widget-header fc-first" style="width: 40px;">&nbsp;</th><th class="fc-mon fc-col0 fc-widget-header" style="width: 168px;">一 7/10</th><th class="fc-tue fc-col1 fc-widget-header" style="width: 167px;">二 7/11</th><th class="fc-wed fc-col2 fc-widget-header" style="width: 167px;">三 7/12</th><th class="fc-thu fc-col3 fc-widget-header" style="width: 167px;">四 7/13</th><th class="fc-fri fc-col4 fc-widget-header" style="width: 167px;">五 7/14</th><th class="fc-sat fc-col5 fc-widget-header" style="width: 167px;">六 7/15</th><th class="fc-sun fc-col6 fc-widget-header fc-last">日 7/16</th><th class="fc-agenda-gutter fc-widget-header fc-last" style="display: none;">&nbsp;</th></tr></thead><tbody><tr class="fc-first fc-last"><th class="fc-agenda-axis fc-widget-header fc-first">&nbsp;</th><td class="fc-mon fc-col0 fc-widget-content"><div style="height: 1007px;"><div class="fc-day-content"><div style="position:relative">&nbsp;</div></div></div></td><td class="fc-tue fc-col1 fc-widget-content"><div><div class="fc-day-content"><div style="position:relative">&nbsp;</div></div></div></td><td class="fc-wed fc-col2 fc-widget-content"><div><div class="fc-day-content"><div style="position:relative">&nbsp;</div></div></div></td><td class="fc-thu fc-col3 fc-widget-content"><div><div class="fc-day-content"><div style="position:relative">&nbsp;</div></div></div></td><td class="fc-fri fc-col4 fc-widget-content"><div><div class="fc-day-content"><div style="position:relative">&nbsp;</div></div></div></td><td class="fc-sat fc-col5 fc-widget-content"><div><div class="fc-day-content"><div style="position:relative">&nbsp;</div></div></div></td><td class="fc-sun fc-col6 fc-widget-content fc-state-highlight fc-today fc-last"><div><div class="fc-day-content"><div style="position:relative">&nbsp;</div></div></div></td><td class="fc-agenda-gutter fc-widget-content fc-last" style="display: none;">&nbsp;</td></tr></tbody></table><div style="position: absolute; z-index: 2; left: 0px; width: 100%; top: 19.15px;"><div class="heightdiv" style="position: absolute; width: 100%; overflow-x: hidden; overflow-y: auto; height: 1007px;"><div style="position:relative;width:100%;overflow:hidden"><div style="position:absolute;z-index:8;top:0;left:0"></div><table class="fc-agenda-slots" style="width:100%" cellspacing="0"><tbody><tr class="fc-slot0 "><th class="fc-agenda-axis fc-widget-header" style="width: 40px;">0:00</th><td class="fc-widget-content"><div style="position:relative">&nbsp;</div></td></tr><tr class="fc-slot1 fc-minor"><th class="fc-agenda-axis fc-widget-header">&nbsp;</th><td class="fc-widget-content"><div style="position:relative">&nbsp;</div></td></tr><tr class="fc-slot2 "><th class="fc-agenda-axis fc-widget-header">1:00</th><td class="fc-widget-content"><div style="position:relative">&nbsp;</div></td></tr><tr class="fc-slot3 fc-minor"><th class="fc-agenda-axis fc-widget-header">&nbsp;</th><td class="fc-widget-content"><div style="position:relative">&nbsp;</div></td></tr><tr class="fc-slot4 "><th class="fc-agenda-axis fc-widget-header">2:00</th><td class="fc-widget-content"><div style="position:relative">&nbsp;</div></td></tr><tr class="fc-slot5 fc-minor"><th class="fc-agenda-axis fc-widget-header">&nbsp;</th><td class="fc-widget-content"><div style="position:relative">&nbsp;</div></td></tr><tr class="fc-slot6 "><th class="fc-agenda-axis fc-widget-header">3:00</th><td class="fc-widget-content"><div style="position:relative">&nbsp;</div></td></tr><tr class="fc-slot7 fc-minor"><th class="fc-agenda-axis fc-widget-header">&nbsp;</th><td class="fc-widget-content"><div style="position:relative">&nbsp;</div></td></tr><tr class="fc-slot8 "><th class="fc-agenda-axis fc-widget-header">4:00</th><td class="fc-widget-content"><div style="position:relative">&nbsp;</div></td></tr><tr class="fc-slot9 fc-minor"><th class="fc-agenda-axis fc-widget-header">&nbsp;</th><td class="fc-widget-content"><div style="position:relative">&nbsp;</div></td></tr><tr class="fc-slot10 "><th class="fc-agenda-axis fc-widget-header">5:00</th><td class="fc-widget-content"><div style="position:relative">&nbsp;</div></td></tr><tr class="fc-slot11 fc-minor"><th class="fc-agenda-axis fc-widget-header">&nbsp;</th><td class="fc-widget-content"><div style="position:relative">&nbsp;</div></td></tr><tr class="fc-slot12 "><th class="fc-agenda-axis fc-widget-header">6:00</th><td class="fc-widget-content"><div style="position:relative">&nbsp;</div></td></tr><tr class="fc-slot13 fc-minor"><th class="fc-agenda-axis fc-widget-header">&nbsp;</th><td class="fc-widget-content"><div style="position:relative">&nbsp;</div></td></tr><tr class="fc-slot14 "><th class="fc-agenda-axis fc-widget-header">7:00</th><td class="fc-widget-content"><div style="position:relative">&nbsp;</div></td></tr><tr class="fc-slot15 fc-minor"><th class="fc-agenda-axis fc-widget-header">&nbsp;</th><td class="fc-widget-content"><div style="position:relative">&nbsp;</div></td></tr><tr class="fc-slot16 "><th class="fc-agenda-axis fc-widget-header">8:00</th><td class="fc-widget-content"><div style="position:relative">&nbsp;</div></td></tr><tr class="fc-slot17 fc-minor"><th class="fc-agenda-axis fc-widget-header">&nbsp;</th><td class="fc-widget-content"><div style="position:relative">&nbsp;</div></td></tr><tr class="fc-slot18 "><th class="fc-agenda-axis fc-widget-header">9:00</th><td class="fc-widget-content"><div style="position:relative">&nbsp;</div></td></tr><tr class="fc-slot19 fc-minor"><th class="fc-agenda-axis fc-widget-header">&nbsp;</th><td class="fc-widget-content"><div style="position:relative">&nbsp;</div></td></tr><tr class="fc-slot20 "><th class="fc-agenda-axis fc-widget-header">10:00</th><td class="fc-widget-content"><div style="position:relative">&nbsp;</div></td></tr><tr class="fc-slot21 fc-minor"><th class="fc-agenda-axis fc-widget-header">&nbsp;</th><td class="fc-widget-content"><div style="position:relative">&nbsp;</div></td></tr><tr class="fc-slot22 "><th class="fc-agenda-axis fc-widget-header">11:00</th><td class="fc-widget-content"><div style="position:relative">&nbsp;</div></td></tr><tr class="fc-slot23 fc-minor"><th class="fc-agenda-axis fc-widget-header">&nbsp;</th><td class="fc-widget-content"><div style="position:relative">&nbsp;</div></td></tr><tr class="fc-slot24 "><th class="fc-agenda-axis fc-widget-header">12:00</th><td class="fc-widget-content"><div style="position:relative">&nbsp;</div></td></tr><tr class="fc-slot25 fc-minor"><th class="fc-agenda-axis fc-widget-header">&nbsp;</th><td class="fc-widget-content"><div style="position:relative">&nbsp;</div></td></tr><tr class="fc-slot26 "><th class="fc-agenda-axis fc-widget-header">13:00</th><td class="fc-widget-content"><div style="position:relative">&nbsp;</div></td></tr><tr class="fc-slot27 fc-minor"><th class="fc-agenda-axis fc-widget-header">&nbsp;</th><td class="fc-widget-content"><div style="position:relative">&nbsp;</div></td></tr><tr class="fc-slot28 "><th class="fc-agenda-axis fc-widget-header">14:00</th><td class="fc-widget-content"><div style="position:relative">&nbsp;</div></td></tr><tr class="fc-slot29 fc-minor"><th class="fc-agenda-axis fc-widget-header">&nbsp;</th><td class="fc-widget-content"><div style="position:relative">&nbsp;</div></td></tr><tr class="fc-slot30 "><th class="fc-agenda-axis fc-widget-header">15:00</th><td class="fc-widget-content"><div style="position:relative">&nbsp;</div></td></tr><tr class="fc-slot31 fc-minor"><th class="fc-agenda-axis fc-widget-header">&nbsp;</th><td class="fc-widget-content"><div style="position:relative">&nbsp;</div></td></tr><tr class="fc-slot32 "><th class="fc-agenda-axis fc-widget-header">16:00</th><td class="fc-widget-content"><div style="position:relative">&nbsp;</div></td></tr><tr class="fc-slot33 fc-minor"><th class="fc-agenda-axis fc-widget-header">&nbsp;</th><td class="fc-widget-content"><div style="position:relative">&nbsp;</div></td></tr><tr class="fc-slot34 "><th class="fc-agenda-axis fc-widget-header">17:00</th><td class="fc-widget-content"><div style="position:relative">&nbsp;</div></td></tr><tr class="fc-slot35 fc-minor"><th class="fc-agenda-axis fc-widget-header">&nbsp;</th><td class="fc-widget-content"><div style="position:relative">&nbsp;</div></td></tr><tr class="fc-slot36 "><th class="fc-agenda-axis fc-widget-header">18:00</th><td class="fc-widget-content"><div style="position:relative">&nbsp;</div></td></tr><tr class="fc-slot37 fc-minor"><th class="fc-agenda-axis fc-widget-header">&nbsp;</th><td class="fc-widget-content"><div style="position:relative">&nbsp;</div></td></tr><tr class="fc-slot38 "><th class="fc-agenda-axis fc-widget-header">19:00</th><td class="fc-widget-content"><div style="position:relative">&nbsp;</div></td></tr><tr class="fc-slot39 fc-minor"><th class="fc-agenda-axis fc-widget-header">&nbsp;</th><td class="fc-widget-content"><div style="position:relative">&nbsp;</div></td></tr><tr class="fc-slot40 "><th class="fc-agenda-axis fc-widget-header">20:00</th><td class="fc-widget-content"><div style="position:relative">&nbsp;</div></td></tr><tr class="fc-slot41 fc-minor"><th class="fc-agenda-axis fc-widget-header">&nbsp;</th><td class="fc-widget-content"><div style="position:relative">&nbsp;</div></td></tr><tr class="fc-slot42 "><th class="fc-agenda-axis fc-widget-header">21:00</th><td class="fc-widget-content"><div style="position:relative">&nbsp;</div></td></tr><tr class="fc-slot43 fc-minor"><th class="fc-agenda-axis fc-widget-header">&nbsp;</th><td class="fc-widget-content"><div style="position:relative">&nbsp;</div></td></tr><tr class="fc-slot44 "><th class="fc-agenda-axis fc-widget-header">22:00</th><td class="fc-widget-content"><div style="position:relative">&nbsp;</div></td></tr><tr class="fc-slot45 fc-minor"><th class="fc-agenda-axis fc-widget-header">&nbsp;</th><td class="fc-widget-content"><div style="position:relative">&nbsp;</div></td></tr><tr class="fc-slot46 "><th class="fc-agenda-axis fc-widget-header">23:00</th><td class="fc-widget-content"><div style="position:relative">&nbsp;</div></td></tr><tr class="fc-slot47 fc-minor"><th class="fc-agenda-axis fc-widget-header">&nbsp;</th><td class="fc-widget-content"><div style="position:relative">&nbsp;</div></td></tr></tbody></table></div></div></div></div></div></div>
    
    <div id="setModel" style="display: none">
        <div class="hostedSignSetting">
            <p>
                时间区间：
                <select id="minTime" class="select" style="width:121px;">
                    <option value="0" selected="selected">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option>                </select>-
                <select id="maxTime" class="select" style="width:121px;">
                    <option value="0" selected="selected">0</option><option value="1">1</option><option value="2">2</option><option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option><option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option><option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option><option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option><option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option><option value="23">23</option><option value="24">24</option>                </select>
            </p>
            <p>
                事件标题：
                <input id="eventTitle" class="input_mid" value="{老师}（{班级}）" maxlength="20" type="text"> <a href="javascript:void(0);" onclick="$(this).parent().find('#eventTitle').val('')" style="margin-left: 5px;">清空</a>
            </p>
            <p>
                可用变量：
                <span class="button btn_gray btn_tab" id="btn_store">门店</span>
                <span class="button btn_gray btn_tab" id="btn_course">课程</span>
                <span class="button btn_gray btn_tab" id="btn_class">班级</span>
                <span class="button btn_gray btn_tab" id="btn_room">教室</span>
                <span class="button btn_gray btn_tab" id="btn_teacher">老师</span>
            </p>
            <br>
            <p align="center"><input class="button btn_orange" onclick="setEventSettting(1)" value="保存设置" type="button"></p>
        </div>
    </div>

    <div class="pos">联系我们</div>
    <div class="form">
        <div style="font-size:12px;" class="content">
            广州骏睿信息科技有限公司<br>
           	联系地址：广州市大学城外环东路232路13栋国家数字家庭基地东区A栋 <br>
            联系电话：020-31063125 <br>
            讨论Q群：91250437 <br>
            论坛支持：<a href="http://bangkebbs.dsmake.com/" target="_blank">点击进入</a>
        </div>
	</div>
</div>


<script type="text/javascript" src="index_files/jquery_002.js"></script>
<script src="index_files/fullcalendar.js"></script> 
<script src="index_files/jquery_005.js"></script>
<script src="index_files/highcharts.js"></script>



<script type="text/javascript">
    var SignChart;
    $(function() {
        calendarInit();
        
        $('#sign_input').typeahead({
            menu: '<ul class="typeahead dropdown-menu" 
id="typeahead_stuList" role="listbox"></ul>',
            items: 5, //最多显示个数
            disableEnter:true,
            source: function (query, process, self) {
                if(!$("#searchModel").is(":checked")){
                    self.hide();
                    return false;
                }
                $.ajax({
                    type:"POST", //表单提交类型
                    url:"/bangke/Manage/CheckStand/searchStudent", 
//表单提交目标
                    data:{s_id:'',key:query}, //表单数据
                    success:function(data){
                        students = [];
                        map = {};
                        var studentList = data.data.studentList;
                        if(data.data.studentList==null){
                            self.hide();
                            return false;
                        }
                        $.each(studentList, function (i, student) {
                                map[student.stu_id] = student;
                                students.push(student.stu_id);
                        });
                        process(students);
                    }
                });
            },
            matcher: function (item) {
                return item;
            },
            highlighter: function (item) {
               return 
"学
生："+map[item].stu_name+"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
手
机："+map[item].stu_mobile+"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
编号："+item;
            },
            afterSelect:function(){
                stu_sign();
            }
        });

    });

    function calendarInit(){
        $('#calendar').fullCalendar('destroy');
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            firstDay:1,
            editable: false,
            timeFormat: 'H:mm',
            axisFormat: 'H:mm',
            titleFormat: {
                month:"yyyy年MMMM月 <b>【点击红色/蓝色方框可查看班级签到】</b>",
                week: "yyyy年MMMM月d日{'&#8212;'yyyy年MMMM月d日} 
<b>【点击红色/蓝色方框可查看班级签到】</b>",
                day: "yyyy年MMMM月d日 dddd <b>【点击红色/蓝色方框可查看班级签到】</b>"
            },
            // slotMinutes:30,
            firstHour: 8,
            minTime:getEventSettting('minTime'),
            maxTime:getEventSettting('maxTime'),
            defaultView:'agendaWeek',
            height:1100,
            allDaySlot:false,

            events:function(start,end,callback){
                var start 
=$.fullCalendar.formatDate(start,'yyyy-MM-dd'); 
                var end =$.fullCalendar.formatDate(end,'yyyy-MM-dd'); 
                $.ajax({
                    type:"get",
                    url:"/bangke/Manage/Booking/book_list_json",
                    dataType:"json",
                    data:{start:start,end:end},
                    success:function(data){
                        if(data==null){
                            return false;
                        }
                        var event = [];
                        $.each(data,function(i){
                            event.push({
                                id:data[i].id,
                                c_name:data[i].c_name,
                                teacher_name:data[i].teacher_name,
                                teacher_iphone:data[i].teacher_iphone,
                                s_name:data[i].s_name,
                                br_name:data[i].br_name,
                                classroom:data[i].classroom,
                                stu_name:data[i].stu_name,
                                stu_mobile:data[i].stu_mobile,

                                
title:getEventSettting('eventTitle',data[i]),
                                start:data[i].start,
                                end:data[i].end,
                                tips:data[i].tips,
                                color:data[i].color,
                                url:data[i].url,
                                allDay:false, //是否为全天事件

                            });
                        });
                        callback(event);
                    }
                });
            },

            eventRender: function(event, element) {
                var html='<div 
style="line-height:25px;"><p><b>门店</b>:<br/>'+event.s_name+'</p><p><b>班级
</b>:<br/>'+event.br_name+'</p><p><b>教室</b>:<br/>'+event.classroom+'</p>
<p><b>老师</b>:<br/>'+event.teacher_name+'</p><p><b>电话</b>:<br
/>'+event.teacher_iphone+'</p><p><b>课程</b>:<br/>'+event.c_name+'</p>';
                if(event.stu_name){
                    html+='<p><b>学员</b>:<br/>'+event.stu_name+'</p>';
                    html+='<p><b>电话</b>:<br/>'+event.stu_mobile+'</p>';
                }
                html+='<p><b>状态</b>:<br/>'+event.tips+'</p></div>';
                element.qtip({
                    content: html,
                    position: {
                        corner: {
                            target: 'leftTop',
                            tooltip: 'rightBottom'
                        }
                    },
                    show: {solo: true},
                    hide: {
                        delay: 800
                    },
                    style: {
                        border:{
                            radius: 2,
                            width: 1
                        },
                        padding: '5px 15px', // Give it some extra 
padding
                        tip: true,
                        name: 'cream' // And style it with the preset 
dark theme
                    }
                });
            }
        });

        (function(){
            var html='<span class="fc-button fc-state-default 
fc-corner-left" unselectable="on" style="-moz-user-select: none;" 
onclick="calendarFullScreen()">全屏</span><span class="fc-button 
fc-state-default fc-corner-left" unselectable="on" 
style="-moz-user-select: none;" onclick="setEventSettting()">设置</span>';
            $('.fc-header-right').append(html);
        }());
    }

    function calendarFullScreen(){
        if($('.tbox_calendar:visible').length>0){
            TINY.box.hide();
        }else{
            showTBox("TitleClose","","100vw,100vh",'<div 
id="calendarContainer" style="padding:10px"></div>',function(){
                $('#calendarContainer').fullCalendar({
                    header: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'month,agendaWeek,agendaDay'
                    },
                    firstDay:1,
                    editable: false,
                    timeFormat: 'H:mm',
                    axisFormat: 'H:mm',
                    titleFormat: {
                        month:"yyyy年MMMM月 <b>【点击红色/蓝色方框可查看班级签到】</b>",
                        week: "yyyy年MMMM月d日{'&#8212;'yyyy年MMMM月d日} 
<b>【点击红色/蓝色方框可查看班级签到】</b>",
                        day: "yyyy年MMMM月d日 dddd 
<b>【点击红色/蓝色方框可查看班级签到】</b>"
                    },
                    // slotMinutes:30,
                    firstHour: 8,
                    minTime:getEventSettting('minTime'),
                    maxTime:getEventSettting('maxTime'),
                    defaultView:'agendaWeek',
                    height:1100,
                    allDaySlot:false,
                    

                    events:function(start,end,callback){
                        var start 
=$.fullCalendar.formatDate(start,'yyyy-MM-dd'); 
                        var end 
=$.fullCalendar.formatDate(end,'yyyy-MM-dd'); 
                        $.ajax({
                            type:"get",
                            url:"/bangke/Manage/Booking/book_list_json",
                            dataType:"json",
                            data:{start:start,end:end},
                            success:function(data){
                                if(data==null){
                                    return false;
                                }
                                var event = [];
                                $.each(data,function(i){
                                    event.push({
                                        id:data[i].id,
                                        c_name:data[i].c_name,
                                        
teacher_name:data[i].teacher_name,
                                        
teacher_iphone:data[i].teacher_iphone,
                                        s_name:data[i].s_name,
                                        br_name:data[i].br_name,
                                        classroom:data[i].classroom,
                                        stu_name:data[i].stu_name,
                                        stu_mobile:data[i].stu_mobile,

                                        
title:getEventSettting('eventTitle',data[i]),
                                        start:data[i].start,
                                        end:data[i].end,
                                        tips:data[i].tips,
                                        color:data[i].color,
                                        url:data[i].url,
                                        allDay:false, //是否为全天事件

                                    });
                                });
                                callback(event);
                            }
                        });
                    },

                    eventRender: function(event, element) {
                        var html='<div 
style="line-height:25px;"><p><b>门店</b>:<br/>'+event.s_name+'</p><p><b>班级
</b>:<br/>'+event.br_name+'</p><p><b>教室</b>:<br/>'+event.classroom+'</p>
<p><b>老师</b>:<br/>'+event.teacher_name+'</p><p><b>电话</b>:<br
/>'+event.teacher_iphone+'</p><p><b>课程</b>:<br/>'+event.c_name+'</p>';
                        if(event.stu_name){
                            
html+='<p><b>学员</b>:<br/>'+event.stu_name+'【'+event.stu_mobile+'】</p>';
                        }
                        
html+='<p><b>状态</b>:<br/>'+event.tips+'</p></div>';
                        element.qtip({
                            content: html,
                            position: {
                                corner: {
                                    target: 'leftTop',
                                    tooltip: 'rightBottom'
                                }
                            },
                            show: {solo: true},
                            hide: {
                                delay: 800
                            },
                            style: {
                                border:{
                                    radius: 2,
                                    width: 1
                                },
                                padding: '5px 15px', // Give it some 
extra padding
                                tip: true,
                                name: 'cream' // And style it with the 
preset dark theme
                            }
                        });
                    }
                });
                var html='<span class="fc-button fc-state-default 
fc-corner-left" unselectable="on" style="-moz-user-select: none;" 
onclick="calendarFullScreen()">退出全屏</span>';
                $('#calendarContainer .fc-header-right').append(html);
            },"","",{maskclose:0,close:0,class:"tbox_unlimit 
tbox_calendar",top:0,left:0});
        }
    }

    function setEventSettting(type){
        if(type){
            var v=$(".tbox #eventTitle").val();
            var min=$('.tbox #minTime').val();
            var max=$('.tbox #maxTime').val();
            if(parseInt(max)<=parseInt(min)){
                alertInfo('结束时间必须大于开始时间');
                return false;
            }
            storageObjOperator("CalendarSetting","eventTitle",v);
            storageObjOperator("CalendarSetting","minTime",min);
            storageObjOperator("CalendarSetting","maxTime",max);
            TINY.box.hide();
            calendarInit();
        }else{
            //同步设置
            var setting=storageObjOperator("CalendarSetting");
            if(!setting){
                alertInfo("该浏览器不支持本地存储");
                return false;
            }
            $('#setModel 
#eventTitle').val(setting.eventTitle||"{老师}（{班级}）");
            $('#setModel #minTime').val(setting.minTime||"6");
            $('#setModel #maxTime').val(setting.maxTime||"24");
            var html=$('#setModel').html();
            showTBox("课表设置","","400px",html,function(){
                $('.tbox 
#eventTitle').val(setting.eventTitle||"{老师}（{班级}）");
                $('.tbox #minTime').val(setting.minTime||"6");
                $('.tbox #maxTime').val(setting.maxTime||"24");

                $('.tbox .btn_tab').css("padding","1px 10px");
                $('.tbox .btn_tab').on('click',function(){
                    var v=$(".tbox #eventTitle").val();
                    var d=$(this).text();
                    var vl=v+"{"+d+"}";
                    if(vl.length>20){
                        alertInfo("太长了哦");
                        return false;
                    }
                    $(".tbox #eventTitle").val(vl);
                });
            });
        }
    }

    function getEventSettting(type,args){
        var setting=storageObjOperator("CalendarSetting");
        if(type=='eventTitle'){
            var title=setting[type]||"{老师}（{班级}）";
            return 
title.replace("{门店}",args.s_name||'').replace("{课
程}",args.c_name||'').replace("{班级}",args.br_name||'').replace("{教
室}",args.classroom||'').replace("{老师}",args.teacher_name||'');
        }else{
            return setting[type];
        }
    }

    var enjoyhint_instance;
    //新手教程
    function tutorial(){
        enjoyhint_instance = new EnjoyHint({});
        var enjoyhint_script_steps = [
          {
            selector:'.right' ,
            description: '欢迎使用上课签到功能，接下来将介绍本模块的基本操作。',
            showNext:true,
            justIntro:true,
            showSkip:true,
          },
          {
            selector:'.two_part' ,
            description: '上课签到分为两种模式，一种是快速签到，一种是手动签到',
            showNext:true,
            showSkip:true,
            disablecontent:true
          },
          {
            selector:'#signinput' ,
            description: 
'在此处输入学员ID或卡号，点击签到，系统将自动检测该学员今天的课程安排以及其所有的班级，若学员只有一个班级则自动（插课）签到，若有多个班级，则
会弹窗提示选择签到的班级',
            showNext:true,
            showSkip:true,
            disablecontent:true
          },
          {
            selector:'#signinfo' ,
            description: '此处为学员快速签到成功后的签到信息',
            showNext:true,
            showSkip:true,
            disablecontent:true
          },
          {
            selector:'#calendar' ,
            description: 
'此处为手动签到区域，功能更完备，点击日历的相应班级即可查看班级信息以及上课学员并可对其进行签到等操作', 
            showNext:true,
            showSkip:true,
            disablecontent:true,
            bottom:400,
            onBeforeStart:function(){
                $('.right').scrollTop(100);
            }
          },{
            selector:'#signcount' ,
            description: '点击此处可以查看课程签到统计',
            event:'click',
            showSkip:true
          },{
            selector:'#counttype' ,
            description: '在此处可以切换视图',
            showNext:true,
            showSkip:true,
            disablecontent:true
          },{
            selector:'#container' ,
            description: '在该图中点击坐标点即可查询该天/月的签到/缺勤详情',
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
            justIntro:true,
            showNext:true,
            showSkip:true,
          }
          ];
        var steps=enjoyhint_script_steps;
        enjoyhint_instance.set(steps);
        enjoyhint_instance.run();
    }

    function showUnsignClass(){
        showTBox('集体课签到',"/bangke/Manage/Booking/classList",'800px');
    }

    function showClassInfo(url){
        showTBox('班级签到',url,'800px');
    }

    function ajax_submit(url, str){
        if (!getCheckboxNum("")){
            alert('请选择项！');
            return false;
        }
        if (window.confirm(str)){
            var form_do = $("#form_do");
            $.ajax({
                type:form_do.attr('method'), //表单提交类型
                url:url, //表单提交目标
                data:form_do.serialize(), //表单数据
                beforeSend: function(data) {
                    submit_before_info();
                },
                success:function(data){
                    alertInfo(data.info,1000,function(){
                        if (data.status == 1) {
                            reopenClass();
                        }  
                    }); 
                }
            });
        }
    }

    //按回车触发签到
    function entersign(event) { 
        if ((event.keyCode || event.which) == 13) {
            if($("#searchModel").is(":checked")){ //搜索模式下屏蔽enter
                if (window.event) {
                    window.event.returnValue = false;
                }else {
                    event.preventDefault(); //for firefox 
                }
            }else{
                if($("#typeahead_stuList:visible").length==0){
                    $("#stu_sign").click(); 
                } 
            }   
            return false;
        } 
    }

    //手机电脑联动函数
    function stu_idInput(stu_id){
        $('#sign_input').val(stu_id);
        $("#stu_sign").click(); 
    }

    function quickSignResult(data){
        data=$.parseJSON(data)||data;

        $('#stu_name').text('');
        $('#c_name').text('');
        $('#class_name').text('');
        $('#remainNum').text('');
        $('#teacher_name').text('');
        $('#class_time').text('');
        if(data.code == -2){   //学员ID不能为空          
            player('/bangke/Public/Static/mp3/notexist');
            return false;
        }else if(data.code == 3){
            player('/bangke/Public/Static/mp3/hasnoclass');
            return false;
        }else if(data.code == 4){
            player('/bangke/Public/Static/mp3/hasnonum');
            return false;
        }else if(data.code == 5){
            player('/bangke/Public/Static/mp3/signbyhand');
            return false;
        }else if(data.code == 1){
            player('/bangke/Public/Static/mp3/signed');
            $('#stu_name').text(data.stu_name?data.stu_name:'');
            $('#c_name').text(data.c_name?data.c_name:'');
            $('#class_name').text(data.class_name?data.class_name:'');
            $('#remainNum').text(data.remainNum?data.remainNum:0);
            
$('#teacher_name').text(data.teacher_name?data.teacher_name:'');
            $('#classroom').text(data.classroom?data.classroom:'');
            $('#class_time').html(data.class_time?data.class_time:'');
            return false;
        }else if(data.code == 6){
            player('/bangke/Public/Static/mp3/false');
            return false;
        }
    }

    function stu_sign(){
        var stu_id=$.trim($('#sign_input').val());
        var LSModel=$('#leaveSchoolModel').is(":checked")?1:0;
        $.ajax({
                type:'GET', //表单提交类型
                url:"/bangke/Manage/Booking/quick_sign", //表单提交目标
                data:{'stu_id':stu_id,'LSModel':LSModel},
                beforeSend: function(data) {
                    submit_before_info();
                },
                success:function(data,info,status){
                    if(!data.info){
                        clear_info();
                        $('#sign_input').val('');
                        TINY.box.show({
                            html:data,
                            height:200,
                            width:800,
                            fixed:false,
                            maskid:'blackmask',
                            maskopacity:40
                        });
                    }else{
                        getSignRes(data);
                    }
                }
        });
    }

    function click_brSign(url){
        TINY.box.hide();
        $.ajax({
                type:'GET', //表单提交类型
                url:url, //表单提交目标
                beforeSend: function(data) {
                    submit_before_info();
                },
                success:function(data,info,status){
                    getSignRes(data);
                }  
        });
    }

    function signResult(data){
        data=$.parseJSON(data)||data;
        getSignRes(data);
    }

    function getSignRes(data){
        alertInfo(data.info,2000);

        $('#sign_input').val('');
        $('#stu_name').text('');
        $('#c_name').text('');
        $('#class_name').text('');
        $('#remainNum').text('');
        $('#teacher_name').text('');
        $('#class_time').text('');
         if(data.resultdata.returnCode == 1){          
            player('/bangke/Public/Static/mp3/notexist');
            return false;
        }else if(data.resultdata.returnCode == 2){
            player('/bangke/Public/Static/mp3/hasnonum');
            return false;
        }else if(data.resultdata.returnCode == 10){ 
            // player('/bangke/Public/Static/mp3/hasnonum');
            return false;
        }else if(data.resultdata.returnCode == 9){
            player('/bangke/Public/Static/mp3/leaved');
            return false;
        }else if(data.resultdata.returnCode == 5){
            
$('#stu_name').text(data.resultdata.stu_name?data.resultdata.stu_name:'');

            
$('#c_name').text(data.resultdata.c_name?data.resultdata.c_name:'');
            
$('#class_name').text(data.resultdata.br_name?data.resultdata.br_name:'');

            
$('#remainNum').text(data.resultdata.remainNum?data.resultdata.remainNum:0);

            
$('#teacher_name').text(data.resultdata.teacher_name?data.resultdata.teacher_name:'');

            
$('#classroom').text(data.resultdata.classroom?data.resultdata.classroom:'');

            
$('#class_time').text(data.resultdata.br_time?data.resultdata.br_time:'');

            
            if(!isNaN(data.resultdata.timeStamp)){
                var 
args={stu_name:data.resultdata.stu_name,c_name:data.resultdata.c_name};
                
BKGlobal.delayQueue.add(data.resultdata.timeStamp,"showShortMsg('classOver','"+JSON.stringify(args)+"')",1);

            }

            player('/bangke/Public/Static/mp3/signed');
            return false;
        }else if(data.resultdata.returnCode == 6){
            player('/bangke/Public/Static/mp3/false');
            return false;
        }
    }

   $(function(){
        //顶部菜单触发
        $("#month_sign").click(function(){
            $(".chart_option").removeClass("active");
            $(this).addClass("active");
            drawChart("/bangke/Manage/Index/month_sign_json",'月');
        });
        $("#year_sign").click(function(){
            $(".chart_option").removeClass("active");
            $(this).addClass("active");
            drawChart("/bangke/Manage/Index/year_sign_json",'年');
        });
        drawChart("/bangke/Manage/Index/month_sign_json");
        $('#sign_input').focus();
/*        $('#sign_input').blur(function () {
            var that = this; //或者用闭包
            setTimeout(function () {
                $(that).focus();
            },100);
        });*/
    });


   //初始化图标
     var drawChart = function (url,type,title) {
         $.ajax({
            type:'GET', //表单提交类型
            
//url:APP+URLPATHDEPR+GROUP+"/Index/course_month_sales_and_expend_money_list_json",
 //表单提交目标
            url:url, //表单提交目标
            //data:$(this).serialize(), //表单数据
            dataType: "json",
            success:function(data){
                draw(data.value,type);
            }
        });
     }

     function preData(){
        var type=$("span[class='info_title chart_option pointer 
active']").attr('id');
        if(type=='month_sign'){
            
drawChart("/bangke/Manage/Index/month_sign_json/type/0",'月');
        }else{
            drawChart("/bangke/Manage/Index/year_sign_json/type/0",'年');
        }
     }

     function nextData(){
        var type=$("span[class='info_title chart_option pointer 
active']").attr('id');
        if(type=='month_sign'){
            
drawChart("/bangke/Manage/Index/month_sign_json/type/1",'月');
        }else{
            drawChart("/bangke/Manage/Index/year_sign_json/type/1",'年');
        }
     }
        
    
    //绘图方法
    var draw = function (chartOptions,type) {
        if(!type){
            type='月';
        }
        var Title="<a href='javascript:void(0);' 
onclick='preData()'>上一"+type+"</a> | "+chartOptions.titleDate+type+"签到统计
 | <a href='javascript:void(0);' onclick='nextData()'>下一"+type+"</a> ";
        
        SignChart = new Highcharts.Chart({
             plotOptions: {
                series: {
                    cursor: 'pointer',
                    events: {
                        click: function(e) {
                            // alert(e.point.category);
                            console.log(e.point);
                           
                            
showdetails({'category':e.point.category,'series':e.point.series._i});
                        }
                    }
                }
            },
            chart: {
                renderTo: 'container',
                type: 'line'
            },
            colors: ['#FB803B','#6FA7CE','#60D295'],
            title: {
                margin:15,
                useHTML:true,
                text: Title
            },
            subtitle: {
                text: '',
            },
            xAxis: {
                categories: chartOptions.xAxis
            },
            yAxis: {
                title: {
                    text: ''
                },
                min: 0,
                plotLines: [{
                    value: 0,
                    width: 1,
                    color: '#808080'
                }]
            },
            tooltip: {
                shared:false,
                pointFormatter:function(){
                    return '<span><br/><span 
style="color:'+this.series.color+'">\u25CF</span>'+
                    this.series.name+': <b>'+this.y+'</b><br/><br 
/>点击查看列表</span>';
                }
            },
            legend: {
                layout: 'horizontal',
                align: 'right',
                verticalAlign: 'top',
                //enabled:false
            },      

            credits:{
                enabled:false // 禁用版权信息
            },
            series: chartOptions.series
        });
    }

    function click_show(obj){
        $('#signStatic').toggle(0,function(){
            
$(obj).val(obj.value=='签到统计与上课通知∨'?'签到统计与上课通知∧':'签到统计与上课通知∨');
        });
        SignChart.reflow();
    }

    function showUnsignList(){
        var url="/bangke/Manage/Index/signList";
        var data={'stype':'all','sdate':'111','signtype':0};
        url=url+'?'+dataToUrl(data).substr(1);

        showTBox('未签到列表',url,'800px');
    }

    function showOrNot(obj){
        //全选/取消
        if($(obj).attr("checked")=="checked"){
            setCheckbox(true,"");
        }else{
            setCheckbox(false,"");
        }
    }

    function sendAll(){
        var data=getTboxCheckboxNum();
        var type=$('input[name="type"]:checked').val();
        $.ajax({
                type:'GET', 
                url:"/bangke/Manage/Booking/sendAllStudent", 
                data:{'data':JSON.stringify(data),'type':type}, 
                beforeSend: function(data) {
                    submit_before_info();
                },
                success:function(data){
                    submit_back_info(data);
                }
        });
    }

    //获取Checkbox被选择个数
    function getTboxCheckboxNum(){
        var data=[];
        $('input[name="key[]"]:checked').each(function(){    
           data.push($(this).val());    
        });    
        return data;
    }

    function showdetails(obj){
        var type=$("span[class='info_title chart_option pointer 
active']").attr('id');

        var sdate=obj.category;

        if(type=='month_sign'){
            var stype='day';
        }else{
            var stype='month';
        }

        var url="/bangke/Manage/Index/signList";
        var signtype=(obj.series==0)?1:0;//1签到  0未签到

        var data={'stype':stype,'sdate':sdate,'signtype':signtype};

        url=url+'?'+dataToUrl(data).substr(1);

        showTBox('查看签到记录',url,'800px');
    } 

    function reopen(){
        reloadTbox();
        $("span[class='info_title chart_option pointer 
active']").trigger('click');
    }

    //取消签到
    function cancelSign(sbid){
        if(confirm("是否取消该学生签到？")){
            $.ajax({
                url: "/bangke/Manage/Booking/cancelSign",
                type: "post",
                data: {sbid:sbid},
                success: function(data){
                    alertInfo(data.info,1000,function(){
                        if (data.status == 1) {
                            reopen();
                        }  
                    });                                                 
          
                }
            });
        }
    }

    //学员签到  
    function stusign(stu_id,c_id,arrange_id,sign_num){
        var 
musicArr=['not_exist','notexist','hasnonum','isinsert','','signed','false','hadsigned','notnow','leaved',''];

        $.ajax({
                url: "/bangke/Manage/Booking/do_sign",
                type: 'post',
                data: {stu_id:stu_id, c_id:c_id, 
arrange_id:arrange_id,sign_num:sign_num},
                success: function(data,info,status){  
                    alertInfo(data.info,1000,function(){
                        if (data.status == 1) {
                            reopen();
                        }  
                    });
                    
musicArr[data.resultdata.returnCode]?player('/bangke/Public/Static/mp3/'+musicArr[data.resultdata.returnCode]):'';
     
                }
        }); 
    }

    function leave(stu_id,arrange_id){
        $.ajax({
            url: "/bangke/Manage/Booking/leave",
            type: "post",
            data: {stu_id:stu_id, arrange_id:arrange_id},
            success: function(data){
                alertInfo(data.info,1000,function(){
                    if (data.status == 1) {
                        reopen();
                    }  
                });
            }
        });
    }

    //撤销请假
    function cancelLeave(stu_id,arrange_id){
        $.ajax({
            url: "/bangke/Manage/Booking/cancelLeave",
            type: "post",
            data: {stu_id:stu_id, arrange_id:arrange_id},
            success: function(data){
                alertInfo(data.info,1000,function(){
                    if (data.status == 1) {
                        reopen();
                    }  
                }); 
            }
        });
    }

    //学生请假
    function truant(id,sign_num){
        $.ajax({
            url: "/bangke/Manage/Booking/truant",
            type: "post",
            data: {id:id,sign_num:sign_num},
            success: function(data){
                alertInfo(data.info,1000,function(){
                    if (data.status == 1) {
                        reopen();
                    }  
                }); 
            }
        });
    }
    
    //撤销请假
    function cancelTruant(id){     
        $.ajax({
            url: "/bangke/Manage/Booking/cancelTruant",
            type: "post",
            data: {sbid:id},
            success: function(data){
                alertInfo(data.info,1000,function(){
                    if (data.status == 1) {
                        reopen();
                    }  
                }); 
            }
        });
    }

    function teasign(b_id){
        $.ajax({
            url: "/bangke/Manage/Booking/teaSign",
            type: "post",
            data: {arrange_id:b_id},
            success: function(data){ 
                alertInfo(data.info,1000,function(){
                    if (data.status == 1) {
                        reopen();
                    }  
                });    
            }
        });
    }

    function cancelAllSign(b_id){
        if(confirm("是否取消该所有已签到学生和上课老师的签到？")){
            $.ajax({
                url: "/bangke/Manage/Booking/cancelAllSign",
                type: "post",
                data: {arrange_id:b_id},
                success: function(data){    
                    alertInfo(data.info,1000,function(){
                        if (data.status == 1) {
                            reopen();
                        }  
                    });
                }
            });
        }
    }

    function showSignNote(){
        var html='<div style="padding:20px;"><div 
style="padding-left:100px;"><label 
for="noteData">上课时间</label>&nbsp;&nbsp;<input type="text" class="input "
 name="noteData" id="noteData" value="2017-07-16" 
onclick="Calendarset(this)"><br/><br/><label>发送短信</label>&nbsp;&nbsp;
<input type="radio" id="typetrue" name="type" value="0"><label 
for="typetrue">是</label><input type="radio" id="typefalse" name="type" 
value="1"  checked="checked"><label for="typefalse">否</label></div><div 
class="foot text-center" style="padding:10px 0px;"><input type="button" 
class="button btn_blue" onclick="confirmNote()" value="确定" /><input 
type="button" class="button btn_blue" style="margin-left:10px" 
onclick="TINY.box.hide();" value="返回" /></div></div>';
        showTBox('批量通知上课','','500px',html);
    }

    function confirmNote(){
        var noteData=$('.tbox #noteData').val();
        var type=$('input[name="type"]:checked').val();
        if(confirm('确定批量通知 '+noteData+' 所有有课的学员吗？')){
            $.ajax({
                url: "/bangke/Manage/Booking/sendAllByDay",
                type: "post",
                data: {'noteData':noteData,'type':type},
                success: function(data){
                    submit_back_info(data);
                }
            });
        }
    }

    function Calendarset(obj){
        Calendar.setup({
            animation:false,
            weekNumbers: true,
            inputField : obj.id,
            trigger    : obj.id,
            dateFormat: "%Y-%m-%d",
            showTime: true,
            minuteStep: 1,
            onSelect   : function() {this.hide();}
        });
        obj.click();
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
<script type="text/javascript" src="index_files/common.js"></script>
<script type="text/javascript" src="index_files/frame.js"></script>
<script type="text/javascript" src="index_files/ajax-submit.js"></script>
<script type="text/javascript" src="index_files/tinybox.js"></script>
<script type="text/javascript" src="index_files/jquery.js"></script>

</body></html>