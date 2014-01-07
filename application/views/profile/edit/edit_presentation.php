<div class="row">
  <div class="col-lg-12">
  	<div class="row">
	    <div class="col-lg-4">
	      <div class="add-profile-form">
	      	<form role="form" id="presentation-form">
	      		<input type="hidden" name="has_coauthor" value="0">
	      	  	<div class="form-group">
				    <label for="presentation-title">Title</label>
				    <input type="text" class="form-control" id="presentation-title" name="title">
				</div>
				<div class="form-group">
				    <label for="presentation">Presentation</label>
				    <input type="text" class="form-control" id="presentation" name="presentation_name" required="true">
				</div>
				<div class="form-group">
				    <label for="presentation-status">Presentation Status</label>
				    <select class="form-control" id="presentation-status" name="status">
				    	<option value="p">Published</option>
				    	<option value="s">Submitted</option>
				    	<option value="r">Revising</option>
				    	<option value="a">Accepted</option>
				    	<option value="t">To Appear</option>
				    </select>
				</div>
				<div class="form-group">
				    <label for="presentation-year">Year</label>
				    <select class="form-control" id="presentation-year" name="year">
                      <?php for($i=1970; $i<2014; $i++) { ?>
                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                      <?php } ?>
                    </select>
				</div>
				<div class="form-group">
				    <label for="presentation-start">Start Page</label>
				    <input type="text" class="form-control" id="presentation-start" name="start">
				</div>
				<div class="form-group">
				    <label for="presentation-end">End Page</label>
				    <input type="text" class="form-control" id="presentation-end" name="end">
				</div>
				<button type="button" class="btn btn-success" id="add-presentation-btn">Add Presentation</button>
	      	</form>
	      </div>
	    </div><!--span-->
	</div><!--/row-->
  	<table class="table table-striped">
            <tbody id="presentation-container">
              <?php if(isset($presentations)) { ?>
              	<?php foreach($presentations as $presentation) { ?>
              	  <tr>
              	  	<td><?php echo $presentation['last_name'].', '.$presentation['first_name'].' '.$presentation['year'].' '.$presentation['title'].' '.$presentation['presentation_name']?></td>
              	  	<td><span id="<?php echo $presentation['id'] ?>" title="edit" onclick="editpresentationform('<?php echo $presentation['first_name'] ?>','<?php echo $presentation['last_name'] ?>','<?php echo $presentation['year'] ?>','<?php echo $presentation['title'] ?>','<?php echo $presentation['presentation_name'] ?>','<?php echo $presentation['status'] ?>','<?php echo $presentation['start'] ?>','<?php echo $presentation['end'] ?>','<?php echo $presentation['id'] ?>');" class="glyphicon glyphicon-pencil"></span></td>
                	<td><span class="glyphicon glyphicon-trash" title="delete" onclick="deletepresentationform('<?php echo $presentation['id'] ?>');"></span></td>
              	  </tr>
              	<?php } ?>
              <?php } ?>
            </tbody>
          </table>
  </div><!--span-->
</div><!--/row-->