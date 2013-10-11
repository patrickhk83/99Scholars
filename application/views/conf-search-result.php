 <?php foreach ($conferences as $conf): ?>
	<div class="row">
  	<div class="col-lg-6">
  	  <p><strong><a href="schedule.html"><?php echo $conf['name'] ?></a></strong> <br/> <?php echo $conf['location'] ?></p>
  	</div>
  	<div class="col-lg-2"><?php echo $conf['type'] ?></div>
  	<div class="col-lg-2"><?php echo $conf['duration'] ?></div>
  	<div class="col-lg-2"><a class="btn btn-info" href="#">Book</a></div>
  </div><!--/row-->
<?php endforeach ?>