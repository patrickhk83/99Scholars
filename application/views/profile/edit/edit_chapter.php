<div class="row">
  <div class="col-lg-12">
  	<div class="row">
	    <div class="col-lg-4">
	      <div class="add-profile-form">
	      	<form role="form" id="chapter-form">
	      		<input type="hidden" name="has_coauthor" value="0">
	      	  	<div class="form-group">
				    <label for="chapter-title">Title</label>
				    <input type="text" class="form-control" id="chapter-title" name="title">
				</div>
				<div class="form-group">
				    <label for="chapter">Book Chapter</label>
				    <input type="text" class="form-control" id="chapter" name="book_chapter" required="true">
				</div>
				<div class="form-group">
				    <label for="chapter-status">Book Status</label>
				    <select class="form-control" id="chapter-status" name="status">
				    	<option value="p">Published</option>
				    	<option value="s">Submitted</option>
				    	<option value="r">Revising</option>
				    	<option value="a">Accepted</option>
				    	<option value="t">To Appear</option>
				    </select>
				</div>
				<div class="form-group">
				    <label for="chapter-year">Year</label>
				    <select class="form-control" id="chapter-year" name="year">
                      <?php for($i=1970; $i<2014; $i++) { ?>
                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                      <?php } ?>
                    </select>
				</div>
				<!--<div class="form-group">
				    <label for="chapter-volume">Volume</label>
				    <input type="text" class="form-control" id="chapter-volume" name="volume">
				</div>-->
				<!--<div class="form-group">
				    <label for="chapter-issue">Conference City</label>
				    <input type="text" class="form-control" id="chapter-city" name="conference_city">
				</div>-->
				<div class="form-group">
				    <label for="chapter-start">Start Page</label>
				    <input type="text" class="form-control" id="chapter-start" name="start">
				</div>
				<div class="form-group">
				    <label for="chapter-end">End Page</label>
				    <input type="text" class="form-control" id="chapter-end" name="end">
				</div>
				<!--<div class="form-group">
				    <label for="chapter-link">Link</label>
				    <input type="text" class="form-control" id="chapter-link" name="link">
				</div>-->
				<button type="button" class="btn btn-success" id="add-chapter-btn">Add Chapter</button>
	      	</form>
	      </div>
	    </div><!--span-->
	</div><!--/row-->
  	<table class="table table-striped">
            <tbody id="chapter-container">
              <?php if(isset($chapters)) { ?>
              	<?php foreach($chapters as $chapter) { ?>
              	  <tr>
              	  	<td><?php echo $chapter['last_name'].', '.$chapter['first_name'].' '.$chapter['year'].' '.$chapter['title'].' '.$chapter['book_chapter']?></td>
              	  	<td><span id="<?php echo $chapter['id'] ?>" title="edit" onclick="editchapterform('<?php echo $chapter['first_name'] ?>','<?php echo $chapter['last_name'] ?>','<?php echo $chapter['year'] ?>','<?php echo $chapter['title'] ?>','<?php echo $chapter['book_chapter'] ?>','<?php echo $chapter['status'] ?>','<?php echo $chapter['start'] ?>','<?php echo $chapter['end'] ?>','<?php echo $chapter['id'] ?>');" class="glyphicon glyphicon-pencil"></span></td>
                	<td><span class="glyphicon glyphicon-trash" title="delete" onclick="deletechapterform('<?php echo $chapter['id'] ?>');"></span></td>
              	  </tr>
              	<?php } ?>
              <?php } ?>
            </tbody>
          </table>
  </div><!--span-->
</div><!--/row-->