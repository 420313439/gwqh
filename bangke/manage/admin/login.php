<!DOCTYPE html>
<html lang="zh-CN"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<script type="text/javascript" async="" src="login_files/ga.js"></script><script charset="utf-8" src="login_files/jquery-1.js"></script>
<link type="text/css" rel="stylesheet" href="login_files/store_login.css">
<title>后台管理系统登录</title>

<script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-7572959-9']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>
    <script charset="utf-8" src="login_files/ani.js"></script>
</head>

<body>
<div class="frontHome page" id="loginbox">
    <!--<div class="wrap-header">
        <div id="header">
            <div class="inner-header">
                <div class="logoNav">
                        <a href="#" id="logo" target="_blank">
                        网站管理系统 <font>beta2.0</font>
                    </a>
                </div>
            </div>
        </div>
    </div>-->
    <div class="wrap-container">
        <div id="home_container" class="clearfix">
            <div id="home_main">
                <div class="inner-main">
                    <div class="login_box">
                         <div class="form-title">

                        <h3>登录</h3>

                        <h4>LOGIN</h4>
                    </div>
                         
                                
                                
                            <form class="well form-horizontal" method="POST" action="./admin_login_check.php" style="background:#FFF">
                               <div class="logininput"> <input name="csrfmiddlewaretoken" value="Q4dYyQbW9ZTJabuZ3Mp1vVqoOuQZ70ys" type="hidden">
                                <fieldset>
                                    
    



    


	<div id="div_id_username" class="clearfix control-group">
		
			<label for="id_username" class="control-label requiredField">
				帐号<span class="asteriskField">*</span>
			</label>
		
    
         

        

        
            <div class="controls">
                
                    <input class="textinput textInput" id="id_username" maxlength="30" name="username" placeholder="用户名/邮箱" type="text">
                    
    





                
            </div>
        
	</div>



    


	<div id="div_id_password" class="clearfix control-group">
		
			<label for="id_password" class="control-label requiredField">
				密码<span class="asteriskField">*</span>
			</label>
		
    
         

        

        
            <div class="controls">
                
                    <input class="textinput textInput" id="id_password" name="password" placeholder="密码" type="password">
                    
    





                
            </div>
        
	</div>



    


	<div id="div_id_remember" class="clearfix control-group">
		
    
         

        

        
            <div class="controls">
                
                    <label for="id_remember" class="checkbox ">
                        <input class="checkboxinput" id="id_remember" name="remember" type="checkbox">
                        三个礼拜内自动登录
                        
    





                    </label>
                
            </div>
        
	</div>




                                    
                                </fieldset>
                                </div>
                                
                                <fieldset class="form-actions" style="position:relative; margin-top:15px;">
                                <div class="lfAutoLogin">
                                    <div class="form-field form-field-rc"><!--  <a class="forget-link fr" href="#">忘记密码？</a> -->
                                        <label><a href="./account/password_reset/">忘记密码？</a></label>
                                    </div>
                                </div>
                                <div class="loginFormBtn clearfix">
                                    <button class="login_btn js_login_btn" type="submit" style="width:100%;">登录</button>
                                   <!--  <a href="" target="_black" class="register_btn" type="button" style="width:100%;">注册</a> -->
                                   <div class="zzy">专业的互联网工具提供商</div>
                                </div>
                                </fieldset>
                            </form>
                          
                        
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <div class="wrap-footer">
        <div id="footer">
            <div class="inner-footer">
                <div class="foot">互联网工具SaaS平台 — 信息展示/营销模块/客户转化/客户管理/数据统计分析 — 云官网-云商城
                                           <div class="foot_kh">一路担当</div></div>
            </div>
        </div>
    </div>
</div>
<!--<div id="login">


             <div id="top">
                      <div id="top_left"><img src="https://s2.d2scdn.com/static/imgs/login_03.gif" /></div>
                          <div id="top_center"></div>
                 </div>

                 <div id="center">
                      <div id="center_left"></div>
                          <div id="center_middle">
                                        <div class="bd">
                
                    
                    
                    <div class="log-field">
                <form class="well form-horizontal" method="POST" action="/account/store_login/">
                    <input type='hidden' name='csrfmiddlewaretoken' value='Q4dYyQbW9ZTJabuZ3Mp1vVqoOuQZ70ys' />
                    <fieldset>
                        
    



    


	<div id="div_id_username" class="clearfix control-group">
		
			<label for="id_username" class="control-label requiredField">
				帐号<span class="asteriskField">*</span>
			</label>
		
    
         

        

        
            <div class="controls">
                
                    <input class="textinput textInput" id="id_username" maxlength="30" name="username" placeholder="用户名/手机号/邮箱" type="text" />
                    
    





                
            </div>
        
	</div>



    


	<div id="div_id_password" class="clearfix control-group">
		
			<label for="id_password" class="control-label requiredField">
				密码<span class="asteriskField">*</span>
			</label>
		
    
         

        

        
            <div class="controls">
                
                    <input class="textinput textInput" id="id_password" name="password" placeholder="密码" type="password" />
                    
    





                
            </div>
        
	</div>



    


	<div id="div_id_remember" class="clearfix control-group">
		
    
         

        

        
            <div class="controls">
                
                    <label for="id_remember" class="checkbox ">
                        <input class="checkboxinput" id="id_remember" name="remember" type="checkbox" />
                        三个礼拜内自动登录
                        
    





                    </label>
                
            </div>
        
	</div>




                        
                    </fieldset>
                    <fieldset class="form-actions">
                    <div class="control-group">
                      <div class="controls"><input type="submit" class="btn-login ll" value="&nbsp;" />
                      <a class="ll wjmm" href="/account/password_reset/">忘记密码？</a></div>
                    </div>
                    </fieldset>
                </form>
                </div>
              
                

            </div>
                          </div>
                          <div id="center_right"></div>
                 </div>
                 <div id="down">
                      <div id="down_left">
                              <div id="inf">
                       <span class="inf_text">版本信息</span>
                                           <span class="copyright">后台管理系统 2016 &nbsp;<span style="color:#F00">(强烈建议使用<a href="http://softdl.360tpcdn.com/Chrome/Chromestable_47.0.2526.106.exe">谷歌浏览器</a>)</span></span>
                              </div>
                          </div>
                          <div id="down_center"></div>
                 </div>


        </div>-->
<div id="noie-content" class="clearfix" style=" display:none">
                <div class="hd"><img src="login_files/oniets.jpg" style=""></div>
        <div class="about-us-box">
<h2>致ie6/7用户</h2>
<p class="hightxt">
尊敬的用户，为了给您提供更方便、更高效、更易操作的后台体验，我们诚恳地建议您升级您的IE6/7浏览器。
</p>
<p>
IE6浏览器是美国微软公司在2001年发布的一款软件，10多年前，IE6凭借着优质的产品质量和与Windows XP操作系统的捆绑方式，使IE6浏览器成为了当时世界上最流行的浏览器软件。
</p>
<p>
然而，互联网是一个飞速发展的行业，10年后的今天，IE6浏览器已经完全无法适应当今互联网越来越复杂的应用了。怪异的渲染引擎、功能的缺失、漏洞百出的安全性已经让IE6完全失去了与其他现代浏览器竞争的条件，就连微软公司自己，也推出了<a target="_blank" href="http://www.ie6countdown.com/">ie6countdown.com</a>网站，用来统计全球IE6浏览器的使用情况，请求用户尽快停止使用IE6浏览器。
</p>

<h3>我们推荐你升级到如下浏览器：</h3>
<div class="new-broswer">
  <ul>
    <li class="chrome"><a target="_blank" href="http://www.google.cn/chrome/intl/zh-CN/landing_chrome.html?hl=zh-CN">谷歌浏览器</a></li>
    <li class="firefox"><a target="_blank" href="http://firefox.com.cn/">火狐浏览器</a></li>
    <li class="safe360"><a target="_blank" href="http://down.360safe.com/se/360se_5.0_20120716_ie8.exe">360浏览器</a></li>
    <li class="ienew"><a target="_blank" href="http://windows.microsoft.com/zh-cn/internet-explorer/downloads/ie">ie8以上版本</a></li>
  </ul>
</div>
</div>
        <div class="bd"><a class="no-upie" href="javascript:void()">暂不升级&gt;&gt;</a>（不推荐）</div>
</div>

    <script type="text/javascript">
        $(function(){
        var mttop=($(window).height()-$('.frontHome.page').height()-20)/2
    if(mttop<0){mttop=0}
    // $('.frontHome.page').css('marginTop', mttop);
        //登录框效果
    $('#id_username').focus(function(){
        $(this).parent('.controls').addClass('focus')
    }).blur(function(){$(this).parent('.controls').removeClass('focus')})
    $('#id_password').focus(function(){
        $(this).parent('.controls').addClass('focus')
    }).blur(function(){$(this).parent('.controls').removeClass('focus')})
        });
      if(!window.localStorage)
                {//alert("低版本浏览器");
                $("#noie-content").show();
                $("#loginbox").hide();}
                else
                {//alert("高级货浏览器");
                $("#noie-content").hide();}
        $(function(){
                $(".no-upie").click(function(){
                        $("#noie-content").hide();
                        $("#loginbox").show();
                        })
                })
    </script>

<div style="display:none;"><script type="text/javascript">
var _bdhmProtocol = (("https:" == document.location.protocol) ? " https://" : " http://");
document.write(unescape("%3Cscript src='" + _bdhmProtocol + "hm.baidu.com/h.js%3F75fb47e8b856d549e2e9b28533498cdb' type='text/javascript'%3E%3C/script%3E"));
</script><script src="login_files/h.js" type="text/javascript"></script><a href="http://tongji.baidu.com/hm-web/welcome/ico?s=75fb47e8b856d549e2e9b28533498cdb" target="_blank"><img src="login_files/21.gif" style="" width="20" height="20" border="0"></a>
</div>
    <div id="container" class="mpage">
        <div id="anitOut" class="anitOut"><canvas style="display: block;" width="1349" height="669"></canvas></div>
    </div>
<script>DM_REQUEST_ID="6ca077a1eeae4dc8af7ecdeb2a5dde25";</script><script src="login_files/middleware.js" type="text/javascript"></script>

</body></html>