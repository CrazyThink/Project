<SECTION class="footer-wrapper clearfix">
<DIV class="container">
<DIV class="foot-block col-lg-3 col-md-3 col-sm-6 col-xs-12">
<H3>LINK</H3>
<UL class="foot-family">
  <LI><A href="http://www.koreatech.ac.kr/" target="_blank">한국기술교육대학교</A></LI>
  <LI><A href="http://portal.koreatech.ac.kr/" target="_blank">아우누리</A></LI></UL>
<UL class="foot-social clearfix">
  <LI><A title="facebook" href="https://www.facebook.com/kutpisa/" target="_blank"><I class="fa fa-facebook-square" aria-hidden="true"></I></A></LI>
  <LI><A title="instagram" href="www.naver.com/" target="_blank"><I class="fa fa-naver" aria-hidden="true"></I></A></LI></UL></DIV>
<DIV class="foot-block col-lg-3 col-md-3 col-sm-6 col-xs-12">
<H3>INFORMATION</H3>
<UL class="foot-nav">
  <LI><A href="http://25.41.10.58/introduction.php">동아리소개</A></LI>
  <LI><A href="#">공연문의</A></LI>
  <LI><A href="#">광고문의</A></LI>
  <LI><A href="#">이용약관</A></LI>
  <LI><A href="#">개인정보취급방침</A></LI>
  <LI><A href="http://25.41.10.58/location.php">찾아오시는길</A></LI>
</UL></DIV>
<DIV class="foot-block col-lg-3 col-md-3 col-sm-6 col-xs-12">
<H3>CONTACT US</H3>
<P>회장 : 010-9723-8319</P>
<P>부회장 : 010-9924-4184</P>
<P>이메일 : pianolove@naver.com</P>
<P>업무시간 : 24시간 연중무휴</P>
<P>주소 : 충남 천안시 동남구 병천면 충절로 1600 한국기술교육대학교 학생회관 316호</P></DIV>
<DIV class="foot-block col-lg-3 col-md-3 col-sm-6 col-xs-12">
<H3 class="foot-domain">pianolove.co.kr</H3>
<P>회장 : 임경제</P>
<P>Copyright 2017~ pianolove.co.kr All rights reserved.</P></DIV></DIV>
</SECTION><!--.footer-warpper--> 

<DIV class="mb-nav-bg hidden-lg hidden-md hidden-sm hidden-xs" id="mb-nav-bg"></DIV>
<NAV class="mb-nav menu-right" id="mb-nav">
	<UL class="log-group clearfix">
  <LI class="dropdown">
  <A class="dropdown-toggle" href="#" data-toggle="dropdown">
  <SPAN><I class="fa fa-globe" aria-hidden="true"></I></SPAN>
  <SPAN class="log-txt">한국어<B class="caret"></B></SPAN></A>
  <UL class="dropdown-menu">
    <LI><A onclick="doChangeLangType('en');return false;" href="#">English</A></LI>
    <LI><A onclick="doChangeLangType('jp');return false;" href="#">日本語</A></LI>
    <LI><A onclick="doChangeLangType('zh-CN');return false;" href="#">中文(中国)</A></LI>
    <LI><A onclick="doChangeLangType('zh-TW');return false;" href="#">中文(臺灣)</A></LI>
    <LI><A onclick="doChangeLangType('fr');return false;" href="#">Français</A></LI></UL></LI><!--언어표시-->

<?
    if(!$userid)
	{
?>
  					 
  <LI><A id="login-buttn" href="http://25.41.10.58/login/login.php" type="button">
  <SPAN><I class="fa fa-lock" aria-hidden="true"></I></SPAN>
  <SPAN class="log-txt">로그인</SPAN></A></LI>
  <LI><A href="http://25.41.10.58/login/join.php">
  <SPAN><I class="fa fa-user" aria-hidden="true"></I></SPAN>
  <SPAN class="log-txt">회원가입</SPAN></A></LI></UL><!--.log-group-->

<?
	}
	else
	{
?>
  						 
  <LI><a title="" href="http://25.41.10.58/login/member_form_modify.php">
  <SPAN><I class="fa fa-user" aria-hidden="true"></I></SPAN>
  <SPAN class="log-txt"><?=$usernick?></SPAN></A></LI>
  <LI><A onclick="if (!confirm('로그아웃하시겠습니까?')) return false" href="http://25.41.10.58/login/logout.php">
  <SPAN><I class="fa fa-unlock"></I></SPAN>
  <SPAN class="log-txt">로그아웃</SPAN></A></LI>
  <LI></LI></UL><!--.log-group-->

<?
	}
?>

  <DIV class="search-group clearfix">
  <!--
  <FORM action="http://25.41.10.58/" method="get">
    <INPUT name="vid" type="hidden">
    <INPUT name="mid" type="hidden" value="main_designsol"> 
    <INPUT name="act" type="hidden" value="IS">
    <INPUT name="is_keyword" class="form-control" type="text" placeholder="Search" value="" autocomplete="off"><INPUT class="hide" type="submit" value="검색"> 
  </FORM>--></DIV><!--search-group-->	 
  <UL class="contact-group">
  <LI><SPAN><I class="fa fa-phone" aria-hidden="true"></I></SPAN>&nbsp;&nbsp;010-9723-8319</LI>
  <LI><SPAN><I class="fa fa-envelope-o" aria-hidden="true"></I></SPAN>&nbsp;&nbsp;pianolove@naver.com</LI></UL><!--.contact-group --> 
</NAV><!--.mb-nav-->