<?php
error_reporting(0);
include_once("dbconnect.php");
$email = $_GET['email'];
$mobile = $_GET['mobile'];
$amount = $_GET['amount'];
$remark=$_GET['remark'];

$data = array(
    'id' =>  $_GET['billplz']['id'],
    'paid_at' => $_GET['billplz']['paid_at'] ,
    'paid' => $_GET['billplz']['paid'],
    'x_signature' => $_GET['billplz']['x_signature']
);

$paidstatus = $_GET['billplz']['paid'];

if ($paidstatus=="true"){
  $receiptid = $_GET['billplz']['id'];
  $signing = '';
    foreach ($data as $key => $value) {
        $signing.= 'billplz'.$key . $value;
        if ($key === 'paid') {
            break;
        } else {
            $signing .= '|';
        }
    }
    
    $signed= hash_hmac('sha256', $signing, 'S-Os7psFnvf2GHQRWQ0yUD0A');
    if ($signed === $data['x_signature']) {
        

    }
    $sqlinsertpurchased = "INSERT INTO tbl_paid(orderid,email,paid,remark,status) VALUES('$receiptid','$email', '$amount','$remark','paid')";
    $sqldeletecart = "DELETE FROM tbl_cart WHERE email='$email'";

    if ($conn->exec($sqlinsertpurchased) && $conn->exec($sqldeletecart)) {
        echo "<script>alert('Payment Completed')</script>";
      

      echo'  <br><br><body><div><h2><br><br><center>Your Receipt</center>
     </h1>
     <table border=1 width=80% align=center>
     <tr><td>Receipt ID</td><td>'.$receiptid.'</td></tr><tr><td>Email to </td>
     <td>'.$email. ' </td></tr><td>Amount </td><td>RM '.$amount.'</td></tr>
     <tr><td>Payment Status </td><td>Completed</td></tr>
     <tr><td>Remarks </td><td>'.$remark.'</td></tr>
     <tr><td>Date </td><td>'.date("d/m/Y").'</td></tr>
     <tr><td>Time </td><td>'.date("h:i a").'</td></tr>
     </table><br>
     <p><center><a href="/project/php/user/index.php" >Press Back Button To Return To Ninjaz</a></center></p></div></body>';
     

    }
      
}
else{
     echo "<script>alert('Payment Failed')</script>";
     echo "<script>window.location.replace('../user/cart.php')</script>";
}
?>