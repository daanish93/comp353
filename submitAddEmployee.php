<?php
    //include('addEmployee.php');
  if($_SERVER["REQUEST_METHOD"] == "POST"){

    $title = $_POST['title'];
    $first_name  = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $address = $_POST['address'];
    $start_date = date("Y-m-d");
    $salary = $_POST['salary'];
    $email_address = $_POST['email_address'];
    $phone_number = $_POST['phone_number'];
    $branch_id = $_POST['branch_id'];

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

    $sql = "INSERT INTO employee(title, first_name, last_name, address, start_date, salary, 
            email_address, phone_number, branch_id) VALUES('$title', '$first_name', '$last_name', 
            '$address', $start_date, $salary, '$email_address', $phone_number, $branch_id);";
    
    echo $sql;

    if ($conn->query($sql) == true) {
        //echo "You have successfully added employee with name: " .$first_name. "!";
        header('Location: employees.php');
    } else {
        echo "0 results";
    }
  
    }else{
    echo 'something went wrong!';
  }

  $conn->close();
?>