<?php
 // include('employees.php');
    $employee_id = htmlspecialchars($_GET["id"]);

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


    $sql = "DELETE FROM employee WHERE employee_id=$employee_id;";

/*
    if ($result == 1) {
       // header('Location: employees.php');
        echo "<script>M.toast({html: 'Employee Successfully deleted!', classes: 'rounded'});</script>";
    }
    else{
      echo "<script>M.toast({html: 'Could not find this employee with ID #".$employee_id."!', classes: 'rounded'});</script>";
    }
*/
    if($conn->query($sql) === true){ 
               header('Location: employees.php');
               echo "<script>M.toast({html: 'Employee Successfully deleted!', classes: 'rounded'});</script>";
    } else{ 
        echo "<script>M.toast({html: 'Could not find this employee with ID #".$employee_id."!', classes: 'rounded'});</script>";
    } 
  

  $conn->close();
?>
