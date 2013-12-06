<div class="row">
  <div class="col-lg-12">
  	<div class="row">
	    <div class="col-lg-4">
	      <div class="add-profile-form">
	      	<form role="form" id="project-form">
	      		<input type="hidden" name="has_coauthor" value="0">
	      	  	<div class="form-group">
				    <label for="project-title">Title</label>
				    <input type="text" class="form-control" id="project-title" name="title">
				</div>
				<div class="form-group">
				    <label for="project">Project</label>
				    <input type="text" class="form-control" id="project" name="project_name" required="true">
				</div>
				<div class="form-group">
				    <label for="project-status">Project Status</label>
				    <select class="form-control" id="project-status" name="status">
				    	<option value="p">Published</option>
				    	<option value="s">Submitted</option>
				    	<option value="r">Revising</option>
				    	<option value="a">Accepted</option>
				    	<option value="t">To Appear</option>
				    </select>
				</div>
				<div class="form-group">
				    <label for="project-year">Year</label>
				    <select class="form-control" id="project-year" name="year">
                      <?php for($i=1970; $i<2014; $i++) { ?>
                        <option value="<?php echo $i ?>"><?php echo $i ?></option>
                      <?php } ?>
                    </select>
				</div>
				<div class="form-group">
				    <label for="project-start">Start Page</label>
				    <input type="text" class="form-control" id="project-start" name="start">
				</div>
				<div class="form-group">
				    <label for="project-end">End Page</label>
				    <input type="text" class="form-control" id="project-end" name="end">
				</div>
				<button type="button" class="btn btn-success" id="add-project-btn">Add Project</button>
	      	</form>
	      </div>
	    </div><!--span-->
	</div><!--/row-->
  	<table class="table table-striped">
            <tbody id="project-container">
              <?php if(isset($projects)) { ?>
              	<?php foreach($projects as $project) { ?>
              	  <tr>
              	  	<td><?php echo $project['last_name'].', '.$project['first_name'].' '.$project['year'].' '.$project['title'].' '.$project['project_name']?></td>
              	  	<td><span id="<?php echo $project['id'] ?>" title="edit" onclick="editprojectform('<?php echo $project['first_name'] ?>','<?php echo $project['last_name'] ?>','<?php echo $project['year'] ?>','<?php echo $project['title'] ?>','<?php echo $project['project_name'] ?>','<?php echo $project['status'] ?>','<?php echo $project['start'] ?>','<?php echo $project['end'] ?>','<?php echo $project['id'] ?>');" class="glyphicon glyphicon-pencil"></span></td>
                	<td><span class="glyphicon glyphicon-trash" title="delete" onclick="deleteprojectform('<?php echo $project['id'] ?>');"></span></td>
              	  </tr>
              	<?php } ?>
              <?php } ?>
            </tbody>
          </table>
  </div><!--span-->
</div><!--/row-->