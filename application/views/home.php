<?php include Kohana::find_file('views', 'header') ?>

      <div class="row row-offcanvas row-offcanvas-right">
      
        <div class="col-xs-6 col-sm-3 sidebar-offcanvas hidden-xs" id="sidebar" role="navigation">
          <div class="well sidebar-nav filter">
            <form role="form">            	
              <ul class="nav"> 
                <li><h5 class="font-gothic">Filter by Subject</h5></li>
                <li class="criteria-container">
                  <div id="category-criteria">
                    <div id="category-option1" class="select-category">
                      <label>
                      <select class="form-control criteria-option form-box">
                        <option value="0">Select Subject</option>
                        <!--option value="1">Technology</option-->
                        <option value="2">Linguistics</option>
                        <option value="3">Psychology</option>
                      </select>
                      </label>
                    </div>
                  </div>
                  <div class="add-criteria-link"><a href="#" id="add-category-link">Add more subject</a></div>
                  <div class="clearfix"></div>      
                </li>
                <li><h5 class="font-gothic">Filter by Country</h5></li>
                <li class="criteria-container">
                  <div id="country-criteria">
                    <div id="country-option1" class="select-category">
                      <label>
                      <select class="form-control criteria-option form-box">
                        <option value="0">Select Country</option>
                        <? foreach($countries as $short_name => $full_name){ ?>
                          <option value="<?= $short_name ?>"><?= $full_name ?></option>
                        <? } ?>
                      </select>
                      </label>
                    </div>
                  </div>
                  <div class="add-criteria-link"><a href="#" id="add-country-link">Add more country</a></div>
                  <div class="clearfix"></div>   
                </li>
                <li><h5 class="font-gothic">Filter by Event Type</h5></li>
                <li class="criteria-container">
                  <div id="type-criteria">
                    <div id="type-option1" class="select-category">
                      <label>
                      <select class="form-control criteria-option form-box">
                        <option value="0">Select Type</option>
                        <option value="1">Conference</option>
                        <option value="2">Seminar</option>
                      </select>
                    </label>
                    </div>
                  </div>
                  <div class="add-criteria-link"><a href="#" id="add-type-link">Add more event type</a></div>
                  <div class="clearfix"></div>   
                </li>
                <li class="criteria-container"><h5 class="font-gothic">Call for abstract only <input type="checkbox" id="accept-abstract"/></h5></li>
                <li><h5 class="font-gothic">Filter by Event Date</h5></li>
                <li class="criteria-container">
                  <div class="form-group">
                    <input type="text" class="form-control datepicker criteria-option form-box-date" placeholder="Start Date" id="start-date" data-date-format="dd/mm/yyyy">
                  </div>
                  <div class="form-group">
                    <input type="text" class="form-control datepicker criteria-option form-box-date" placeholder="End Date" id="end-date" data-date-format="dd/mm/yyyy"/>
                  </div>
                </li>
              </ul>
            </form>
          </div><!--/.well -->
        </div><!--/span-->
        
        <div class="col-xs-12 col-sm-9">
          <!--<p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>-->

          <div class="panel panel-default">
            <div class="panel-body academic-box">
              <h5>Submit your academic event TODAY!</h5>
              <p>Have a conference or seminar? WIth 99Scholars, your academic event will be recognized by more people around the world.</p>
              <p><a href="<?php echo URL::site('conference/submit') ?>"><button type="button" class="btn btn-primary btn-sm academic-btn">Submit an Academic Event</button></a></p>
            </div>
          </div>

          <div class="row">
            <div class="col-lg-12">
                <div class="row">
                          <div id="total-conference-display">
                            <h2><span id="total-display"><?php echo $total ?></span> <spen id="event-text">Events found</span></h2> <span class="category-container"> [ <span id="categories"></span> ]</span> <span class="clear-filter-container"> ( <a href="#" id="clear-filter-btn">clear all filter</a> )</span>
                          </div>
                          <a id="filter-toggle" class="visible-xs fright filter-toggle">Filter by <span class="caret" style="border-top-color: #6a6a6a"></span></a>
                          <div class="clearfix"></div>
                          <div id="filter-toggle-on" class="filter-toggle-on">
                              <form role="form">
                                  <ul class="nav">
                                      <li><h5 class="font-gothic">Filter by Subject</h5></li>
                                      <li class="criteria-container">
                                          <div id="category-criteria">
                                              <div id="category-option1" class="select-category">
                                                  <label>
                                                      <select class="form-control criteria-option form-box">
                                                          <option value="0">Select Subject</option>
                                                          <!--option value="1">Technology</option-->
                                                          <option value="2">Linguistics</option>
                                                          <option value="3">Psychology</option>
                                                      </select>
                                                  </label>
                                              </div>
                                          </div>
                                          <div class="add-criteria-link"><a href="#" id="add-category-link">Add more subject</a></div>
                                          <div class="clearfix"></div>
                                      </li>
                                      <li><h5 class="font-gothic">Filter by Country</h5></li>
                                      <li class="criteria-container">
                                          <div id="country-criteria">
                                              <div id="country-option1" class="select-category">
                                                  <label>
                                                      <select class="form-control criteria-option form-box">
                                                          <option value="0">Select Country</option>
                                                          <? foreach($countries as $short_name => $full_name){ ?>
                                                              <option value="<?= $short_name ?>"><?= $full_name ?></option>
                                                          <? } ?>
                                                      </select>
                                                  </label>
                                              </div>
                                          </div>
                                          <div class="add-criteria-link"><a href="#" id="add-country-link">Add more country</a></div>
                                          <div class="clearfix"></div>
                                      </li>
                                      <li><h5 class="font-gothic">Filter by Event Type</h5></li>
                                      <li class="criteria-container">
                                          <div id="type-criteria">
                                              <div id="type-option1" class="select-category">
                                                  <label>
                                                      <select class="form-control criteria-option form-box">
                                                          <option value="0">Select Type</option>
                                                          <option value="1">Conference</option>
                                                          <option value="2">Seminar</option>
                                                      </select>
                                                  </label>
                                              </div>
                                          </div>
                                          <div class="add-criteria-link"><a href="#" id="add-type-link">Add more event type</a></div>
                                          <div class="clearfix"></div>
                                      </li>
                                      <li class="criteria-container"><h5 class="font-gothic">Call for abstract only <input type="checkbox" id="accept-abstract"/></h5></li>
                                      <li><h5 class="font-gothic">Filter by Event Date</h5></li>
                                      <li class="criteria-container">
                                          <div class="form-group">
                                              <input type="text" class="form-control datepicker criteria-option form-box-date" placeholder="Start Date" id="start-date" data-date-format="dd/mm/yyyy">
                                          </div>
                                          <div class="form-group">
                                              <input type="text" class="form-control datepicker criteria-option form-box-date" placeholder="End Date" id="end-date" data-date-format="dd/mm/yyyy"/>
                                          </div>
                                      </li>
                                  </ul>
                              </form>
                          </div>
                    <script type="text/javascript">
                        $(document).ready(
                            function(){
                                $("#filter-toggle-on").hide();
                                $("#filter-toggle").click(function () {
                                    $("#filter-toggle-on").fadeToggle();
                                });
                            });
                    </script>
                </div>
                <div class="row hidden-xs">
                    <div class="search-box">
                        <label>
                            <input type="search" name="search_text" id="search_text" placeholder="Search">
                            <button type="button" class="btn btn-primary btn-block search-btn" onclick="updateSearchResult();">Search</button>
                        </label>
                    </div>
                </div>
            <div class="row">
	            <div class="col-lg-12 event-list">
                <div id="conf-list">
                  
	                <?php foreach ($conferences as $conf): ?>
	                	<div class="row event-row">
  		              	<div class="col-sm-6">
  		              	  <p><strong><a href="<?php echo URL::site('conference/view/'.$conf['id'])?>"><?php echo $conf['name'] ?></a></strong> <br/> <?php echo $conf['location'] ?></p>
                        <h6>118 Attending</h6>
  		              	</div>
  		              	<div class="col-sm-2 hidden-xs"><button type="button" class="btn btn-<?php echo $conf['type_style'] ?> btn-xs"><?php echo $conf['type'] ?></button></div>
  		              	<div class="col-sm-2 pad0 event-date"><?php echo $conf['duration'] ?></div>
  		              	<div class="col-sm-2">
                        <?php if($conf['is_booked']) { ?>
                          <button type="button" class="btn btn-info btn-block" onclick="cancelBooking(<?php echo $conf['id'] ?>, this)">Cancel booking</button>
                        <?php } else { ?>
                          <button type="button" class="btn btn-primary btn-block book-btn" onclick="bookConference(<?php echo $conf['id'] ?>, this)">Book</button>
                        <?php } ?>
                        </div>
                        <div class="col-sm-2 visible-xs event-type"><button type="button" class="btn btn-<?php echo $conf['type_style'] ?> btn-xs"><?php echo $conf['type'] ?></button></div>
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
        <p>&copy; 99Scholars 2013</p>
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
    <script language="javascript">
    $('.dropdown-toggle').dropdown();
    $('.dropdown-menu').find('form').click(function (e) {
        e.stopPropagation();
      });
    </script>
  </body>
</html>
