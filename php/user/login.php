<?php
session_start();
include_once("dbconnect.php");

if (isset($_POST['submit'])) {
    $email = trim($_POST['email']);
    $password = trim(sha1($_POST['password']));
    $sqllogin = "SELECT * FROM tbl_user WHERE email = '$email' AND password = '$password' AND otp = '1'";

    $select_stmt = $conn->prepare($sqllogin);
    $select_stmt->execute();
    $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
    if ($select_stmt->rowCount() > 0) {
        $_SESSION["session_id"] = session_id();
        $_SESSION["email"] = $email;
        $_SESSION["name"] = $row['NAME'];
        $_SESSION["phone"] = $row['PHONE'];
        $_SESSION["pass"] = $row['PASSWORD'];
        $_SESSION["datereg"] = $row['DATEREG'];
        echo "<script> alert('Login Successful')</script>";
        echo "<script> window.location.replace('/project/php/user/index.php')</script>";
    } else {
        session_unset();
        session_destroy();
        echo "<script> alert('Login Fail. Please Verify / Register Your Account.')</script>";
        echo "<script> window.location.replace('../login.php')</script>";
    }
}
if (isset($_GET["status"])) {
    if (($_GET["status"] == "logout")) {
        session_unset();
        session_destroy();
        echo "<script> alert('Session Cleared')</script>";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
	<title>Login Account</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" type="image" href="/project/images/logo.png">
	<script src="/project/js/login.js"></script>
	<link rel="stylesheet" href="/project/css/stt.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>

<body onload="loadCookies()">
	<div class="header">
		<h1>Ninjaz</h1>
		<p>King of Mobile Phone Accessories</p>
	</div>
	<div class="navbar">
		<a href="/project/html/register.html" class="right"><i class="fa fa-plus-circle"></i>     Register</a>
		<a href="/project/index.html" class="left">Home</a>
        <a href="/project/html/about.html" class="left">About</a>
        <a href="/project/html/contactus.html" class="left">Contact Us</a>
	</div>
	<div class="main">
	
		<center>
			<h1>Login into User Account</h2>
		</center>
		<div class="container">
			<form name="loginForm" action="/project/php/user/login.php"  onsubmit="return validateLoginForm()" method="post">
				<div class="row">
					<div class="col-25">
						<i class="fa fa-envelope icon"></i>
						<label for="femail">Email</label>
					</div>
					<div class="col-75">
						<input type="text" id="idemail" name="email" placeholder="Please key in your email">
					</div>
				</div>
				<div class="row">
					<div class="col-25">
						<i class="fa fa-key icon"></i>
						<label for="lname">Password</label>
					</div>
					<div class="col-75">
						<input type="password" id="idpass" name="password" placeholder="Please key in your password">
					</div>
				</div>
				<br>
					<div class="row">
							<div class="col-25">
								<i class="fa fa-clone icon"></i>
								
								<label for="lname">Remember Me </label>
								
								<input type="checkbox" id="idremember" name="rememberme">
								
							</div>
						</div>
				<div class="row">
					<div class="forget">
						<a style="text-decoration:none;color: white;font-weight: bold" href="/project/php/user/forget.php">Forgot password ?</a>
					</div>
				</div>
			
			
				<br>
				<div class="row">
			
					<div><input type="submit" name="submit" value="Login"></div>
				</div>
				
			</form>
		</div>


	</div>



</body>

</html>