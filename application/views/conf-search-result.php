
<?php if(isset($total)) { ?>
	<input type="hidden" id="total-search-result" value="<?php echo $total ?>">
<?php } ?>
<?php foreach ($conferences as $conf): ?>
	<div class="row event-row">
		<div class="col-md-6">
		  <p><strong><a href="<?php echo URL::site('conference/view/'.$conf['id']) ?>"><?php echo $conf['name'] ?></a></strong> <br/> <?php echo $conf['location'] ?></p>
          <h6>118 Attending</h6>
		</div>
		<div class="col-md-2 hidden-xs"><button type="button" class="btn btn-<?php echo $conf['type_style'] ?> btn-xs"><?php echo $conf['type'] ?></button></div>
		<div class="col-md-2 pad0 event-date"><?php echo $conf['duration'] ?></div>
		<div class="col-md-2">
			<?php if($conf['is_booked']) { ?>
              <button type="button" class="btn btn-info btn-block" onclick="cancelBooking(<?php echo $conf['id'] ?>, this)">Cancel booking</button>
            <?php } else { ?>
              <button type="button" class="btn btn-primary btn-block book-btn" onclick="bookConference(<?php echo $conf['id'] ?>, this)">Book</button>
            <?php } ?>
		</div>
        <div class="col-md-2 visible-xs event-type"><button type="button" class="btn btn-<?php echo $conf['type_style'] ?> btn-xs"><?php echo $conf['type'] ?></button></div>
	</div><!--/row-->
<?php endforeach ?>