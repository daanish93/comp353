<?php
 // include('clients.php');
    $client_id = htmlspecialchars($_GET["id"]);

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

    //Have to do it this eay somehow
    $sql = "DELETE FROM chequingaccount WHERE client_id=$client_id;";
    $sql2 = "DELETE FROM clientchargeplan WHERE account_id in (SELECT account_number FROM account WHERE client_id=$client_id);";       
    $sql3 = "DELETE FROM account WHERE client_id=$client_id;";
    $sql4 = "DELETE FROM liability WHERE client_id=$client_id;";
    $sql5 = "DELETE FROM savingsaccount WHERE client_id=$client_id;";
    $sql6 = "DELETE FROM transaction WHERE client_id=$client_id;";
    $sql7 = "DELETE FROM client WHERE client_id=$client_id;";

    $conn->query($sql);
    $conn->query($sql2);
    $conn->query($sql3);
    $conn->query($sql4);
    $conn->query($sql5);
    $conn->query($sql6);

    if($conn->query($sql7) === true){ 
               header('Location: clients.php');
               echo "<script>M.toast({html: 'Client Successfully deleted!', classes: 'rounded'});</script>";
    } else{ 
        echo 'THERE IS A PB!!';
        echo "<script>M.toast({html: 'Could not find this client with ID #".$client_id."!', classes: 'rounded'});</script>";
    } 
  

  $conn->close();
?>
