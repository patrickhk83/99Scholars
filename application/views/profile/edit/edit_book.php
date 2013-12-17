<div class="row">
  <div class="col-lg-12">
  	<div class="row">
	    <div class="col-lg-4">
	      <div class="add-profile-form">
	      	<form role="form" id="book-form">
	      		<input type="hidden" name="has_coauthor" value="0">
	      	  	<div class="form-group">
				    <label for="book-title">Title</label>
				    <input type="text" class="form-control" id="book-title" name="title">
				</div>
				<div class="form-group">
				    <label for="book">Publisher</label>
				    <input type="text" class="form-control" id="book" name="book_name" required="true">
				</div>
				<div class="form-group">
				    <label for="book-status">Book Status</label>
				    <select class="form-control" id="book-status" name="status">
				    	<option value="p">Published</option>
				    	<option value="s">Submitted</option>
				    	<option value="r">Revising</option>
				    	<option value="a">Accepted</option>
				    	<option value="t">To Appear</option>
				    </select>
				</div>
				<div class="form-group">
				    <label for="book-year">Year</label>
				    <select class="form-control" id="book-year" name="year">
                      <?php for($i=1970; $i<2014; $i++) { ?>
                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                      <?php } ?>
                    </select>
				</div>
				<!--<div class="form-group">
				    <label for="book-volume">Volume</label>
				    <input type="text" class="form-control" id="book-volume" name="volume">
				</div>-->
				<!--<div class="form-group">
				    <label for="book-issue">Conference City</label>
				    <input type="text" class="form-control" id="book-city" name="conference_city">
				</div>-->
				<div class="form-group">
				    <label for="book-start">Start Page</label>
				    <input type="text" class="form-control" id="book-start" name="start">
				</div>
				<div class="form-group">
				    <label for="book-end">End Page</label>
				    <input type="text" class="form-control" id="book-end" name="end">
				</div>
				<!--<div class="form-group">
				    <label for="book-link">Link</label>
				    <input type="text" class="form-control" id="book-link" name="link">
				</div>-->
				<button type="button" class="btn btn-success" id="add-book-btn">Add Book</button>
	      	</form>
	      </div>
	    </div><!--span-->
	</div><!--/row-->
  	<table class="table table-striped">
            <tbody id="book-container">
              <?php if(isset($books)) { ?>
              	<?php foreach($books as $book) { ?>
              	  <tr>
              	  	<td><?php echo $book['last_name'].', '.$book['first_name'].' '.$book['year'].' '.$book['title'].' '.$book['book_name']?></td>
              	  	<td><span id="<?php echo $book['id'] ?>" title="edit" onclick="editbookform('<?php echo $book['first_name'] ?>','<?php echo $book['last_name'] ?>','<?php echo $book['year'] ?>','<?php echo $book['title'] ?>','<?php echo $book['book_name'] ?>','<?php echo $book['status'] ?>','<?php echo $book['start'] ?>','<?php echo $book['end'] ?>','<?php echo $book['id'] ?>');" class="glyphicon glyphicon-pencil"></span></td>
                	<td><span class="glyphicon glyphicon-trash" title="delete" onclick="deletebookform('<?php echo $book['id'] ?>');"></span></td>
              	  </tr>
              	<?php } ?>
              <?php } ?>
            </tbody>
          </table>
  </div><!--span-->
</div><!--/row-->