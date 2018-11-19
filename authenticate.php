<?php
  include('index.php');
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $card_number = $_POST['card_number'];
    $password = $_POST['password'];

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


    $sql = "SELECT client_id, password FROM client WHERE card_number=".$card_number.";";
    $result = $conn->query($sql);


    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $client_id = $row['client_id'];
          $auth_password= $row['password'];
        }
    }

    if ($auth_password == $password){
      session_start();
      $_SESSION['client_id'] = $client_id;
      header('Location: welcome.php');
    }
    else{
      echo "<script>M.toast({html: 'Incorrect Password!', classes: 'rounded'});</script>";
    }
  }
  else{
    echo 'something went wrong!';
  }

  $conn->close();
?>
