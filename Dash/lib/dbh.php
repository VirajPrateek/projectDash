<?php

  $host="localhost";
  $user="root";
  $pass="toor";
  $dbname="dash";
  
$dbcon = new PDO("mysql:host={$host};dbname={$dbname}",$user,$pass);

$conn=mysqli_connect('localhost','root','toor','dash');
if(!$conn){
	die('Error:Not Connected to database');
}

?>