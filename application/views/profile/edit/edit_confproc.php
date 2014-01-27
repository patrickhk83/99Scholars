<div class="row">
  <div class="col-lg-12">
  	<div class="row" id="message_box_confproc">
  	</div>	  	
  	<div class="row">
	    <div class="col-lg-4">
	      <div class="add-profile-form">
	      	<form role="form" id="confproc-form">
	      		<input type="hidden" name="has_coauthor" value="0">
	      	  	<div class="form-group">
				    <label for="confproc_title" id="label_confproc_title">Title</label>
				    <input type="text" class="form-control" id="confproc_title" name="confproc_title">
				</div>
				<div class="form-group">
				    <label for="conference" id="label_confproc_name">Conference Prodceedings</label>
				    <input type="text" class="form-control" id="confproc_name" name="confproc_name" required="true">
				</div>
				<input type="button" value="Add author" id="add_confproc_author_bttn" style="float: right;position: absolute;right: -80px;margin-top: 28px;">
				<div class="form-group" id="add-confproc-box">
				    <label for="co_author">Co-Author</label>
				    <input type="text" class="form-control" name="has_confproc_coauthor1">
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
				    <label for="confproc_country">Country</label>
				    <?php echo $conference_proceeding_country; ?>
				</div>
				<div class="form-group">
				    <label for="confproc_city" id="label_confproc_city">Conference City</label>
				    <input type="text" class="form-control" id="confproc_city" name="confproc_city">
				</div>
				<div class="form-group">
				    <label for="confproc-start" id="label_confproc_start">Start Page</label>
				    <input type="text" class="form-control" id="confproc_start" name="confproc_start">
				</div>
				<div class="form-group">
				    <label for="confproc-end" id="label_confproc_end">End Page</label>
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