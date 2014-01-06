<form role="form" id="chapter-form1">
  <input type="hidden" name="has_coauthor" value="0">
  <div class="form-group">
	      <label for="chapter-title">Title</label>
	      <input type="text" class="form-control" id="chapter-title1" name="title">
	  </div>
	  <div class="form-group">
	      <label for="chapter">Book Chapter</label>
	      <input type="text" class="form-control" id="chapter1" name="book_chapter" required="true">
	  </div>
	  <div class="form-group">
	      <label for="chapter-status">Book Status</label>
	      <select class="form-control" id="chapter-status1" name="status">
		  <option value="p">Published</option>
		  <option value="s">Submitted</option>
		  <option value="r">Revising</option>
		  <option value="a">Accepted</option>
		  <option value="t">To Appear</option>
	      </select>
	  </div>
	  <div class="form-group">
	      <label for="chapter-year">Year</label>
	      <select class="form-control" id="chapter-year1" name="year">
	      <?php for($i=1970; $i<2014; $i++) { ?>
		<option value="<?php echo $i ?>"><?php echo $i ?></option>
	      <?php } ?>
	      </select>
	  </div>
	  <div class="form-group">
	      <label for="chapter-start">Start Page</label>
	      <input type="text" class="form-control" id="chapter-start1" name="start">
	  </div>
	  <div class="form-group">
	      <label for="chapter-end">End Page</label>
	      <input type="text" class="form-control" id="chapter-end1" name="end">
	  </div>
	  <button type="button" class="btn btn-success" id="add-chapter-btn1">Save</button>
</form>