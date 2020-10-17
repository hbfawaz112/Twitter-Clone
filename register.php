<?php

 session_start();

 require_once('dbconnect.php');

 if(isset($_SESSION['user']))
 {
    header('Location: home.php');
 }

 if(isset($_POST['username']) && isset($_POST['password']))
 {
     $firstname=$_POST['firstname'];
     $lastname=$_POST['lastname'];
     
     $username=$_POST['username'];
     $passwrod=$_POST['password'];
     $dob=$_POST['dob'];
     $bio=null;
     $result=$db->users->insertOne(array('firstname'=>$firstname,'lastname'=>$lastname,'username'=>$username , 'password'=>$passwrod,'dob'=>$dob, 'bio'=>$bio ));
    header('Location: index.php');
     
 }

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>


<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">


<div class="container">



<div style="margin-top:150px; width:550px; margin-left:250px "  class="card">
<article class="card-body">
	<h4 class="card-title text-center mb-4 mt-1">Create Account</h4>
	
	
	<form method="post" action="register.php"> 
	
	<div class="form-group">
	<div class="input-group">
		<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
		 </div>
		<input name="firstname" class="form-control" placeholder="First Name" type="text">
	</div> <!-- input-group.// -->
	</div>
	
	
	<div class="form-group">
	<div class="input-group">
		<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
		 </div>
		<input name="lastname" class="form-control" placeholder="Last Name" type="text">
	</div> <!-- input-group.// -->
	</div>
	
	<div class="form-group">
	<div class="input-group">
		<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
		 </div>
		<input name="username" class="form-control" placeholder="Email or Username" type="text">
	</div> <!-- input-group.// -->
	</div> <!-- form-group// -->
	<div class="form-group">
	<div class="input-group">
		<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
		 </div>
	    <input class="form-control" name="password" placeholder="******" type="password">
	</div> <!-- input-group.// -->
	</div> <!-- form-group// -->
	
		<div class="form-group">
	<div class="input-group">
		<div class="input-group-prepend">
		    <span class="input-group-text"> <i class="fas fa-calendar-alt"></i> </span>
		 </div>
		<input name="dob" class="form-control" placeholder="Date of birthday" type="date">
	</div> <!-- input-group.// -->
	</div>
	
	
	<div class="form-group">
	<button type="submit" class="btn btn-primary btn-block"> Sign Up  </button>
	</div> <!-- form-group// -->
	<p class="text-center"><a href="index.php" class="btn">Already have an acount? - Signin</a></p>
	</form>
</article>
</div> <!-- card.// -->
 