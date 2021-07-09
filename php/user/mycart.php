<?php
session_start();
$email=$_SESSION ["email"];
include_once("dbconnect.php");


$sqlloadcart = "SELECT * FROM tbl_cart INNER JOIN tbl_products ON tbl_cart.prid = tbl_products.prid WHERE tbl_cart.email = '$email'";
$stmt = $conn->prepare($sqlloadcart);
$stmt->execute();
$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
$rows = $stmt->fetchAll();

?>

<!DOCTYPE html>
<html>

<head>
  <title>My Shopping Cart</title>
  <link rel="shortcut icon" type="image" href="/project/images/logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="/project/css/stt.css">
    
<link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
    
    <div class="header">
      <img src="/project/images/logo.png" alt="Logo" >
        <h1>Ninjaz</h1>
        <p>King of Mobile Phone Accessories</p>
        <h2>My Shopping Cart</h2>
    </div>
    <div class="navbar">
      
        <a href="../user/index.php" class="right">Back to Main Page</a>
        <!-- <a href="html/register.html" class="right">Register</a>
        <a href="html/login.html" class="right">Login</a> -->
        
     </div>
     <div class="row">
         <?php
           $sumtotal = 0.0;
           foreach ($rows as $carts) {
            echo "<div class='column-card'>";
            $prid = $carts['prid'];
            $prqty = $carts['prqty'];
            $qty = $carts['qty'];
            // $prremarks = $carts['prremarks'];
            $total = 0.0;
            $total = $carts['prprice'] * $carts['qty'];
            $imgurl = "/project/images/".$carts['image'];
            ?>
            <div class='card'>
            <p align='right' style='margin-top:-5%;'><a href='deleteselecteditem.php?prid=<?php echo $carts['prid'];?>' class='fa fa-remove' onclick='return deleteDialog()' style="text-decoration: none; color:black; font-weight: bold; font-size: 25px; padding-left:40px"></a></p>
            <?php
						echo "<img src='$imgurl' class='image' width=50% height=50%>";
					?>
            <h3 align='center' ><?php echo $carts['prname']; ?>  </h3>
            <p align='center'> RM <?php echo number_format($carts['prprice'],2) ?>/unit<br></p>
            <table class='center' style='margin-left:40%;'><tr><td><a href='updatedeleteitem.php?prid=<?php echo $carts['prid'];?>&qty=<?php echo $carts['qty'];?>'><i class='fa fa-minus' style='font-size:24px;color:dodgerblue'></i></a></td>
            <td>Qty <?php echo $carts['qty']; ?></td>
            <td>&nbsp<a href='updateplusitem.php?prid=<?php echo $carts['prid'];?>'><i class='fa fa-plus' style='font-size:24px;color:dodgerblue'></i></a></td></tr></table><br>
            Total RM <?php echo number_format($total,2) ?><br>
            <!--<p align='center'> Remarks: <?php echo $carts['prremarks']; ?><br></p>-->
            </div>
            </div>
            <?php
            $sumtotal = $total + $sumtotal;
        }
        echo "</div>";
        
        echo "<div class='container-src'>
        <h3 style='margin-left:30px'>Total Price: RM " . number_format($sumtotal, 2) . "</h3></div>";
        ?>
        </div>
   
    <br>
    <br>
   
    <div class="container">
      <center>
        <h3>Payment Form</h3>
      </center>
        <form action="mycartprocess.php" method="get">
            <div class="row">
                <div class="col-25">
                <i class="	fa fa-envelope"></i>
                    <label for="lblemail">Your Email</label>
                </div>
                <div class="col-75">
                    <input type="text" id="idemail" name="email" value="<?php echo $email ?>" disabled>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                <i class="	fa fa-address-book"></i>
                    <label for="lblname">Your Name</label>
                </div>
                <div class="col-75">
                    <input type="text" id="idname" name="name" placeholder="Your Name" required>
                </div>
            </div>

            <div class="row">
                <div class="col-25">
                <i class="fa fa-mobile-phone"></i>
                    <label for="lphone">Phone Number</label>
                </div>
                <div class="col-75">
                    <input type="text" id="idphone" name="phone" placeholder="Your phone" required>
                </div>
            </div>
            <div class="row">
                <div class="col-25">
                <i class="fa fa-sticky-note"></i>
                    <label for="lremark">Remarks</label>
                </div>
                <div class="col-75">
                    <input type="text" id="idremarks" name="remark" placeholder="Please write your remarks" required>
                </div>
            </div>
           <div class="row">
                  <div class="col-25">
                    <i class="fa fa-clock-o" ></i>
                    <label for="ltime" >Pickup Time</label>
                  </div>
                  <div class="col-75">
                    <input type="time" id="idtime" name="pickup" min="09:00" max="18:00" required>
                  </div>
               </div>
               
            <input type="hidden" id="idprice" name="price" value="<?php echo $sumtotal ?>">
            <input type="hidden" id="email" name="email" value="<?php echo $email ?>">
            <div class="row">
                <div class="col-25">
                </div>
                <div class="col-75">
                    <input type="submit" name="submit" value="Pay">
                </div>
            </div>
        </form>
    </div>
    <br>
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