<form role="form" id="project-form1">
  <input type="hidden" name="has_coauthor" value="0">
  <div class="form-group">
	      <label for="project-title">Title</label>
	      <input type="text" class="form-control" id="project-title1" name="title">
	  </div>
	  <div class="form-group">
	      <label for="conference">Project</label>
	      <input type="text" class="form-control" id="project1" name="project_name" required="true">
	  </div>
	  <div class="form-group">
	      <label for="project-status">Project Status</label>
	      <select class="form-control" id="project-status1" name="status">
		  <option value="p">Published</option>
		  <option value="s">Submitted</option>
		  <option value="r">Revising</option>
		  <option value="a">Accepted</option>
		  <option value="t">To Appear</option>
	      </select>
	  </div>
	  <div class="form-group">
	      <label for="project-year">Year</label>
	      <select class="form-control" id="project-year1" name="year">
	      <?php for($i=1970; $i<2014; $i++) { ?>
		<option value="<?php echo $i ?>"><?php echo $i ?></option>
	      <?php } ?>
	      </select>
	  </div>
	  <div class="form-group">
	      <label for="project-start">Start Page</label>
	      <input type="text" class="form-control" id="project-start1" name="start">
	  </div>
	  <div class="form-group">
	      <label for="project-end">End Page</label>
	      <input type="text" class="form-control" id="project-end1" name="end">
	  </div>
	  <button type="button" class="btn btn-success" id="add-project-btn1">Save</button>
</form>