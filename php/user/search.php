<html>
<head>
      <title>Searching Results</title>
      <link rel="shortcut icon" type="image" href="/project/images/logo.png">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="/project/css/search.css">
   </head>
  
<body>
<a class="back" href="index.php"><i class="fa fa-arrow-left"></i></a>
  <div class="header">
  <h2 style="text-align:center">That result that your searching ....</h2>
  </div>
  <?php

	$conn = mysqli_connect("localhost","sopmycom_adminmyshop","i58[uBtsBU#k") or die("Unable to connect");
				mysqli_select_db($conn,"sopmycom_myshop");

   $prname = $_POST['prname'];
   $prtype = $_POST['prtype'];

   if ($prtype == "all") {
       $sqlsearch = "SELECT * FROM tbl_products WHERE prname LIKE '%$prname%' ORDER BY prid DESC" ;
   } else {
       $sqlsearch = "SELECT * FROM tbl_products WHERE prtype = '$prtype' AND prname LIKE '%$prname%'ORDER BY prid DESC ";
   }


$sql = $conn -> query($sqlsearch);
if($sql->num_rows >0){
    while ($row = $sql->fetch_array()){
    
       ?>
       <div class="row">
   <div class="column-card" >
            <div class="card">
               <div class="left">
                  <!-- <div style="float:left;width:25%;text-align:center;padding:10px 50px 18px 50px"> -->
                  <img src = "/project/images/<?php echo $row['image'];?>" height=70% width=70%/>
               </div>
               <div class="right">
                  <p>Product Name: &nbsp&nbsp<?php echo $row['prname']; ?></p>
                  <p>Product Type: &nbsp&nbsp<?php echo $row['prtype']; ?></p>
                  <p>Product Price: &nbsp&nbsp<?php echo $row['prprice']; ?></p>
                  <p>Quantity: &nbsp&nbsp<?php echo $row['prqty']; ?></p>
               </div>
            </div>
         </div>
         </div>
    <?php
    }
}
else{
   echo "<script>alert('There are no result')</script>";
   echo "<script>window.location.replace('../php/index.php')</script>";
}
?>

</body>
</html>