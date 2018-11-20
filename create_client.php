<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>login</title>

    <style media="screen">

    .center {
      display: block;
      margin-left: auto;
      margin-right: auto;
      width: 50%;
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
<script>
   $(document).ready(function() {
      $('select').material_select();
   });
</script>
  </head>
  <body>
  <nav>
      <div class="nav-wrapper">
        <a href="#" class="brand-logo">Bank of Canada</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
          <li><a href="create_client.php">Register</a></li>
          <li><a href="admin.php">Admin</a></li>
        </ul>
      </div>
    </nav>

    <div class="container">
      <form class="col s12" method="POST" action="create_client_2.php">

        <div class="row">
          <br>
        <div class="input-field col s6">
          <input id="first_name" name="first_name" type="text" class="validate">
          <label for="first_name">First Name</label>
        </div>
        <div class="input-field col s6">
          <input id="last_name" name="last_name" type="text" class="validate">
          <label for="last_name">Last Name</label>
        </div>
        <br>
        </div>
        <div class = "row">
           <label>Date of Birth</label>
           <input type = "date" class = "datepicker" name="date_of_birth" />
        </div>

        <div class="input-field col s6">
          <input id="address" name="address" type="text" class="validate">
          <label for="address">Address</label>
        </div>

        <div class="input-field col s6">
          <input id="email_inline" name="email" type="email" class="validate">
          <label for="email_inline">Email</label>
        </div>
        <div class="input-field col s6">
         <input id="icon_telephone" name="phone_number" type="tel" class="validate">
         <label for="icon_telephone">    <i class="material-icons">phone</i>Telephone</label>
       </div>
       <br>
       <div class="input-field col s12">
        <select name="category">
          <option value=""  disabled selected>Choose category</option>
          <option value="1">category 1</option>
          <option value="2">category 2</option>
          <option value="3">category 3</option>
        </select>
      </div>

        <br> <br>
        <div class="input-field col s12">
         <select name="branch">
           <option value="" disabled selected>Choose Branch</option>
           <option value="1">Branch 1</option>
           <option value="2">Branch 2</option>
           <option value="3">Branch 3</option>
         </select>
       </div>
          <br>
        <div class="row">
          <div class="input-field col s12">
            <input id="card_number" name="card_number" type="text" class="validate">
            <label for="card_number">Card Number</label>
          </div>
        </div>
        <div class="row">
          <div class="input-field col s12">
            <input id="password" name="password" type="password" class="validate">
            <label for="password">Password</label>
          </div>
        </div>
        <button class="btn waves-effect waves-light" type="submit" name="action">Submit
          <i class="material-icons right"></i>
        </button>
      </form>

    </div>



  </body>
</html>
