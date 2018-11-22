<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Modify Client</title>

        <style media="screen">

.center {
  display: block;
  margin-left: auto;
  margin-right: auto;
  width: 50%;
}
</style>
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
    $client_id = htmlspecialchars($_GET["id"]);

    $first_name;
    $last_name;
    $address;
    $date_of_birth;
    $join_date;
    $email_address;
    $phone_number;
    $category;
    $branch_id;
    $card_number;
    $password;

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


    $sql = "SELECT * FROM client WHERE client_id=$client_id;";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $first_name = $row['first_name'];
            $last_name = $row['last_name'];
            $join_date = $row['join_date'];
            $date_of_birth = $row['date_of_birth'];
            $category = $row['category'];
            $card_number = $row['card_number'];
            $password = $row['password'];
            $phone_number = $row['phone_number'];
            $address = $row['address'];
            $email_address = $row['email_address'];
            $branch_id = $row['branch_id'];
         }
        } else {
            echo "There is a problem!";
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
      <li><a href="bankDetails.php">Bank Details</a></li>
      <li><a href="adminSignout.php">Log Out</a></li>
    </ul>
  </div>
  </nav>
    <h3>Modifying Client #<?php echo $client_id ?></h3>

    <br><br>

    <div class="container">
      <form class="col s6" method="POST" action="submitModifyClient.php">

        <div class="row">
        <div class="input-field col s1">
          <input readonly value="<?php echo $client_id ?>" id="client_id" name="client_id" type="text" class="validate">
          <label for="client_id">Client ID</label>
        </div>
        </div>

        <div class="row">
        <div class="input-field col s6">
          <input value="<?php echo $first_name ?>" id="first_name" name="first_name" type="text" class="validate">
          <label for="first_name">First Name</label>
        </div>
        <div class="input-field col s6">
          <input value="<?php echo $last_name ?>" id="last_name" name="last_name" type="text" class="validate">
          <label for="last_name">Last Name</label>
        </div>
        <br>
        </div>
        <div class = "input-field col s6">
           <label>Birthdate</label>
           <input value="<?php echo $date_of_birth ?>" type = "date" class = "datepicker" name="date_of_birth" />
        </div>
        <br>
        <div class = "input-field col s6">
           <label>Joined</label>
           <input value="<?php echo $join_date ?>" type = "date" class = "datepicker" name="join_date" />
        </div>
        <br>
        <div class="input-field col s6">
          <input value="<?php echo $address ?>" id="address" name="address" type="text" class="validate">
          <label for="address">Address</label>
        </div>
        <br>
        <div class="input-field col s6">
          <input value="<?php echo $email_address ?>" id="email_inline" name="email" type="email" class="validate">
          <label for="email_inline">Email</label>
        </div>

        <br>
        <div class="input-field col s6">
         <input value="<?php echo $phone_number ?>" id="icon_telephone" name="phone_number" type="tel" class="validate">
         <label for="icon_telephone">    <i class="material-icons">phone</i>Telephone</label>
       </div>
       <br>
       <div class="input-field col s12">
        <select name="category">
          <option value="<?php echo $category ?>" disabled selected="selected"><?php echo $category ?></option>
          <option value="personal">Personal</option>
          <option value="business">Business</option>
          <option value="corporate">Corporate</option>
        </select>
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

        if ($result->num_rows > 0) {
          echo  "  <br> 
          <div class='input-field col s12'>
           <select name='branch'>
             <option value='$branch_id'  disabled selected='selected'>Branch $branch_id</option>";
            
             // output data of each row
            while($row = $result->fetch_assoc()) {
              $id = $row['branch_id'];
              if($id != $branch_id){
                  echo "<option value='$id'>Branch $id</option>";
              }
            }
            echo "</select></div>";
        }
        else 
            echo "        <br> 
            <div class='input-field col s12'>
             <select name='branch'>
               <option value=''  disabled selected>No Branch</option>
             </select>
           </div>";

      $conn->close();
    ?>

          <br>
        <div class="row">
          <div class="input-field col s12">
            <input value="<?php echo $card_number ?>" id="card_number" name="card_number" type="text" class="validate">
            <label for="card_number">Card Number</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <input value="<?php echo $password ?>" id="password" name="password" type="password" class="validate">
            <label for="password">Password</label>
          </div>
        </div>
        <button class="btn waves-effect waves-light" type="submit" name="action">Submit
          <i class="material-icons right"></i>
        </button>
      </form>

    </div>

    
</html>
