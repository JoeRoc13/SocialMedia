<?php
  session_start();
  $get_root = "/SideProjects/SocialMedia";

  if (isset($_SESSION['logged_in'])) {
      header("location: index.php");
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="../../favicon.ico">

    <title>Social Media Site</title>

    <!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="<?php echo $get_root;?>/assets/css/style.css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <a class="navbar-brand" href="<?php echo $get_root;?>">Social Media Site</a>
          <h1 id="session"><?php var_dump($_SESSION); ?></h1>
        </div>
        <?php if (isset($_SESSION['userData'])) { ?>
          <div id="navbar" class="navbar-collapse collapse">
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-anchor"></i> Profile <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                <li><a href="#"><i class="fa fa-envelope"></i> Edit Profile</a></li>
                <li><a href="#"><i class="fa fa-comments"></i> Sign Out</a></li>
              </ul>
            </li>
          </div>
        <?php } else { ?>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">
            <li>
              <p class="navbar-text">Already have an account?</p>
            </li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown"><b>Login</b> <span class="caret"></span></a>
              <ul id="login-dp" class="dropdown-menu">
                <li>
                  <div class="row">
                    <div class="col-md-12">
                      <label>Login:</label>
                      <form data-toggle="validator" data-focus="false" class="form" role="form" method="post" action="login" accept-charset="UTF-8" id="formSignIn">
                        <div class="form-group">
                          <label class="sr-only" for="exampleInputEmail2">Email address</label>
                          <input type="email" class="form-control" id="login_email" placeholder="Email address" name="login_email" required>
                        </div>
                        <div class="form-group">
                          <label class="sr-only" for="exampleInputPassword2">Password</label>
                          <input type="password" class="form-control" id="login_password" placeholder="Password" name="login_password" required>
                          <div class="help-block text-right"><a href="">Forget the password?</a></div>
                        </div>
                        <div class="form-group">
                          <button type="submit" class="btn btn-primary btn-block" id="btnSignin">Sign in</button>
                        </div>
                        <div class="checkbox">
                          <label>
                            <input type="checkbox"> keep me logged-in
                          </label>
                        </div>
                      </form>
                    </div>
                  </div>
                </li>
              </ul>
            </li>
          </ul>
        </div><!--/.navbar-collapse -->
        <?php
    } ?>
      </div>
    </nav>
