<? 
	include "../dbconn.php";

	$sql = "select * from $table where num=$num";
	$result = mysql_query($sql, $connect);
    $row = mysql_fetch_array($result);       
	
	$item_num     = $row[num];
	$item_id      = $row[id];
	$item_name    = $row[name];
  	$item_nick    = $row[nick];
	$item_hit     = $row[hit];

	$image_name[0]   = $row[file_name_0];
	$image_name[1]   = $row[file_name_1];
	$image_name[2]   = $row[file_name_2];
	$image_copied[0] = $row[file_copied_0];
	$image_copied[1] = $row[file_copied_1];
	$image_copied[2] = $row[file_copied_2];

    $item_date    = $row[regist_day];
	$item_subject = str_replace(" ", "&nbsp;", $row[subject]);
	$item_content = $row[content];
	$is_html      = $row[is_html];

	if ($is_html!="y")
	{
		$item_content = str_replace(" ", "&nbsp;", $item_content);
		$item_content = str_replace("\n", "<br>", $item_content);
	}	

	for ($i=0; $i<3; $i++)
	{
		if ($image_copied[$i]) 
		{
			$imageinfo = GetImageSize("./data/".$image_copied[$i]);
			$image_width[$i] = $imageinfo[0];
			$image_height[$i] = $imageinfo[1];
			$image_type[$i]  = $imageinfo[2];

			if ($image_width[$i] > 785)
				$image_width[$i] = 785;
		}
		else
		{
			$image_width[$i] = "";
			$image_height[$i] = "";
			$image_type[$i]  = "";
		}
	}
	$new_hit = $item_hit + 1;
	$sql = "update $table set hit=$new_hit where num=$num";   // 글 조회수 증가시킴
	mysql_query($sql, $connect);
?>
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
	$table = "album";
	$ripple = "album_ripple";
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

<script>
	function check_input()
	{
		if (!document.ripple_form.ripple_content.value)
		{
			alert("내용을 입력하세요!");    
			document.ripple_form.ripple_content.focus();
			return;
		}
		document.ripple_form.submit();
    }

    function del(href) 
    {
        if(confirm("한번 삭제한 자료는 복구할 방법이 없습니다.\n\n정말 삭제하시겠습니까?")) {
                document.location.href = href;
        }
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
<H1 class="fadeInDown-1">악보게시판</H1></A>
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





<DIV class="bd use_np  hover_effect" id="bd_7246_7609" data-bdfilestype="" 
data-default_style="list">
<DIV class="bd_hd v2 clear">
<DIV class="bd_set fr m_btn_wrp m_no"></DIV></DIV>
<DIV class="rd rd_nav_style2 clear" data-docsrl="7609">
<DIV class="rd_hd clear">
<DIV class="blog v">
<DIV class="top_area ngeb np_18px"></DIV>
<H1 class="font ngeb" style="animation-name: rd_h1_v; -webkit-animation-name: rd_h1_v; -moz-animation-name: rd_h1_v;">
<?= $item_subject ?></H1>
<DIV class="btm_area ngeb np_18px">
<SPAN><SMALL>by </SMALL><B><?= $item_nick ?></B></SPAN>				
<SPAN title="2016.12.06 21:16"><SMALL>posted </SMALL><B class="date"><?= $item_date ?></B></SPAN>
<SPAN><SMALL>hit </SMALL><B><?= $item_hit ?></B></SPAN>	
</DIV></DIV>

<DIV class="rd_nav img_tx fr m_btn_wrp">


<A title="크게" class="font_plus bubble" >
<I class="fa fa-search-plus"></I><B class="tx">크게</B></A>	 
<A title="작게" class="font_minus bubble" >
<I class="fa fa-search-minus"></I><B class="tx">작게</B></A>			 
</DIV>

<DIV class="rd_body clear"><ARTICLE><!--BeforeDocument(7609,4)-->
<DIV class="document_7609_4 xe_content">
<DIV class="newbl-about">
<DIV class="cnt-img">
<?
	for ($i=0; $i<3; $i++)
	{
		if ($image_copied[$i])
		{
			$img_name = $image_copied[$i];
			$img_name = "./data/".$img_name;
			$img_width = $image_width[$i];
			
			echo "<A href='$img_name'> 다운로드 - $item_subject </A>";
		}
	}
?>
</DIV>
<?= $item_content ?>

</DIV><!--/newbl-about-->				
	

			
</DIV><!--AfterDocument(7609,4)--></ARTICLE></DIV>



<DIV class="fdb_lst_wrp">
<DIV class="fdb_lst clear">
<DIV class="cmt_editor">
<TABLE class="bd_lst bd_tb_lst bd_tb">
<?
	    $sql = "select * from album_ripple where parent='$item_num'";
	    $ripple_result = mysql_query($sql);

		while ($row_ripple = mysql_fetch_array($ripple_result))
		{
			$ripple_num     = $row_ripple[num];
			$ripple_id      = $row_ripple[id];
			$ripple_nick    = $row_ripple[nick];
			$ripple_content = str_replace("\n", "<br>", $row_ripple[content]);
			$ripple_content = str_replace(" ", "&nbsp;", $ripple_content);
			$ripple_date    = $row_ripple[regist_day];
?>
			<div>
			<TR>
			<TD><?=$ripple_nick?></TD>
			<TD class="title"><?=$ripple_content?></TD>
			<TD><?=$ripple_date?></TD>
			<TD> 
		      <? 
					if($userid=="admin" || $userid==$ripple_id)
			          echo "<a href='delete_ripple.php?table=$table&num=$item_num&ripple_num=$ripple_num'>[삭제]</a>"; 
			  ?>
			</TD>
			</TR>

			

			</div>
<?
		}
?>
</TABLE>
<LABEL class="cmt_editor_tl fl"><EM>✔</EM><STRONG>댓글 쓰기</STRONG></LABEL> 

<DIV class="bd_wrt clear">
<DIV class="simple_wrt"><SPAN class="profile img no_img">?</SPAN>	
<form  name="ripple_form" method="post" action="insert_ripple.php?table=<?=$table?>&num=<?=$item_num?>">  	 
<DIV class="text">
<?
	if($userid)
	{
?>
		<textarea name="ripple_content" style="resize:none"></textarea>
<?
	}
	else
	{
?>
		<A class="cmt_disable bd_login" href="#">댓글 쓰기 권한이 없습니다. 로그인 하시겠습니까?</A>
<?
	}
?>
</DIV>
<INPUT class="bd_btn" type="button" value="등록" onclick="check_input()">
</form>
</DIV></DIV></DIV>
<DIV id="cmtPosition" aria-live="polite"></DIV></DIV></DIV></DIV>




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
<DIV class="fl"><A class="btn_img fl" href="album.php"><I class="fa fa-bars"></I>목록</A>				
<FORM class="bd_srch_btm on" name="board_form" action="album.php?table=<?=$table?>&amp;mode=search" method="post">
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
<? 
	if(($userid && ($userid==$item_id)) || ($userid=="admin"))
	{
?>
		<a href="write_form.php?table=<?=$table?>&mode=modify&num=<?=$num?>&page=<?=$page?>"><img align="right" src="../files/img/modify.png"></a>
		<a href="javascript:del('delete.php?table=<?=$table?>&num=<?=$num?>')"><img align="right" src="../files/img/delete.png"></a>
<?
	}
?>


</DIV>
<FORM class="bd_pg clear" action="./" method="get">
	 
<FIELDSET>
	<INPUT name="vid" type="hidden">
	<INPUT name="mid" type="hidden" value="au_guide">
	<INPUT name="category" type="hidden">
	<INPUT name="search_keyword" type="hidden">
	<INPUT name="search_target" type="hidden">
	<INPUT name="listStyle" type="hidden" value="list">
	<STRONG class="direction"><I class="fa fa-angle-left"></I> <A href="album.php?table=<?=$table?>&amp;page=<?=($page<=1)?(1):($page-1)?>">Prev</A></STRONG>	
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
			echo "<a href='album.php?table=$table&page=$i'> $i </a>";
		}      
   }
?>			
	
	<STRONG class="direction"><A href="album.php?table=<?=$table?>&amp;page=<?=($page>=$total_page)?($total_page):($page+1)?>">Next</A><I class="fa fa-angle-right"></I></STRONG>		
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