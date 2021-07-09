<?php
$servername = "localhost";
$username = "sopmycom_adminmyshop";
$password = "i58[uBtsBU#k";
$dbname = "sopmycom_myshop";

try {
  $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
  // set the PDO error mode to exception
  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
   
  echo "Connection failed: " . $e->getMessage();
}
?>