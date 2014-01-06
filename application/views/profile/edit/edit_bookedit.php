<form role="form" id="book-form1">
  <input type="hidden" name="has_coauthor" value="0">
  <div class="form-group">
	      <label for="book-title">Title</label>
	      <input type="text" class="form-control" id="book-title1" name="title">
	  </div>
	  <div class="form-group">
	      <label for="conference">Publisher</label>
	      <input type="text" class="form-control" id="book1" name="book_name" required="true">
	  </div>
	  <div class="form-group">
	      <label for="book-status">Book Status</label>
	      <select class="form-control" id="book-status1" name="status">
		  <option value="p">Published</option>
		  <option value="s">Submitted</option>
		  <option value="r">Revising</option>
		  <option value="a">Accepted</option>
		  <option value="t">To Appear</option>
	      </select>
	  </div>
	  <div class="form-group">
	      <label for="book-year">Year</label>
	      <select class="form-control" id="book-year1" name="year">
	      <?php for($i=1970; $i<2014; $i++) { ?>
		<option value="<?php echo $i ?>"><?php echo $i ?></option>
	      <?php } ?>
	      </select>
	  </div>
	  <div class="form-group">
	      <label for="book-start">Start Page</label>
	      <input type="text" class="form-control" id="book-start1" name="start">
	  </div>
	  <div class="form-group">
	      <label for="book-end">End Page</label>
	      <input type="text" class="form-control" id="book-end1" name="end">
	  </div>
	  <button type="button" class="btn btn-success" id="add-book-btn1">Save</button>
</form>