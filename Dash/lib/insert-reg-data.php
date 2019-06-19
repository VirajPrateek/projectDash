<?php
require('dbh.php');

$username = mysqli_real_escape_string($conn, $_POST['name']);
$email= mysqli_real_escape_string($conn, $_POST['email']);
$pass=mysqli_real_escape_string($conn, $_POST['pass']);
 $pass=sha1($pass);
$cpass=mysqli_real_escape_string($conn, $_POST['cpass']);

$query=mysqli_query($conn,"INSERT INTO users (username, email, passwords) VALUES ('$username','$email','$pass')");

 if($query){
   
   echo "<span style='color: #FA8072'>Good Work $username!<br>You've been registered <br> with the email<br>$email</span>";
 }
 else{
 	echo "<span style='color: #FA8072'>Oophs!<br> That's embarassing!<br>Something went wrong. ";
 }



?>