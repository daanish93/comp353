<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <style media="screen">
    body {
      background-color: lightblue;
    }
    </style>
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


      $sql = "SELECT * FROM account WHERE client_id=".$client_id.";";
      $result = $conn->query($sql);

?>
  <div class="container">

   <h5>Bill your bills</h5>
  <form action="submitPayBill.php" method="post">
<?php
      if ($result->num_rows > 0) {
        echo     "<table border='1' class='highlight' id='account_table'>
            <tr>
              <th>account_number</th>
              <th>balance</th>
              <th>account_type</th>
              <th>account_category</th>
              <th></th>
            </tr>";
          // output data of each row
          while($row = $result->fetch_assoc()) {
              echo "<tr>";
              echo '<td>'.$row['account_number'].'</td>';
              echo '<td>'.$row['balance'].'</td>';
              echo '<td>'.$row['account_type'].'</td>';
              echo '<td>'.$row['account_category'].'</td>';
              $account_number = $row['account_number'];
              echo "<td>      <label> <input type='radio' name='account_number' value=$account_number />  <span></span> </label> </td>";
              echo "</tr>";
          }
          echo "</table>";
      }

      echo "<br><br>";

      $sql = "SELECT * FROM liability WHERE client_id=".$client_id.";";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        ?>
        <h5>Pay your liabilities</h5>
        <table border='1' class='highlight' id='account_table'>
        <colgroup>
           <col span='1' style='width: 25%;'>
           <col span='1' style='width: 25%;'>
           <col span='1' style='width: 25%;'>
           <col span='1' style='width: 15%;'>
        </colgroup>
            <tr>
              <th>liability_id</th>
              <th>type</th>
              <th>credit limit</th>
              <th>balance</th>
              <th></th>
            </tr>
            <?php
          // output data of each row
          while($row = $result->fetch_assoc()) {
              echo "<tr>";
              echo "<td><input type='text' name='liability_id' value=".$row['liability_id']." readonly />"."</td>";
              echo '<td>'.$row['type'].'</td>';
              echo '<td>'.$row['credit_limit'].'</td>';
              echo '<td>'.$row['balance'].'</td>';
              $liability_id = $row['liability_id'];
              echo "<td><input type='text' name='amount' value=0 /></td>";
              echo "</tr>";
          }
          echo "</table>";
      }

    $conn->close();
    }
    else{
            echo "<script>M.toast({html: 'Error', classes: 'rounded'});</script>";
            header('refresh:1,url=index.php');
    }

?>
<h5>Or pay your bills</h5>
<table>
  <tr>
    <th>Name of Bill</th>
    <th>Bill identification number</th>
    <th>Amount</th>
  </tr>
  <tr>
    <td> <input type="text" name="bill_name" value=""> </td>
    <td> <input type="text" name="bill_number" value=""> </td>
    <td> <input type="text" name="bill_amount" value=""> </td>
  </tr>
</table>

<button class="btn waves-effect waves-light" type="submit" name="action" >Submit
  <i class="material-icons right"></i>
</button>
<br><br><br>
</form>


</div>
  </body>
</html>
