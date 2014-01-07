<!DOCTYPE html>
<html lang=”en”>
	<head>
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <meta name="description" content="">
	    <meta name="author" content="">
		<title>User Activity Statistics</title>	
	    <?php echo HTML::style('css/jquery-ui.css') ?>
	    <?php echo HTML::style('css/bootstrap.min.css') ?>
	    <?php echo HTML::style('css/bootstrap-theme.min.css') ?>

	    <!-- Custom styles for this template -->
	    <?php echo HTML::script('js/jquery.js') ?>
	    <?php echo HTML::script('js/jquery-ui.js') ?>
	    <?php echo HTML::script('js/bootstrap.min.js') ?>
	</head>
	<body>
		<div class="container">
			<?php include Kohana::find_file('views/statistics', 'header'); ?>
			<div class="main">
        		<div class="panel panel-default">
        			<div class="content panel-body">
						<?php include Kohana::find_file('views/statistics', $bodies); ?>
					</div>
        		</div>
    		</div>
    		<?php include Kohana::find_file('views/statistics', 'footer'); ?>
		</div>	

	</body>
</html>			