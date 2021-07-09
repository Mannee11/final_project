
<?php
include_once('dbconnect.php');
$prid = $_GET['prid'];
$qty = $_GET['qty'];

$conn = mysqli_connect("localhost","sopmycom_adminmyshop","i58[uBtsBU#k") or die("Unable to connect");
  mysqli_select_db($conn,"sopmycom_myshop"); 
  if ($qty == 1) {
    echo "<script>alert('Failed.')</script>";
    echo "<script> window.location.replace('mycart.php')</script>";
  }
  else{
  $sqlupdatecart = "UPDATE tbl_cart SET qty = qty -1 WHERE prid = $prid";
$result = mysqli_query($conn,$sqlupdatecart);

if($result){
    
    echo "<script> window.location.replace('mycart.php')</script>";
}
else{
    echo "<script>alert('Failed add')</script>";
    echo "<script> window.location.replace('mycart.php')</script>";
}
  }

?>