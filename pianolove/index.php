<? include "style.php"; ?>
</HEAD> 
<BODY><!--META --> <!--DEFAULT -->		 <!--CSS-->				 	 	 	 <!--JS-->								 <!--BODY-->	
<HEADER class="main-header fixed">
<? include "menu.php"; ?>
</HEADER><!--.main-header-->
<DIV class="banner-wrapper">
<DIV>
<DIV class="owl-carousel" id="banner">
<DIV class="item owlbg bg1">
<DIV class="owl-content"><A class="caption" href="index.php">
<H1 class="fadeInDown-1">Piano Love</H1>
<P class="fadeInDown-2">♡</P></A>				 </DIV></DIV>
</DIV></DIV></DIV><!--.banner-wrapper-->	<!--.banner-wrapper--> 
<DIV class="main container">
<DIV class="breadcrumb-wrapper"><A href="index.php">Home</A>
				 </DIV><!--.breadcrumb-wrapper-->	 <SECTION class="quick-wrapper clearfix">
<DIV class="quick-mnu-left col-lg-5 col-md-5 col-sm-5 col-xs-12">
<A class="quick-mnu0" href="notice/notice.php">
<DIV class="ver-bar"></DIV>
<DIV class="quick-caption">
<H2>Notice</H2>
<P>공지사항을 확인해주세요.</P></DIV></A></DIV>
<DIV class="quick-mnu-right col-lg-7 col-md-7 col-sm-7 col-xs-12">
<A class="quick-mnu1 col-lg-6 col-md-6 col-sm-6 col-xs-6" href="photo/photo.php">
<DIV class="quick-caption">
<H2>Picture</H2>
<P>사진첩</P></DIV></A>			 
<A class="quick-mnu2 col-lg-6 col-md-6 col-sm-6 col-xs-6" href="free/free.php">
<DIV class="quick-caption">
<H2>Community</H2>
<P>게시판</P></DIV></A>			 
<A class="quick-mnu3 col-lg-6 col-md-6 col-sm-6 col-xs-6" href="location.php">
<DIV class="quick-caption">
<H2>Path</H2>
<P>찾아오시는길</P></DIV></A>			 
<A class="quick-mnu4 col-lg-6 col-md-6 col-sm-6 col-xs-6" href="faq/faq.php">
<DIV class="quick-caption">
<H2>Help</H2>
<P>회원센터</P></DIV></A>		 </DIV></SECTION><!--.quick-wrapper-->	 
<SECTION class="info1-wrap clearfix">
<DIV class="cnt1 col-lg-4 col-md-4 col-sm-6 col-xs-12">
<DIV class="owl-carousel" id="prod-caro">
<DIV class="item owlbg bg1">
<DIV class="caption">
<P>나른한 오후, 풀밭에 누워서</P></DIV></DIV>
</DIV></DIV>
<DIV class="cnt2 col-lg-4 col-md-4 col-sm-6 col-xs-12">
<DIV class="hor-bar"></DIV>
<DIV class="cnts cont-table">
<DIV class="cont-table-cell">
<H1>Notice</H1>
<P>최신 공지사항을 확인해주세요.<BR>읽지 않을시에는 불이익을 당할 우려가 있습니다.</P>
<DIV><A class="buttn buttn-orange" href="notice/notice.php">공지사항확인</A>
</DIV></DIV></DIV></DIV>
<DIV class="cnt3 col-lg-4 col-md-4 col-sm-12 col-xs-12">
<A class="cnt-t clearfix" href="notice/notice.php">
<DIV class="cnt-img text-center cont-table">
<DIV class="cont-table-cell">
<I class="fa fa-star" aria-hidden="true"></I></DIV></DIV>
<DIV class="cnt-txt cont-table">
<DIV class="cont-table-cell">
<H4>6월 계획중인 공연!</H4>
<P>6월 26일 오창 게릴라 공연<BR>6월 29일 대전 게릴라 공연</P></DIV></DIV></A>
<A class="cnt-b clearfix" href="/photo/view.php?table=photo&num=10">
<DIV class="cnt-img text-center cont-table">
<DIV class="cont-table-cell">
<I class="fa fa-photo" aria-hidden="true"></I></DIV></DIV>
<DIV class="cnt-txt cont-table">
<DIV class="cont-table-cell">
<H4>5월 이달의 사진!</H4>
<P>지난달 사진의 주인공입니다!</P></DIV></DIV></A></DIV></SECTION><!--/.info1-wrap-->


<SECTION class="recent-webz-wrapper clearfix">
<DIV class="grid-title"><A href="photo/photo.php">
<H4 class="underline-title">동아리 활동 사진</H4>
<P>피아노 사랑 동아리의 활동 사진입니다.</P></A></DIV>
<DIV class="xe-widget-wrapper ">
<DIV style="padding: 0px !important;">
<DIV class="widgetContainer">
<UL class="grid sol-webzine clearfix">

<?
	$table = "photo";
	include "dbconn.php";
	$sql = "select * from $table order by num desc";


	$result = mysql_query($sql, $connect);
	$total_record = mysql_num_rows($result); // 전체 글 수
	for ($i=0; $i < $total_record && $i < 12; $i++)                    
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
        <DIV class="thumb"><A href="photo/view.php?table=<?=$table?>&amp;num=<?=$item_num?>">
        <DIV class="thumb-img hover-img" style='background-image: url("photo/data/<?=$image_copied?>");'></DIV></A></DIV>
        <DIV class="content">
		    <P class="title clearfix"><A href="photo/view.php?table=<?=$table?>&amp;num=<?=$item_num?>"><?=$item_subject?></A></P>
        <P class="author-area clearfix">
		    <SPAN class="author"><A class="author member_4"><?=$item_nick?></A></SPAN>
        <SPAN class="date"><?=$item_date?></SPAN></P></DIV></LI>
<?
    }
?>
</UL></DIV></DIV></DIV></SECTION><!--.recent-webz-wrapper-->



<SECTION class="video-wrapper clearfix">
<DIV class="video-title"><A href="video/video.php">
<H4 class="underline-title">피아노 공연 동영상</H4>
<P>피아노 사랑 동아리 공연 동영상입니다.</P></A></DIV>

<?
	$table = "video";
	include "dbconn.php";
	$sql = "select * from $table order by num desc";


	$result = mysql_query($sql, $connect);
	$total_record = mysql_num_rows($result); // 전체 글 수

	for ($i=0; $i < $total_record && $i < 3; $i++)                    
   {
      mysql_data_seek($result, $i);     // 포인터 이동        
      $row = mysql_fetch_array($result); // 하나의 레코드 가져오기	      
      $item_num     = $row[num];
      $item_id      = $row[id];
      $item_nick    = $row[nick];
      $item_date    = $row[regist_day];
      $item_date = substr($item_date, 0, 10);  
      $item_subject = str_replace(" ", "&nbsp;", $row[subject]);
      $item_link    = $row[link];
      $image_copied = $row[file_copied_0];


?>
    <STYLE>.video<?=$i?> .video-bg {background-image: url(video/data/<?=$image_copied?>)}</STYLE>
		<DIV class="video<?=$i?> col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<DIV class="video-block">
		<SPAN class="video-link" data-video-id="y-<?=$item_link?>">
		<I class="fa fa-play" aria-hidden="true"></I></SPAN>
		<DIV class="video-bg hover-img"></DIV></DIV>
		<A class="cont-txt"><?=$item_subject?></A></DIV>
<?
    }
?>
</SECTION><!--/.video-wrapper-->


<SECTION class="recent-list-wrapper clearfix">
<DIV class="owl-carousel" id="recent-carousel">
<DIV class="item item-left">
<A class="underline-title" href="notice/notice.php">공지사항</A>				
<DIV class="xe-widget-wrapper ">
<DIV style="padding: 0px !important;">
<DIV class="widgetContainer">

<?	
  $table = "notice";
	include "dbconn.php";
  $sql = "select * from $table order by num desc";
  $result = mysql_query($sql, $connect);
	$total_record = mysql_num_rows($result); // 전체 글 수
   for ($i = 0; $i < $total_record && $i < 6; $i++)                    
   {
      mysql_data_seek($result, $i);     // 포인터 이동        
      $row = mysql_fetch_array($result); // 하나의 레코드 가져오기	      
	  $item_num     = $row[num];
    $item_date = $row[regist_day];
	  $item_date = substr($item_date, 0, 10);  
	  $item_subject = str_replace(" ", "&nbsp;", $row[subject]);
?>

<UL class="sol-list">
  <LI class="clearfix">
  <DIV class="title-group clearfix">
  <A class="title" href="notice/view.php?table=<?=$table?>&amp;num=<?=$item_num?>&amp;page=<?=$page?>"><?= $item_subject ?></A>                 
  </DIV><SPAN class="date"><?= $item_date ?></SPAN>                                  
  </LI>
</UL>

<?
   	   $number--;
   }
?>
</DIV></DIV></DIV></DIV>


<DIV class="item item-right"><A class="underline-title" href="faq/faq.php">FAQ</A>				
<DIV class="xe-widget-wrapper ">
<DIV style="padding: 0px !important;">
<DIV class="widgetContainer">


<?	
  $table = "faq";
	include "dbconn.php";
  $sql = "select * from $table order by num desc";
  $result = mysql_query($sql, $connect);
	$total_record = mysql_num_rows($result); // 전체 글 수
   for ($i = 0; $i < $total_record && $i < 6; $i++)                    
   {
      mysql_data_seek($result, $i);     // 포인터 이동        
      $row = mysql_fetch_array($result); // 하나의 레코드 가져오기	      
	  $item_num     = $row[num];
    $item_date = $row[regist_day];
	  $item_date = substr($item_date, 0, 10);  
	  $item_subject = str_replace(" ", "&nbsp;", $row[subject]);
?>

<UL class="sol-list">
  <LI class="clearfix">
  <DIV class="title-group clearfix">
  <A class="title" href="faq/view.php?table=<?=$table?>&amp;num=<?=$item_num?>&amp;page=<?=$page?>"><?= $item_subject ?></A>                 
  </DIV><SPAN class="date"><?= $item_date ?></SPAN>                                  
  </LI>
</UL>

<?
   	   $number--;
   }
?>
  
</DIV></DIV></DIV></DIV></DIV></SECTION><!--.recent-list-wrapper-->
<SECTION class="content-wrapper clearfix">
<DIV class="content col-lg-12 clearfix" id="content"></DIV></SECTION><!--.content--> 
</DIV><!--.main container-->	 
<? include "help.php"; ?>
<? include "foot.php"; ?>

<A id="toTop" href="index.php/#top"><I class="fa fa-chevron-up"></I></A> 
<DIV class="xe-widget-wrapper ">
<DIV style="padding: 0px !important;"><!--.login-widget--></DIV></DIV><!-- ETC --> 
<DIV class="wfsr"></DIV>
<SCRIPT src="resource/b7eb2a149f84f739f69ad54751a280b5.ko.compiled.js"></SCRIPT>
<SCRIPT src="resource/0ab33566cc291decfb406ddb3dd9e4dd.ko.compiled.js"></SCRIPT>
</BODY></HTML>