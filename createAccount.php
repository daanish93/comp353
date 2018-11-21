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

  <link rel = "stylesheet"
 href = "https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel = "stylesheet"
 href = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/css/materialize.min.css">
<script type = "text/javascript"
 src = "https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js">
</script>

</head>
  <body>
    <nav>
  <div class="nav-wrapper">
    <a href="#" class="brand-logo"> <img src="https://techflourish.com/images/money-cliparts-15.jpg" alt="" height="60" width="60">Bank of Canada</a>
    <ul id="nav-mobile" class="right hide-on-med-and-down">
      <li><a href="welcome.php">Accounts</a></li>
      <li><a href="#paybill">Pay Bill</a></li>
      <li><a href="signout.php">Log Out</a></li>
    </ul>
  </div>
  </nav>

  <h4> <em> Create an Account </em></h4>

  <form action="submitCreateAccount.php" method="post">

    <div class="container">
      <div class="input-field col s12">
       <select name="account_type">
         <option value="nothing" disabled selected>Account Type</option>
         <option value="chequing">Chequing</option>
         <option value="savings">Savings</option>
       </select>
     </div>
    </div>

    <div class="container">
      <div class="input-field col s12">
       <select name="account_category">
         <option value="nothing" disabled selected>Account Category</option>
         <option value="personal">personal</option>
         <option value="buisiness">buisiness</option>
       </select>
     </div>

     <div>
  <input type="checkbox" id="check">
  <label for="check">I agree that if I choose savings account then standard interest rate of 2% will apply. I further agree to standard payment plans for chequing and savings of account limit of 5000$ per month with monthly charge of 25 dollars.</label>
  </div>
  <br>
  <button class="btn waves-effect waves-light" type="submit" name="action">Submit
    <i class="material-icons right"></i>
  </button>
    </div>
  </form>



  </body>
</html>

<script>
   $(document).ready(function() {
      $('select').material_select();
   });
</script>
