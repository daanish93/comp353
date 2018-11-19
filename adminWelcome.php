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
    <nav>
  <div class="nav-wrapper">
    <a href="#" class="brand-logo"> <img src="https://techflourish.com/images/money-cliparts-15.jpg" alt="" height="60" width="60">Bank of Canada</a>
    <ul id="nav-mobile" class="right hide-on-med-and-down">
      <li><a href="#clients">Clients</a></li>
      <li><a href="#employees">Employees</a></li>
      <li><a href="#accounts">Accounts</a></li>
      <li><a href="adminSignout.php">Log Out</a></li>
    </ul>
  </div>
  </nav>
    <h3>Welcome to the bank</h3>

    <?php
        session_start();
        $admin_id = $_SESSION['admin_id'];

        $servername = "localhost";
        $username = "root";
        $password_db = "root";
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


        $sql = "SELECT first_name, last_name, date_of_birth, join_date, category FROM client";
        $result = $conn->query($sql);


        if ($result->num_rows > 0) {
          echo  "<h5>Here are the clients from the Bank</h5>
                    <table border='1' class='highlight'>
              <tr>
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
                  echo "<td>".$data."</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        }
        else 
            echo "<h5>There are no clients in the bank</h5>";

      $conn->close();
    ?>

  </body>
</html>
