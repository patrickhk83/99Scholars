<div class="row">
    <div class="col-lg-12">
      
      		<?php if(isset($events)) { ?>
      			<table class="table table-striped">
      				<tbody>
      					<?php foreach ($events as $event) { ?>
      						<tr>
      							<td><strong><a href="<?php echo URL::site('conference/view/'.$event['id']) ?>"><?php echo $event['name'] ?></a></strong> <br/> <?php echo $event['location'] ?></td>
      							<td><?php echo $event['duration'] ?></td>
      						</tr>
      					<?php } ?>
      				</tbody>
      			</table>
			<?php } else { ?>

			<?php } ?>
    </div><!--span-->
</div><!--/row-->