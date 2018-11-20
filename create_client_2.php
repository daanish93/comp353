<?php
  include('index.php');
if($_SERVER["REQUEST_METHOD"] == "POST"){
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $date_of_birth = $_POST['date_of_birth'];
  $address = $_POST['address'];
  $email = $_POST['email'];
  $phone_number = $_POST['phone_number'];
  $category = $_POST['category'];
  $branch = $_POST['branch'];
  $card_number = $_POST['card_number'];
  $password = $_POST['password'];
/*
  echo "$first_name";
  echo '<br>';
  echo "$last_name";
  echo '<br>';
  echo "$date_of_birth";
  echo '<br>';
  echo "$address";
  echo '<br>';
  var_dump("$email");
  echo '<br>';
  echo "$phone_number";
  echo '<br>';
  echo "$category";
  echo '<br>';
  echo "$branch";
  echo '<br>';
  echo "$card_number";
  echo '<br>';
  echo "$password";
  echo '<br>';
*/
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

  $date_now = date("Y-m-d");

  $sql = "INSERT INTO `client` ( `first_name`, `last_name`, `date_of_birth`, `join_date`, `address`, `email_address`, `phone_number`, `category`, `branch_id`, `card_number`, `password`)
          VALUES ('$first_name', '$last_name', '$date_of_birth', $date_now ,'$address', '$email', '$phone_number', '$category', '$branch', $card_number, '$password')";

  if ($conn->query($sql) === TRUE) {
    echo "<script>M.toast({html: 'Account Created Successfully', classes: 'rounded'});</script>";
    header('refresh:1;url=index.php');

  } else {
      echo "<br>" . $conn->error;
  }
}
