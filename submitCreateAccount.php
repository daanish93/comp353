 <?php
 include('createAccount.php');
 session_start();
 if(isset($_POST['account_type']) && isset($_POST['account_category'])){
   $client_id = $_SESSION['client_id'];
   $account_type = $_POST['account_type'];
   $account_category = $_POST['account_category'];

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
   if($account_type == 'savings'){
     $interest_rate_id = 1;
   }

   $sql = "INSERT INTO account(balance, interest_rate_id, account_type, account_category, client_id) VALUES(0,1,'$account_type','$account_category',$client_id);";

   if ($conn->query($sql) === TRUE) {
     echo "<script>M.toast({html: 'Account Created Successfully', classes: 'rounded'});</script>";
    header('Location: welcome.php');

   } else {
       echo "<script>alert('Failure: Account Not Created');</script>";
       header('refresh:1;url=createAccount.php');
   }


 }
 else{
   echo "<script>alert('Failure: Account Not Created');</script>";
   header('refresh:1;url=createAccount.php');
 }
  ?>
