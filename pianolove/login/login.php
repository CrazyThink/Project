<? include "../style2.php"; ?>

 </HEAD> 
<BODY><!--META --><!--DEFAULT --><!--CSS--><!--JS--><!--BODY-->	

<HEADER class="main-header fixed">
<? include "../menu.php"; ?>
</HEADER>

<DIV class="banner-wrapper">
<DIV>
<DIV class="owl-carousel" id="banner">
<DIV class="item owlbg bg1">
<DIV class="owl-content">
<A class="caption" href="../index.php">
<H1 class="fadeInDown-1">로그인</H1></A>
</DIV></DIV></DIV></DIV></DIV> <!--/.banner-wrap--> 

<DIV class="main container"><SECTION class="ver-wrap clearfix">
<DIV class="hr-wrap"><SPAN></SPAN></DIV>
<DIV class="ver-caro-wrap">
<DIV class="xe-widget-wrapper ">
<DIV style="padding: 0px !important;">
</DIV></DIV></DIV>
<DIV class="hr-wrap"><SPAN></SPAN></DIV></SECTION><!--section1 ver-wrap-->
	 <!--section3 serv-wrap-->
		 <SECTION class="content-wrap clearfix">
<DIV class="content col-lg-12 clearfix" id="content"><SECTION class="xm">
<DIV class="signin" style="width: 100%; max-width: 700px;">
<DIV class="login-header">
<H1><I class="icon-user"></I>통합 로그인</H1></DIV>
<DIV class="login-body"
<DIV class="login-default">				 
<FORM id="fo_member_login" action="login_check.php" method="post">
	<INPUT name="error_return_url" type="hidden" value="login.php">
	<INPUT name="mid" type="hidden" value="main_designsol">
	<INPUT name="vid" type="hidden"><INPUT name="ruleset" type="hidden" value="login">
	<INPUT name="success_return_url" type="hidden">			 
	<INPUT name="act" type="hidden" value="procMemberLogin">
	<INPUT name="xe_validator_id" type="hidden" value="modules/member/skins">
<FIELDSET>
<DIV class="control-group">
	<INPUT name="user_id" title="아이디" id="uid" required="" type="text" placeholder="아이디" value="">
	<INPUT name="password" title="비밀번호" id="upw" required="" type="password" placeholder="비밀번호" value="">
</DIV>
<DIV class="control-group">					 
	<INPUT class="submit member_btn buttn buttn-orange" type="submit" value="로그인">
</DIV>
<DIV class="login-footer">
	<A class="buttn buttn-gray" href="join.php">회원가입</A>
</DIV>
</FIELDSET></FORM></DIV></DIV></DIV>

 </SECTION></DIV></SECTION><!--.content--> </DIV><!--/.main container--> 

<? include "../help.php"; ?>

<? include "../foot.php"; ?>

<A id="toTop" href="http://127.0.0.1/#top">
<I class="fa fa-chevron-up" aria-hidden="true"></I></A> 

<DIV class="wfsr"></DIV>
<SCRIPT src="../resource/22aab7071849c59489d7da53b46f14cd.ko.js"></SCRIPT>
<SCRIPT src="../resource/d350b1be1c0837715faa620a24477c00.ko.compiled.js"></SCRIPT>
<SCRIPT src="../resource/045a1284a0405b8f282f598d7a8d1d90.ko.compiled.js"></SCRIPT>
</BODY></HTML>