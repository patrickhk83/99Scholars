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
	    <a href="#"><button class="btn btn-default btn-lg" id="schedule-id">Add schedule</button></a>
            <!--<p><button class="btn btn-primary btn-lg">Book this conference</button> <button class="btn btn-default btn-lg">Add this conference to my list</button></p>-->
            <p></p>
          </div>
	  
	  <div class="row" id="schedule-main" style="display: none;">
            <div class="col-lg-12">
		<h2>4th Global Conference: Performance: Visual Aspects of Performance Practice</h2>
		<ul class="nav nav-tabs" id="schedule-tab">
			<li><a href="#session" data-toggle="tab">Session</a></li>
			<li><a href="#room" data-toggle="tab">Room</a></li>
			<li><a href="#time" data-toggle="tab">Time Table</a></li>
			<li><a href="#presentation" data-toggle="tab">Presentation</a></li>
		</ul>
	    </div>
	  </div>
         <div class="tab-content" id="schedule-content" style="display: none;">
            <div class="tab-pane fade attachment-content active in" id="session">
              <table class="table" id="session_data">
                <tbody id="session_body"><tr><th>Date</th><th>Title</th></tr>
		<?php
		if(!empty($session_names)){
			foreach($session_names as $session)
			{
				$time = strtotime($session['date']);
				?>
				<tr><td><?php echo date('d/m/Y',$time)?></td><td><?php echo $session['name']?></td></tr>
				<?php				
			}
		}
		?>	
              </tbody></table>

              <form role="form" id="form-session">
                <div class="form-group">
                  <label>Date</label>
		  
		<?php        
			$sta= $start_date;
			$en= $end_date;
		?>
		<select class="form-control"  name="date"  id="date">                
               <?php
			$start_date = $sta;
			$st = strtotime($start_date);
			$end = strtotime($en);
			for ($i=$st;$i<=$end;$i += 86400) {
		?>
			<option  value="<?php  echo date('d/m/Y',$i)  ?>">    <?php  echo date('d/m/Y',$i );  ?> </option>
			<?php
			}
			?>
		</select>
                </div>
                <div class="form-group">
                  <label>Title</label>
                  <input type="text" name="text" class="form-control">
                </div>
                <button type="button" class="btn btn-default" id="schedule_session">Submit</button>
              </form>
            </div>
            <div class="tab-pane fade attachment-content" id="room">
              <table class="table">
                <tbody id="room_body"><tr><th>Room</th><th>Session</th></tr>
		<?php
		if(!empty($room_names)){ ?>
			<?php foreach($room_names as $room)
			{
				?>
				<tr><td><?php echo $room['name']?></td><td><?php echo $room['session']?></td></tr>
				<?php				
			}
		}
		?>	
              </tbody></table>
              <form role="form" id="form-room">
                <div class="form-group">
                  <label>Room Name</label>
                  <input type="text" class="form-control" name="room_name">
                </div>
                <div class="form-group">
                  <label>Session</label>
		  
		<?php
		if(!empty($session_names)){ ?>
			<select class="form-control" id="session_room1">
			<?php foreach($session_names as $session)
			{
				$time = strtotime($session['date']);
				?>
				<option value="<?php echo $session['id']?>"><?php echo date('d/m/Y',$time)?> - <?php echo $session['name']?></option>
				<?php				
			}?>
			</select>
		<?php }
		?>
                </div>
                <button type="button" class="btn btn-default" id="schedule_room">Submit</button>
              </form>
            </div>
            <div class="tab-pane fade attachment-content" id="time">
              <table class="table">
                <tbody id="time_body"><tr><th>Session</th><th>Start</th><th>End</th></tr>
		<?php
		if(!empty($time_names)){ ?>
			<?php foreach($time_names as $time)
			{
				?>
				<tr><td><?php echo $time['session']?></td><td><?php echo $time['start_time']?></td><td><?php echo $time['end_time']?></td></tr>
				<?php				
			}
		}
		?>
              </tbody></table>

              <form role="form" id="form-time">
                <div class="form-group">
                  <label>Start Time</label>
                  <input type="text" class="form-control" name="start_time">
                </div>
                <div class="form-group">
                  <label>End Time</label>
                  <input type="text" class="form-control" name="end_time">
                </div>
                <div class="form-group">
                  <label>Session</label>
		  
		<?php
		if(!empty($session_names)){ ?>
			<select class="form-control" id="session_room2">
			<?php foreach($session_names as $session)
			{
				$time = strtotime($session['date']);
				?>
				<option value="<?php echo $session['id']?>"><?php echo date('d/m/Y',$time)?> - <?php echo $session['name']?></option>
				<?php				
			}?>
			</select>
		<?php }
		?>  
                </div>
                <button type="button" class="btn btn-default" id="schedule_time">Submit</button>
              </form>
            </div>
            <div class="tab-pane fade attachment-content" id="presentation">
              <table class="table">
                <tbody id="presentation_body"><tr><th>Session</th><th>Time Slot</th><th>Room</th><th>Title</th></tr>
		<?php
		if(!empty($presentation_final)){ ?>
			<?php foreach($presentation_final as $presentation)
			{
				?>
				<tr><td><?php echo $presentation['session']?></td><td><?php echo $presentation['timeslot']?></td><td><?php echo $presentation['room']?></td><td><?php echo $presentation['title']?></td></tr>
				<?php				
			}
		}
		?>	
		</tbody></table>

              <form role="form" id="form-presentation">
                <div class="form-group">
                  <label>Session</label>
                  <?php
		if(!empty($session_names)){ ?>
			<select class="form-control" id="session_room3" value="">
			<?php foreach($session_names as $session)
			{
				$time = strtotime($session['date']);
				?>
				<option value="<?php echo $session['id']?>"><?php echo date('d/m/Y',$time)?> - <?php echo $session['name']?></option>
				<?php				
			}?>
			</select>
		<?php }
		?>  
                </div>
                <div class="form-group">
                  <label>Time Table</label>
			<select class="form-control" name="presentation_time" id="presentation_time">
				<!--<option></option>-->
			</select>
                </div>
                <div class="form-group">
                  <label>Room</label>
			<select class="form-control" name="presentation_room" id="presentation_room">
				<!--<option></option>-->
			</select>
                </div>
                <div class="form-group">
                  <label>Slot Type</label>
                  <select class="form-control" name="presentation_slot" id="presentation_slot">
                    <option value="1">One room</option>
                    <option value="2">Take all room</option>
                    <option value="3">One room, more than 1 time table</option>
                  </select>
                </div>
                <div class="form-group">
                  <label>End Time Table</label>
			<select class="form-control" name="presentation_endtime" id="presentation_endtime">
				<option></option>
			</select>
                </div>
                <div class="form-group">
                  <label>Presentation Title</label>
                  <input type="text" class="form-control" name="presentation_name">
                </div>
                
                <button type="button" class="btn btn-default" id="schedule_presentation">Submit</button>
              </form>
            </div>
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
        <p>&copy; Company 2013</p>
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