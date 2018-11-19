<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Admin login</title>

    <style media="screen">
    body {
      background-color: lightblue;
    }
    .center {
      display: block;
      margin-left: auto;
      margin-right: auto;
      width: 50%;
    }
    </style>

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

  </head>
  <body>
    <div class="valign-wrapper row login-box">
  <div class="col card hoverable s10 pull-s1 m6 pull-m3 l4 pull-l4">

        <div class="card-content">
          <div class="row">
            <form class="col s12" method="POST" action="adminAuthenticate.php">
              <div class="row">
                <div class="input-field col s12 center">
                  <h4><em>Admin Login</em></h4>
                  <img src="https://techflourish.com/images/money-cliparts-15.jpg" alt="" height="100" width="120" >
                </div>
              </div>
              <div class="row">
                <div class="input-field col s12">
                  <input id="username" name="username" type="text" class="validate">
                  <label for="username">Username</label>
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
        </div>
      </div>
    </div>

  </body>
</html>
