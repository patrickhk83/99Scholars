<div class="row">
  <div class="col-lg-12">
  	<div class="row" id="message_box">
    	<?php 
    		if (isset($errors)) 
    			echo "<div class='alert alert-danger'>";
    		else
    			echo "<div class='alert alert-info'>";
    		echo "Fields in <span class='required'><b>red</b></span> are required.";
    		echo "</div>";
    	?>
  	</div>	  	
  	<div class="row">
	    <div class="col-lg-4">
	      <div class="add-profile-form">
	      	<form role="form" id="confproc-form">
	      		<input type="hidden" name="has_coauthor" value="0">
	      	  	<div class="form-group">
				    <label for="confproc_title" class="required">Title</label>
				    <input type="text" class="form-control" id="confproc_title" name="confproc_title">
				</div>
				<div class="form-group">
				    <label for="conference" class="required">Conference Prodceedings</label>
				    <input type="text" class="form-control" id="confproc_name" name="confproc_name" required="true">
				</div>
				<input type="button" value="Add author" id="add_bttn" style="float: right;position: absolute;right: -80px;margin-top: 28px;">
				<div class="form-group" id="add-input-box">
				    <label for="co_author">Co-Author</label>
				    <input type="text" class="form-control" name="has_coauthor1">
				</div>
				<div class="form-group">
				    <label for="confproc-status">Conference Proceedings Status</label>
				    <select class="form-control" id="confproc_status" name="confproc_status">
				    	<option value="p">Published</option>
				    	<option value="s">Submitted</option>
				    	<option value="r">Revising</option>
				    	<option value="a">Accepted</option>
				    	<option value="t">To Appear</option>
				    </select>
				</div>
				<div class="form-group">
				    <label for="confproc-year">Year</label>
				    <select class="form-control" id="confproc_year" name="confproc_year">
                      <?php for($i=1970; $i<2015; $i++) { ?>
                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                      <?php } ?>
                    </select>
				</div>
				<div class="form-group">
				    <label for="confproc_country" class="required">Country</label>
				    <?php echo $conference_proceeding_country; ?>
				</div>
				<div class="form-group">
				    <label for="confproc_city" class="required">Conference City</label>
				    <input type="text" class="form-control" id="confproc_city" name="confproc_city">
				</div>
				<div class="form-group">
				    <label for="confproc-start" class="required">Start Page</label>
				    <input type="text" class="form-control" id="confproc_start" name="confproc_start">
				</div>
				<div class="form-group">
				    <label for="confproc-end" class="required">End Page</label>
				    <input type="text" class="form-control" id="confproc_end" name="confproc_end">
				</div>
				<button type="button" class="btn btn-success" id="add-confproc-btn">Add Conference Proceedings</button>
				<input type="hidden" value="" name="confproc_id" id="confproc_id" value="-1">
	      	</form>
	      </div>
	    </div><!--span-->
	</div><!--/row-->
	<div class="row" id="confproc_container">
    	<?php echo $confprocs; ?>
	</div>
  </div><!--span-->
</div><!--/row-->