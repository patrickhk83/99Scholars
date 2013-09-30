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
              <form role="form" action="<?php echo URL::site('conference/submit') ?>" method="post">
              <div class="panel panel-default">
                  <div class="panel-heading">General Information</div>
	              <div class="panel-body">
	              	<div class="form-group">
	              	  <label for="conf-name">Conference's Name</label>
	              	  <input type="text" class="form-control" id="conf-name" placeholder="Enter name of the conference" name="name"/>	
	              	</div>
	              	
	              	<div class="form-group">
	              	  <label>Duration</label>
	              	  <div class="form-inline">
	              	    <div class="form-group">
	              	      <input type="date" class="form-control datepicker" id="start-date" placeholder="22/09/2013" name="start_date" data-date-format="dd/mm/yyyy"/>
	              	    </div>
	              	    <div class="form-group">
	              	      to
	              	    </div>
	              	    <div class="form-group">
	              	      <input type="date" class="form-control datepicker" id="end-date" placeholder="24/09/2013" name="end_date" data-date-format="dd/mm/yyyy"/>
	              	    </div>
	              	  </div>
	              	</div>
	              	
	              	<div class="form-group">
	              	  <label>Description</label>
	              	  <textarea class="form-control" rows="4" placeholder="What your conference is about?" name="description"></textarea>
	              	</div>

	              	<div class="form-group">
	              	  <label>Registration Period</label>
	              	  <div class="form-inline">
	              	    <div class="form-group">
	              	      <input type="date" class="form-control datepicker" id="regis-start" placeholder="22/09/2013" name="regis_start" data-date-format="dd/mm/yyyy"/>
	              	    </div>
	              	    <div class="form-group">
	              	      to
	              	    </div>
	              	    <div class="form-group">
	              	      <input type="date" class="form-control datepicker" id="regis-end" placeholder="24/09/2013" name="regis_end" data-date-format="dd/mm/yyyy"/>
	              	    </div>
	              	  </div>
	              	</div>
	              	
	              	<div class="form-group">
	              	  <label>Organizer</label>
	              	  <input type="text" class="form-control" id="organizer-name" placeholder="Name of the organizer" name="organizer"/>
	              	</div>
	              	
	              	<div class="form-group">
	              	  <label>Website</label>
	              	  <input type="text" class="form-control" id="website" placeholder="URL of conference's website" name="website"/>
	              	</div>
	              	
	              	<div class="form-group">
	              	  <label>Type</label>
	              	  <select class="form-control" name="type">
	              	    <option>Choose Conference's Type</option>
	              	    <option value="1">Conference</option>
	              	  </select>
	              	</div>
	              	
	              	<div class="form-group">
	              	  <label>Category</label>
	              	  <select class="form-control" name="category">
	              	    <option>Choose Conference's Category</option>
	              	    <option value="1">Technology</option>
	              	  </select>
	              	</div>
	              	
	              	<div class="form-group">
	              	  <label>Deadline For Abstracts/Proposals</label>
	              	  <input type="date" class="form-control datepicker" id="deadline" placeholder="10/09/2013" name="deadline" data-date-format="dd/mm/yyyy"/>
	              	</div>

	              	<div class="form-group">
	              	  <label>Notification of Acceptance</label>
	              	  <input type="date" class="form-control datepicker" id="accept_notify" placeholder="10/09/2013" name="accept_notify" data-date-format="dd/mm/yyyy"/>
	              	</div>

	              	
	              	<div class="form-group">
	              	  <label>Contact Person</label>
	              	  <input type="text" class="form-control" id="contact-person" placeholder="Name of contact person" name="contact_person"/>
	              	</div>
	              	
	              	<div class="form-group">
	              	  <label>Contact Email</label>
	              	  <input type="email" class="form-control" id="contact-email" placeholder="Email for contact" name="contact_email"/>
	              	</div>
	              	
	              	</div>
              	</div>
              	
              	<div class="panel panel-default">
              	  <div class="panel-heading">Venue's Address</div>
              	  <div class="panel-body">
              	  
              	    <div class="form-group">
              	      <label>Venue Name</label>
              	      <input type="text" class="form-control" id="address" placeholder="Name of the venue" name="venue_name"/>
              	    </div>
              	    
	              	<div class="form-group">
	              	  <label>Street Address</label>
	              	  <input type="text" class="form-control" id="address" placeholder="Address of the venue" name="address"/>
	              	</div>
	              	
	              	<div class="form-group">
	              	  <label>City</label>
	              	  <input type="text" class="form-control" id="city" placeholder="City" name="city"/>
	              	</div>
	              	
	              	<div class="form-group">
	              	  <label>State/Province</label>
	              	  <input type="text" class="form-control" id="state" placeholder="State/Province" name="state"/>
	              	</div>
	              	
	              	<div class="form-group">
	              	  <label>Postal Code</label>
	              	  <input type="text" class="form-control" id="state" placeholder="Postal Code" name="postal_code"/>
	              	</div>
	              	
	              	<div class="form-group">
	              	  <label>Country</label>
	              	  <select class="form-control" name="country">
	              	    <option>Choose Country</option>
	              	    <option value="1">United States</option>
	              	  </select>
	              	</div>
	              </div>
	            </div>
              	
              	
              	
              	<p><button type="submit" class="btn btn-success">Submit Conference</button> or <a href="#">Cancel</a></p>
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
    <?php echo HTML::script('js/jquery.js') ?>
    <?php echo HTML::script('js/bootstrap.min.js') ?>
    <?php echo HTML::script('js/offcanvas.js') ?>
    <?php echo HTML::script('js/bootstrap-datepicker.js') ?>
    <script>
    	$('.datepicker').datepicker();
    </script>
  </body>
</html>
