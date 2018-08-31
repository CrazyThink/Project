<? include "../style2.php"; ?>

<script>
   function check_id()
   {
     window.open("check_id.php?id=" + id_name.value,
         "IDcheck",
          "left=200,top=200,width=400,height=200,scrollbars=no,resizable=yes");
   }

   function check_nick()
   {
     window.open("check_nick.php?nick=" + nick_name.value,
         "NICKcheck",
          "left=200,top=200,width=400,height=200,scrollbars=no,resizable=yes");
   }

   function check_input()
   {
      member_form.submit();
   }
 </script>  

 </HEAD> 
<BODY><!--META --> <!--DEFAULT -->		 <!--CSS-->									 <!--JS-->							 <!--BODY-->	
<HEADER class="main-header fixed">
<? include "../menu.php"; ?>
</HEADER>
<DIV class="banner-wrapper">
<DIV>
<DIV class="owl-carousel" id="banner">
<DIV class="item owlbg bg1">
<DIV class="owl-content">
<A class="caption" href="../index.php">
<H1 class="fadeInDown-1">피아노사랑 회원가입</H1></A>
</DIV></DIV></DIV></DIV></DIV> <!--/.banner-wrap--> 
<DIV class="main container"><SECTION class="ver-wrap clearfix">
<DIV class="hr-wrap"><SPAN></SPAN></DIV>
<DIV class="ver-caro-wrap">
<DIV class="xe-widget-wrapper ">
<DIV style="padding: 0px !important;">
<DIV class="widgetContainer">
</DIV></DIV></DIV></DIV>
<DIV class="hr-wrap"><SPAN></SPAN></DIV></SECTION><!--section1 ver-wrap-->
	
		 <SECTION class="content-wrap clearfix">
<DIV class="content col-lg-12 clearfix" id="content"><!--#JSPLUGIN:ui--><!--#JSPLUGIN:ui.datepicker--><SECTION 
class="xm">	     
<H1>회원가입</H1>
<FORM class="form-horizontal" name="member_form" id="fo_insert_member" action="insert.php" enctype="multipart/form-data" method="post">
<INPUT name="error_return_url" type="hidden" value="/index.php?mid=main_designsol&amp;act=dispMemberSignUpForm">
<INPUT name="mid" type="hidden" value="main_designsol"><INPUT name="vid" type="hidden"><INPUT name="ruleset" type="hidden" value="@insertMember">
		 <INPUT name="act" type="hidden" value="procMemberInsert">		 <INPUT name="xe_validator_id" type="hidden" value="modules/member/skins">
		 <INPUT name="success_return_url" type="hidden" value="/index.php?mid=main_designsol&amp;act=dispMemberInfo">
		 
<DIV class="agreement">
<DIV class="text">
<H5 style="font-family: 나눔고딕;">가. 개인정보의 수집 목적 및 항목</H5>
<SPAN style="font-family: 나눔고딕;">동아리는 원활한 고객상담을 위해 아래와 같은 개인정보를 수집하고 있으며 단순 고객상담외에 어떠한 용도로도 수집된 개인정보를 사용하지 않음을 알려드립니다.</SPAN><BR><BR>
<SPAN style="font-family: 나눔고딕;">- 필수사항 : 이름, 연락처, 이메일</SPAN><BR><BR>
<SPAN style="font-family: 나눔고딕;">또한 서비스 이용과정이나 사업처리 과정에서 아래와 같은 정보들이 자동으로 생성되어 수집될 수 있습니다.</SPAN><BR>
<SPAN style="font-family: 나눔고딕;">- IP Address, 쿠키, 접속로그, 서비스 이용 기록, 불량 이용 기록, 결제기록</SPAN><BR><BR>
<H5 style="font-family: 나눔고딕;">나. 관련법령에 의한 정보보유 사유</H5>
<SPAN style="font-family: 나눔고딕;">상법, 전자상거래 등에서의 소비자보호에 관한 법률 등 관계법령의 규정에 의하여 보존할 필요가 있는 경우 동아리는 관계법령에서 정한 일정한 기간 동안 회원정보를 보관합니다. 이 경우 동아리는 보관하는 정보를 그 보관의 목적으로만 이용하며 보존기간은 아래와 같습니다.</SPAN><BR><BR>
<STRONG style="font-family: 나눔고딕;">- 상거래 관련 기록</STRONG><BR>
<SPAN style="font-family: 나눔고딕;">보존 이유 : 전자상거래 등에서의 소비자보호에 관한 법률&nbsp;</SPAN><BR>
<SPAN style="font-family: 나눔고딕;">보존 기간 : 계약 또는 청약철회 등에 관한 기록 : 5년</SPAN><BR>
<SPAN style="font-family: 나눔고딕;">대금결제 및 재화 등의 공급에 관한 기록 : 5년</SPAN><BR>
<SPAN style="font-family: 나눔고딕;">소비자의 불만 또는 분쟁처리에 관한 기록 : 3년</SPAN><BR><BR>
<STRONG style="font-family: 나눔고딕;">- 본인확인에 관한 기록</STRONG><BR>
<SPAN style="font-family: 나눔고딕;">보존 이유 : 정보통신망 이용촉진 및 정보보호 등에 관한 법률&nbsp;</SPAN><BR>
<SPAN style="font-family: 나눔고딕;">보존 기간 : 6개월&nbsp;</SPAN><BR><BR>
<STRONG style="font-family: 나눔고딕;">- 방문에 관한 기록</STRONG>
<SPAN style="font-family: 나눔고딕;">&nbsp;</SPAN><BR>
<SPAN style="font-family: 나눔고딕;">보존 이유 : 통신비밀보호법&nbsp;</SPAN><BR>
<SPAN style="font-family: 나눔고딕;">보존 기간 : 3개월</SPAN></DIV>
<DIV class="confirm"><LABEL class="accept-agree" for="accept_agree">
<INPUT name="accept_agreement" id="accept_agree" type="checkbox" value="Y">	약관을 모두 읽었으며 동의합니다.</LABEL></DIV></DIV>
<DIV class="control-group"><LABEL class="control-label" for="nick_name">
<EM style="color: red;">*</EM> 아이디</LABEL>
<DIV class="controls"><INPUT name="id_name" id="id_name" type="text">
<a href="#"><img src="../files/img/check_id.gif" onclick="check_id()"></a></DIV></DIV>
<DIV class="control-group"><LABEL class="control-label" for="password">
<EM style="color: red;">*</EM> 비밀번호</LABEL>
<DIV class="controls"><INPUT name="password" id="password" required="" type="password">				 
<P class="help-inline">비밀번호는 6자리 이상이어야 하며 영문과 숫자를 반드시 포함해야 합니다.</P></DIV></DIV>
<DIV class="control-group"><LABEL class="control-label" for="password2">
<EM style="color: red;">*</EM> 비밀번호 확인</LABEL>
<DIV class="controls"><INPUT name="password2" id="password2" required="" type="password"></DIV></DIV>
<DIV class="control-group"><LABEL class="control-label" for="nick_name">
<EM style="color: red;">*</EM> 이름</LABEL>
<DIV class="controls"><INPUT name="name" id="nick_name" required="" type="text"></DIV></DIV>
<DIV class="control-group"><LABEL class="control-label" for="nick_name">
<EM style="color: red;">*</EM> 닉네임</LABEL>
<DIV class="controls"><INPUT name="nick_name" id="nick_name" required="" type="text">
<a href="#"><img src="../files/img/check_id.gif" onclick="check_nick()"></a></DIV></DIV>
<DIV class="control-group"><LABEL class="control-label" for="nick_name">
<EM style="color: red;">*</EM> 전화번호</LABEL>
<DIV class="controls"><INPUT name="hp" id="nick_name" required="" type="text"></DIV></DIV>
<DIV class="control-group"><LABEL class="control-label" for="email_address">
<EM style="color: red;">*</EM> 이메일</LABEL>
<DIV class="controls"><input type="email" name="email" id="email_address" value="" /></DIV></DIV>
<DIV class="btnArea" style="padding-top: 10px; border-top-color: rgb(204, 204, 204); border-top-width: 1px; border-top-style: solid;">
<INPUT class="buttn sinup-y" type="submit" value="등록">
<A class="buttn sinup-n" href="../index.php">취소</A></DIV></FORM>
<SCRIPT>
jQuery(function($){
	// label for setup
	$('.control-label[for]').each(function(){
		var $this = $(this);
		if($this.attr('for') == ''){
			$this.attr('for', $this.next().children(':visible:first').attr('id'));
		}
	});
});
(function($){
	$(function(){
		var option = { changeMonth: true, changeYear: true, gotoCurrent: false,yearRange:'-100:+10', dateFormat:'yy-mm-dd', onSelect:function(){
			$(this).prev('input[type="hidden"]').val(this.value.replace(/-/g,""))}
		};
		$.extend(option,$.datepicker.regional['ko']);
		$(".inputDate").datepicker(option);
		$(".dateRemover").click(function() {
			$(this).prevAll('input').val('');
			return false;});
	});
})(jQuery);
</SCRIPT>
 </SECTION></DIV></SECTION><!--.content--> </DIV><!--/.main container--> 

<? include "../help.php"; ?>

<? include "../foot.php"; ?>


<A id="toTop" href="http://127.0.0.1/#top">
<I class="fa fa-chevron-up" aria-hidden="true"></I></A> 
<SCRIPT src="../resource/jquery-ui.min.js"></SCRIPT>
<SCRIPT src="../resource/jquery.ui.datepicker-ko.js"></SCRIPT>
<SCRIPT src="../resource/4af8efd5b7a9201c0c99687a982202a7.ko.js"></SCRIPT>
<SCRIPT src="../resource/d350b1be1c0837715faa620a24477c00.ko.compiled.js"></SCRIPT>
<SCRIPT src="../resource/045a1284a0405b8f282f598d7a8d1d90.ko.compiled.js"></SCRIPT>
 </BODY></HTML>