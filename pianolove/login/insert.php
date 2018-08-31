<meta charset="utf-8">
<?

   $regist_day = date("Y-m-d (H:i)"); 
   $ip = $REMOTE_ADDR;     

   include "../dbconn.php";   

   $sql = "select * from member where id='$id_name'";
   $result = mysql_query($sql, $connect);
   $exist_id = mysql_num_rows($result);

   if($exist_id) {
     echo("
           <script>
             window.alert('이미 존재하는 아이디입니다.')
             history.go(-1)
           </script>
         ");
         exit;
   }
   else
   {     
	    $sql = "insert into member(id, pass, name, nick, hp, email, regist_day, level) ";
		$sql .= "values('$id_name', '$password', '$name', '$nick_name', '$hp', '$email', '$regist_day', 9)";

		mysql_query($sql, $connect); 
   }

   mysql_close();   
   echo "
	   <script>
	    location.href = '../index.php';
	   </script>
	";
?>

   
