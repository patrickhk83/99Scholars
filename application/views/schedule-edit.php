<?php include Kohana::find_file('views', 'header') ?>
<script>
  var suggest_url = "<?php echo URL::site('conference/suggest_seminar_info');?>";
  var add_relate_seminar_info_url = "<?php echo URL::site('conference/new_relate_seminar_info');?>";
</script>
<input type="hidden" id="conf-id" value="<?php echo $id ?>">
<div class="row" id="schedule-main">
            <div class="col-lg-12">
		<h2>4th Global Conference: Performance: Visual Aspects of Performance Practice</h2>
		<ul class="nav nav-tabs" id="schedule-tab">
			<li><a href="#session" data-toggle="tab" style="color:#428bca;">Session</a></li>
			<li><a href="#room" data-toggle="tab" style="color:#428bca;">Room</a></li>
			<li><a href="#time" data-toggle="tab" style="color:#428bca;">Time Table</a></li>
			<li><a href="#presentation" data-toggle="tab" style="color:#428bca;" id="presentation-tab-title">Presentation</a></li>
		</ul>
	    </div>
	  </div>
         <div class="tab-content" id="schedule-content">
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
				if(!empty($session_names)) { ?>
				<select class="form-control" id="session_room3" value="">
				<?php 
				foreach($session_names as $session)
				{
					$time = strtotime($session['date']);
				?>
					<option value="<?php echo $session['id']?>"><?php echo date('d/m/Y',$time)?> - <?php echo $session['name']?></option>
				<?php } ?>
				</select>
				<?php } ?>  
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

			<div class="form-group">
				<label>Seminar Info</label>
				<div class="row">
					<div class="col-md-6">
						<input type="text" class="form-control" placeholder="Input Seminar's Info" id="autocomplete_tags">
						<div class="well" id="list_suggest_seminar" style="overflow:auto; height:130px; padding:0;"></div>  
					</div> 
					<div class="col-md-6">
						<p class="form-control-static" style="margin-bottom: 6px;"><b>Selected Seminar</b></p>
						<div class="well" style="overflow:auto; height:130px; padding:0;">
							<ul id="list_selected_seminar" class="list-group">
							</ul>  
						</div>
					</div>   
				</div>   
			</div>                  

            <button type="button" class="btn btn-default" id="schedule_presentation">Submit</button>
        </form>
    </div>
</div>


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