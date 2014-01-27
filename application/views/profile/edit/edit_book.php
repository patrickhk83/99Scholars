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
	      	<form role="form" id="book-form">
	      		<input type="hidden" name="has_coauthor" value="0">
	      	  	<div class="form-group">
				    <label for="book_title" class="required">Title</label>
				    <input type="text" class="form-control" id="book_title" name="book_title">
				</div>
				<input type="button" value="Add author" id="add_bttn" style="float: right;position: absolute;right: -80px;margin-top: 28px;">
				<div class="form-group" id="add-input-box">
				    <label for="co_author">Co-Author</label>
				    <input type="text" class="form-control" name="has_coauthor1">
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
				    <label for="chapter_publisher_city" class="required">Publisher City</label>
				    <input type="text" class="form-control" id="book_publisher_city" name="book_publisher_city">
				</div>
				<div class="form-group">
				    <label for="chapter_publisher" class="required">Publisher</label>
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