 
<?php if(isset($total)) { ?>
	<input type="hidden" id="total-search-result" value="<?php echo $total ?>">
<?php } ?>
<?php foreach ($conferences as $conf): ?>
	<div class="row">
		<div class="col-lg-6">
		  <p><strong><a href="<?php echo URL::site('conference/view/'.$conf['id']) ?>"><?php echo $conf['name'] ?></a></strong> <br/> <?php echo $conf['location'] ?></p>
		</div>
		<div class="col-lg-2"><?php echo $conf['type'] ?></div>
		<div class="col-lg-2"><?php echo $conf['duration'] ?></div>
		<div class="col-lg-2"><a class="btn btn-info" href="#">Book</a></div>
	</div><!--/row-->
<?php endforeach ?>