<?php
session_start();
include_once("dbconnect.php");

if (isset($_POST['submit'])) {
    $email = trim($_POST['email']);
    $password = trim(sha1($_POST['password']));
    $sqllogin = "SELECT * FROM tbl_admin WHERE email = '$email' AND password = '$password' AND otp = '1'";

    $select_stmt = $conn->prepare($sqllogin);
    $select_stmt->execute();
    $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
    if ($select_stmt->rowCount() > 0) {
        $_SESSION["session_id"] = session_id();
        $_SESSION["email"] = $email;
        $_SESSION["name"] = $row['name'];
        $_SESSION["phone"] = $row['phone'];
        $_SESSION["pass"] = $row['password'];
        $_SESSION["datereg"] = $row['datereg'];
        echo "<script> alert('Login Successful')</script>";
        echo "<script> window.location.replace('/project/php/admin/main_page_admin.php')</script>";
    } else {
        session_unset();
        session_destroy();
        echo "<script> alert('Login Fail. Please Verify / Register Your Account.')</script>";
        echo "<script> window.location.replace('../login_admin.php')</script>";
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
	<link rel="shortcut icon" type="image" href="../images/logo.png">
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

		<a href="/project/index.html" class="left">Home</a>
		<a href="#news" class="left">News</a>
		<a href="#contact" class="left">Contact</a>
	</div>
	<div class="main">
		<center>
			<h1>Login into Admin Account</h2>
		</center>
		<div class="container">
			<form name="loginForm" action="/project/php/admin/login_admin.php"  onsubmit="return validateLoginForm()" method="post">
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
					<div class="forget">
						<a style="text-decoration:none;color: white;font-weight: bold" href="forget_password.php">Forgot password ?</a>
					</div>
				</div>
				<!-- <div class="row">
					<div class="col-75">
					<div>
					<label>
					<input type="checkbox" checked="checked" name="remember"> Remember me
					</label>
					</div>
					</div>
				</div> -->
				<br>
				<br>
				<div class="row">
					<input type="submit" name="submit" value="Login">
				</div>
			</form>
		</div>


	</div>



</body>

</html>