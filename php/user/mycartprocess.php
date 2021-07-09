<?php
   $email= $_GET['email']; 
   $name = $_GET['name'];
   $mobile = $_GET['phone'];
   $pickup = $_GET['pickup'];
   $remark=$_GET['remark'];
   $amount = $_GET['price'];

   $api_key = '86ec44ac-1c4e-4c9d-af62-8fc67d167461';
   $collection_id = '3cnkh6j4';
   $host = 'https://billplz-staging.herokuapp.com/api/v3/bills';

   $data = array(
       'collection_id' => $collection_id,
       'email' => $email,
       'mobile' => $mobile,
       'name' => $name,
       'amount' => $amount * 100, // RM20
       'description' => 'Payment for order',
       'callback_url' => "https://sopmy520.com/project/php/user/index.php",
       'redirect_url' => "https://sopmy520.com/project/php/user/payment_update.php?email=$email&name=$name&mobile=$mobile&remark=$remark&amount=$amount"
   );
   $process = curl_init($host);
   curl_setopt($process, CURLOPT_HEADER, 0);
   curl_setopt($process, CURLOPT_USERPWD, $api_key . ":");
   curl_setopt($process, CURLOPT_TIMEOUT, 30);
   curl_setopt($process, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($process, CURLOPT_SSL_VERIFYHOST, 0);
   curl_setopt($process, CURLOPT_SSL_VERIFYPEER, 0);
   curl_setopt($process, CURLOPT_POSTFIELDS, http_build_query($data));

   $return = curl_exec($process);
   curl_close($process);

   $bill = json_decode($return, true);

   header("Location: {$bill['url']}");
?>