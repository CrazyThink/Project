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
<?
    include "../dbconn.php";

    $sql = "select * from member where id='$userid'";
    $result = mysql_query($sql, $connect);

    $row = mysql_fetch_array($result);

    mysql_close();
?>

<DIV class="banner-wrapper">
<DIV>
<DIV class="owl-carousel" id="banner">
<DIV class="item owlbg bg1">
<DIV class="owl-content">
<A class="caption" href="../index.php">
<H1 class="fadeInDown-1">정보수정</H1></A>
</DIV></DIV></DIV></DIV></DIV> 
<DIV class="main container"><!--section1 ver-wrap-->
	
<SECTION class="content-wrap clearfix">
<DIV class="content col-lg-12 clearfix" id="content"><!--#JSPLUGIN:ui--><!--#JSPLUGIN:ui.datepicker-->
<SECTION class="xm">	     
<H1>정보수정</H1>
<FORM class="form-horizontal" name="member_form" id="fo_insert_member" action="modify.php" enctype="multipart/form-data" method="post">
<INPUT name="error_return_url" type="hidden" value="member_form_modify.php">
<INPUT name="mid" type="hidden" value="main_designsol">
<INPUT name="vid" type="hidden">
<INPUT name="ruleset" type="hidden" value="@insertMember">
<INPUT name="act" type="hidden" value="procMemberInsert">
<INPUT name="xe_validator_id" type="hidden" value="modules/member/skins">
<INPUT name="success_return_url" type="hidden" value="member_form_modify.php">

<DIV class="control-group"><LABEL class="control-label" for="nick_name">
<EM style="color: red;">*</EM> 아이디</LABEL>
<DIV class="controls"><?= $row[id] ?></DIV></DIV>
<DIV class="control-group"><LABEL class="control-label" for="password">
<EM style="color: red;">*</EM> 비밀번호</LABEL>
<DIV class="controls"><INPUT name="password" id="password" required="" type="password" value="<?= $row[pass] ?>"> 
<P class="help-inline">비밀번호는 6자리 이상이어야 하며 영문과 숫자를 반드시 포함해야 합니다.</P></DIV></DIV>
<DIV class="control-group"><LABEL class="control-label" for="password2">
<EM style="color: red;">*</EM> 비밀번호 확인</LABEL>
<DIV class="controls"><INPUT name="password2" id="password2" required="" type="password" value="<?= $row[pass] ?>"></DIV></DIV>
<DIV class="control-group"><LABEL class="control-label" for="nick_name">
<EM style="color: red;">*</EM> 이름</LABEL>
<DIV class="controls"><INPUT name="name" id="nick_name" required="" type="text" value="<?= $row[name] ?>"></DIV></DIV>
<DIV class="control-group"><LABEL class="control-label" for="nick_name">
<EM style="color: red;">*</EM> 닉네임</LABEL>
<DIV class="controls"><INPUT name="nick_name" id="nick_name" required="" type="text" value="<?= $row[nick] ?>">
<a href="#"><img src="../files/img/check_id.gif" onclick="check_nick()"></a></DIV></DIV>
<DIV class="control-group"><LABEL class="control-label" for="nick_name">
<EM style="color: red;">*</EM> 전화번호</LABEL>
<DIV class="controls"><INPUT name="hp" id="nick_name" required="" type="text" value="<?= $row[hp] ?>"></DIV></DIV>
<DIV class="control-group"><LABEL class="control-label" for="email_address">
<EM style="color: red;">*</EM> 이메일</LABEL>
<DIV class="controls"><input type="email" name="email" id="email_address" value="<?= $row[email] ?>"></DIV></DIV>

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