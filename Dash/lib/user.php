<?php
require('dbh.php');
$username=$_POST['enname'];
$check_query=mysqli_query($conn,"SELECT username FROM users WHERE username='$username' ");
if(mysqli_num_rows($check_query)>0){
	echo 1;
}else {echo 0;}
mysqli_close($conn);

?>