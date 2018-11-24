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
    <?php include('client_navbar.php') ?>

    <div class="container">
    <br>
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


        $sql = "SELECT account_id, type, date, amount FROM transaction WHERE account_id in (SELECT account_number FROM account WHERE client_id=$client_id);";
        $result = $conn->query($sql);

        //echo $sql;

        if ($result->num_rows > 0) {
          echo  "<h5>Transactions</h5>
                    <table border='1' class='highlight'>
              <tr>
                <th>Account Number</th>
                <th>Type</th>
                <th>Date</th>
                <th>Amount</th>
              </tr>";
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                foreach($row as $data){
                    if($data == $row['amount']){
                        if($data < 0){
                            $data = -($data);
                            echo "<td>($".$data.")</td>";
                        }
                        else{
                            echo "<td>$".$data."</td>";
                        }
                    }
                    else{
                        echo "<td>".$data."</td>";
                    }
                }
                echo "</tr>";
            }
            echo "</table>";
        }
        else
            echo "<h5>You have not made transactions yet!</h5>";
        
        $conn->close();
    }
    else{
        echo "<script>M.toast({html: 'Error', classes: 'rounded'});</script>";
        header('refresh:1,url=index.php');
    }

    ?>

    <br>
    <br>
    </div>
  </body>
</html>
