<?
	@session_start();
?>
<meta charset="utf-8">
<?

   $regist_day = date("Y-m-d (H:i)");  

   include "../dbconn.php";       

   $sql = "update member set pass='$password', name='$name' , ";
   $sql .= "nick='$nick_name', hp='$hp', email='$email', regist_day='$regist_day' where id='$userid'";

   mysql_query($sql, $connect);  

   mysql_close();           
   echo "
	   <script>
	    location.href = '../index.php';
	   </script>
	";
?>