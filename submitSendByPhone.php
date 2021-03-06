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

    if(isset($_POST['account']) && isset($_POST['phone']) && $_POST['amount']>0){

        $sender_account = $_POST['account'];
        $phone = $_POST['phone'];
        $amount = $_POST['amount'];
        $date = date('Y-m-d');
        
        $sql = "SELECT balance FROM account WHERE account_number=$sender_account;";
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
              $sender_balance = $row['balance'];
            }
        }

        //We assume clients can only send money to chequing accounts
        //This will take the first chequing account of all the chequing accounts found
        $sql = "SELECT account_number, balance FROM account WHERE client_id in (SELECT client_id FROM client 
                WHERE phone_number=$phone) AND account_type='chequing' LIMIT 1;";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
              $receiver_balance = $row['balance'];
              $receiver_account = $row['account_number'];
            }

            if($sender_balance >= $amount){
                $new_sender_balance = $sender_balance - $amount;
                $new_receiver_balance = $receiver_balance + $amount;
    
                $sql = "UPDATE account SET balance=$new_sender_balance 
                        WHERE account_number=$sender_account;";
    
                if ($conn->query($sql) == true) {
                    $sql = "UPDATE account SET balance=$new_receiver_balance 
                        WHERE account_number=$receiver_account;";
    
                    if ($conn->query($sql) == true) {
                        //Add the transaction
                        $sql = "INSERT INTO transaction(account_id, type, amount, date) 
                                VALUES($receiver_account, 'transfer', $amount, '$date'), 
                                ($sender_account, 'transfer', -$amount, '$date');";
                        
                        $conn->query($sql);

                        //Update client's num of transactions
                        $sql = "SELECT num_transaction FROM account
                        WHERE account_number=$sender_account;";
                        $result = $conn->query($sql);

                        //echo $sql;

                        if($result->num_rows > 0){
                            while($row = $result->fetch_assoc()) {
                            $transaction = 1 + $row['num_transaction'];
                            }
                        }

                        $sql = "UPDATE account SET num_transaction=$transaction
                        WHERE account_number=$sender_account;";
                        $conn->query($sql);

                        //check if exceeded num of trans (if so charge this biiiiih)
            
                    }
                    else{
                        $error =  "Seems like something wrong with the receiver account!";
                    }
                }
                else{
                    $error =  "Seems like something wrong with your account!";
                }
            }
            else{
                $error =  "You don't have enough money in this account!";
            }
        }
        else{
            $error =  "The receiver does not have a chequing account!";
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
            echo "<h3>Send Money to $phone Succesfull</h3>
                    <br><h4>Your new balances</h4>
                    <br><h5>Account</h5>
                    <table>
                    <tr>
                        <th>Account</th>
                        <th>Old Balance</th>
                        <th>New Balance</th>
                    </tr>
                     <tr>
                        <td>$sender_account</td>
                        <td>$$sender_balance</td>
                        <td>$$new_sender_balance</td>
                    </tr>
                    </table><br>";
        }
        ?>

      </div>

  </body>
  </html>