<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Admin login</title>

    <style media="screen">
    body {
      background-color: lightblue;
      background-image: url('https://dzrlz2ysbzk1i.cloudfront.net/directblinds/media/direct-blinds/product%20images%20-%20lifestyles%20closeups%20swatches/vertical%20blinds/vertical%20swatches/skus/skus/bermuda-plain-dark-grey-89mm%20vertical%20blind-swatch.jpg');
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
  <nav>
      <div class="nav-wrapper">
        <a href="#" class="brand-logo">Bank of Canada</a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
          <li><a href="create_client.php">Register</a></li>
          <li><a href="index.php">Client</a></li>
        </ul>
      </div>
    </nav>
    <div class="valign-wrapper row login-box">
  <div class="col card hoverable s10 pull-s1 m6 pull-m3 l4 pull-l4">

        <div class="card-content">
          <div class="row">
            <form class="col s12" method="POST" action="adminAuthenticate.php">
              <div class="row">
                <div class="input-field col s12 center">
                  <h4><em>Admin Login</em></h4>
                  <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQnajQmgQQLoyqYYlde4AQ-KvzHhAwOM_U-ogj8imeEuMs0HpwhUg" alt="" height="100" width="120" >
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
