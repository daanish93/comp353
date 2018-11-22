<?php

  if($_SERVER["REQUEST_METHOD"] == "POST"){

    //var_dump($_POST);

    $client_id = $_POST['client_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $join_date = $_POST['join_date'];
    $date_of_birth = $_POST['date_of_birth'];
    $category = $_POST['category'];
    $card_number = $_POST['card_number'];
    $password = $_POST['password'];
    $phone_number = $_POST['phone_number'];
    $address = $_POST['address'];
    $email_address = $_POST['email'];
    $branch_id = $_POST['branch'];

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

    $sql = "UPDATE client SET first_name='$first_name', last_name='$last_name', 
            join_date='$join_date', date_of_birth='$date_of_birth', category='$category', 
            phone_number=$phone_number, address='$address', email_address='$email_address', 
            card_number='$card_number', password='$password', branch_id='$branch_id' 
            WHERE client_id=$client_id;";

    //echo $sql;
    

    if ($conn->query($sql) == true) {
        //echo "You have successfully modified client with ID: " .$clien_id. "!";
        header('Location: clients.php');
    } else {
        echo "0 results";
    }
  
    }else{
    echo 'something went wrong!';
  }

  $conn->close();
?>