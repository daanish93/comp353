<?php
  include('employees.php');
  if($_SERVER["REQUEST_METHOD"] == "POST"){
    $employee_id = $_POST['employee_id'];

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


    $sql = "DELETE FROM employee WHERE employee_id=$employee_id;";
    $result = $conn->query($sql);

    echo $result;

    if ($result) {
        echo "<script>M.toast({html: 'Employee Successfully deleted!', classes: 'rounded'});</script>";
        header('Location: employees.php');
    }
    else{
      echo "<script>M.toast({html: 'Could not find this employee with ID #".$employee_id."!', classes: 'rounded'});</script>";
    }
  }
  else{
    echo 'something went wrong!';
  }

  $conn->close();
?>
