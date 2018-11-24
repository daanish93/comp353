<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <style media="screen">
    </style>
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
      <li><a href="bankDetails.php">Bank Details</a></li>
      <li><a href="adminSignout.php">Log Out</a></li>
    </ul>
  </div>
  </nav>
    <h3>Welcome to the bank</h3>

    <div class="container">
    <br>
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


        $sql = "SELECT client_id, first_name, last_name, date_of_birth, join_date, category FROM client";
        $result = $conn->query($sql);


        if ($result->num_rows > 0) {
          echo  "<h5>Clients</h5>
                    <table border='1' class='highlight'>
              <tr>
                <th>#</th>
                <th>First Name</th>
                <th>Last Name </th>
                <th>Birthdate</th>
                <th>Joined</th>
                <th>Category</th>
              </tr>";
            // output data of each row
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                foreach($row as $data){
                  $id = $row['client_id'];
                  echo "<td>".$data."</td>";
                }
                echo "<td><a class='waves-effect waves-light btn red darken-4' href=deleteClient.php?id=$id>Delete</a></td><td><a class='waves-effect waves-light btn blue' href=modifyClient.php?id=$id>Modify</td></tr>";
                echo "</tr>";
            }
            echo "</table>";
        }
        else
            echo "<h5>There are no clients in the bank</h5>";

      $conn->close();
    ?>

    <br>
    <br>
    </div>
  </body>
</html>
