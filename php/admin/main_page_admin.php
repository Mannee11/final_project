
<?php
session_start();
$email=$_SESSION ["email"];

?>
<!DOCTYPE html>
<html>
   <head>
      <title>Welcome to Ninjaz</title>
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
    <a href="/project/php/admin/editadminprofile.php" class="right"><i class="fa fa-user-circle"></i>    Profile</a>
		<a href="/project/php/admin/login_admin.php" class="right"><i class="fa fa-sign-out"></i>    Logout</a>
		
	</div>
   <center>
   <h2>Welcome <?php echo $email?> to Ninjaz</h2></center>
    <br>
    
        <form action="search_product.php" method="POST">
            <div class="row">
                <div class="column">
                    <input type="text" id="idname" name="prname" placeholder="Product name..">
                </div>
                <div class="column">
                    <select id="idtype" name="prtype">
                        <option value="all">All</option>
                        <option value="powerbank">Powerbank</option>
                        <option value="phone case">Phone Case</option>
                        <option value="charger">Charger</option>
                        <option value="earphone">Earphone</option>
                    </select>
                </div>
                <div class="column">
            <button type="submit" name="button" value="search"><i class="fa fa-search" style="height:15px;
font-size: 15.0;"></i></button></button>
            </div>
            </div>
        </form>
      

      <div class="row">
         <?php
            $conn = mysqli_connect("localhost","sopmycom_adminmyshop","i58[uBtsBU#k") or die("Unable to connect");
            mysqli_select_db($conn,"sopmycom_myshop");
            
            $sql ="SELECT * FROM tbl_products ORDER BY prid DESC";
            $result=mysqli_query($conn,$sql);
            if(mysqli_num_rows($result)>0){
            	while($row=mysqli_fetch_assoc($result)){
         ?>
         <div class="column-card" >
            <div class="card">
               <div class="left">
                  <!-- <div style="float:left;width:25%;text-align:center;padding:10px 50px 18px 50px"> -->
                  <img src = "/project/images/<?php echo $row['image'];?>" height=80% width=80%/>
               </div>
               <div class="right">
                  <p>Product Name: &nbsp&nbsp<?php echo $row['prname']; ?></p>
                  <p>Product Type: &nbsp&nbsp<?php echo $row['prtype']; ?></p>
                  <p>Product Price: &nbsp&nbsp<?php echo $row['prprice']; ?></p>
                  <p>Quantity: &nbsp&nbsp<?php echo $row['prqty']; ?></p>
                  <a href='edit_product.php?prid=<?php echo $row['prid']; ?>' class='fa fa-pencil' style="text-decoration: none; color:black; font-weight: bold; font-size: 25px; padding-left:40px"> &nbsp&nbsp 
                            <a href='deleteproduct.php?prid=<?php echo $row['prid']; ?>' class='fa fa-trash' onclick='return deleteDialog()' style="text-decoration: none; color:black; font-weight: bold; font-size: 25px; padding-left:40px"></a></a></p>
               </div>

            </div>
         </div>
         <?php
            }}
         ?>
      </div>
	<br>
	<br>
    <br>
    <br>
    <br>
      <a href="/project/php/admin/newproduct.php" class="float">
          <i class="fa fa-plus my-float"></i>
          <span class="tooltiptext">Add New Product</span>
        </a>
        <div class="footer">
        <p>Ninjaz Malaysia Sdn. Bhd. (1259993-K) Copyright <span>&#169;</span> 2021 All Rights Reserved. Website
            developed by Man Nee</p>
    </div>
   </body>
</html>