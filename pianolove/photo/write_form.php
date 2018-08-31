<? include "../style2.php"; ?>
 
<STYLE data-id="bdCss">
.bd em,.bd .color{color:#333333;}
.bd .shadow{text-shadow:1px 1px 1px ;}
.bd .bolder{color:#333333;text-shadow:2px 2px 4px ;}
.bd .bg_color{background-color:#333333;}
.bd .bg_f_color{background-color:#333333;background:-webkit-linear-gradient(#FFF -50%,#333333 50%);background:linear-gradient(to bottom,#FFF -50%,#333333 50%);}
.bd .border_color{border-color:#333333;}
.bd .bx_shadow{box-shadow:0 0 2px ;}
.viewer_with.on:before{background-color:#333333;box-shadow:0 0 2px #333333;}
.bd_zine .info b,.bd_zine .info a{color:;}
.bd_zine.card h3{color:#333333;}
.bd_tb_lst .cate span,.bd_tb_lst .author span,.bd_tb_lst .last_post small{max-width:px}
</STYLE>
</HEAD> 
<?  
	include "../dbconn.php";

	if ($mode=="modify")
	{
		$sql = "select * from $table where num=$num";
		$result = mysql_query($sql, $connect);
		$row = mysql_fetch_array($result);       
	
		$item_subject     = $row[subject];
		$item_file_0 = $row[file_name_0];

		$copied_file = $row[file_copied];
	}
?>
<script>
  function check_input()
   {
      if (!document.board_form.subject.value)
      {
          alert("제목을 입력하세요1");    
          document.board_form.subject.focus();
          return;
      }
      document.board_form.submit();
   }
</script>
<BODY><!--META --> <!--DEFAULT -->		 <!--CSS-->				 	 	 	 <!--JS-->								 <!--BODY-->

<HEADER class="main-header fixed">
<? include "../menu.php"; ?>
</HEADER><!--.main-header-->		



<DIV class="banner-wrapper">
<DIV>
<DIV class="owl-carousel" id="banner">
<DIV class="item owlbg bg1">
<DIV class="owl-content">
<A class="caption" href="../index.php">
<H1 class="fadeInDown-1">활동사진</H1></A>
				 </DIV></DIV></DIV></DIV></DIV><!--.banner-wrapper-->	<!--.banner-wrapper--> 
<DIV class="main container">
		 <SECTION class="content-wrapper clearfix">
<DIV class="content col-lg-12 clearfix" id="content"><!--#JSPLUGIN:ui-->
<SCRIPT>//<![CDATA[
var lang_type = "ko";
var bdLogin = "로그인 하시겠습니까?@/login/login.php";
jQuery(function($){
	board('#bd_7246_7609');
	$.cookie('bd_viewer_font',$('body').css('font-family'));
});
//]]></SCRIPT> 
 

<DIV class="bd use_np  hover_effect" id="bd_7246_7609" data-bdfilestype="" data-default_style="list">
<DIV class="rd rd_nav_style2 clear" data-docsrl="7609">
<DIV class="rd_hd clear">
<P></P>

<DIV class="cmt_editor">
<?
	if($mode=="modify")
	{
?>
		<form  name="board_form" method="post" action="insert.php?mode=modify&num=<?=$num?>&page=<?=$page?>&table=<?=$table?>" enctype="multipart/form-data"> 
<?
	}
	else
	{
?>
		<form  name="board_form" method="post" action="insert.php?table=<?=$table?>" enctype="multipart/form-data"> 
<?
	}
?>

<TABLE class="bd_lst bd_tb_lst bd_tb">
  <THEAD class="bg_f_f9">
	<TR>
		<TD class="author"><SPAN>별명</SPAN></TD>
		<TD class="title"><?=$usernick?></TD>
	</TR>	
	<TR>
		<TD "author"><SPAN>제목</SPAN></TD>
		<TD class="title"><input type="text" name="subject" value="<?=$item_subject?>" style="width:100%"></TD>
	</TR>
	<TR>
		<TD "author"><SPAN>이미지파일</SPAN></TD>
		<TD class="title"><input type="file" name="upfile[]">
<? 	if ($mode=="modify" && $item_file_0)
	{
?>
		<div class="delete_ok"><?=$item_file_0?> 파일이 등록되어 있습니다. <input type="checkbox" name="del_file[]" value="0"> 삭제</div>
		<div class="clear"></div>
<?
	}
?>
		</TD>
	</TR>
  </THEAD></TABLE>

<div id="write_button"><a href="#"><img src="../files/img/ok.png" onclick="check_input()"></a>&nbsp;
<a href="photo.php?table=<?=$table?>&page=<?=$page?>"><img src="../files/img/list.png"></a>
</div>
</form>


</DIV></DIV></DIV></SECTION><!--.content--> 
</DIV><!--.main container-->	 
<? include "../help.php"; ?>

<? include "../foot.php"; ?>

<A id="toTop" href="http://127.0.0.1/#top"><I 
class="fa fa-chevron-up"></I></A> 
</DIV></DIV><!-- ETC --> 
<DIV class="wfsr"></DIV>
<SCRIPT src="../resource/d046d1841b9c79c545b82d3be892699d.ko.compiled.js"></SCRIPT>
<SCRIPT src="../resource/1bdc15d63816408b99f674eb6a6ffcea.ko.compiled.js"></SCRIPT>
<SCRIPT src="../resource/9b007ee9f2af763bb3d35e4fb16498e9.ko.compiled.js"></SCRIPT>
<SCRIPT src="../resource/autolink.js"></SCRIPT>
<SCRIPT src="../resource/jquery-ui.min.js"></SCRIPT>
<SCRIPT src="../resource/jquery.ui.datepicker-ko.js"></SCRIPT>
<SCRIPT src="../resource/imagesloaded.pkgd.min.js"></SCRIPT>
<SCRIPT src="../resource/jquery.cookie.js"></SCRIPT>
<SCRIPT src="../resource/xe_textarea.min.js"></SCRIPT>
<SCRIPT src="../resource/jquery.autogrowtextarea.min.js"></SCRIPT>
<SCRIPT src="../resource/board.js"></SCRIPT>
<SCRIPT src="../resource/jquery.masonry.min.js"></SCRIPT>
<SCRIPT src="../resource/b7eb2a149f84f739f69ad54751a280b5.ko.compiled.js"></SCRIPT>
<SCRIPT src="../resource/0ab33566cc291decfb406ddb3dd9e4dd.ko.compiled.js"></SCRIPT>
 </BODY></HTML>