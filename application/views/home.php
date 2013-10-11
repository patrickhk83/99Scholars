<?php include Kohana::find_file('views', 'header') ?>

      <div class="row row-offcanvas row-offcanvas-right">
      
        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
          <div class="well sidebar-nav">
            <form role="form">
              <ul class="nav">
                <li><h5>Filter by Category</h5></li>
                <li class="criteria-container">
                  <div id="category-criteria">
                    <div id="category-option1">
                      <select class="form-control criteria-option">
                        <option>Select Category</option>
                        <option>Technology</option>
                        <option>Linguistics</option>
                        <option>Psychology</option>
                      </select>
                    </div>
                  </div>      
                </li>
                <li class="criteria-container"><h5>Call for abstract only <input type="checkbox"/></h5></li>
                <li><h5>Filter by Conference Date</h5></li>
                <li class="criteria-container">
                  <div class="form-group">
                    <input type="text" class="form-control datepicker criteria-option" placeholder="Start Date">
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control datepicker criteria-option" placeholder="End Date"/>
                  </div>
                </li>
                <li><h5>Filter by Type</h5></li>
                <li class="criteria-container">
                  <div id="type-criteria">
                    <div id="type-option1">
                      <select class="form-control criteria-option">
                        <option>Select Type</option>
                        <option>Conference</option>
                        <option>Seminar</option>
                        <option>Workshop</option>
                        <option>Webinar</option>
                        <option>Online Conference</option>
                      </select>
                    </div>
                  </div>
                </li>
                <li><h5>Filter by Country</h5></li>
                <li class="criteria-container">
                  <div id="country-criteria">
                    <div id="country-option1">
                      <select class="form-control criteria-option">
                        <option>Argentina</option>
                        <option>Brazil</option>
                        <option>China</option>
                        <option>Hong Kong</option>
                        <option>Singapore</option>
                        <option>Thailand</option>
                      </select>
                    </div>
                  </div>
                </li>
              </ul>
            </form>
          </div><!--/.well -->
        </div><!--/span-->
        
        <div class="col-xs-12 col-sm-9">
          <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>

          <div class="panel panel-default">
            <div class="panel-body">
              <h5>Submit your conference today!</h5>
              <p>Have a conference? With 99Scholars, your conference will be recognized by more people around the world.</p>
              <p><a href="<?php echo URL::site('conference/submit') ?>"><button type="button" class="btn btn-primary btn-sm">Submit conference</button></a></p>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-12">
              <h2>1,298 Conferences found</h2> <br>
            <div class="row">
	            <div class="col-lg-12">
                <div id="conf-list">
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
                </div>
	              
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
    <script src="js/offcanvas.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/home.js"></script>
  </body>
</html>
