<?php
   include_once("dbconnect.php");
?>
<!DOCTYPE html>
<html>
<head>
      <title>Edit the Product</title>
      <link rel="shortcut icon" type="image" href="/project/images/logo.png">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="/project/css/stt.css">
   </head>
   <body>
      <div class="header">
   <img src="/project/images/logo.png" alt="Logo" >

   <center>
        <h1>Ninjaz</h1>
       
        <p>Edit Product</p>
       </center>
    </div>
      <div class="navbar">
         <a href="../admin/main_page_admin.php" class="right">Cancel</a>
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

            <form name="newForm" action="../admin/editproductprocess.php" onsubmit="return validateNewForm()" method="post" enctype="multipart/form-data">
               <div class="row" align="center">
                  <img class="imgselection" src="/project/images/<?php echo $row ['image'];?>"><br>
                  <input type="file" onchange="previewFile()" name="primage" id="idprimage" accept="image/*"><br>
               </div>
               <div class="row">
               <div class="col-25">
                        <i class="  fa fa-mobile-phone"></i>
                        <label for="prname">Product Name </label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="idpname" name="prname" placeholder="Your Product name.." value="<?php echo $row['prname'];?>">
                    </div>
               </div>
               <div class="row">
                  <div class="col-25">
                     <i class="fa fa-suitcase"></i>
                     <label for="prtype">Product Type</label>
                  </div>
                  <div class="col-75">
                  <select name="prtype" id="idptype">
                            <option value="noselection" <?php if($prtype == 'noselection') echo "selected"; ?>>Please Select Your Product Type</option>
                            <option value="Phone Case"<?php if($prtype == 'Phone Case') echo "selected"; ?>>Phone Case</option>
                            <option value="Earphone"<?php if($prtype == 'Earphone') echo "selected"; ?>>Earphone</option>
                            <option value="Charger"<?php if($prtype == 'Charger') echo "selected"; ?>>Charger</option>
                            <option value="Powerbank"<?php if($prtype == 'Powerbank') echo "selected"; ?>>Powerbank</option>
                        </select>
                  </div>
               </div>
               <div class="row">
                    <div class="col-25">
                        
                        <i class="fa fa-money"></i>
                        <label for="prprice">Product Price (RM) </label>
                    </div>
                    <div class="col-75">
                        <input type="number" id="idprice" name="prprice" placeholder="Your Product price.."value="<?php echo $row['prprice'];?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <i class="fa fa-sort-numeric-asc"></i>
                        <label for="prqty">Product Quantity</label>
                    </div>
                    <div class="col-75">
                        <input type="number" id="idquantity" name="prqty" placeholder="Your Product Quantity.."value="<?php echo $row['prqty'];?>">
                    </div>
                </div>
               <input type="hidden" name="prid" value="<?php echo $row["prid"]; ?>"/><br>
               <div class="row">
                  <div><input type="submit" name="update" value="Save My Edit"></div>
               </div>
            </form>
         </div>
      </div>
      <div class="footer">
      <p><b>Copyright 2021 <span>&#169;</span> EZ Papeteria. All rights reserved.</b></p>
      </div>
   </body>
</html>
<script>
   function previewFile() {
       const preview = document.querySelector('.imgselection');
       const file = document.querySelector('input[type=file]').files[0];
       const reader = new FileReader();
       reader.addEventListener("load", function () {
              preview.src = reader.result;
       }, false);
       
       if (file) {
           reader.readAsDataURL(file);
       }
   }
</script>