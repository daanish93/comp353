<?php
 // include('accounts.php');
    $account_number = htmlspecialchars($_GET["id"]);

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

    //Have to do it this way
    $sql = "DELETE FROM accountchargeplan WHERE account_id=$account_number;";
    $sql2 = "DELETE FROM transaction WHERE account_id =$account_number;";
    $sql3 = "DELETE FROM account WHERE account_number=$account_number;";

    $conn->query($sql);
    $conn->query($sql2);

    if($conn->query($sql3) === true){ 
               header('Location: accounts.php');
               echo "<script>M.toast({html: 'Client Successfully deleted!', classes: 'rounded'});</script>";
    } else{ 
        echo 'THERE IS A PB!!';
        echo "<script>M.toast({html: 'Could not find this client with ID #".$account_number."!', classes: 'rounded'});</script>";
    } 
  

  $conn->close();
?>
