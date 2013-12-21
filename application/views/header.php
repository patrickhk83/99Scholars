<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Expand your network through conferences - 99Scholars</title>

    <!-- Bootstrap core CSS -->
    <?php echo HTML::style('css/bootstrap.min.css') ?>

    <!-- Custom styles for this template -->
    <?php echo HTML::style('css/offcanvas.css') ?>

    <?php echo HTML::style('css/datepicker.css') ?>
    <!-- New Style -->
    <?php echo HTML::style('css/newstyle.css') ?>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
    <script type="text/javascript" src="http://twitter.github.com/bootstrap/assets/js/bootstrap-dropdown.js"></script>
    <input type="hidden" id="base-url" value="<?php echo URL::site('') ?>">
    <div class="navbar navbar-fixed-top navbar-inverse" role="navigation">
      <div class="nav-logo hidden-xs">
        <div class="container">
          <span class="fleft"><img src="img/logo-<?php $imgname=basename($_SERVER['PHP_SELF']); echo preg_replace('/\.php$/', '', $imgname);?>.png"></span>
          <ul class="social-icons">
            <li><a href=""><img src="img/fb.png"></a></li>
            <li><a href=""><img src="img/twitter.png"></a></li>
            <li><a href=""><img src="img/linkedin.png"></a></li>
          </ul>   
          <div class="clearfix"></div>
        </div>
      </div>
      <div class="container">
        <div class="navbar-header" style="background-image: url(img/moblogo-<?php $imgname=basename($_SERVER['PHP_SELF']); echo preg_replace('/\.php$/', '', $imgname);?>.png); background-position: center center; background-repeat: no-repeat; height:100%">
          <button type="button" class="navbar-toggle fleft toggle-btn" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <span class="fright mobsearch visible-xs"><a href=""><img src="img/mobsearch.png"></a></span>
        </div>
        <div class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li class="active"><a href="<?php echo URL::site('') ?>">Home</a></li>
            <li><?php echo HTML::anchor("/events", "Events"); ?></li>
            <li><?php echo HTML::anchor("/people", "People"); ?></li>
			      <li><?php echo HTML::anchor("/design", "Design"); ?></li>
            <li><?php echo HTML::anchor("/jobs", "Jobs"); ?></li>
            <li><?php echo HTML::anchor("/Article", "Blog"); ?></li>
          </ul>

          <?php if(!Service_Login::is_login()) { ?>

            <!--<form class="navbar-form navbar-right" action="<?php echo URL::site('login/email') ?>" method="post">
              <div class="form-group">
                <input type="text" placeholder="Email" class="form-control" name="email">
              </div>
              <div class="form-group">
                <input type="password" placeholder="Password" class="form-control" name="password">
              </div>-->
            <div class="header-login">
              <a href="<?php echo URL::site('signup') ?>"><button type="button" class="btn btn-default signup-button">Register</button></a>
              <a class="btn btn-success signin-button dropdown-toggle" href="#" data-toggle="dropdown">Sign In</a>
              <div class="dropdown-menu" style="padding: 15px; padding-bottom: 0px;">
                <form style="margin: 0px" accept-charset="UTF-8" action="<?php echo URL::site('login/email') ?>" method="post"><div style="margin:0;padding:0;display:inline"><input name="utf8" type="hidden" value="&#x2713;" /><input name="authenticity_token" type="hidden" value="4L/A2ZMYkhTD3IiNDMTuB/fhPRvyCNGEsaZocUUpw40=" /></div>
                   <fieldset class='textbox' style="padding:10px">
                     <input style="margin-top: 8px" type="text" placeholder="Username" />
                     <input style="margin-top: 8px" type="password" placeholder="Passsword" />
                     <input class="btn-primary" name="commit" type="submit" value="Log In" />
                   </fieldset>
                 </form>
              </div>  
            </div>
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