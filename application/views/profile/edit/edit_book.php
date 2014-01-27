<div class="row">
  <div class="col-lg-12">
  	<div class="row" id="message_box_book">
  	</div>	  	  
  	<div class="row">
	    <div class="col-lg-4">
	      <div class="add-profile-form">
	      	<form role="form" id="book-form">
	      		<input type="hidden" name="has_coauthor" value="0">
	      	  	<div class="form-group">
				    <label for="book_title" id="label_book_title">Title</label>
				    <input type="text" class="form-control" id="book_title" name="book_title">
				</div>
				<input type="button" value="Add author" id="add_book_author_bttn" style="float: right;position: absolute;right: -80px;margin-top: 28px;">
				<div class="form-group" id="add-book-box">
				    <label for="co_author">Co-Author</label>
				    <input type="text" class="form-control" name="has_book_coauthor1">
				</div>
				<div class="form-group">
				    <label for="book_year">Year</label>
				    <select class="form-control" id="book_year" name="book_year">
                      <?php for($i=1970; $i<2015; $i++) { ?>
                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                      <?php } ?>
                    </select>
				</div>
				<div class="form-group">
				    <label for="chapter_publisher_city" id="label_book_publisher_city">Publisher City</label>
				    <input type="text" class="form-control" id="book_publisher_city" name="book_publisher_city">
				</div>
				<div class="form-group">
				    <label for="chapter_publisher" id="label_book_publisher">Publisher</label>
				    <input type="text" class="form-control" id="book_publisher" name="book_publisher">
				</div>
				<button type="button" class="btn btn-success" id="add-book-btn">Add Book</button>
				<input type="hidden" value="" name="book_id" id="book_id" value="-1">
	      	</form>
	      </div>
	    </div><!--span-->
	</div><!--/row-->
	<div class="row" id="book_container">
    	<?php echo $books; ?>
	</div>
  </div><!--span-->
</div><!--/row-->