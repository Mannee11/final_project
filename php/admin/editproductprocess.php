<?php
 $primage = uniqid() . '.png';
 $prid=$_POST['prid'];
 $prname=$_POST['prname'];
 $prtype = $_POST['prtype'];
 $prprice = $_POST['prprice'];
 $prqty = $_POST['prqty'];

 $conn = mysqli_connect("localhost","sopmycom_adminmyshop","i58[uBtsBU#k") or die("Unable to connect");
  mysqli_select_db($conn,"sopmycom_myshop"); 

  $sql="UPDATE tbl_products SET image ='$primage', prname='$prname', prtype = '$prtype', prprice = '$prprice', prqty = '$prqty' WHERE prid='$prid'";

   $result= mysqli_query($conn,$sql) or die(mysqli_error());
   if($result == true){
        uploadImage($primage);
        echo '<script type="text/javascript"> alert("Are you sure you want to save your edit?")</script>';
        echo "<script>window.location.replace('../admin/main_page_admin.php')</script>";
   }else{
           echo "Error";
   }
   function uploadImage($primage)
   {
     $target_dir = "/home10/sopmycom/public_html/project/images/";
     $target_file = $target_dir . $primage;
     move_uploaded_file($_FILES["primage"]["tmp_name"], $target_file);
   }
?>