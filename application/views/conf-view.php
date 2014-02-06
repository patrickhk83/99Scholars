<?php include Kohana::find_file('views', 'header') ?>
<input type="hidden" id="conf-id" value="<?= $conference->id ?>">
<input type="hidden" id="user_id" value="<?php echo $user_id ?>">
<div class="row row-offcanvas row-offcanvas-right">
  <div class="col-xs-12 col-sm-12">
    <div class="row">
      <div class="col-lg-12">
        <div class="row">
          <div class="col-lg-12 seminar">
            <p>
              <h3><b><?= $conference->name ?></b></h3>
            </p>
            <p><h5><?php echo $conference->description; ?></h5></p>
          </div>
        </div> 
        <div class="row">
          <div class="col-lg-6">
            <p>
              <strong class="seminardate">
                <?php echo Util_Date::to_readable_date($conference->start_date); ?>
                <?php echo " - "; ?>
                <?php echo Util_Date::to_readable_date($conference->end_date); ?>
              </strong>  
            </p>
            <?php echo HTML::image('img/location2.png', array('class' => 'fleft locationimg')); ?>
            <p class="seminarloc">
              <?php echo $conference->conference_venue->venue_address->address; ?>, 
              <?php echo $organization; ?>
              <br>
              <?php echo $conference->conference_venue->venue_address->get_short_location(); ?> 
              <span class="text-muted">(
                <a href="http://maps.google.com/maps?q=<?= $organization; ?>" target="_blank">
                  view map
                </a>)
              </span>
            </p>  
          </div>
        </div> 
      </div>
    </div>

    <div class="row">
      <div class="col-lg-12">
        <ul class="nav nav-tabs hidden-xs" id="attachment-tab">
          <li><a href="#info" data-toggle="tab">Info</a></li>
          <li><a href="#programme" data-toggle="tab">Programme</a></li>
        </ul>        
      </div>  
      <div class="visible-xs btn-group">
        <button class="mobuser-dropdown dropdown-toggle" data-target="#" data-backdrop="static" data-toggle="dropdown">
          <span class="dropdown-label user-label">Overview</span>
          <span class="caret" style="border-top-color: #fff;"></span>
        </button>
        <ul class="dropdown-menu text-center text-sm mobuser-dropmenu">
          <li><a href="#info" data-toggle="tab">Info</a></li>
          <li><a href="#programme" data-toggle="tab">Programme</a></li>
        </ul>
      </div>      
    </div>  

    <div class="tab-content">
      <div class="tab-pane fade active attachment-content" id="info">
        <div class="row">
          <div class="col-lg-8">  
            <h4>Event Type</h4>
            <p><?php echo $conference->conference_type->name; ?></p>
            <h4>Cateogry</h4>
            <p><?php echo $conference->category->conference_category->name; ?></p>
            <h4>Tags</h4>
            <p><?php echo $tags; ?></p>
            <h4>Submission Deadline</h4>
            <p><?php echo Util_Date::to_readable_date($conference->deadline); ?></p>
            <h4>Notification of Acceptance</h4>
            <p>
              <?php echo Util_Date::to_readable_date($conference->accept_notify); ?>
            </p>
            <h4>Registration Dates</h4>
            <p>
              <?php echo Util_Date::to_readable_date($conference->registration->start_date)." - ".Util_Date::to_readable_date($conference->registration->end_date);  ?>
            </p>
            <h4>Contact Person</h4>
            <p>
              <?php echo $conference->contact_person.",&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".$conference->contact_email; ?>
            </p>
            <h4>Venue</h4>
            <p>
              <?php echo $conference->conference_venue->name." ".$conference->conference_venue->venue_address->address." ".$conference->conference_venue->venue_address->city." ".$conference->conference_venue->venue_address->state." ".$conference->conference_venue->venue_address->postal_code; ?>
            </p>
          </div>
        </div>
      </div>

      <div class="tab-pane fade active attachment-content" id="programme">
        <p class="pull-right visible-xs">
          <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
        </p>
        <div class="jumbotron" id="jumbotronid">
          <h2>
            4th Global Conference: Performance: Visual Aspects of Performance Practice
          </h2>
          <p>
            For details of the main conference schedule for Tuesday to Thursday, please see below. There are also free Community Events taking place in the evenings, for more details please see the ASF wiki page
          </p>
          <a href="<?= URL::site('conference/edit/'.$id) ?>">
            <button class="btn btn-default btn-lg" id="schedule-id">
              Add schedule
            </button>
          </a>
          <p></p>   
        </div>  
        <?php 
          foreach($conference->conference_session->find_all() as $conf_session) 
          { 
            $room_count = 0;
            echo "<h4>".$conf_session->get_readable_date()."</h4>";
            echo "<table class='table table-bordered schedule-table' id='schedule-table'><tr>";
            foreach ($conf_session->rooms->find_all() as $room) 
            {
              echo "<th>".$room->room_name."</th>";
              $room_count++; 
            }

            echo "</tr>";
            foreach($conf_session->timetables->order_by('start_time', 'ASC')->find_all() as $timetable) 
            {
              echo "<tr>";
              echo "<td class='time'>".$timetable->get_readable_starttime()."</td>";
              foreach($timetable->timeslots->find_all() as $timeslot) 
              {
                if($timeslot->is_single_slot()) 
                {
                  echo "<td class='slot'>".$timeslot->slot_presentation->title."</td>";
                } 
                else if($timeslot->is_whole_slot()) 
                {
                  echo "<td class='slot event' colspan='".$room_count."'>";
                  echo $timeslot->slot_presentation->title;
                  echo "</td>";
                } 
                else if($timeslot->is_expand_slot()) 
                {                  
                  echo "<td class='slot' rowspan='".$timeslot->get_row_span()."'>";
                  echo $timeslot->slot_presentation->title;
                  echo "</td>";
                }
              }

              echo "</tr>";
            }

            echo "</table>";
          }
        ?>
    </div>                        

  </div>      
</div>  

    <?php echo HTML::script('js/jquery.js'); ?>
    <?php echo HTML::script('js/bootstrap.min.js'); ?>
    <?php echo HTML::script('js/offcanvas.js'); ?>
    <?php echo HTML::script('js/jquery-ui.js'); ?>
    <?php echo HTML::script('js/lightbox-2.6.min.js'); ?>
    <?php echo HTML::script('js/conference.js'); ?>