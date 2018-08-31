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
	$table = "photo";
	include "../dbconn.php";
	$sql = "select * from $table order by num desc";

	if ($mode=="search")
	{
		if(!$search)
		{
			echo("
				<script>
				 window.alert('검색할 단어를 입력해 주세요!');
			     history.go(-1);
				</script>
			");
			exit;
		}
		$sql = "select * from $table where $find like '%$search%' order by num desc";
	}
	else
	{
		$sql = "select * from $table order by num desc";
	}

	$result = mysql_query($sql, $connect);
	$total_record = mysql_num_rows($result); // 전체 글 수
?>
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
 
<DIV></DIV>
<DIV class="bd use_np  hover_effect" id="bd_7246_7609" data-bdfilestype="" data-default_style="list">
<DIV class="rd rd_nav_style2 clear" data-docsrl="7609">
<DIV class="rd_hd clear">



<SECTION class="recent-webz-wrapper clearfix">
<DIV class="grid-title">
<BR><BR><BR><BR><BR>
</DIV>
<DIV class="xe-widget-wrapper ">
<DIV style="padding: 0px !important;">
<DIV class="widgetContainer">
<UL class="grid sol-webzine clearfix">
<?
	for ($i=0; $i < $total_record; $i++)                    
   {
      mysql_data_seek($result, $i);     // 포인터 이동        
      $row = mysql_fetch_array($result); // 하나의 레코드 가져오기	      
      $item_num     = $row[num];
	  $item_id      = $row[id];
	  $item_nick    = $row[nick];
      $item_date    = $row[regist_day];
	  $item_date = substr($item_date, 0, 10);  
	  $item_subject = str_replace(" ", "&nbsp;", $row[subject]);
	  $image_copied = $row[file_copied_0];
?>
        <LI class="grid-item">
        <DIV class="thumb"><A href="view.php?table=<?=$table?>&amp;num=<?=$item_num?>">
        <DIV class="thumb-img hover-img" style='background-image: url("data/<?=$image_copied?>");'></DIV></A></DIV>
        <DIV class="content">
		<P class="title clearfix"><A href="view.php?table=<?=$table?>&amp;num=<?=$item_num?>"><?=$item_subject?></A></P>
        <P class="author-area clearfix">
		<SPAN class="author"><A class="author member_4"><?=$item_nick?></A></SPAN>
        <SPAN class="date"><?=$item_date?></SPAN></P></DIV></LI>
<?
    }
?>
</UL></DIV></DIV></DIV></SECTION>


<DIV class="btm_mn clear">
<DIV class="fl"><A class="btn_img fl" href="video.php"><I class="fa fa-bars"></I>목록</A></DIV>
<FORM class="bd_srch_btm on" name="board_form" action="photo.php?table=<?=$table?>&amp;mode=search" method="post">
      <SPAN class="btn_img itx_wrp">
      <BUTTON class="search" onclick="jQuery(this).parents('form.bd_srch_btm').submit();return false;" type="submit"><I class="fa fa-search"></I></BUTTON>
      <INPUT name="search" class="bd_srch_btm_itx srch_itx" id="bd_srch_btm_itx_7246" type="text">
	  </SPAN><SPAN class="btn_img select">
      <SELECT name="find">
      <OPTION value="subject">제목</OPTION></SELECT></SPAN></FORM></DIV>
<? 
	if($userid)
	{
?>
		<a href="write_form.php?table=<?=$table?>"><img align="right" src="../files/img/write.png"></a>
<?
	}
?>

</DIV>
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