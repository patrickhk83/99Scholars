<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
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
    <?php echo HTML::style('css/socialbutton.css') ?>
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.min.css">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
      <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
      <script type="text/javascript" src="http://twitter.github.com/bootstrap/assets/js/bootstrap-dropdown.js"></script>
  </head>

  <body>
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
            <li><?php echo HTML::anchor("/", "Events"); ?></li>
            <li><?php echo HTML::anchor("#", "People"); ?></li>
			      <li><?php echo HTML::anchor("#", "Design"); ?></li>
            <li><?php echo HTML::anchor("#", "Jobs"); ?></li>
            <li><?php echo HTML::anchor("#", "Blog"); ?></li>
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
              <div class="fright">
              <a class="btn dropdown-toggle signin-button" href="#" data-toggle="dropdown">Sign In</a>
              <div class="dropdown-menu login-dropdown">
                <form style="margin: 0px" accept-charset="UTF-8" action="<?php echo URL::site('login/email') ?>" method="post"><div style="margin:0;padding:0;display:inline"><input name="utf8" type="hidden" value="&#x2713;" /><input name="authenticity_token" type="hidden" value="4L/A2ZMYkhTD3IiNDMTuB/fhPRvyCNGEsaZocUUpw40=" /></div>
                   <fieldset class='textbox'>
                     <input type="text" placeholder="Username" />
                     <input type="password" placeholder="Password" />
                     <input type="checkbox" class="login-checkbox"><h6>Remember Me</h6>
                     <input class="btn-primary login" name="commit" type="submit" value="Log In" />
                     <h6 class="forgot"><a href="">Forgot your password?</a></h6>
                     <div class="login-border"></div>
                     <button class="btn btn-facebook"><i class="fa fa-facebook"></i> | Facebook</button>
                     <button class="btn btn-linkedin"><i class="fa fa-linkedin"></i> | LinkedIn</button>
                     <button class="btn btn-google-plus"><i class="fa fa-google-plus"></i> | Google Plus</button>
                   </fieldset>
                 </form>
              </div>
              </div>
                <!--<a href="<?php echo URL::site('signup') ?>"><button type="button" class="btn btn-default signup-button">Register</button></a>-->
                <div class="fright">
                    <a class="btn dropdown-toggle signup-button" href="#" data-toggle="dropdown">Register</a>
                    <div class="dropdown-menu email-dropdown">
                        <form style="margin: 0px" accept-charset="UTF-8" action="<?php echo URL::site('signup') ?>" method="post">
                            <div class="form-group">
                                <label for="first-name">First Name</label>
                                <input type="text" class="form-control" id="first-name" placeholder="Your First Name" name="first_name"/>
                            </div>
                            <div class="form-group">
                                <label for="last-name">Last Name</label>
                                <input type="text" class="form-control" id="last-name" placeholder="Your Last Name"name="last_name"/>
                            </div>
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input type="email" class="form-control" id="email" placeholder="Enter email" name="email"/>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" id="password" placeholder="Password" name="password"/>
                            </div>
                            <div class="form-group">
                                <label for="confirm-password">Confirm Password</label>
                                <input type="password" class="form-control" id="confirm-password" placeholder="Password again" name="confirm_password"/>
                            </div>
                            <button type="submit" class="btn btn-success signup-btn">Signup</button>
                        </form>
                    </div>
                </div>
                <script type="text/javascript">
                $('.login-dropdown, .email-dropdown').click(function(event){
                event.stopPropagation();
                });
                </script>
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