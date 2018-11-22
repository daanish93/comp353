<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Modify Employee</title>

    
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
    $employee_id = htmlspecialchars($_GET["id"]);

    $title;
    $first_name;
    $last_name;
    $address;
    $start_date;
    $salary;
    $email_address;
    $phone_number;
    $branch_id;

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


    $sql = "SELECT * FROM employee WHERE employee_id=$employee_id;";
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
            header('Location: employees.php');
            echo "<script>M.toast({html: 'Could not find employee!', classes: 'rounded'});</script>";
        }
  
    

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
    <h3>Modifying Employee #<?php echo $employee_id ?></h3>

    <br><br>

    <div class="row">
    <form class="col s3" method="POST" action="submitModifyEmployee.php">
      <div class="row">
      <div class="input-field col s12">
          <input readonly value="<?php echo $employee_id ?>" name="employee_id" type="text" class="validate">
          <label for="employee_id">ID</label>
        </div>
        <div class="input-field col s12">
          <input value="<?php echo $title ?>" name="title" type="text" class="validate">
          <label for="title">Title</label>
        </div>
        <div class="input-field col s12">
          <input value="<?php echo $first_name ?>" name="first_name" type="text" class="validate">
          <label for="first_name">First Name</label>
        </div>
        <div class="input-field col s12">
          <input value="<?php echo $last_name ?>" name="last_name" type="text" class="validate">
          <label for="last_name">Last Name</label>
        </div>
      </div>
      <div class="row">
      <div class="input-field col s12">
          <input value="<?php echo $address ?>" name="address" type="text" class="validate">
          <label for="address">Address</label>
        </div>
      </div>
      <div class="row">
      <div class = "input-field col s12">
           <label>Start Date</label>
           <input value="<?php echo $start_date ?>" type = "date" class = "datepicker" name="start_date" />
        </div>
      </div>
      <div class="row">
      <div class="input-field col s12">
          <input value="<?php echo $salary ?>" name="salary" type="text" class="validate">
          <label for="salary">Salary</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input value="<?php echo $email_address ?>" name="email_address" type="text" class="validate">
          <label for="email_address">Email</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input value="<?php echo $phone_number ?>" name="phone_number" type="text" class="validate">
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
             <option value='$branch_id'>$branch_id</option>";
            
             // output data of each row
            while($row = $result->fetch_assoc()) {
                $id = $row['branch_id'];
                if($id != $branch_id){
                    echo "<option value='$id'>Branch $id</option>";
                }
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

      <button class="btn waves-effect waves-light" type="submit" name="action">Submit
        </button>
    </form>
  </div>

</html>
