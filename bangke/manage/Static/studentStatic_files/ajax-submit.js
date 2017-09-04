function submit_back_info(data){
	if(data.status == 1){	
		alertInfo(data.info,1200,function(){
			if(data.url != 'stop'&&data.url != ''){
				window.location.href=data.url;
			}
		});
	}else{
		if(data.errcode === 400){
			alertInfo('网络不太好，再试一次吧~',1200);
		}else if(data.info != '' && data.info != null){
			alertInfo(data.info,1200);
		}else{
			alertInfo('出错了，再试一次吧~',1200);
		}
	}
}

function submit_before_info(str){
	if(str == '' || str == null){
		str = "处理中...";
	}
	alertInfo(str,-1);
}
function alert_info(str){
	$('.globalLoading').fadeIn(300).find('.info').text(str);
	window.setTimeout(function(){
			$('.globalLoading').fadeOut(300);
		},1200);
}

function clear_info(){
	$('.globalLoading').fadeOut(300);
}

function check_before_go(data,url){
	if(data.status == 0){
		if(data.errcode === 400){
			alertInfo('网络不太好，再试一次吧~',1200);
		}else if(data.info != '' && data.info != null){
			alertInfo(data.info,1200);
		}else{
			alertInfo('出错了，再试一次吧~',1200);
		}
	}else{
		window.location.href=url;
	}
}

function check_before_load(data,noAlert){
	if(data.status == 0){
		if(data.errcode === 400){
			alertInfo('网络不太好，再试一次吧~',1200);
		}else if(data.info != '' && data.info != null){
			alertInfo(data.info,1200);
		}else{
			if(!noAlert){
				alertInfo('出错了，再试一次吧~',1200);
			}else{
				clear_info();
			}
		}
		return false;
	}else{
		clear_info();
		return true;
	}
}




