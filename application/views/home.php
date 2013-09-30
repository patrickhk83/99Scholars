<?php include Kohana::find_file('views', 'header') ?>

      <div class="row row-offcanvas row-offcanvas-right">
      
        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
          <div class="well sidebar-nav">
            <ul class="nav">
              <li>Filter by Country</li>
              <li>
              	<div class="btn-group">
              	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
              	    Select Country <span class="caret"></span>
              	  </button>
              	  <ul class="dropdown-menu" role="menu">
              	    <li><a href="#">Argentina</a></li>
              	    <li><a href="#">Brazil</a></li>
              	    <li><a href="#">China</a></li>
              	    <li><a href="#">Hong Kong</a></li>
              	    <li><a href="#">Singapore</a></li>
              	    <li><a href="#">Thailand</a></li>
              	  </ul>
              	</div><!-- button -->
              </li>
              <li>Type</li>
              <li>
              	<div class="btn-group">
              	  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
              	    All Type <span class="caret"></span>
              	  </button>
              	  <ul class="dropdown-menu" role="menu">
              	    <li><a href="#">Conference</a></li>
              	    <li><a href="#">Seminar</a></li>
              	    <li><a href="#">Workshop</a></li>
              	    <li><a href="#">Webinar</a></li>
              	    <li><a href="#">Online Conference</a></li>
              	  </ul>
              	</div><!-- button -->
              </li>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        
        <div class="col-xs-12 col-sm-9">
          <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>
          <div class="jumbotron">
            <h2>Submit your conference today!</h2>
            <p>With 99Scholars, your conference will be recognized by more people around the world.</p>
            <p><a href="<?php echo URL::site('conference/submit') ?>"><button type="button" class="btn btn-primary btn-lg">Submit conference</button></a></p>
          </div>
          <div class="row">
            <div class="col-lg-12">
              <h2>Conferences</h2>
            </div><!--/span-->
            <div class="row conf-list">
	            <div class="col-lg-12">

	                <?php foreach ($conferences as $conf): ?>
	                	<div class="row">
		              	<div class="col-lg-6">
		              	  <p><strong><a href="schedule.html"><?php echo $conf['name'] ?></a></strong> <br/> <?php echo $conf['location'] ?></p>
		              	</div>
		              	<div class="col-lg-2"><?php echo $conf['type'] ?></div>
		              	<div class="col-lg-2"><?php echo $conf['duration'] ?></div>
		              	<div class="col-lg-2"><a class="btn btn-info" href="#">Book</a></div>
		              </div><!--/row-->
	            	<?php endforeach ?>
	              
	              <div class="row">
	              	<div class="col-lg-12">
	              		<ul class="pagination">
	              		  <li class="disabled"><a href="#">&laquo;</a></li>
	              		  <li class="active"><a href="#">1</a></li>
	              		  <li><a href="#">2</a></li>
	              		  <li><a href="#">3</a></li>
	              		  <li><a href="#">4</a></li>
	              		  <li><a href="#">5</a></li>
	              		  <li><a href="#">&raquo;</a></li>
	              		</ul>
	              	</div>
	              </div><!--/row-->
	              
	            </div><!--/span-->
            </div><!--/row-->
            
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
    <script src="js/offcanvas.js"></script>
  </body>
</html>
