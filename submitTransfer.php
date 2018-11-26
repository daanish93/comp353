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

    if(isset($_POST['chequing']) && isset($_POST['savings']) && $_POST['amount']>0){

        $chequing_account = $_POST['chequing'];
        $savings_account = $_POST['savings'];
        $amount = $_POST['amount'];
        $date = date('Y-m-d');
        
        $sql = "SELECT balance FROM account WHERE account_number=$chequing_account;";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
              $chequing_balance = $row['balance'];
            }
        }

        $sql = "SELECT balance FROM account WHERE account_number=$savings_account;";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
              $savings_balance = $row['balance'];
            }
        }

        if($chequing_balance >= $amount){
            $new_chequing_balance = $chequing_balance - $amount;
            $new_savings_balance = $savings_balance + $amount;

            $sql = "UPDATE account SET balance=$new_chequing_balance 
                    WHERE account_number=$chequing_account;";

            if ($conn->query($sql) == true) {
                $sql = "UPDATE account SET balance=$new_savings_balance 
                    WHERE account_number=$savings_account;";

                if ($conn->query($sql) == true) {
                    //Add the transaction
                    $sql = "INSERT INTO transaction(account_id, type, amount, date) 
                            VALUES($chequing_account, 'transfer', -$amount, '$date'), 
                            ($savings_account, 'transfer', $amount, '$date');";
                    $conn->query($sql);

                    //Update client's num of transactions
                    $sql = "SELECT num_transaction FROM account
                    WHERE account_number=$chequing_account;";
                    $result = $conn->query($sql);

                    //echo $sql;

                    if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()) {
                        $transaction = 1 + $row['num_transaction'];
                        }
                    }

                    $sql = "UPDATE account SET num_transaction=$transaction
                    WHERE account_number=$chequing_account;";
                    $conn->query($sql);

                    $sql = "SELECT num_transaction FROM account
                    WHERE account_number=$savings_account;";
                    $result = $conn->query($sql);

                    //echo $sql;

                    if($result->num_rows > 0){
                        while($row = $result->fetch_assoc()) {
                        $transaction = 1 + $row['num_transaction'];
                        }
                    }

                    $sql = "UPDATE account SET num_transaction=$transaction
                    WHERE account_number=$savings_account;";
                    $conn->query($sql);

                    //check if exceeded num of trans (if so charge this biiiiih)

                }
                else{
                    $error =  "Seems like something wrong with your savings account!";
                }
            }
            else{
                $error =  "Seems like something wrong with your chequing account!";
            }
        }
        else{
            $error =  "You don't have enough money in your chequing account!";
        }

    }
    else{
        $error =  "You were missing information. Please go back";
    }

}

$conn->close();
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
        else{
            echo "<h3>Transfer Money Succesfull</h3>
                    <br><h4>Your new balances</h4>
                    <br><h5>Chequing</h5>
                    <table>
                    <tr>
                        <th>Chequing Account</th>
                        <th>Old Balance</th>
                        <th>New Balance</th>
                    </tr>
                     <tr>
                        <td>$chequing_account</td>
                        <td>$$chequing_balance</td>
                        <td>$$new_chequing_balance</td>
                    </tr>
                    </table><br>";

            echo"<br><h5>Savings</h5>
            <table>
            <tr>
                <th>Savings Account</th>
                <th>Old Balance</th>
                <th>New Balance</th>
            </tr>
             <tr>
                <td>$savings_account</td>
                <td>$$savings_balance</td>
                <td>$$new_savings_balance</td>
            </tr>
            </table>";
        }
        ?>

      </div>

  </body>
  </html>