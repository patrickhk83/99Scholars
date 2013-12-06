<div class="row">
  <div class="col-lg-12">
  	<div class="row">
	    <div class="col-lg-4">
	      <div class="add-profile-form">
	      	<form role="form" id="journal-form">
	      		<!--<input type="hidden" name="has_coauthor" value="0">-->
	      	  	<div class="form-group">
				    <label for="journal-title">Title</label>
				    <input type="text" class="form-control" id="journal-title" name="title">
				</div>
				<div class="form-group">
				    <label for="journal">Journal</label>
				    <input type="text" class="form-control" id="journal" name="journal">
				</div>
				<input type="button" value="Add author" id="add_bttn" style="float: right;position: absolute;right: -80px;margin-top: 28px;">
				<div class="form-group" id="add-input-box">
				    <label for="co-author">co-author</label>
				    <input type="text" class="form-control" name="has_coauthor1">
				</div>
				<div class="form-group">
				    <label for="journal-status">Journal Status</label>
				    <select class="form-control" id="journal-status" name="status">
				    	<option value="p">Published</option>
				    	<option value="s">Submitted</option>
				    	<option value="r">Revising</option>
				    	<option value="a">Accepted</option>
				    	<option value="t">To Appear</option>
				    </select>
				</div>
				<div class="form-group">
				    <label for="journal-year">Year</label>
				    <select class="form-control" id="journal-year" name="year">
                      <?php for($i=1970; $i<2014; $i++) { ?>
                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                      <?php } ?>
                    </select>
				</div>
				<div class="form-group">
				    <label for="journal-volume">Volume</label>
				    <input type="text" class="form-control" id="journal-volume" name="volume">
				</div>
				<div class="form-group">
				    <label for="journal-issue">Issue</label>
				    <input type="text" class="form-control" id="journal-issue" name="issue">
				</div>
				<div class="form-group">
				    <label for="journal-start">Start Page</label>
				    <input type="text" class="form-control" id="journal-start" name="start">
				</div>
				<div class="form-group">
				    <label for="journal-end">End Page</label>
				    <input type="text" class="form-control" id="journal-end" name="end">
				</div>
				<div class="form-group">
				    <label for="journal-link">Link</label>
				    <input type="text" class="form-control" id="journal-link" name="link">
				</div>
				<button type="button" class="btn btn-success" id="add-journal-btn">Add journal</button>
	      	</form>
	      </div>
	    </div><!--span-->
	</div><!--/row-->
  	<table class="table table-striped">
            <tbody id="journal-container">
              <?php if(isset($journals)) { ?>
              	<?php foreach($journals as $journal) { ?>
              	  <tr>
              	  	<td><?php echo $journal ?></td>
              	  	<td><span class="glyphicon glyphicon-pencil"></span></td>
                	<td><span class="glyphicon glyphicon-trash"></span></td>
              	  </tr>
              	<?php } ?>
              <?php } ?>
            </tbody>
          </table>
  </div><!--span-->
</div><!--/row-->
