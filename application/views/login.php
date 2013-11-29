<?php include Kohana::find_file('views', 'header') ?>

<div class="row row-offcanvas row-offcanvas-right">
        
        <div class="col-xs- col-sm-12 col-lg-6 col-md-6 col-lg-offset-3 col-md-offset-3">
          <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>
          <?php if(isset($error)) { ?>
            <div class="alert alert-warning"><?php echo $error ?></div>
          <?php } ?>
          <div class="row">
            <div class="col-lg-12">
              <h3>Sign in to 99Scholars</h3>
              <form role="form" method="post" action="<?php echo URL::site('login') ?>">
                <div class="form-group">
                  <label for="userEmail">Email address</label>
                  <input type="email" class="form-control" id="userEmail" placeholder="Enter your email" name="email"/>  
                </div>
                <div class="form-group">
                  <label for="userPassword">Password</label>
                  <input type="password" class="form-control" id="userPassword" placeholder="Enter your password" name="password"/>
                </div>
                <button type="submit" class="btn btn-success">Sign in</button> or <a href="<?php echo URL::site('signup') ?>">Signup for 99Scholars</a>
              </form>
            </div><!--/span-->            
          </div><!--/row-->
        </div><!--/span-->

      </div><!--/row-->

      <hr>

      <footer>
        <p>&copy; 99Scholars 2013</p>
      </footer>

    </div><!--/.container-->



    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php echo HTML::script('js/jquery.js') ?>
    <?php echo HTML::script('js/bootstrap.min.js') ?>
    <?php echo HTML::script('js/offcanvas.js') ?>
  </body>
</html>