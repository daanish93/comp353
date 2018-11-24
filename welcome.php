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
    <?php
      include('client_navbar.php');
     ?>
    <h3>Welcome to the bank</h3>

<div class="container">
<label>
  <input name="acc_category" type="radio" onclick="handleClick(this);" value="personal" checked />
  <span>Personal</span>
</label>
<label>
  <input name="acc_category" type="radio" onclick="handleClick(this);" value="buisiness" />
  <span>Buisiness</span>
</label>

</div>
<br>
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


          $sql = "SELECT * FROM account WHERE client_id=".$client_id.";";
          $result = $conn->query($sql);


          if ($result->num_rows > 0) {
            echo     "<table border='1' class='highlight' id='account_table'>
                <tr>
                  <th>account_number</th>
                  <th>balance</th>
                  <th>account_type</th>
                  <th>account_category</th>
                  <th>number of transactions</th>
                </tr>";
              // output data of each row
              while($row = $result->fetch_assoc()) {
                  echo "<tr>";
                    echo "<td>".$row['account_number']."</td>";
                    echo "<td>".$row['balance']."</td>";
                    echo "<td>".$row['account_type']."</td>";
                    echo "<td>".$row['account_category']."</td>";
                    echo "<td>".$row['transaction_limit']."</td>";
                  echo "</tr>";
              }
              echo "</table>";
          }

        $conn->close();
        }
        else{
                echo "<script>M.toast({html: 'Please Login', classes: 'rounded'});</script>";
                header('refresh:1,url=index.php');
        }
    ?>
    <br>
    <div class="container" style="position: relative;">
        <a class="btn-floating btn-medium waves-effect waves-light red" style=" position: absolute;right: -150px;top: 5px;" href="createAccount.php"><i class="material-icons">+</i></a>
    </div>
  </body>
</html>

<script type="text/javascript">
renderAccount('personal');

function handleClick(myRadio) {
    value = myRadio.value;
    renderAccount(value);
}
function renderAccount(value){
  if(value == 'personal'){
    account_table = document.getElementById('account_table').getElementsByTagName('tr');
    for (i=1; i<account_table.length; i++){
      var type = account_table[i].getElementsByTagName('td')[3].innerHTML;
        if (type == 'buisiness'){
          document.getElementById('account_table').getElementsByTagName('tr')[i].style.display = 'none';
        }
        else{
          document.getElementById('account_table').getElementsByTagName('tr')[i].style.display = '';
        }
    }
  }
  if(value == 'buisiness'){
    account_table = document.getElementById('account_table').getElementsByTagName('tr');
    for (i=1; i<account_table.length; i++){
      var type = account_table[i].getElementsByTagName('td')[3].innerHTML;
        if (type == 'personal'){
          document.getElementById('account_table').getElementsByTagName('tr')[i].style.display = 'none';
        }
        else{
          document.getElementById('account_table').getElementsByTagName('tr')[i].style.display = '';
        }
    }
  }
}

</script>
