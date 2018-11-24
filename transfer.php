<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>

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
  <body>
    <?php
      include('client_navbar.php');
     ?>

    <?php
    session_start();
    if(isset($_SESSION['client_id'])){
      $client_id = $_SESSION['client_id'];

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


      $sql = "SELECT * FROM account WHERE client_id=".$client_id." AND account_type='chequing';";
      $result = $conn->query($sql);

?>
      <br><br>
  <div class="container">

   <h5>Transfer Money</h5>
  <form action="submitTransfer.php" method="post">
<?php
        echo "  <br><div class='row'>
        <div class='input-field col s4'>
          <select name='chequing' class='icons'>
            <option value='' disabled selected>Choose a Chequing Account</option>";

      if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
              $account_number = $row['account_number'];
              $balance = $row['balance'];
              echo "<option value = '$account_number'>Chequing Account #$account_number ($$balance)</option>";
          }
      }
      else{
            echo "<option value=''>You have no Chequing Account</option>";
      }

      echo "</select>
          <label>From</label>
        </div>";

        $sql = "SELECT * FROM account WHERE client_id=".$client_id." AND account_type='savings';";
        $result = $conn->query($sql);

      echo "  <div class='row'>
        <div class='input-field col s4'>
          <select name= 'savings' class='icons'>
            <option value='' disabled selected>Choose a Savings Account</option>";

      if ($result->num_rows > 0) {
          // output data of each row
          while($row = $result->fetch_assoc()) {
              $account_number = $row['account_number'];
              $balance = $row['balance'];
              echo "<option value = '$account_number'>Savings Account #$account_number ($$balance)</option>";
          }
      }
      else{
            echo "<option value=''>You have no Saving Account</option>";
      }

      echo "</select>
          <label>To</label>
        </div>";

    $conn->close();
    }
    else{
            echo "<script>M.toast({html: 'Error', classes: 'rounded'});</script>";
            header('refresh:1,url=index.php');
    }

?>

        <div class="row">
        <div class="input-field col s4">
        <input id="amount" name="amount" type="text" class="validate">
        <label for="amount">Amount</label>
        </div>
        </div>

        <button class='btn waves-effect waves-light' type='submit' name='action'>Transfer Money
        <i class='material-icons right'></i>
      </button>
      <br><br><br>
      </form>


</div>
  </body>
</html>
