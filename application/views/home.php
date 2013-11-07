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
                        <option value="0">Select Category</option>
                        <option value="1">Technology</option>
                        <option value="2">Linguistics</option>
                        <option value="3">Psychology</option>
                      </select>
                    </div>
                  </div>
                  <div class="add-criteria-link"><a href="#" id="add-category-link">Add more category</a></div>      
                </li>
                <li class="criteria-container"><h5>Call for abstract only <input type="checkbox" id="accept-abstract"/></h5></li>
                <li><h5>Filter by Conference Date</h5></li>
                <li class="criteria-container">
                  <div class="form-group">
                    <input type="text" class="form-control datepicker criteria-option" placeholder="Start Date" id="start-date" data-date-format="dd/mm/yyyy">
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control datepicker criteria-option" placeholder="End Date" id="end-date" data-date-format="dd/mm/yyyy"/>
                  </div>
                </li>
                <li><h5>Filter by Type</h5></li>
                <li class="criteria-container">
                  <div id="type-criteria">
                    <div id="type-option1">
                      <select class="form-control criteria-option">
                        <option value="0">Select Type</option>
                        <option value="1">Conference</option>
                        <option value="2">Seminar</option>
                        <option value="3">Workshop</option>
                        <option value="4">Webinar</option>
                        <option value="5">Online Conference</option>
                      </select>
                    </div>
                  </div>
                  <div class="add-criteria-link"><a href="#" id="add-type-link">Add more type</a></div>
                </li>
                <li><h5>Filter by Country</h5></li>
                <li class="criteria-container">
                  <div id="country-criteria">
                    <div id="country-option1">
                      <select class="form-control criteria-option">
                        <option value="0">Select Country</option>
                        <option value="1">United States</option>
                        <option value="2">Brazil</option>
                        <option value="3">China</option>
                        <option value="4">Hong Kong</option>
                        <option value="5">Singapore</option>
                        <option value="6">Thailand</option>
                      </select>
                    </div>
                  </div>
                  <div class="add-criteria-link"><a href="#" id="add-country-link">Add more country</a></div>
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
              <div id="total-conference-display">
                <h2><span id="total-display"><?php echo $total ?></span> Conferences found</h2> <span id="clear-filter-container">( <a href="#" id="clear-filter-btn">clear all filter</a> )</span>
              </div>
            <div class="row">
	            <div class="col-lg-12">
                <div id="conf-list">
                  
	                <?php foreach ($conferences as $conf): ?>
	                	<div class="row">
  		              	<div class="col-lg-6">
  		              	  <p><strong><a href="<?php echo URL::site('conference/view/'.$conf['id'])?>"><?php echo $conf['name'] ?></a></strong> <br/> <?php echo $conf['location'] ?></p>
  		              	</div>
  		              	<div class="col-lg-2"><button type="button" class="btn btn-<?php echo $conf['type_style'] ?> btn-xs"><?php echo $conf['type'] ?></button></div>
  		              	<div class="col-lg-2"><?php echo $conf['duration'] ?></div>
  		              	<div class="col-lg-2">
                        <?php if($conf['is_booked']) { ?>
                          <button type="button" class="btn btn-info btn-block" onclick="cancelBooking(<?php echo $conf['id'] ?>, this)">Cancel booking</button>
                        <?php } else { ?>
                          <button type="button" class="btn btn-primary btn-block" onclick="bookConference(<?php echo $conf['id'] ?>, this)">Book</button>
                        <?php } ?>
                      </div>
		                </div><!--/row-->
	            	  <?php endforeach ?>
                  
                </div>
                <div class="paging"><a href="/99scholars/conference/search?page=2" id="next-paging"></a></div>
	              
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
    <script src="js/jquery.infinitescroll.min.js"></script>
  </body>
</html>
