<?php
require('../lib/dbh.php');
  session_start();  //for storing current password
  if(isset($_POST['name'])) 
  {
      $name     = trim(strip_tags($_POST['name']));

      if(preg_match('/^\w{4,}$/', $name)){ //alphanumeric and 4 atleast chars because \w equals "[0-9A-Za-z_]"

		  $stmt=$dbcon->prepare("SELECT username FROM users WHERE username=:name");
		  $stmt->execute(array(':name'=>$name));
		  $count=$stmt->rowCount();
		  	  
		  if($count>0)
		  {
			  echo "<span class='error' style='color:brown; font-size:14px'><b>Oophs! </b>Looks like username is already in use.</span>";
		  }
		  else
		  {
			  echo "<span style='color:green;font-size:14px'><b>Available. </b> Press Enter to proceed.</span><script>transit('name')</script>";
		  }
	 } else{
	 	  echo "<span style='color:brown; font-size:14px'>Psst! No special chars.</span>";
	 }
  }
  else if(isset($_POST['email']))
  {
      $email     = $_POST['email'];
      if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false){

      	 $stmt=$dbcon->prepare("SELECT email FROM users WHERE email=:email");
		  $stmt->execute(array(':email'=>$email));
		  $count=$stmt->rowCount();
		  	  
			  if($count>0)
			    {
				  echo "<span style='color:brown; font-size:14px'>Someone is already using this email !</span>";
			   }
			  else
			    {
				 echo "<span style='color:green;font-size:14px'>Press Enter to continue.</span><script>transit('email')</script>";
			  }
	      }else{
	      	echo "<span style='color:brown; font-size:14px'>That does not look like an email !</span>";
	      }
      
	 
  }

  else if(isset($_POST['pass']))
  {   
  	  $pass=$_POST['pass'];
  	  if(strlen($pass)>6){
	      $_SESSION['pass'] =$pass;
	      echo "<span style='color:green;font-size:14px'>Press Enter to continue.</span><script>transit('pass')</script>";
	    }else{
	    	echo "<span style='color:brown; font-size:14px'>Oh C'mon! You can make stronger password than this.</span>";
	    }
  }
  else if(isset($_POST['cpass'])){
  	 $cpass=$_POST['cpass'];	  
	  if($_SESSION['pass']==$cpass)
	  {    
		  echo "<span style='color:green; font-size:14px'>All set!<br><input type='button' name='submit' id='submit' value='I agree to terms and conditions'></span>";
	  }
	  else
	  {
		  echo "<span style='color:brown; font-size:14px;'> Password mismatch. Press Enter to set again.</span><script>transit(2)</script>";
	  }
  }
?>