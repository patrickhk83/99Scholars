<form role="form" id="confproc-form1">
  <input type="hidden" name="has_coauthor" value="0">
  <div class="form-group">
	      <label for="confproc-title">Title</label>
	      <input type="text" class="form-control" id="confproc-title1" name="title">
	  </div>
	  <div class="form-group">
	      <label for="conference">Conference Prodceedings</label>
	      <input type="text" class="form-control" id="confproc1" name="conference" required="true">
	  </div>
	  <div class="form-group">
	      <label for="confproc-status">Conference Proceedings Status</label>
	      <select class="form-control" id="confproc-status1" name="status">
		  <option value="p">Published</option>
		  <option value="s">Submitted</option>
		  <option value="r">Revising</option>
		  <option value="a">Accepted</option>
		  <option value="t">To Appear</option>
	      </select>
	  </div>
	  <div class="form-group">
	      <label for="confproc-year">Year</label>
	      <select class="form-control" id="confproc-year1" name="year">
	      <?php for($i=1970; $i<2014; $i++) { ?>
		<option value="<?php echo $i ?>"><?php echo $i ?></option>
	      <?php } ?>
	      </select>
	  </div>
	  <div class="form-group">
	      <label for="confproc-start">Start Page</label>
	      <input type="text" class="form-control" id="confproc-start1" name="start">
	  </div>
	  <div class="form-group">
	      <label for="confproc-end">End Page</label>
	      <input type="text" class="form-control" id="confproc-end1" name="end">
	  </div>
	  <button type="button" class="btn btn-success" id="add-confproc-btn1">Save</button>
</form>