<?php
session_start();
$email=$_SESSION ["email"];

   include_once("dbconnect.php");

       if (isset($_POST['submit'])) {
         $primage = uniqid() . '.png';
          $prname = $_POST['prname'];
          $prtype = $_POST['prtype'];
          $prprice = $_POST['prprice'];
          $prqty = $_POST['prqty'];
          
      
          if (file_exists($_FILES["primage"]["tmp_name"]) || is_uploaded_file($_FILES["primage"]["tmp_name"])) {
              $sqlinsertprod =  "INSERT INTO tbl_products(image,prname, prtype, prprice, prqty) VALUES('$primage','$prname','$prtype','$prprice','$prqty')";
              if ($conn->exec($sqlinsertprod)) {
                  uploadImage($primage);
                  echo "<script>alert('Success')</script>";
                  echo "<script>window.location.replace('../user/index.php')</script>";
              } else {
                  echo "<script>alert('Failed')</script>";
                  echo "<script>window.location.replace('../user/newproduct.php')</script>";
                  return;
              }
          } else {
              echo "<script>alert('Image not available')</script>";
              echo "<script>window.location.replace('../user/newproduct.php')</script>";
              return;
          }
      }
      
      function uploadImage($primage)
      {
          $target_dir = "/home10/sopmycom/public_html/project/images/";
          $target_file = $target_dir . $primage;
          move_uploaded_file($_FILES["primage"]["tmp_name"], $target_file);
      }
      
      ?>
<!DOCTYPE html>
<html>
<head>
      <title>New Product Registration</title>
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
        <p>New Product Registration</p>
        <center>
   <h2>Welcome <?php echo $email?> to Ninjaz</h2></center>
    <br>
    </div>

      <div class="navbar">
         
         <a class="back" href="main_page_admin.php"class="right"><i class="fa fa-arrow-left"></i> Back to Main Page</a>
      </div>
      <div class="container">
            <form name="addNew" action="/project/php/user/newproduct.php" onsubmit="return validateAddNew() " method="post" enctype="multipart/form-data" >

               <div class="row" align="center">
                   <img class="imgselection" src="/project/images/camera1.jpg"><br>
                   <input type="file" onchange="previewFile()" name="primage" id="idimage" accept="image/*"><br>
               </div>
               <div class="row">
                    <div class="col-25">
                        <i class="  fa fa-mobile-phone"></i>
                        <label for="prname">Product Name </label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="idpname" name="prname" placeholder="Your Product name..">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <i class="fa fa-search"></i>
                        <label for="prtype">Product Type</label>
                    </div>
                    <div class="col-75">
                        <select name="prtype" id="idptype">
                            <option value="noselection">Please Select Your Product Type</option>
                            <option value="Phone Case">Phone Case</option>
                            <option value="Earphone">Earphone</option>
                            <option value="Charger">Charger</option>
                            <option value="Powerbank">Powerbank</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        
                        <i class="fa fa-money"></i>
                        <label for="prprice">Product Price (RM) </label>
                    </div>
                    <div class="col-75">
                        <input type="number" id="idprice" name="prprice" placeholder="Your Product price.." min="1" max="100">
                    </div>
                </div>

                <div class="row">
                    <div class="col-25">
                        <i class="fa fa-sort-numeric-asc"></i>
                        <label for="prqty">Product Quantity</label>
                    </div>
                    <div class="col-75">
                        <input type="number" id="idquantity" name="prqty" placeholder="Your Product Quantity.."min="1" max="100">
                    </div>
                </div>
                <br>
                <br>
       
                <div class="row">
                    <div><input type="submit" name="submit" value="Add New Product"></div>
                </div>

            </form>

        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
    <div class="footer">
        <p>Ninjaz Malaysia Sdn. Bhd. (1259993-K) Copyright <span>&#169;</span> 2021 All Rights Reserved. Website
            developed by Man Nee</p>
    </div>
    </body>
</html>
<script>
    function previewFile() {
    const preview = document.querySelector('.imgselection');
    const file = document.querySelector('input[type=file]').files[0];
    const reader = new FileReader();
    reader.addEventListener("load", function () {
        // convert image file to base64 string
           preview.src = reader.result;
    }, false);
    
    if (file) {
        reader.readAsDataURL(file);
    }
}
    </script>



