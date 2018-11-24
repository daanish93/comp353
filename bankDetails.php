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
        <li><a href="accounts.php">Accounts</a></li>
        <li><a href="adminSignout.php">Log Out</a></li>
    </ul>
  </div>
  </nav>

    <h3>Bank Information</h3>

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


        //OFF DUTIES

        $sql = "SELECT employee_id, start_date, end_date, reason FROM personnel_off_duty;";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          echo  "<h5>Off Duties</h5>
                    <table border='1' class='highlight'>
              <tr>
                <th>Full Name</th>
                <th>Start Date</th>
                <th>End Date</th>
                <th>Reason</th>
              </tr>";
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                $employee_id = $row['employee_id'];
                $sqlEmployee = "SELECT first_name, last_name FROM employee WHERE employee_id=$employee_id;";
                $resultEmployee = $conn->query($sqlEmployee);
                if ($resultEmployee->num_rows > 0) {
                    while($rowEmployee = $resultEmployee->fetch_assoc()){
                        $first_name = $rowEmployee['first_name'];
                        $last_name = $rowEmployee['last_name'];
                        echo"<td>".$first_name. " " .$last_name."</td>";
                    }
                }
                else{
                    echo"<td>Unknown Name</td>";
                }
                foreach($row as $data){
                    if($data != $row['employee_id']){
                        echo "<td>".$data."</td>";
                    }
                }
                echo "</tr>";
            }
            echo "</table>";
        }
        else 
            echo "<h5>There are no off duties in the Bank</h5>";

        //PAYROLL

        $sql = "SELECT employee_id, date, amount FROM payroll;";

        $result = $conn->query($sql);

        $totalPayroll = 0;

        if ($result->num_rows > 0) {
        echo  "<br><br><h5>Payroll</h5>
                <table border='1' class='highlight'>
          <tr>
            <th>Full Name</th>
            <th>Date</th>
            <th>Amount</th>
          </tr>";
        // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                $employee_id = $row['employee_id'];
                $sqlEmployee = "SELECT first_name, last_name FROM employee WHERE employee_id=$employee_id;";
                $resultEmployee = $conn->query($sqlEmployee);
                if ($resultEmployee->num_rows > 0) {
                    while($rowEmployee = $resultEmployee->fetch_assoc()){
                        $first_name = $rowEmployee['first_name'];
                        $last_name = $rowEmployee['last_name'];
                        echo"<td>".$first_name. " " .$last_name."</td>";
                    }
                }
                else{
                    echo"<td>Unknown Name</td>";
                }
                $totalPayroll += $row['amount'];
                foreach($row as $data){
                    if($data != $row['employee_id']){
                        if($data == $row['amount']){
                            echo "<td>$".$data."</td>";
                        }
                        else{
                            echo "<td>".$data."</td>";
                        }
                    }
                }
                echo "</tr>";
            }
            echo "<tr><td><b>Total<b></td><td></td><td>$".$totalPayroll."</td></table>";
        }
        else 
            echo "<h5>There are no payrolls in the Bank</h5>";


    //PROFITS BY BRANCH  
    
    $sql = "SELECT account_id, amount FROM transaction WHERE type='deposit';";

    $result = $conn->query($sql);

    $total = 0;

    if ($result->num_rows > 0) {
      echo  "<br><br><h5>Profits By Branch</h5>
                <table border='1' class='highlight'>
          <tr>
            <th>Branch ID</th>
            <th>City</th>
            <th>Amount</th>
          </tr>";
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            $account_id = $row['account_id'];
            $sqlClient = "SELECT client_id FROM account WHERE account_number=$account_id;";
            $resultClient = $conn->query($sqlClient);
            if($resultClient->num_rows > 0){
                while($rowClient = $resultClient->fetch_assoc()){
                    $client_id = $rowClient['client_id'];
                    $sqlBranch = "SELECT branch_id FROM client WHERE client_id=$client_id;";
                    $resultBranch = $conn->query($sqlBranch);
                    if ($resultBranch->num_rows > 0) {
                        while($rowBranch = $resultBranch->fetch_assoc()){
                            $branch_id = $rowBranch['branch_id'];
                            echo"<td>".$branch_id."</td>";
                            $sqlLocation = "SELECT location FROM branch WHERE branch_id=$branch_id;";
                            $resultLocation = $conn->query($sqlLocation);
                            if($resultLocation->num_rows > 0){
                                while($rowLocation = $resultLocation->fetch_assoc()){
                                    $location = $rowLocation['location'];
                                    $sqlCity = "SELECT city FROM location WHERE location_id=$location;";
                                    $resultCity =  $conn->query($sqlCity);
                                    if($resultCity->num_rows > 0){
                                        while($rowCity = $resultCity->fetch_assoc()){
                                            $city = $rowCity['city'];
                                            echo"<td>".$city."</td>";
                                        }
                                    }
                                    else{
                                        echo"<td>Unknown City</td>";
                                    }
                                }
                            }
                            else{
                                echo"<td>Unknown Location</td>";
                            }
                        }
                    }
                    else{
                        echo"<td>Unknown Branch</td>";
                    }
               }
            }
            else{
                echo"<td>Unknown Account</td>";
            }

            $total += $row['amount'];
            foreach($row as $data){
                if($data != $row['account_id']){
                    echo "<td>$".$data."</td>";
                }
            }
            echo "</tr>";
        }
        echo "<tr><td><b>Total Profits<b></td><td></td><td>$".$total."</td></table>";
    }
    else 
        echo "<h5>The bank has not make any Profits</h5>";

    
    //PROFITS BY CITY  
    
    $sql = "SELECT account_id, amount FROM transaction WHERE type='deposit';";

    $result = $conn->query($sql);

    $total = 0;

    if ($result->num_rows > 0) {
      echo  "<br><br><h5>Profits By City</h5>
                <table border='1' class='highlight'>
          <tr>
            <th>City</th>
            <th>Provence</th>
            <th>Amount</th>
          </tr>";
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            $account_id = $row['account_id'];
            $sqlClient = "SELECT client_id FROM account WHERE account_number=$account_id;";
            $resultClient = $conn->query($sqlClient);
            if($resultClient->num_rows > 0){
                while($rowClient = $resultClient->fetch_assoc()){
                    $client_id = $rowClient['client_id'];
                    $sqlBranch = "SELECT branch_id FROM client WHERE client_id=$client_id;";
                    $resultBranch = $conn->query($sqlBranch);
                    if ($resultBranch->num_rows > 0) {
                        while($rowBranch = $resultBranch->fetch_assoc()){
                            $branch_id = $rowBranch['branch_id'];
                            $sqlLocation = "SELECT location FROM branch WHERE branch_id=$branch_id;";
                            $resultLocation = $conn->query($sqlLocation);
                            if($resultLocation->num_rows > 0){
                                while($rowLocation = $resultLocation->fetch_assoc()){
                                    $location = $rowLocation['location'];
                                    $sqlCity = "SELECT provence, city FROM location WHERE location_id=$location;";
                                    $resultCity =  $conn->query($sqlCity);
                                    if($resultCity->num_rows > 0){
                                        while($rowCity = $resultCity->fetch_assoc()){
                                            $city = $rowCity['city'];
                                            $provence = $rowCity['provence'];
                                            echo"<td>".$city."</td>";
                                            echo"<td>".$provence."</td>";
                                        }
                                    }
                                    else{
                                        echo"<td>Unknown City</td>";
                                    }
                                }
                            }
                            else{
                                echo"<td>Unknown Location</td>";
                            }
                        }
                    }
                    else{
                        echo"<td>Unknown Branch</td>";
                    }
                }
            }
            else{
                echo"<td>Unknown Account</td>";
            }
            
            $total += $row['amount'];
            foreach($row as $data){
                if($data != $row['account_id']){
                    echo "<td>$".$data."</td>";
                }
            }
            echo "</tr>";
        }
        echo "<tr><td><b>Total Profits<b></td><td></td><td>$".$total."</td></table>";
    }
    else 
        echo "<h5>The bank has not make any Profits</h5>";

    
    //LOSSES BY BRANCH  
    
    $sql = "SELECT account_id, amount FROM transaction WHERE type='withdraw';";

    $result = $conn->query($sql);

    $total = 0;

    if ($result->num_rows > 0) {
      echo  "<br><br><h5>Losses By Branch</h5>
                <table border='1' class='highlight'>
          <tr>
            <th>Branch ID</th>
            <th>City</th>
            <th>Amount</th>
          </tr>";
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            $account_id = $row['account_id'];
            $sqlClient = "SELECT client_id FROM account WHERE account_number=$account_id;";
            $resultClient = $conn->query($sqlClient);
            if($resultClient->num_rows > 0){
                while($rowClient = $resultClient->fetch_assoc()){
                    $client_id = $rowClient['client_id'];
                    $sqlBranch = "SELECT branch_id FROM client WHERE client_id=$client_id;";
                    $resultBranch = $conn->query($sqlBranch);
                    if ($resultBranch->num_rows > 0) {
                        while($rowBranch = $resultBranch->fetch_assoc()){
                            $branch_id = $rowBranch['branch_id'];
                            echo"<td>".$branch_id."</td>";
                            $sqlLocation = "SELECT location FROM branch WHERE branch_id=$branch_id;";
                            $resultLocation = $conn->query($sqlLocation);
                            if($resultLocation->num_rows > 0){
                                while($rowLocation = $resultLocation->fetch_assoc()){
                                    $location = $rowLocation['location'];
                                    $sqlCity = "SELECT city FROM location WHERE location_id=$location;";
                                    $resultCity =  $conn->query($sqlCity);
                                    if($resultCity->num_rows > 0){
                                        while($rowCity = $resultCity->fetch_assoc()){
                                            $city = $rowCity['city'];
                                            echo"<td>".$city."</td>";
                                        }
                                    }
                                    else{
                                        echo"<td>Unknown City</td>";
                                    }
                                }
                            }
                            else{
                                echo"<td>Unknown Location</td>";
                            }
                        }
                    }
                    else{
                        echo"<td>Unknown Branch</td>";
                    }
               }
            }
            else{
                echo"<td>Unknown Account</td>";
            }

            $total += $row['amount'];
            foreach($row as $data){
                if($data != $row['account_id']){
                    echo "<td>$".$data."</td>";
                }
            }
            echo "</tr>";
        }
        echo "<tr><td><b>Total Losses<b></td><td></td><td>$".($total+$totalPayroll)."</td></table>";
    }
    else 
        echo "<h5>The bank has not make any Losses</h5>";
    
        
    //LOSSES BY CITY  
    
    $sql = "SELECT account_id, amount FROM transaction WHERE type='withdraw';";

    $result = $conn->query($sql);

    $total = 0;

    if ($result->num_rows > 0) {
      echo  "<br><br><h5>Losses By City</h5>
                <table border='1' class='highlight'>
          <tr>
            <th>City</th>
            <th>Provence</th>
            <th>Amount</th>
          </tr>";
        // output data of each row
        while($row = $result->fetch_assoc()) {
            echo "<tr>";
            $account_id = $row['account_id'];
            $sqlClient = "SELECT client_id FROM account WHERE account_number=$account_id;";
            $resultClient = $conn->query($sqlClient);
            if($resultClient->num_rows > 0){
                while($rowClient = $resultClient->fetch_assoc()){
                    $client_id = $rowClient['client_id'];
                    $sqlBranch = "SELECT branch_id FROM client WHERE client_id=$client_id;";
                    $resultBranch = $conn->query($sqlBranch);
                    if ($resultBranch->num_rows > 0) {
                        while($rowBranch = $resultBranch->fetch_assoc()){
                            $branch_id = $rowBranch['branch_id'];
                            $sqlLocation = "SELECT location FROM branch WHERE branch_id=$branch_id;";
                            $resultLocation = $conn->query($sqlLocation);
                            if($resultLocation->num_rows > 0){
                                while($rowLocation = $resultLocation->fetch_assoc()){
                                    $location = $rowLocation['location'];
                                    $sqlCity = "SELECT provence, city FROM location WHERE location_id=$location;";
                                    $resultCity =  $conn->query($sqlCity);
                                    if($resultCity->num_rows > 0){
                                        while($rowCity = $resultCity->fetch_assoc()){
                                            $city = $rowCity['city'];
                                            $provence = $rowCity['provence'];
                                            echo"<td>".$city."</td>";
                                            echo"<td>".$provence."</td>";
                                        }
                                    }
                                    else{
                                        echo"<td>Unknown City</td>";
                                    }
                                }
                            }
                            else{
                                echo"<td>Unknown Location</td>";
                            }
                        }
                    }
                    else{
                        echo"<td>Unknown Branch</td>";
                    }
                }
            }
            else{
                echo"<td>Unknown Account</td>";
            }
            
            $total += $row['amount'];
            foreach($row as $data){
                if($data != $row['account_id']){
                    echo "<td>$".$data."</td>";
                }
            }
            echo "</tr>";
        }
        echo "<tr><td><b>Total Losses<b></td><td></td><td>$".($total+$totalPayroll)."</td></table>";
    }
    else 
        echo "<h5>The bank has not make any Losses</h5>";


      $conn->close();
    ?>

    <br><br>
    </div>
  </body>
</html>
