<div class="row">
  <div class="col-lg-12">
  	<div class="row">
	    <div class="col-lg-4">
	      <div class="add-profile-form">
	      	<form role="form" id="confproc-form">
	      		<input type="hidden" name="has_coauthor" value="0">
	      	  	<div class="form-group">
				    <label for="confproc-title">Title</label>
				    <input type="text" class="form-control" id="confproc-title" name="title">
				</div>
				<div class="form-group">
				    <label for="conference">Conference Prodceedings</label>
				    <input type="text" class="form-control" id="confproc" name="conference" required="true">
				</div>
				<div class="form-group">
				    <label for="confproc-status">Conference Proceedings Status</label>
				    <select class="form-control" id="confproc-status" name="status">
				    	<option value="p">Published</option>
				    	<option value="s">Submitted</option>
				    	<option value="r">Revising</option>
				    	<option value="a">Accepted</option>
				    	<option value="t">To Appear</option>
				    </select>
				</div>
				<div class="form-group">
				    <label for="confproc-year">Year</label>
				    <select class="form-control" id="confproc-year" name="year">
                      <?php for($i=1970; $i<2014; $i++) { ?>
                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                      <?php } ?>
                    </select>
				</div>
				<!--<div class="form-group">
				    <label for="confproc-volume">Volume</label>
				    <input type="text" class="form-control" id="confproc-volume" name="volume">
				</div>-->
				<!--<div class="form-group">
				    <label for="confproc-issue">Conference City</label>
				    <input type="text" class="form-control" id="confproc-city" name="conference_city">
				</div>-->
				<div class="form-group">
				    <label for="confproc-start">Start Page</label>
				    <input type="text" class="form-control" id="confproc-start" name="start">
				</div>
				<div class="form-group">
				    <label for="confproc-end">End Page</label>
				    <input type="text" class="form-control" id="confproc-end" name="end">
				</div>
				<!--<div class="form-group">
				    <label for="confproc-link">Link</label>
				    <input type="text" class="form-control" id="confproc-link" name="link">
				</div>-->
				<button type="button" class="btn btn-success" id="add-confproc-btn">Add Conference Proceedings</button>
	      	</form>
	      </div>
	    </div><!--span-->
	</div><!--/row-->
  	<table class="table table-striped">
            <tbody id="confproc-container">
              <?php if(isset($confprocs)) { ?>
              	<?php foreach($confprocs as $confproc) { ?>
              	  <tr>
              	  	<td><?php echo $confproc['last_name'].', '.$confproc['first_name'].' '.$confproc['year'].' '.$confproc['title'].' '.$confproc['conference']?></td>
              	  	<td><span id="<?php echo $confproc['id'] ?>" title="edit" onclick="editconfprocform('<?php echo $confproc['first_name'] ?>','<?php echo $confproc['last_name'] ?>','<?php echo $confproc['year'] ?>','<?php echo $confproc['title'] ?>','<?php echo $confproc['conference'] ?>','<?php echo $confproc['status'] ?>','<?php echo $confproc['start'] ?>','<?php echo $confproc['end'] ?>','<?php echo $confproc['id'] ?>');" class="glyphicon glyphicon-pencil"></span></td>
                	<td><span class="glyphicon glyphicon-trash" title="delete" onclick="deleteconfprocform('<?php echo $confproc['id'] ?>');"></span></td>
              	  </tr>
              	<?php } ?>
              <?php } ?>
            </tbody>
          </table>
  </div><!--span-->
</div><!--/row-->