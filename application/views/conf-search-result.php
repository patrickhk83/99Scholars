 
<?php if(isset($total)) { ?>
	<input type="hidden" id="total-search-result" value="<?php echo $total ?>">
<?php } ?>
<?php foreach ($conferences as $conf): ?>
	<div class="row">
		<div class="col-lg-6">
		  <?php if($conf['type'] === 'Seminar') { ?>
		  	<p><strong><a href="<?php echo URL::site('seminar') ?>"><?php echo $conf['name'] ?></a></strong> <br/> <?php echo $conf['location'] ?></p>
		  <?php } else { ?>
		  	<p><strong><a href="<?php echo URL::site('conference/view/'.$conf['id']) ?>"><?php echo $conf['name'] ?></a></strong> <br/> <?php echo $conf['location'] ?></p>
		  <?php } ?>
		</div>
		<div class="col-lg-2"><button type="button" class="btn btn-<?php echo $conf['type_style'] ?> btn-xs"><?php echo $conf['type'] ?></button></div>
		<div class="col-lg-2"><?php echo $conf['duration'] ?></div>
		<div class="col-lg-2"><a class="btn btn-info" href="#">Book</a></div>
	</div><!--/row-->
<?php endforeach ?>