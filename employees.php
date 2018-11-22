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
    <h3>Welcome to the bank</h3>

    <br>

    <div class="container">
    <?php
        session_start();
        $admin_id = $_SESSION['admin_id'];

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


        $sql = "SELECT employee_id, first_name, last_name, start_date, salary, phone_number FROM employee";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
          echo  "<h5>Employees from the Bank</h5>
                    <table border='1' class='highlight'>
              <tr>
                <th>#</th>
                <th>First Name</th>
                <th>Last Name </th>
                <th>Started</th>
                <th>Salary</th>
                <th>Phone Number</th>
              </tr>";
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                foreach($row as $data){
                  $id = $row['employee_id'];
                  echo "<td>".$data."</td>";
                }
                echo "<td><a class='waves-effect waves-light btn red darken-4' href=deleteEmployee.php?id=$id>Delete</a></td><td><a class='waves-effect waves-light btn blue' href=modifyEmployee.php?id=$id>Modify</td><td><a class='waves-effect waves-light btn green'>Details</td></tr>";
                echo "</tr>";
            }
            echo "</table>";
        }
        else 
            echo "<h5>There are no employees in the bank</h5>";

      $conn->close();
    ?>

    <br>

    <a class="btn-floating btn-large waves-effect waves-light red right" href="addEmployee.php"><i class="material-icons">add</i></a>

    <br><br>
    </div>
  </body>
</html>
