<?php
    //include('modifyEmployee.php');
  if($_SERVER["REQUEST_METHOD"] == "POST"){

    $employee_id = $_POST['employee_id'];
    $title = $_POST['title'];
    $first_name  = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $address = $_POST['address'];
    $start_date = $_POST['start_date'];
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

    $sql = "UPDATE employee SET title='$title', first_name='$first_name', last_name='$last_name',
            salary=$salary, start_date='$start_date', phone_number=$phone_number, address='$address',
            email_address='$email_address', branch_id='$branch_id' WHERE employee_id=$employee_id;";
    

    if ($conn->query($sql) == true) {
        //echo "You have successfully modified employee with ID: " .$employee_id. "!";
        header('Location: employees.php');
    } else {
        echo "0 results";
    }
  
    }else{
    echo 'something went wrong!';
  }

  $conn->close();
?>