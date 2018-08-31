<?
   include "../dbconn.php";

   $sql ="select * from survey";
   $result = mysql_query($sql, $connect);
   $row = mysql_fetch_array($result);

   $total = $row[ans1] + $row[ans2] + $row[ans3] + $row[ans4]; 

   $ans1_percent = $row[ans1]/$total * 100;
   $ans2_percent = $row[ans2]/$total * 100;
   $ans3_percent = $row[ans3]/$total * 100;
   $ans4_percent = $row[ans4]/$total * 100;

   $ans1_percent = floor($ans1_percent);
   $ans2_percent = floor($ans2_percent);
   $ans3_percent = floor($ans3_percent);
   $ans4_percent = floor($ans4_percent);
?>
<html>
 <head>
  <title> 설문조사 </title>
  <LINK href="../resource/aroundyou.css" rel="stylesheet"> 
  <meta charset="utf-8">
 </head>
<body>
			
    <table width=100% height=100% border='0' cellspacing='0' cellpadding='0'>
        <tr>
          <td width=100% height=5% colspan=5 bgcolor=#ffffff></td>
        </tr>
        <tr>
          <td height=5% bgcolor='#ffffff'></td>
          <td bgcolor='#ffffff'></td>
          <td width=100%  align=center bgcolor='#ffffff'><b> 
          총 투표수 : <? echo $total ?> &nbsp;명 </b></td>
          <td width=5% bgcolor='#ffffff'></td>
          <td width=5% bgcolor='#ffffff'></td>
        </tr>
        <tr>
          <td height=5% bgcolor='#ffffff'></td>
          <td></td>
          <td valign=middle><b>♬ 가장 좋아하는 피아노 음악 장르는?</b></td>
          <td></td>
          <td bgcolor='#ffffff'></td>
        </tr>
        <tr>
          <td height=5% bgcolor='#ffffff'></td>
          <td></td>
          <td> 클래식 (<b><? echo $ans1_percent ?></b> %)
            <font color=purple><b><? echo $row[ans1] ?></b></font> 명</td>
          <td></td>
          <td bgcolor='#ffffff'></td>
        </tr>
        <tr>
          <td height=3% bgcolor='#ffffff'></td>
          <td></td>
          <td>
    <table width=100% border=0 height=3% cellspacing=0 cellpadding=0>
        <tr>
<?
   $rest = 100 - $ans1_percent;
   echo "
        <td width='$ans1_percent%' bgcolor=purple></td>
        <td width='$rest%' bgcolor='#dddddd' height=5></td>
               ";
?>
        </tr>
    </table>	
          </td>
          <td></td>
          <td bgcolor='#ffffff'></td>
        </tr>
        <tr>
          <td height=5% bgcolor='#ffffff'></td>
          <td></td>
          <td> 뉴에이지 (<b><? echo $ans2_percent ?></b> %)
            <font color=blue><b><? echo $row[ans2] ?></b></font> 명</td>
          <td></td>
          <td bgcolor='#ffffff'></td>
        </tr>
        <tr>
          <td height=3% bgcolor='#ffffff'></td>
          <td></td>
          <td>
    <table width=100% border=0 height=3% cellspacing=0 cellpadding=0>
        <tr>
<?
   $rest = 100 - $ans2_percent;
   echo "
        <td width='$ans2_percent%' bgcolor=blue></td>
        <td width='$rest%' bgcolor='#dddddd' height=5></td>
               ";
?>
        </tr>
    </table>	
          </td>
          <td></td>
          <td bgcolor='#ffffff'></td>
        </tr>
        <tr>
          <td height=5% bgcolor='#ffffff'></td>
          <td></td>
          <td> 재즈 (<b><? echo $ans3_percent ?></b> %)
            <font color=green><b><? echo $row[ans3] ?></b></font> 명</td>
          <td></td>
          <td bgcolor='#ffffff'></td>
        </tr>
        <tr>
          <td height=3% bgcolor='#ffffff'></td>
          <td></td>
          <td>
    <table width=100% border=0 height=3% cellspacing=0 cellpadding=0>
        <tr>
<?
     $rest = 100 - $ans3_percent;
     echo "
          <td width='$ans3_percent%' bgcolor=green></td>
          <td width='$rest%' bgcolor='#dddddd' height=5></td>
               ";
?>
        </tr>
    </table>	
          </td>
          <td></td>
          <td bgcolor='#ffffff'></td>
        </tr>

        <tr>
          <td height=5% bgcolor='#ffffff'></td>
          <td></td>
          <td> 동요 (<b><? echo $ans4_percent ?></b> %)
            <font color=skyblue><b><? echo $row[ans4] ?></b></font> 명</td>
          <td></td>
          <td bgcolor='#ffffff'></td>
        </tr>
        <tr>
          <td height=3% bgcolor='#ffffff'></td>
          <td></td>
          <td>
    <table width=100% border=0 height=3% cellspacing=0 cellpadding=0>
        <tr>
<?
   $rest = 100 - $ans4_percent;
     echo "
          <td width='$ans4_percent%' bgcolor=skyblue></td>
          <td width='$rest%' bgcolor='#dddddd' height=5></td>
               ";
?>
         </tr>
     </table>
          </td>
          <td></td>
          <td bgcolor='#ffffff'></td>
        </tr>
        <tr>
          <td height=10% bgcolor='#ffffff'></td>
          <td></td>
          <td align=center valign=middle>
              <A class="buttn buttn-gray" onclick="window.close()">닫기</A></td>
          <td></td>
          <td bgcolor='#ffffff'></td>
        </tr>
        <tr>
          <td height=1% colspan=5 bgcolor=#ffffff></td>
        </tr>
    </table>
</body>
</html>

