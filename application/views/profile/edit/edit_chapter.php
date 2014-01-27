<div class="row">
  <div class="col-lg-12">
  	<div class="row" id="message_box_chapter">
  	</div>	  	  	
  	<div class="row">
	    <div class="col-lg-4">
	      <div class="add-profile-form">
	      	<form role="form" id="chapter-form">
	      		<input type="hidden" name="has_coauthor" value="0">
	      	  	<div class="form-group">
				    <label for="chapter_title" id="label_chapter_title">Chapter Title</label>
				    <input type="text" class="form-control" id="chapter_title" name="chapter_title">
				</div>
				<input type="button" value="Add author" id="add_chapter_author_bttn" style="float: right;position: absolute;right: -80px;margin-top: 28px;">
				<div class="form-group" id="add-chapter-box">
				    <label for="co_author">Co-Author</label>
				    <input type="text" class="form-control" name="has_chapter_coauthor1">
				</div>
				<div class="form-group">
				    <label for="chapter_year">Year</label>
				    <select class="form-control" id="chapter_year" name="chapter_year">
                      <?php for($i=1970; $i<2015; $i++) { ?>
                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                      <?php } ?>
                    </select>
				</div>
				<div class="form-group">
				    <label for="chapter_editors" id="label_chapter_editor">Editors</label>
				    <input type="text" class="form-control" id="chapter_editors" name="chapter_editors" required="true">
				</div>
				<div class="form-group">
				    <label for="chapter_book_name" id="label_chapter_book_name">Book Title</label>
				    <input type="text" class="form-control" id="chapter_book_name" name="chapter_book_name">
				</div>
				<div class="form-group">
				    <label for="chapter_publisher_city" id="label_chapter_publisher_city">Publisher City</label>
				    <input type="text" class="form-control" id="chapter_publisher_city" name="chapter_publisher_city">
				</div>
				<div class="form-group">
				    <label for="chapter_publisher" id="label_chapter_publisher">Publisher</label>
				    <input type="text" class="form-control" id="chapter_publisher" name="chapter_publisher">
				</div>
				<div class="form-group">
				    <label for="chapter_start" id="label_chapter_start">Start Page</label>
				    <input type="text" class="form-control" id="chapter_start" name="chapter_start">
				</div>
				<div class="form-group">
				    <label for="chapter_end" id="label_chapter_end">End Page</label>
				    <input type="text" class="form-control" id="chapter_end" name="chapter_end">
				</div>
				<button type="button" class="btn btn-success" id="add-chapter-btn">Add Chapter</button>
				<input type="hidden" value="" name="book_chapter_id" id="book_chapter_id" value="-1">
	      	</form>
	      </div>
	    </div><!--span-->
	</div><!--/row-->
	<div class="row" id="book_chapter_container">
    	<?php echo $chapters; ?>
	</div>
  </div><!--span-->
</div><!--/row-->