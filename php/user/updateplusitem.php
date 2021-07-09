
<?php
include_once('dbconnect.php');

$conn = mysqli_connect("localhost","sopmycom_adminmyshop","i58[uBtsBU#k") or die("Unable to connect");
  mysqli_select_db($conn,"sopmycom_myshop"); 

  $sqlupdatecart = "UPDATE tbl_cart SET qty = qty +1 WHERE prid = '$_GET[prid]'";
$result = mysqli_query($conn,$sqlupdatecart);

if($result){
    
    echo "<script> window.location.replace('mycart.php')</script>";
}
else{
    echo "<script>alert('Failed delete')</script>";
    echo "<script> window.location.replace('mycart.php')</script>";
}
?>