<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Conference Submission - 99Scholars</title>

    <!-- Bootstrap core CSS -->
    <?php echo HTML::style('css/bootstrap.min.css') ?>

    <!-- Custom styles for this template -->
    <?php echo HTML::style('css/offcanvas.css') ?>

    <?php echo HTML::style('css/datepicker.css') ?>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <input type="hidden" id="base-url" value="<?php echo URL::site('') ?>">
    <div class="navbar navbar-fixed-top navbar-inverse" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">99Scholars</a>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="<?php echo URL::site('') ?>">Home</a></li>
            <li><a href="#about">About</a></li>
			<li><?php echo HTML::anchor("blogarticles", "Blog"); ?></li>
            <li><a href="#contact">Contact</a></li>
          </ul>

          <?php if(!Service_Login::is_login()) { ?>

            <form class="navbar-form navbar-right" action="<?php echo URL::site('login') ?>" method="post">
              <div class="form-group">
                <input type="text" placeholder="Email" class="form-control" name="email">
              </div>
              <div class="form-group">
                <input type="password" placeholder="Password" class="form-control" name="password">
              </div>
              <button type="submit" class="btn btn-success">Sign in</button>
              <a href="<?php echo URL::site('signup') ?>"><button type="button" class="btn btn-default">Sign up</button></a>
            </form>

            <?php } else { ?>

            <div class="navbar-form navbar-right">
              <a href="<?php echo URL::site('profile') ?>"><button type="submit" class="btn btn-default">My Profile</button></a>
              <a href="<?php echo URL::site('logout') ?>"><button type="button" class="btn btn-danger">Log out</button></a>
            </div>

          <?php } ?>
        </div><!-- /.nav-collapse -->
      </div><!-- /.container -->
    </div><!-- /.navbar -->

    <div class="container">