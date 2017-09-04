/*	$(function(){

		//快捷菜单
		//bindQuickMenu();

		//菜单切换(测试)
		bindAdminMenu();
		ChangeNav("common");

		//菜单开关
		LeftMenuToggle();

		//全部功能开关
		//AllMenuToggle();

		//取消菜单链接虚线
		$(".head").find("a").click(function(){$(this).blur()});
		$(".menu").find("a").click(function(){$(this).blur()});


	}).keydown(function(event){//快捷键
		if(event.keyCode ==116 ){
			url = $("#main").attr("src");
			main.location.href = url;
			return false;
		}
		if(event.keyCode ==27 ){
			$("#qucikmenu").slideToggle("fast")
		}
	});

	function bindQuickMenu(){//快捷菜单
		$("#ac_qucikmenu").bind("mouseenter",function(){
			$("#qucikmenu").slideDown("fast");
		}).dblclick(function(){
			$("#qucikmenu").slideToggle("fast");
		}).bind("mouseleave",function(){
			hidequcikmenu=setTimeout('$("#qucikmenu").slideUp("fast");',700);
			$(this).bind("mouseenter",function(){clearTimeout(hidequcikmenu);});
		});
		$("#qucikmenu").bind("mouseleave",function(){
			hidequcikmenu=setTimeout('$("#qucikmenu").slideUp("fast");',700);
			$(this).bind("mouseenter",function(){clearTimeout(hidequcikmenu);});
		}).find("a").click(function(){
			$(this).blur();
			$("#qucikmenu").slideUp("fast");
			$("#ac_qucikmenu").text($(this).text());
		});
	}


	function bindAdminMenu(){
		$("#nav").find("a").click(function(){
			ChangeNav($(this).attr("_for"));
			//$('#main').get(0).src = $(this).attr("href");
			//alert($(this).attr("href"));
		});

		$("#menu").find("dt").click(function(){
			dt = $(this);
			dd = $(this).next("dd");
			if(dd.css("display")=="none"){
				dd.slideDown("fast");
				dt.css("background-position","right 10px");
			}else{
				dd.slideUp("fast");
				dt.css("background-position","right -40px");
			}
		});

		$("#menu dd ul li a").click(function(){
			$(this).addClass("active").blur().parents("#menu").find("ul li a").not($(this)).removeClass("active");
			//url = $(this).attr("_href");
			//main.location.href = url;
			//return false;
		});
	}

	function ChangeNav(nav){//菜单跳转
		$("#nav").find("a").removeClass("active");
		$("#nav").find("a[_for='"+nav+"']").addClass("active").blur();
		$("body").attr("class","showmenu");
		$("#menu").find("div[id^=items]").hide();
		$("#menu").find("#items_"+nav).show().find("dl dd").show().find("ul li a").removeClass("active");
		$("#menu").find("#items_"+nav).show().find("dd ul li a").eq(0).addClass("active").blur();
	}

	function LeftMenuToggle(){
		$("#togglemenu").click(function(){
			if($("body").attr("class")=="showmenu"){
				$("body").attr("class","hidemenu");
				$(this).html("显示菜单");
			}else{
				$("body").attr("class","showmenu");
				$(this).html("隐藏菜单");
			}
		});
	}


	function AllMenuToggle(){
		mask = $(".pagemask,.iframemask,.allmenu");
		$("#allmenu").click(function(){
				mask.show();
		});
		//mask.mousedown(function(){alert("123");});
		mask.click(function(){mask.hide();});
	}
	*/
	
	
	function set_nav_state(path,element,attr){
		var winUrl = window.location.href;//获取当前浏览器地址 
		
		$navNode = $(path).find(element);//主导航节点 
      	$navNode.removeClass("active");//在遍历前去掉所有的选中效果 
      	$navNode.each(function(){//遍历主导航节点 
        var currentUrl = $(this).attr(attr);//当前导航的url 
		//alert(currentUrl);
        winUrl.indexOf(currentUrl) >-1 ? $(this).addClass("active") : '';//如果当前主导航的href地址和浏览器的url匹配，则选中 
      });
	}
	//menu dl dd ul li a
	$(function(){
	var menu_click=true;
      var winUrl = window.location.href;//获取当前浏览器地址 
	  //alert(winUrl);
	  
	  //左边菜单状态设置
	  set_nav_state(".menu li","a","href");
	  //顶部菜单栏目状态设置
	  set_nav_state(".nav li","dt","model");
	  //顶部菜单子栏目状态设置
	  set_nav_state(".nav li","dd","model");
	  //顶部菜单子栏目选项状态设置
	  set_nav_state(".nav li","a","href");

	  	//顶部菜单触发
	  	$(".nav li").find("dt").click(function(){
			menu_click=true;
			dt = $(this);
			dd = $(this).next("dd");
			
			$(".nav li dt").removeClass("active");
			$(".nav li dd").removeClass("active");
			dt.addClass("active");
			//dd.slideDown("fast");
			//dd.css("display","block");
			dd.addClass("active");
		});		
		
		//顶部菜单移动触发
		
		$(".nav li").find("dt").hover(function(){
			//menu_click=false;
			dt = $(this);
			dd = $(this).next("dd");
			
			$(".nav li dt").removeClass("active");
			$(".nav li dd").removeClass("active");
			dt.addClass("active");
			//dd.slideDown("fast");
			//dd.css("display","block");
			dd.addClass("active");
		},function(){
			if(menu_click == false){
	  		//顶部菜单栏目状态设置
	  		set_nav_state(".nav li","dt","model");
	  		//顶部菜单子栏目状态设置
	  		set_nav_state(".nav li","dd","model");
			}
  		});
		
		
		
	  
    }) 



