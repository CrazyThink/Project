<? include "../style2.php"; ?>
</HEAD> 

<?
	$table = "faq";
	$ripple = "faq_ripple";
	include "../dbconn.php";
	$scale=10;			// 한 화면에 표시되는 글 수

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

	// 전체 페이지 수($total_page) 계산 
	if ($total_record % $scale == 0)     
		$total_page = floor($total_record/$scale);      
	else
		$total_page = floor($total_record/$scale) + 1; 
 
	if (!$page)                 // 페이지번호($page)가 0 일 때
		$page = 1;              // 페이지 번호를 1로 초기화
 
	// 표시할 페이지($page)에 따라 $start 계산  
	$start = ($page - 1) * $scale;      
	$number = $total_record - $start;
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
<H1 class="fadeInDown-1">FAQ</H1></A>
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



		<div id="list_content">


<TABLE class="bd_lst bd_tb_lst bd_tb">
  <CAPTION class="blind">List of Articles</CAPTION>
  <THEAD class="bg_f_f9">
  <TR>
    <TH class="no" scope="col"><SPAN>번호</SPAN></TH>
    <TH class="title" scope="col"><SPAN>제목</SPAN></TH>
    <TH scope="col"><SPAN>글쓴이</SPAN></TH>
    <TH scope="col"><SPAN>날짜</SPAN></TH>
    <TH class="m_no" scope="col"><SPAN>조회 수</SPAN></TH></TR></THEAD>
  <TBODY>

<?		
   for ($i=$start; $i<$start+$scale && $i < $total_record; $i++)                    
   {
      mysql_data_seek($result, $i);     // 포인터 이동        
      $row = mysql_fetch_array($result); // 하나의 레코드 가져오기	      
      
	  $item_num     = $row[num];
	  $item_id      = $row[id];
	  $item_name    = $row[name];
  	  $item_nick    = $row[nick];
	  $item_hit     = $row[hit];
      $item_date    = $row[regist_day];
	  $item_date = substr($item_date, 0, 10);  
	  $item_subject = str_replace(" ", "&nbsp;", $row[subject]);

	  $sql = "select * from $ripple where parent=$item_num";
	  $result2 = mysql_query($sql, $connect);
	  $num_ripple = mysql_num_rows($result2);
?>


  <TR>
    <TD class="no"><?= $number ?></TD>
    <TD class="title">
    <A class="hx" href="view.php?table=<?=$table?>&amp;num=<?=$item_num?>&amp;page=<?=$page?>">
     <?= $item_subject ?></A>
<?
    if ($num_ripple)
				echo " [$num_ripple]";
?>
	</TD>
    <TD class="author"><SPAN><?= $item_nick ?></SPAN></TD>
    <TD title="14:43" class="time"><?= $item_date ?></TD>
    <TD class="m_no"><?= $item_hit ?></TD>
  </TR>

<?
   	   $number--;
   }
?>

  </TBODY></TABLE>
<DIV class="btm_mn clear">
<DIV class="fl"><A class="btn_img fl" href="faq.php"><I class="fa fa-bars"></I>목록</A>				
<FORM class="bd_srch_btm on" name="board_form" action="faq.php?table=<?=$table?>&amp;mode=search" method="post">
      <SPAN class="btn_img itx_wrp">
      <BUTTON class="search" onclick="jQuery(this).parents('form.bd_srch_btm').submit();return false;" type="submit"><I class="fa fa-search"></I></BUTTON>
      <INPUT name="search" class="bd_srch_btm_itx srch_itx" id="bd_srch_btm_itx_7246" type="text">
	  </SPAN><SPAN class="btn_img select">
      <SELECT name="find">
      <OPTION value="subject">제목</OPTION>
      <OPTION value="content">내용</OPTION>
      <OPTION value="nick">별명</OPTION>
      <OPTION value="name">이름</OPTION></SELECT></SPAN></FORM></DIV>


<? 
	if($userid)
	{
?>
		<a href="write_form.php?table=<?=$table?>"><img align="right" src="../files/img/write.png"></a>
<?
	}
?>

</DIV>
<FORM class="bd_pg clear" action="./" method="get">
	 
<FIELDSET>
	<STRONG class="direction"><I class="fa fa-angle-left"></I> <A href="faq.php?table=<?=$table?>&amp;page=<?=($page<=1)?(1):($page-1)?>">Prev</A></STRONG>	
<?
   // 게시판 목록 하단에 페이지 링크 번호 출력
   for ($i=1; $i<=$total_page; $i++)
   {
		if ($page == $i)     // 현재 페이지 번호 링크 안함
		{
?>
		<A title= "현재 페이지" class="frst_last bubble this">
<?
			echo "<b> $i </b>";
			echo "</A>";
		}
		else
		{ 
			echo "<a href='faq.php?table=$table&page=$i'> $i </a>";
		}      
   }
?>			
	
	<STRONG class="direction"><A href="faq.php?table=<?=$table?>&amp;page=<?=($page>=$total_page)?($total_page):($page+1)?>">Next</A><I class="fa fa-angle-right"></I></STRONG>	
	</FIELDSET></FORM></DIV></DIV></DIV></SECTION><!--.content--> 
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