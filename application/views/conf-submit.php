<?php include Kohana::find_file('views', 'header') ?>

      <div class="row row-offcanvas row-offcanvas-right">
        
        <div class="col-xs- col-sm-12 col-lg-8 col-md-8 col-lg-offset-2 col-md-offset-2">
          <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>          
          <div class="row">
            <div class="col-lg-12">
              <p><h3>Submit your conference</h3></p>
              <p>Enter information about your conference</p>
              <form id="form-conference" role="form" action="<?php echo URL::site('new/conference') ?>" method="post">
              <div class="panel panel-default">
                  <div class="panel-heading">General Information</div>
	              <div class="panel-body">
	              	<div class="form-group">
	              	  <label>Type</label>
	              	  <select class="form-control required" name="Conference[type]" id="conf-type">
	              	    <option value="">Choose Conference's Type</option>
	              	    <option value="1">Conference</option>
	              	    <option value="2">Seminar</option>
	              	  </select>
	              	</div>
	              	<div id="form-body">

	              	</div>
	              </div>
              	</div>
              	
              	<div class="panel panel-default" id="address-form">
              	  <div class="panel-heading">Venue's Address</div>
              	  <div class="panel-body">
              	  
              	    <div class="form-group">
              	      <label>Venue Name</label>
              	      <input type="text" class="form-control required" id="venue-name" placeholder="Name of the venue" name="Venue[name]"/>
              	    </div>
              	    
	              	<div class="form-group">
	              	  <label>Address</label>
	              	  <input type="text" class="form-control" id="address" placeholder="Address of the venue" name="Address[address]"/>
	              	</div>
	              	
	              	<div class="form-group">
	              	  <label>City</label>
	              	  <input type="text" class="form-control required" id="city" placeholder="City" name="Address[city]"/>
	              	</div>
	              	
	              	<div class="form-group">
	              	  <label>State/Province</label>
	              	  <input type="text" class="form-control" id="state" placeholder="State/Province" name="Address[state]"/>
	              	</div>
	              	
	              	<div class="form-group">
	              	  <label>Postal Code</label>
	              	  <input type="text" class="form-control digits" id="postal-code" placeholder="Postal Code" name="Address[postal_code]"/>
	              	</div>
	              	
	              	<div class="form-group">
	              	  <label>Country</label>
	              	  <select class="form-control required" name="Address[country]">
	              	    <option value="">Choose Country</option>
	              	    <? foreach($countries as $short_name => $full_name){ ?>
                        <option value="<?= $short_name ?>"><?= $full_name ?></option>
                      <? } ?>
	              	  </select>
	              	</div>
	              </div>
	            </div>
              	<p id="conf-submit-container"><button type="submit" class="btn btn-success">Submit Conference</button> or <a href="#">Cancel</a></p>
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
    <?php echo HTML::script('js/bootstrap-datepicker.js') ?>
    <?php echo HTML::script('js/jquery.validate.min.js') ?>
    <?php echo HTML::script('js/conf-submit.js') ?>
  </body>
</html>
