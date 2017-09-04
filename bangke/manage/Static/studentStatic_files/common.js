//删除左右两端的空格
function trim(str){ 
    return str.replace(/(^\s*)|(\s*$)/g, "");
}
//转跳网址
function goUrl(url) {
    if (!url) {
        return false;
    }
    location.href  = url;
}
//添加
function add(url) {
    if (!url) {
        return false;
    }
    location.href  = url;
}



//删除
function del(url) {
    if (!url) {
        alert('请选择删除项！');
        return false;
    }
    if (window.confirm('确实要永久删除选择项吗？')){
        location.href  = url;
    }
}

//删除有确认
function delItem(url,item) {
    if (!url) {
        alert('请选择删除项！');
        return false;
    }
    if (window.confirm('确实要永久删除  \''+item+'\' 吗？')){
        location.href  = url;
    }
    
}

//批量删除
function delAll(){
    //if 没有被选中的checkbox
    if (!getCheckboxNum("")){
        alert('请选择项！');
        return false;
    }
    if (window.confirm('确实要永久删除选择项吗？')){
        document.getElementById("form_do").submit(); 
    }
      

}

//批量确认通用
function doConfirmBatch(url, str){
    //if 没有被选中的checkbox
    if (!getCheckboxNum("")){
        alert('请选择项！');
        return false;
    }
    if (window.confirm(str)){
        var form_do = document.getElementById("form_do"); 
        form_do.action = url;
        form_do.submit(); 
    }
}

//批量确认通用
function doConfirmBatchSendMessage(url, str){
    //if 没有被选中的checkbox
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
                //data.url = location.href;
                submit_back_info(data);
                if(data.resultdata.reload==1){
                    location.reload();
                }
            }
        });
    }
}

function doConfirmRestPSW(url, str){
    if (window.confirm(str)){
        var form_do = document.getElementById("form_do"); 
        form_do.action = url;
        form_do.submit(); 
    }
}

//批量通用(无确认)
function doGoBatch(url, str){
    //if 没有被选中的checkbox
    if (!getCheckboxNum("")){
        alert('请选择项！');
        return false;
    }
    var form_do = document.getElementById("form_do"); 
    form_do.action = url;
    form_do.submit();       

}

//全部确认通用
function doConfirmAll(url, str){

    if (window.confirm(str)){
        var form_do = document.getElementById("form_do"); 
        form_do.action = url;
        form_do.submit(); 
    }
      

}



//批量通过审核
function checkPass(id){
    var keyValue;
    if (id)
    {
        keyValue = id;
    }else {
        keyValue = getCheckValues();
    }

    if (!keyValue){
        alert('请选择审核项！');
        return false;
    }

    if (window.confirm('确实要通过选择项吗？')){
        location.href =  trim(SELF)+"&a=checkPass&id="+keyValue;
        //ThinkAjax.send(URL+"/foreverdelete/","id="+keyValue+'&ajax=1',doDelete);
    }
}
//批量取消审核
function forbid(id){
    var keyValue;
    if (id)
    {
        keyValue = id;
    }else {
        keyValue = getCheckValues();
    }

    if (!keyValue){
        alert('请选择审核项！');
        return false;
    }

    if (window.confirm('确实要取消选择项吗？')){
        location.href =  trim(SELF)+"&a=forbid&id="+keyValue;
        //ThinkAjax.send(URL+"/foreverdelete/","id="+keyValue+'&ajax=1',doDelete);
    }
}

//获取Checkbox被选择个数
function getCheckboxNum(ele){
    if(ele =="")
        ele = "key[]";
   var checkbox = document.getElementsByName(ele);
   var j = 0; // 用户选中的选项个数
   for(var i=0;i<checkbox.length;i++){
      if(checkbox[i].checked){
          j++;
      }
   }
   return j;

}
//设置Checkbox状态
function setCheckbox(flag,ele){
    flag = flag? true : false;
    if(ele =="")
        ele = "key[]";
    var checkbox = document.getElementsByName(ele);
    for(var i=0;i<checkbox.length;i++){
        if (!checkbox[i].disabled) {        
            checkbox[i].checked = flag;
        }
    }

}

function getCheckValues(ele){
    if(ele =='')
        ele = 'key';
	var obj = document.getElementsByName(ele);
	var result ='';
	var j= 0;
	for (var i=0;i<obj.length;i++){
            if (obj[i].checked===true){
//                selectRowIndex[j] = i+1;
                result += obj[i].value+",";
                j++;
            }
	}
	return result.substring(0, result.length-1);
}

function getFormJson(form) {
    var o = {};
    var a = $(form).serializeArray();
    $.each(a, function () {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
}

function resetControl() {
    var v = document.forms[0].elements;
    for (var i = 0; i < v.length; i++) {
    if (v[i].type == "text") {
    v[i].value = "";
    } else if (v[i].type == "select-one") {
    v[i].options[0].selected = true;
    }
}
}

//删除
function del_ajax(url,content,title) {
    TINY.box.show({
		html:popwin_str(title,content),
		width:454,
		height:224,
		fixed:false,
		boxid: 'pop_remove-form',
		maskid:'blackmask',
		maskopacity:40,
		openjs:function(){
			var $box = $('#pop_remove-form');
			$box.find('.popwin_confirm').off('click').on('click',function(){
                $.ajax({
					type:'GET', //表单提交类型
					url:url, //表单提交目标
					success:function(data){
						submit_back_info(data);
                        
                        if(data.status==1&&data.url == ''){
                            location.reload();
                        }
					}
				});
				TINY.box.hide();
			});
		}
	});
}

//删除
function remark_ajax(url,param,content,title) {
    TINY.box.show({
        html:popeditwin_str(url,param,title,content),
        width:454,
        height:224,
        fixed:false,
        boxid: 'pop_remove-form',
        maskid:'blackmask',
        maskopacity:40,
        openjs:function(){
            var $box = $('#pop_remove-form');
            $box.find('.popwin_confirm').off('click').on('click',function(){
                if($("#remark_content").val().trim() == "")
                {
                    alert_info("备注内容不能为空！");
                    return false;
                }
                TINY.box.hide();
            });
        }
    });
}

//批量确认通用
function doConfirmBatch_ajax(url, str){
    //if 没有被选中的checkbox
    if (!getCheckboxNum('')){
        alert_info('请选择项！');
        return false;
    }
	TINY.box.show({
		html:popwin_str('',str),
		width:454,
		height:224,
		fixed:false,
		boxid: 'pop_remove-form',
		maskid:'blackmask',
		maskopacity:40,
		openjs:function(){
			var $box = $('#pop_remove-form');
			$box.find('.popwin_confirm').off('click').on('click',function(){
				var form_do = $("#form_do");
				$.ajax({
					type:form_do.attr('method'), //表单提交类型
					url:url, //表单提交目标
					data:form_do.serialize(), //表单数据
					beforeSend: function(data) {
						submit_before_info();
					},
					success:function(data){
						//data.url = location.href;
						submit_back_info(data);
					}
				});
				TINY.box.hide();
			});
		}
	});
}


function doConfirmRestPSW_ajax(url, str){
		TINY.box.show({
		html:popwin_str('重置密码','确定要重置密吗？'),
		width:454,
		height:224,
		fixed:false,
		boxid: 'pop_remove-form',
		maskid:'blackmask',
		maskopacity:40,
		openjs:function(){
			var $box = $('#pop_remove-form');
			$box.find('.popwin_confirm').off('click').on('click',function(){
				$.ajax({
					type:'GET', //表单提交类型
					url:url, //表单提交目标
					success:function(data){
						//data.url = location.href;
						submit_back_info(data);
					}
				});
				
				TINY.box.hide();
			});
		}
	});
}

function popeditwin_str(url,param,title,content){
    if(title=='' || title == null){
        title = '操作确认';
    }
    var popwin = $("#popwin_confirmForm").html();
    if(popwin == null){
        popwin = $("#popwin_deleteForm").html();
    }
    popwin = popwin.replace('#title#',title);
    popwin = popwin.replace('#content#',content);
    popwin = popwin.replace('#action_confirm#',url);
    popwin = popwin.replace('#id#',param);

    return popwin;
}

function popwin_str(title,content,obj){
	if(title=='' || title == null){
		title = '操作确认';
	}
	if(content=='' || content == null){
		content = '确认此次操作吗？';
	}
	var popwin = $("#popwin_confirmForm").html();
	if(popwin == null){
		popwin = $("#popwin_deleteForm").html();
	}

    if(obj){
        popwin=$(obj).html();
    }
	popwin = popwin.replace('#title#',title);
	popwin = popwin.replace('#content#',content);
	
	return popwin;
}

function msg_form_str(title,content){
	if(title=='' || title == null){
		title = '操作确认';
	}
	if(content=='' || content == null){
		content = '确认此次操作吗？';
	}
	var popwin = $("#popwin_messageBox").html();
	popwin = popwin.replace('#title#',title);
	popwin = popwin.replace('#content#',content);
	
	return popwin;
}

/*//批量确认通用
function show_msg(url, title, content){
    //if 没有被选中的checkbox
	TINY.box.show({
		html:msg_form_str(title,content),
		width: 500,
		height: 300,
		animate:true,
		close:true,
		boxid: "messageFeedback_win",
		openjs:function(){
			var $box = $('#messageFeedback_win');
			$box.find('.popwin_messageBox_close').off('click').on('click',function(){
				TINY.box.hide();
			});
		}
	});
}*/


function getDateFromTime(d)
{
    var day = d.getFullYear()+"-"+(d.getMonth()+1)+"-"+d.getDate();
    return day;
}

function nowDateTime(){
    var d=new Date();
    return d.getFullYear()+"-"+(d.getMonth()+1)+"-"+d.getDate()+" "+packZero(d.getHours())+":"+packZero(d.getMinutes());
}

function packZero(num){
    return num<10?("0"+num):num;
}

/*格式化输出时间1970-01-01 00:00*/
function formatDateTime(dtime){
    var now = new Date(parseInt(dtime));
    var year = now.getFullYear();
    var month = now.getMonth() + 1;
    var date = now.getDate();
    var hour = now.getHours();
    var minute = now.getMinutes();
    var second = now.getSeconds();
    return year+'-'+format_number(month)+'-'+format_number(date) +" "+ format_number(hour)+":"+format_number(minute)+":"+format_number(second);
}

/*自动补零*/
function format_number(number) {
        return number< 10 ? '0' + number : number;
}



function getDateDistance(o){
    /** for test
    o='2014-09-23';
    o='2014-09-24';
    o='2014-09-25';
    o='2014-09-26';
    o='2014-09-22';
    o='2014-09-21';
    o='2014-09-20';
     **/
    var dayIn = new Date(o.replace(/-/ig,'/'));
    var dayInDateOnly = getDateFromTime(dayIn);
    var today=new Date();//今天
    var tommorrow=new Date();//明天
    tommorrow.setDate(today.getDate()+1);
    var after_tommorrow=new Date();//后天
    after_tommorrow.setDate(today.getDate()+2);
    var three_tommorrow=new Date();//大后天
    three_tommorrow.setDate(today.getDate()+3);

    var yesterday=new Date();//昨天
    yesterday.setDate(today.getDate()-1);
    var after_yesterday=new Date();//前天
    after_yesterday.setDate(today.getDate()-2);
    var three_yesterday=new Date();//大前天
    three_yesterday.setDate(today.getDate()-3);

    if(getDateFromTime(today) == dayInDateOnly)
    {
        return '<span style="color: red">今天</span>';
    }else if(getDateFromTime(tommorrow) == dayInDateOnly)
    {
        return '<span style="color: red">明天</span>';
    }else if(getDateFromTime(after_tommorrow) == dayInDateOnly)
    {
        return '<span style="color: red">后天</span>';
    }else if(getDateFromTime(three_tommorrow) == dayInDateOnly)
    {
        return '<span style="color: red">大后天</span>';
    }else if(getDateFromTime(yesterday) == dayInDateOnly)
    {
        return '<span style="color: green">昨天</span>';
    }else if(getDateFromTime(after_yesterday) == dayInDateOnly)
    {
        return '<span style="color: green">前天</span>';
    }else if(getDateFromTime(three_yesterday) == dayInDateOnly)
    {
        return '<span style="color: green">大前天</span>';
    }else
    {
        return '';
    }


}

function count_down(o){
    var www_dsmake_com=/^[\d]{4}-[\d]{1,2}-[\d]{1,2}( [\d]{1,2}:[\d]{1,2}(:[\d]{1,2})?)?$/ig,str='',conn ='',prex,s;
    if(!o.match(www_dsmake_com)){
        alert('参数格式为2012-01-01[ 01:01[:01]].\r其中[]内的内容可省略');
        return false;
    }
    var dayIn = o;
    var sec=(new Date(o.replace(/-/ig,'/')).getTime() - new Date().getTime())/1000;
    if(sec > 0){
        prex='后';
    }else{
        prex='前';
        sec*=-1;
    }

    conn = getDateDistance(dayIn);
    day = sec/24/3600;
    day = Math.floor(day);
    xx = Math.abs(day);
    if('' == conn)
    {
        conn = xx+'天'+prex;
    }

    document.write(conn);
}

/*获取时间段*/
function getDatelength(dtime1,dtime2){
    var dtime1=new Date(parseInt(dtime1) * 1000);
    var dtime2=new Date(parseInt(dtime2) * 1000);
    var month=dtime1.getMonth()+1;
    var date=dtime1.getDate();
    var day=dtime1.getDay();
    var year=dtime1.getFullYear();
    var week=Array('周日','周一','周二','周三','周四','周五','周六');
    var hour1 = dtime1.getHours();
    var minute1 = dtime1.getMinutes();
    var hour2 = dtime2.getHours();
    var minute2 = dtime2.getMinutes();
    return year+"-"+format_number(month)+"-"+format_number(date)+"&nbsp;&nbsp;"+format_number(hour1)+":"+format_number(minute1)+"-"+format_number(hour2)+":"+format_number(minute2)+"&nbsp;&nbsp;"+week[day];
}


function dateOperator(date,days,operator){
    date = date.replace(/-/g,"/"); //更改日期格式2014/02/25
    var nd = new Date(date);//自动调用Date.parse()将日期字符串2014/02/25转为毫秒数，Date将其返回值格式化成Sat Feb 25 2012 00:00:00 GMT+0800
    nd = nd.valueOf();//date.valueOf 返回存储的时间是从 1970 年 1 月 1 日午夜开始计的毫秒数 UTC。
    if(operator=="+"){//毫秒数相+-
     nd = nd + days * 24 * 60 * 60 * 1000;
    }else if(operator=="-"){
        nd = nd - days * 24 * 60 * 60 * 1000;
    }else{
        return false;
    }
    nd = new Date(nd);//格式化
 
    var y = nd.getFullYear();
    var m = nd.getMonth()+1;
    var d = nd.getDate();
    if(m <= 9) m = "0"+m;
    if(d <= 9) d = "0"+d;
    var cdate = y+"-"+m+"-"+d;
    return cdate;
}

//复制对象
function cloneJSObj(obj){  
    function Clone(){}  
    Clone.prototype = obj;  
    var o = new Clone();  
    for(var a in o){  
        if(typeof o[a] == "object") {  
            o[a] = cloneJSObj(o[a]);  
        }  
    }  
    return o;  
}  

function clone(myObj){  
  if(typeof(myObj) != 'object') return myObj;  
  if(myObj == null) return myObj;  
    
  var myNewObj = new Object();  
    
  for(var i in myObj)  
     myNewObj[i] = clone(myObj[i]);  
    
  return myNewObj;  
}  


	
	