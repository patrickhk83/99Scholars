<form role="form" id="presentation-form1">
  <input type="hidden" name="has_coauthor" value="0">
  <div class="form-group">
	      <label for="presentation-title">Title</label>
	      <input type="text" class="form-control" id="presentation-title1" name="title">
	  </div>
	  <div class="form-group">
	      <label for="presentation">Presentation</label>
	      <input type="text" class="form-control" id="presentation1" name="presentation_name" required="true">
	  </div>
	  <div class="form-group">
	      <label for="presentation-status">Presentation Status</label>
	      <select class="form-control" id="presentation-status1" name="status">
		  <option value="p">Published</option>
		  <option value="s">Submitted</option>
		  <option value="r">Revising</option>
		  <option value="a">Accepted</option>
		  <option value="t">To Appear</option>
	      </select>
	  </div>
	  <div class="form-group">
	      <label for="presentation-year">Year</label>
	      <select class="form-control" id="presentation-year1" name="year">
	      <?php for($i=1970; $i<2014; $i++) { ?>
		<option value="<?php echo $i ?>"><?php echo $i ?></option>
	      <?php } ?>
	      </select>
	  </div>
	  <div class="form-group">
	      <label for="presentation-start">Start Page</label>
	      <input type="text" class="form-control" id="presentation-start1" name="start">
	  </div>
	  <div class="form-group">
	      <label for="presentation-end">End Page</label>
	      <input type="text" class="form-control" id="presentation-end1" name="end">
	  </div>
	  <button type="button" class="btn btn-success" id="add-presentation-btn1">Save</button>
</form>