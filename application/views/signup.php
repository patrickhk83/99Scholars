<?php include Kohana::find_file('views', 'header') ?>

      <div class="row row-offcanvas row-offcanvas-right">
        
        <div class="col-xs- col-sm-12 col-lg-6 col-md-6 col-lg-offset-3 col-md-offset-3">
          <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>
          <?php if(isset($after_submit) && $after_submit) { ?>
            <h4>One more step to submit your conference!</h4>
          <?php } ?>
          <?php if(isset($error)) { ?>
            <div class="alert alert-warning"><?php echo $error ?></div>
          <?php } ?>
          <div class="jumbotron">
           <h3>Signup with 
            <?php
                $kopauth = Kopauth::instance();
                $error_message = Session::instance()->get_once('kopauth_error');
                
                // Display error flash message if set
                if ($error_message)
                {
                    unset($error_message['raw']);
                    
                    echo '<div class="alert alert-danger">';
                    foreach ($error_message as $key => $value)
                    {
                        echo '<p><strong>'.$key.':</strong> '.$value.'</p>';
                    }
                    echo '</div>';
                }
                
                // Create list of configured providers
                foreach ($kopauth->env['Strategy'] as $strategy)
                {
                    $is_authenticated = $kopauth->is_authenticated($strategy['strategy_url_name']);
                    
                    $auth_route = URL::site(Route::get('kopauth')->uri(array(
                        'action'   => 'authenticate',
                        'strategy' => $strategy['strategy_url_name']))
                    );
                    
                    $button_class = $is_authenticated ? 'btn-success' : 'btn-primary';
                    
                    // Start Row
                    echo '<div class="row">';
                    
                    // Auth Buttom Column
                    echo '<a href="'.$auth_route.'" >'.$strategy['strategy_name'].'</a>';
                   
                    
                    // View Data Column
                    echo '<div class="col-lg-2"><p>';
                    if ($is_authenticated)
                    {
                        $sessiondata_route = URL::site(Route::get('kopauth')->uri(array(
                            'action'   => 'sessiondata',
                            'strategy' => $strategy['strategy_url_name']))
                        );
                        
                        echo '<a href="'.$sessiondata_route.'" class="btn btn-default btn-block">Session Data</a>';
                    }
                    echo '</p></div>';
                    
                    // Logout Column
                    echo '<div class="col-lg-2"><p>';
                    if ($is_authenticated)
                    {
                        $logout_route = URL::site(Route::get('kopauth')->uri(array(
                            'action'   => 'logout',
                            'strategy' => $strategy['strategy_url_name']))
                        );
                        
                        echo '<a href="'.$logout_route.'" class="btn btn-default btn-block">Logout</a>';
                    }
                    echo '</p></div>';
                    
                    // End Row
                    echo '</div>';
                }
            ?> </h3></div>
          
          <div class="row">
            <div class="col-lg-12">
              <h3>Signup with email</h3>
              <form role="form" action="<?php echo URL::site('signup') ?>" method="post">
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
