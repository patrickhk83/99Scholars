<div class="row">
  <div class="col-lg-12">
  	<div class="row" id="message_box_journal">
   	</div>	
  	<div class="row">
	    <div class="col-lg-4">
	      <div class="add-profile-form">
	      	<form role="form" id="journal-form">
	      		<!--<input type="hidden" name="has_coauthor" value="0">-->
	      	  	<div class="form-group">
				    <label for="journal-title" id="label_journal_title">Title</label>
				    <input type="text" class="form-control" id="title" name="title">
				</div>
				<div class="form-group">
				    <label for="journal" id="label_journal_name">Journal</label>
				    <input type="text" class="form-control" id="journal_name" name="journal_name">
				</div>
				<input type="button" value="Add author" id="add_bttn" style="float: right;position: absolute;right: -80px;margin-top: 28px;">
				<div class="form-group" id="add-input-box">
				    <label for="co-author">Co-Author</label>
				    <input type="text" class="form-control" name="has_coauthor1">
				</div>
				<div class="form-group">
				    <label for="journal-status">Journal Status</label>
				    <select class="form-control" id="status" name="status">
				    	<option value="p">Published</option>
				    	<option value="s">Submitted</option>
				    	<option value="r">Revising</option>
				    	<option value="a">Accepted</option>
				    	<option value="t">To Appear</option>
				    </select>
				</div>
				<div class="form-group">
				    <label for="journal-year">Year</label>
				    <select class="form-control" id="year" name="year">
                      <?php for($i=1970; $i<2015; $i++) { ?>
                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                      <?php } ?>
                    </select>
				</div>
				<div class="form-group">
				    <label for="journal-volume" id="label_journal_volume">Volume</label>
				    <input type="text" class="form-control" id="volume" name="volume">
				</div>
				<div class="form-group">
				    <label for="journal-issue" id="label_journal_issue">Issue</label>
				    <input type="text" class="form-control" id="issue" name="issue">
				</div>
				<div class="form-group">
				    <label for="journal-start" id="label_journal_start">Start Page</label>
				    <input type="text" class="form-control" id="start" name="start">
				</div>
				<div class="form-group">
				    <label for="journal-end" id="label_journal_end">End Page</label>
				    <input type="text" class="form-control" id="end" name="end">
				</div>
				<div class="form-group">
				    <label for="journal-link">Link</label>
				    <input type="text" class="form-control" id="link" name="link">
				</div>
				<button type="button" class="btn btn-success" id="add-journal-btn">Add journal</button>
				<input type="hidden" value="" name="journal_id" id="journal_id" value="-1">
	      	</form>
	      </div>
	    </div><!--span-->
	</div><!--/row-->
	<div class="row" id="journal_container">
    	<?php echo $journals; ?>
	</div>
  </div><!--span-->
</div><!--/row-->
