<?php include Kohana::find_file('views', 'header') ?>
<?php
//echo "<pre>";
//print_r($presentation_front);
//die;
?>
<input type="hidden" id="conf-id" value="<?php echo $id ?>">
<div class="row row-offcanvas row-offcanvas-right">
        
        <div class="col-xs-12 col-sm-12">
          <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>
          <div class="jumbotron" id="jumbotronid">
            <h2>4th Global Conference: Performance: Visual Aspects of Performance Practice</h2>
            <p>For details of the main conference schedule for Tuesday to Thursday, please see below. There are also free Community Events taking place in the evenings, for more details please see the ASF wiki page</p>
	    <a href="<?= URL::site('conference/edit/'.$id) ?>"><button class="btn btn-default btn-lg" id="schedule-id">Add schedule</button></a>
            <!--<p><button class="btn btn-primary btn-lg">Book this conference</button> <button class="btn btn-default btn-lg">Add this conference to my list</button></p>-->
            <p></p>
          </div>
			
			<?php foreach($conference->conference_session->find_all() as $conf_session) { 
				$room_count = 0;
			?>
				<h4><?= $conf_session->get_readable_date() ?></h4>
				<table class='table table-bordered schedule-table' id='schedule-table'>
					<tr>
						<td></td>
						<?php foreach ($conf_session->rooms->find_all() as $room) { ?>
							<th><?= $room->room_name ?></th>
						<?php $room_count++; } ?>
					</tr>

					<?php foreach($conf_session->timetables->order_by('start_time', 'ASC')->find_all() as $timetable) { ?>
						<tr>
							<td class="time"><?= $timetable->get_readable_starttime() ?></td>
							<?php foreach($timetable->timeslots->find_all() as $timeslot) { ?>
								<?php if($timeslot->is_single_slot()) { ?>
									<td class="slot">
										<?= $timeslot->slot_presentation->title ?>
									</td>
								<?php } else if($timeslot->is_whole_slot()) { ?>
									<td class="slot event" colspan="<?= $room_count ?>">
										<?= $timeslot->slot_presentation->title ?>
									</td>
								<?php } else if($timeslot->is_expand_slot()) { ?>
									<td class="slot" rowspan="<?= $timeslot->get_row_span() ?>">
										<?= $timeslot->slot_presentation->title ?>
									</td>
								<?php } ?>
								
							<?php } ?>
						</tr>
					<?php } ?>

				</table>

			<?php } ?>
            
			
			</div><!--/span-->            
          </div><!--/row-->
        </div><!--/span-->

      </div><!--/row-->

      <hr>

      <footer>
        <p>&copy; 99Scholars 2013</p>
      </footer>

    </div><!--/.container-->



    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <?php echo HTML::script('js/jquery.js') ?>
    <?php echo HTML::script('js/bootstrap.min.js') ?>
    <?php echo HTML::script('js/offcanvas.js') ?>
    <?php echo HTML::script('js/jquery-ui.js') ?>
    <?php echo HTML::script('js/schedule.js') ?>
  </body>
</html>