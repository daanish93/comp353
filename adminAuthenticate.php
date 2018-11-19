<?php
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $admin = $_POST['username'];
    $auth_password = $_POST['password'];

    $servername = "localhost";
    $username = "root";
    $password_db = "root";

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


    $sql = "SELECT admin_id, pass FROM admin WHERE username='".$admin."';";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $admin_id = $row['admin_id'];
          $pass= $row['pass'];
        }
    }

    if ($auth_password == $pass){
      session_start();
      $_SESSION['admin_id'] = $admin_id;
      header('Location: adminWelcome.php');
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
