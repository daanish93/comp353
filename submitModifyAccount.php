<?php
 session_start();
 if(isset($_POST['type']) && isset($_POST['category']) 
    && isset($_POST['transaction_limit']) && isset($_POST['balance'])){

   $account_number = $_POST['account_number'];
   $type = $_POST['type'];
   $category = $_POST['category'];
   $balance = $_POST['balance'];
   $transaction_limit = $_POST['transaction_limit'];

   $servername = "localhost";
   $username = "root";
   $password_db = "";
   // Create connection
   $conn = new mysqli($servername, $username, $password_db);

   if ($conn->connect_error) {
       die("Connection failed: " . $conn->connect_error);
   }

   $sql = "USE kec353_2";

   if ($conn->query($sql) === TRUE) {

   } else {
       echo "<br>" . $conn->error;
   }

   $interest_rate_id = 'NULL';
   if($type == 'savings'){
     $interest_rate_id = 1;
   }

   $sql = "UPDATE account SET balance=$balance, interest_rate_id=$interest_rate_id, 
            account_type='$type', account_category= '$category', transaction_limit=$transaction_limit 
            WHERE account_number=$account_number;";

    echo $sql;

   if ($conn->query($sql) == TRUE) {
     //echo "<script>M.toast({html: 'Account modified Successfully', classes: 'rounded'});</script>";
    header('Location: accounts.php');

   } else {
       echo "<script>alert('Failure: Account Not Modified');</script>";
       //header('refresh:1;url=accounts.php');
   }


 }
 else{
   echo "<script>alert('Failure: Account Not Modified');</script>";
   //header('refresh:1;url=accounts.php');
 }
  ?>
