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
      //echo "<br>" . $conn->error;
  }


  $sql = "SELECT account_number FROM account WHERE client_id=".$client_id.";";
  $result = $conn->query($sql);


  $accounts_to_check = array();
  if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
        array_push($accounts_to_check, $row['account_number']);
      //  echo $row['account_number']."<br>";
    }

  }

  //var_dump($accounts_to_check);

  foreach ($accounts_to_check as $x){

    $sql = "SELECT * FROM transaction WHERE account_id = $x;";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {



      $month_now = date("Y-m-d");
      $month_now = substr($month_now, 0, 7);

      // to check if monthly charges have been applied already
      $check = false;

      while($row = $result->fetch_assoc()) {

        //echo 'account_id = '. $row['account_id']."<br>";
        //echo $row['type']."<br>";

        //echo $row['amount']."<br>";

        $month = substr($row['date'], 0, 7);

        //echo "month = $month <br>";
        if($month == $month_now){
          if($row['type'] == 'monthly payment'){
            $check = true;
          }
        }
      }

      if($check == false){
        $date_now = date("Y-m-d");
        $account_id =  $row['account_id'];
        //echo "$account_id wasn't charged for $date_now <br>";
        $sql = "SELECT `charge` FROM `chargeplan` WHERE `option_id` = (SELECT charge_plan_option_id FROM accountchargeplan WHERE account_id='$x')";
        echo $sql . '<br>';
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {

          while($row = $result->fetch_assoc()) {
            echo '---';
            $charge = $row['charge'];
            echo '---';

            $sql = "INSERT INTO transaction(account_id, type, amount, date) VALUES ($x,'monthly payment',$charge,'$date_now');";
            echo "$sql<br>";

            if ($conn->query($sql) === TRUE) {


              echo "SUCCES CHARGED <br>";

            } else {
                echo "ERROR INSERTION<br>";
                    echo "Error: " . $sql . "<br>" . $conn->error ."<br>";
            }


          }
        }



      }
      else{
        //echo "no need to charge <br>";
      }

    //  echo "---<br>";

    }

  }

          $conn->close();

}

 ?>
