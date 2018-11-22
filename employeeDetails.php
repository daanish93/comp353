<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>

    <link rel = "stylesheet" href = "https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel = "stylesheet" href = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/css/materialize.min.css">
    <script type = "text/javascript" src = "https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script>

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

  </head>
  <body>
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

    <?php $employee_id = htmlspecialchars($_GET["id"]);?>

    <h3>Employee #<?php echo $employee_id?> Information</h3>

    <br>

    <div class="container">
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


        $sql = "SELECT start_date, end_date, reason FROM personnel_off_duty 
                WHERE employee_id =$employee_id";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          echo  "<h5>Off Duties</h5>
                    <table border='1' class='highlight'>
              <tr>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Reason</th>
              </tr>";
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                foreach($row as $data){
                  echo "<td>".$data."</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        }
        else 
            echo "<h5>This employee does not have off duties</h5>";

    $sql = "SELECT date, amount FROM payroll WHERE employee_id =$employee_id";

    $result = $conn->query($sql);

    $total = 0;

    if ($result->num_rows > 0) {
      echo  "<br><br><h5>Payroll</h5>
                <table border='1' class='highlight'>
          <tr>
            <th>Date</th>
            <th>Amount</th>
          </tr>";
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            $total += $row['amount'];
            foreach($row as $data){
                echo "<td>".$data."</td>";
            }
            echo "</tr>";
        }
        echo "<tr><td><b>Total<b></td><td>$total</td></table>";
    }
    else 
        echo "<h5>This employee did not get any payroll</h5>";

      $conn->close();
    ?>

    <br><br>
    </div>
  </body>
</html>
