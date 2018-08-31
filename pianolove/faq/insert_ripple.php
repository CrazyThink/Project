<?
   session_start();
?>
<meta charset="utf-8">
<?
   if(!$userid) {
     echo("
	   <script>
	     window.alert('�α��� �� �̿��ϼ���.')
	     history.go(-1)
	   </script>
	 ");
	 exit;
   }   
   include "../dbconn.php";       // dconn.php ������ �ҷ���

   $regist_day = date("Y-m-d (H:i)");  // ������ '��-��-��-��-��'�� ����

   // ���ڵ� ���� ���
   $sql = "insert into faq_ripple (parent, id, name, nick, content, regist_day) ";
   $sql .= "values($num, '$userid', '$username', '$usernick', '$ripple_content', '$regist_day')";    
   
   mysql_query($sql, $connect);  // $sql �� ����� ��� ����
   mysql_close();                // DB ���� ����

   echo "
	   <script>
	    location.href = 'view.php?table=$table&num=$num';
	   </script>
	";
?>

   
