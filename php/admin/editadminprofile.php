<?php
    include 'dbconnect.php';
    session_start();
	$email=$_SESSION['email'];

	$conn = mysqli_connect("localhost","sopmycom_adminmyshop","i58[uBtsBU#k") or die("Unable to connect");
    mysqli_select_db($conn,"sopmycom_myshop");
    
	$query=mysqli_query($conn,"SELECT * FROM tbl_admin where email='$email'")or die(mysqli_error());
	$row=mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html>
	<head>
    	<title>Edit Admin Profile</title>
        <link rel="shortcut icon" type="image" href="/project/images/logo.png">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="/project/css/stt.css">
	</head>

	<body>
    <div class="header">
   <img src="/project/images/logo.png" alt="Logo" >
        <h1>Ninjaz</h1>
        <p>King of Mobile Phone Accessories</p>
        
       
    </div>

    	<div class="navbar">
        	<a href="/project/php/admin/main_page_admin.php" class="right">Back to Main Page <i class="fa fa-level-up"></i></a>
    	</div>

    	<div class="main">
            <center>
        	<h2>Edit Profile</h2>
</center>
        <div class="container">

        <?php
            $email=$_SESSION ["email"];

            $conn = mysqli_connect("localhost","sopmycom_adminmyshop","i58[uBtsBU#k") or die("Unable to connect");
            mysqli_select_db($conn,"sopmycom_myshop");
            $sql ="SELECT * FROM tbl_admin WHERE email=".$email++;
            $result = mysqli_query($conn,$sql);
                if($result ==true){
                	$row= mysqli_fetch_assoc($result);
                    $name=$row['name'];
                    $phone= $row['phone'];
                }
        ?>

            <form name="editAdminProfile" action="/project/php/admin/editadminprofile.php" onsubmit="return validateRegForm()" method="post">
            	<div class="row">
                	<div class="col-25">
                    	<i class="fa fa-user icon"></i>
                    	<label for="fname">Name</label>
                	</div>
                	<div class="col-75">
                    	<input type="text" id="idname" name="name" placeholder="Your Name ..." value="<?php echo $row['name'];?>">
                	</div>
               </div>

            	<div class="row">
                	<div class="col-25">
                    	<i class="fa fa-phone"></i>
                    	<label for="lphone">Phone</label>
                  	</div>
                  	<div class="col-75">
                    	<input type="tel" id="idphone" name="phone" placeholder="Your Phone Number ..." value="<?php echo $row['phone'];?>">
                  	</div>
            	</div>

            	<input type="hidden" id="idemail" name="email" placeholder="Your Email ..." value="<?php echo $row['email'];?>">
            	<br>
				<div class="row">
                	<div><input type="submit" name="update" value="Edit"></div>
            	</div>
            </form>
        </div>
    </div>

    <div class="footer">
        <p>Ninjaz Malaysia Sdn. Bhd. (1259993-K) Copyright <span>&#169;</span> 2021 All Rights Reserved. Website
            developed by Man Nee</p>
    </div>
	</body>
</html>

<?php
	if(isset($_POST['update'])){
		$name = $_POST['name'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $query = "UPDATE tbl_admin SET name = '$name', phone = '$phone' WHERE email = '$email'";
        $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
?>
        <script type="text/javascript">alert("Update Successful");window.location = "main_page_admin.php";</script>
<?php
   }              
?>