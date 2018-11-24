<?php

session_start();
if(isset($_SESSION['client_id'])){

  if(isset($_POST['account_number'])){
    $account_number = $_POST['account_number'];


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


    $sql = "SELECT * FROM account WHERE account_number=".$account_number.";";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $balance = $row['balance'];
        }
    }


    if($_POST['bill_name']!= '' && $_POST['bill_number'] != '' && $_POST['bill_amount'] != 0 ){
      $bill_name = $_POST['bill_name'];
      $bill_number = $_POST['bill_number'];
      $bill_amount = $_POST['bill_amount'];
      //echo $bill_name .'<br>';
      //echo $bill_number .'<br>';
      //echo $bill_amount .'<br>';
      //echo "form 2";


      $new_balance = $balance - $bill_amount;

      if($new_balance >= 0){

        $date_now = date('Y-m-d');

        $sql = "INSERT INTO `transaction`(`account_id`, `type`, `amount`, `date`) VALUES ($account_number,'bill payment', $bill_amount, '$date_now');";
        echo $sql;

        if ($conn->query($sql) === TRUE) {
          $sql = "UPDATE `account` SET `balance`=$new_balance WHERE account_number=$account_number";

          if ($conn->query($sql) === TRUE) {
            $sql = "SELECT num_transaction FROM client
            WHERE client_id=$client_id;";
            $result = $conn->query($sql);

            if($result->num_rows > 0){
                while($row = $result->fetch_assoc()) {
                    $transcation = $row['num_transaction'];
                  }
            }

            $sql = "UPDATE client SET num_transaction=($transcation+1) 
            WHERE client_id=$client_id;";
            
            if($conn->query($sql) === TRUE){
              header('Location: payBills.php');
              //echo 'insertion success';
            }
          } else {
              echo 'insertion failed';
          }
        } else {
            echo 'insertion failed';
        }

      }


    }
    else if(isset($_POST['liability_id']) && isset($_POST['amount']) && $_POST['amount']>0){
      $liability_id = $_POST['liability_id'];
      $amount = $_POST['amount'];
      //echo $liability_id .'<br>';
      //echo $amount .'<br>';
      //echo "form 1";
      $new_balance = $balance - $amount;

      if($new_balance >= 0){

        $date_now = date('Y-m-d');
        echo $date_now;

        $sql = "INSERT INTO `transaction`(`account_id`, `type`, `amount`, `date`) VALUES ($account_number,'bill payment', $amount, '$date_now');";
        echo $sql;



        if ($conn->query($sql) === TRUE) {
          $sql = "UPDATE `account` SET `balance`=$new_balance WHERE account_number=$account_number";

          if ($conn->query($sql) === TRUE) {
            $sql = "SELECT balance FROM liability WHERE liability_id=".$liability_id.";";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while($row = $result->fetch_assoc()) {
                  $liability_balance = $row['balance'];
                }
            }


            $sql = "UPDATE `liability` SET `balance`=$liability_balance-$amount WHERE liability_id=$liability_id";
            if ($conn->query($sql) === TRUE) {
              $sql = "SELECT num_transaction FROM client
              WHERE client_id=$client_id;";
              $result = $conn->query($sql);

              if($result->num_rows > 0){
                  while($row = $result->fetch_assoc()) {
                      $transcation = $row['num_transaction'];
                    }
              }

              $sql = "UPDATE client SET num_transaction=($transcation+1) 
              WHERE client_id=$client_id;";
                          
              if($conn->query($sql) === TRUE){
                header('Location: payBills.php');
                //echo 'insertion success';
              }
              else{
                echo 'insertion failed';
              }
            } else {
                echo 'insertion failed';
            }
          } else {
              echo 'insertion failed';
          }
        } else {
            echo 'insertion failed';
        }

      }

    }
    else{
      $error =  "you were missing information. please go back";
    }
  }
  else {
    $error =  "you did not select an account";
  }

}
 ?>
 <!DOCTYPE html>
 <html lang="en" dir="ltr">
   <head>
     <meta charset="utf-8">
     <title></title>
     <!-- Compiled and minified CSS -->
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

     <!-- Compiled and minified JavaScript -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

   </head>
   <body>
     <?php
       include('client_navbar.php');
      ?>

      <div class="container">

        <?php
        if(isset($error)) {
            echo "<h4 style='color:red'><em> $error </em> </h4>";
        }


        ?>

      </div>

  </body>
  </html>
