<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Add Employee</title>

    <link rel = "stylesheet" href = "https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/css/materialize.min.css">
    <script type = "text/javascript" src = "https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script>
    <script>
        $(document).ready(function(){
            $('select').formSelect();
        });
    </script>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    </head>

<?php
    //include('employees.php');

    $title;
    $first_name;
    $last_name;
    $address;
    $salary;
    $email_address;
    $phone_number;
    $branch_id;

    $date_now = date("Y-m-d");

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


    /*$sql = "SELECT * FROM employee WHERE employee_id=$employee_id;";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $first_name = $row['first_name'];
            $last_name = $row['last_name'];
            $title = $row['title'];
            $salary = $row['salary'];
            $start_date = $row['start_date'];
            $phone_number = $row['phone_number'];
            $address = $row['address'];
            $email_address = $row['email_address'];
            $branch_id = $row['branch_id'];
         }
        } else {
            //header('Location: employees.php');
            echo "<script>M.toast({html: 'Could not find employee!', classes: 'rounded'});</script>";
        }*/
  
    

  //$conn->close();
?>

<nav>
  <div class="nav-wrapper">
    <a href="#" class="brand-logo"> <img src="https://techflourish.com/images/money-cliparts-15.jpg" alt="" height="60" width="60">Bank of Canada</a>
    <ul id="nav-mobile" class="right hide-on-med-and-down">
      <li><a href="clients.php">Clients</a></li>
      <li><a href="employees.php">Employees</a></li>
      <li><a href="#accounts">Accounts</a></li>
      <li><a href="adminSignout.php">Log Out</a></li>
    </ul>
  </div>
  </nav>
    <h3>Add Employee</h3>

    <div class="row">
    <form class="col s3" method="POST" action="submitAddEmployee.php">
      <div class="row">
        <div class="input-field col s12">
          <input placeholder="Enter Title" name="title" type="text" class="validate">
          <label for="title">Title</label>
        </div>
        <div class="input-field col s12">
          <input placeholder="Enter First Name" name="first_name" type="text" class="validate">
          <label for="first_name">First Name</label>
        </div>
        <div class="input-field col s12">
          <input placeholder="Enter Last Name" name="last_name" type="text" class="validate">
          <label for="last_name">Last Name</label>
        </div>
      </div>
      <div class="row">
      <div class="input-field col s12">
          <input placeholder="Enter Address" name="address" type="text" class="validate">
          <label for="address">Address</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
        <input readonly value='<?php echo $date_now?>' name="start_date" type="text" class="validate">
          <label for="start_date">Start Date</label>
        </div>
      </div>
      <div class="row">
      <div class="input-field col s12">
          <input placeholder="Enter Salary" name="salary" type="text" class="validate">
          <label for="salary">Salary</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input placeholder="Enter Email" name="email_address" type="text" class="validate">
          <label for="email_address">Email</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input placeholder="Enter Phone Number" name="phone_number" type="text" class="validate">
          <label for="phone_number">Phone Number</label>
        </div>
      </div>
      
      <?php
        //session_start();
        //$admin_id = $_SESSION['admin_id'];

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


        $sql = "SELECT branch_id FROM branch";
        $result = $conn->query($sql);

        //echo $result->num_rows;

        if ($result->num_rows > 0) {
          echo  " <div class='row'> <div class='input-field col s12'>
           <select name='branch_id'>
             <option value=''>Choose Branch</option>";
            
             // output data of each row
            while($row = $result->fetch_assoc()) {
                $id = $row['branch_id'];
                echo "<option value='$id'>Branch $id</option>";
            }
            echo "</select></div></div>";
        }
        else 
            echo "  <div class='row'> <div class='input-field col s12'>
             <select name='branch_id'>
               <option value=''  disabled selected>No Branch</option>
             </select>
           </div></div>";

      $conn->close();
    ?>

     <br> 

      <button class="btn waves-effect waves-light" type="submit" name="action">Submit
        </button>
    </form>
  </div>

</html>
