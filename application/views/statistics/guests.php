<script>
	var url = "<?php echo URL::site('actionstatistics/guests/');?>";
</script>
<?php echo HTML::script('js/statistics_guest.js'); ?>
<?php echo HTML::script("js/bootstrap-datepicker.js"); ?>
<?php echo HTML::style('css/datepicker.css') ?>
<div class="col-md-3">
	<ul class="nav nav-pills nav-stacked">
		<li>
			<a href="<?php echo URL::site('actionstatistics') ?>">Users</a>
		</li>
		<li class='active'>
			<a href="<?php echo URL::site('actionstatistics/guests') ?>">Guests</a>
		</li>
	</ul>
</div>	
<div class="col-md-9" role="main">
	<div class="panel panel-default">
		<div class="panel-heading">
			<form action="" id="search_form" method="post" class="form-inline">
				<div class="form-group">
					<label for="action" class="sr-only">Action</label>
					<select class="form-control" id="select_actions">
						<option value="All">All</option>
						<?php echo $str_options; ?>
					</select>	
				</div>	
				<div class="form-group">
					<label for="start_date" class="sr-only">Date</label>
					<input type="datetime" class="form-control datepicker criteria-option" id="start_date" placeholder="Date" data-date-format="dd-mm-yyyy" readonly="true" value="<?php echo $start_date; ?>"> 
				</div>
				<div class="form-group">
					<label for="submit_btn" class="sr-only">Search</label>
					<input type="button" class="btn btn-success" id="search_btn" value="Search">
					
				</div>	
				<input type="hidden" name="page_num" id="page_num" value="<?php echo $page_num;?>" />
				<input type="hidden" name="per_page" id="per_page" value="<?php echo $per_page;?>" />				
			</form>				
		</div>
		<div class="panel-body">
			<table class="table table-striped table-hover table-condensed">
				<thead>
					<tr>
						<th>#</th>
						<th>IP Address</th>
						<th>Name</th>
						<th>Action</th>
						<th>Time</th>	
					</tr>	
				</thead>	
				<tbody>
					<?php echo $str_table; ?>
				</tbody>	
			</table>				
		</div>
		<div class="panel-footer">
			<?php echo $link; ?>
		</div>	
	</div>		
</div>	