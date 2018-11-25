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
    $account_number = htmlspecialchars($_GET["id"]);

    $balance;
    $type;
    $category;
    $transaction_limit;

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


    $sql = "SELECT * FROM account WHERE account_number=$account_number;";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $balance = $row['balance'];
            $type = $row['account_type'];
            $category = $row['account_category'];
            $transaction_limit = $row['transaction_limit'];
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
    <h3>Modifying Account #<?php echo $account_number ?></h3>

    <br><br>

    <div class="container">
      <form class="col s6" method="POST" action="submitModifyAccount.php">

        <div class="row">
        <div class="input-field col s2">
          <input readonly value="<?php echo $account_number ?>" id="account_number" name="account_number" type="text" class="validate">
          <label for="account_number">Account Number</label>
        </div>
        </div>

        <div class="row">
        <div class="input-field col s2">
          <input value="<?php echo $balance ?>" id="balance" name="balance" type="text" class="validate">
          <label for="balance">Balance</label>
        </div>
        <div class="input-field col s3">
        <select name="type">
          <option value="<?php echo $type ?>" disabled selected="selected"><?php echo $type ?></option>
          <option value="chequing">Chequing</option>
          <option value="savings">Savings</option>
        </select>
      </div>
        <div class="input-field col s2">
          <input value="<?php echo $transaction_limit ?>" id="transaction_limit" name="transaction_limit" type="text" class="validate">
          <label for="transaction_limit">transaction_limit</label>
        </div>
       <div class="input-field col s12">
        <select name="category">
          <option value="<?php echo $category ?>" disabled selected="selected"><?php echo $category ?></option>
          <option value="personal">Personal</option>
          <option value="business">Business</option>
        </select>
      </div>
      </div>
        <button class="btn waves-effect waves-light" type="submit" name="action">Submit
          <i class="material-icons right"></i>
        </button>
      </form>
<br><br>
    </div>

    
</html>
