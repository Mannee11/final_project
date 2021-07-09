<?php
session_start();
$email=$_SESSION ["email"];

	include_once("dbconnect.php");

       if (isset($_POST['submit'])) {
         //$primage = uniqid() . '.png';
         // $prname = $_POST['prname'];
         // $prtype = $_POST['prtype'];
        //  $prprice = $_POST['prprice'];
        $prid = $_POST['prid'];
          $qty = $_POST['qty'];
         // $prremarks = $_POST['prremarks'];
          
      
          //if (file_exists($_FILES["primage"]["tmp_name"]) || is_uploaded_file($_FILES["primage"]["tmp_name"])) {
              $sqlinsertcart =  "INSERT INTO tbl_cart(email,prid,qty) VALUES('$email','$prid','$qty')";
              if ($conn->exec($sqlinsertcart)) {
                 
                  echo "<script>alert('Success')</script>";
                  echo "<script>window.location.replace('../user/index.php')</script>";
              } else {
                  echo "<script>alert('Failed')</script>";
                  echo "<script>window.location.replace('../user/cart.php')</script>";
                  return;
              }
          /*else {
              echo "<script>alert('Image not available')</script>";
              echo "<script>window.location.replace('../user/cart.php')</script>";
              return;
          }*/
       }
      
      /* function uploadImage($primage)
       {
           $target_dir = "/xampp/htdocs/project/images/";
           $target_file = $target_dir . $primage;
           move_uploaded_file($_FILES["primage"]["tmp_name"], $target_file);
       }*/
       
      
?>

<!DOCTYPE html>
<html>
<head>
      <title>Add to Cart</title>
      <link rel="shortcut icon" type="image" href="/project/images/logo.png">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="/project/css/stt.css">
      <script src="/project/js/validate.js"></script>
      
   </head>
   
	<body>

		 
    <div class="header">
      <img src="/project/images/logo.png" alt="Logo" >
        <h1>Ninjaz</h1>
       	<h2>Add to Cart </h2>
    </div>
		<div class="navbar">
			<a href="../user/index.php" class="right">Main Page</a>
		</div>
		<div class="main">
			<br>
			<div class="container">
				<?php
					$prid=$_GET['prid'];
					
					$conn = mysqli_connect("localhost","sopmycom_adminmyshop","i58[uBtsBU#k") or die("Unable to connect");
					mysqli_select_db($conn,"sopmycom_myshop");
					
					$sql ="SELECT * FROM tbl_products WHERE prid=".$prid++;
					
                  $result = mysqli_query($conn,$sql);
                    if($result ==true){
						     $row= mysqli_fetch_assoc($result);
						     $prname=$row['prname'];
						     $prtype = $row['prtype'];
						     $prprice = $row['prprice'];
						     $prqty = $row['prqty'];
					     }
				?>
				
           <form name="newForm" action="../user/cart.php" onsubmit="return validateNewForm()" method="post" enctype="multipart/form-data">
               <div class="row" align="center">
                  <img class="imgselection" src="/project/images/<?php echo $row['image'];?>"><br>
                  <!-- <input type="file" onchange="previewFile()" name="primage" id="idimage" accept="image/*" ><br> -->
               </div>
               <br>
               
                   <div class="row"align="center" style="text-align:center;font-size:18px;color:darkslateblue" >
                  
                     <label for="prname" ><b><?php echo $row['prname']; ?></b></label>
                  
               </div>
                <div class="row"align="center" style="text-align:center;font-size:18px;color:darkslateblue" >
                  
                     <label for="prtype"><b>Product Type: <?php echo $row['prtype'];?></b></label>
                  </div>
               
                <div class="row"align="center" style="text-align:center;font-size:18px;color:darkslateblue" >
                  
                     <label for="prprice"><b>Product Price: RM<?php echo $row['prprice'];?></b></label>
                  </div>
               
               <br><br>
               <div class="row">
                  <div class="col-25">
                     <i class="fa fa-sort-numeric-asc icon"></i>
                     <label for="qty"><b>Quantity: </b></label>
                  </div>
                  <div class="col-75">
                     <input type="number" id="idqty" name="qty" placeholder="Select product quantity that you want to order.." min="1" max="<?php echo $row['prqty'];?>">
                  </div>
               </div>
     <!--          <div class="row">-->
					<!--	<div class="col-25">-->
					<!--		<i class="fa fa-pencil icon"></i>-->
					<!--		<label for="prqty"><b>Remarks: <b></label>-->
					<!--	</div>-->
					<!--	<div class="col-75">-->
					<!--		<input type="text" id="idremarks" name="prremarks" placeholder="Please key in your remarks">-->
					<!--	</div>-->
					<!--</div>-->
               <input type="hidden" name="prid" value="<?php echo $row["prid"]; ?>"/><br>
               <div class="row">
                  <div><input type="submit" name="submit" value="Add To Cart"></div>
               </div>
            </form>
         </div>
      </div>
      <br>
      <div class="footer">
        <p>Ninjaz Malaysia Sdn. Bhd. (1259993-K) Copyright <span>&#169;</span> 2021 All Rights Reserved. Website
            developed by Man Nee</p>
    </div>
   </body>
</html>