<?php include Kohana::find_file('views', 'header') ?>

      <div class="row row-offcanvas row-offcanvas-right">
        
        <div class="col-xs- col-sm-12 col-lg-6 col-md-6 col-lg-offset-3 col-md-offset-3">
          <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>
          <?php if(isset($after_submit) && $after_submit) { ?>
            <h4>One more step to submit your conference!</h4>
          <?php } ?>
          <div class="jumbotron">
            <h3>Signup with <a href="#">Facebook</a> or <a href="#">LinkedIn</a></h3>
          </div>
          
          <div class="row">
            <div class="col-lg-12">
              <h3>Signup with email</h3>
              <form role="form">
              	<div class="form-group">
              	  <label for="userEmail">Email address</label>
              	  <input type="email" class="form-control" id="userEmail" placeholder="Enter email"/>	
              	</div>
              	<div class="form-group">
              	  <label for="userPassword">Password</label>
              	  <input type="password" class="form-control" id="userPassword" placeholder="Password" />
              	</div>
              	<div class="form-group">
              	  <label for="confirmPassword">Confirm Password</label>
              	  <input type="password" class="form-control" id="confirmPassword" placeholder="Password again" />
              	</div>
              	<button type="submit" class="btn btn-success">Signup</button> or <a href="#">Cancel</a>
              </form>
            </div><!--/span-->            
          </div><!--/row-->
        </div><!--/span-->

      </div><!--/row-->

      <hr>

      <footer>
        <p>&copy; Company 2013</p>
      </footer>

    </div><!--/.container-->



    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="offcanvas.js"></script>
  </body>
</html>
