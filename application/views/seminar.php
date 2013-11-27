<?php include Kohana::find_file('views', 'header') ?>
<input type="hidden" id="conf-id" value="<?= $conference->id ?>">
<div class="row row-offcanvas row-offcanvas-right">
        
        <div class="col-xs-12 col-sm-12">
          <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>
          <div class="row">
            <div class="col-lg-12">
              <div class="row">
                  <div class="col-lg-12">
                    <p><h2><?= $conference->name ?></h2></p>
                    <p><strong>Speaker : </strong> <a href="<?= URL::site('user') ?>"><?= $conference->seminar->speaker ?></a></p>
                  </div><!--span-->
              </div><!--/row-->
              <div class="row">
                  <div class="col-lg-8">
                    <p><strong><?= $conference->start_date ?></strong><br><strong><?= Util_Date::time_elapsed($conference->created_date).' ago' ?></strong> <span class="text-muted">(<a href="#">view map</a>)</span></p>
                  </div><!--span-->
                  <div class="col-lg-4">
                    <p class="text-right">
                      <?php if($is_attended) { ?>
                        <button type="button" class="btn btn-info cancel-book-btn">Cancel booking</button>
                      <?php } else { ?>
                        <button type="button" class="btn btn-primary book-conf-btn">Attend this seminar</button>
                      <?php } ?>
                      
                    </p>
                  </div>
              </div><!--/row-->
              
              
            </div><!--/span--> 
          </div><!--/row--> 
          <div class="row">
            <div class="col-lg-12">
            
            <ul class="nav nav-tabs" id="attachment-tab">
              <li><a href="#info" data-toggle="tab">Info</a></li>
              <li><a href="#video" data-toggle="tab">Videos</a></li>
              <li><a href="#file" data-toggle="tab">Files</a></li>
              <li><a href="#photo" data-toggle="tab">Photos</a></li>
            </ul>
            
            <div class="tab-content">
              <div class="tab-pane fade active attachment-content" id="info">
              	<p><h4>Description</h4></p>
              	<p><?= $conference->description ?></p>
              	<p><h4>Abstract</h4></p>
              	<p><?= $conference->seminar->abstract ?></p>
              </div>
              <div class="tab-pane fade active attachment-content" id="video">
              	<div class="row">
              	    <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
              	      <div class="flex-video"><br/><iframe width="560" height="315" src="http://www.youtube.com/embed/DqekY0Yga4o?rel=0" frameborder="0" allowfullscreen></iframe></div>
              	    </div><!--span-->
              	</div><!--/row-->
              </div>
              <div class="tab-pane fade attachment-content" id="file">
              	<p>
              	 <ul class="list-unstyled">
              	   <li><span class="glyphicon glyphicon-file"></span> <a href="#">PresentationSlide.pptx</a> <span class="text-muted">(5.1 MB)</span></li>
              	   <li><span class="glyphicon glyphicon-file"></span> <a href="#">DataSheet.xlsx</a> <span class="text-muted">(20.8 MB)</span></li>
              	   <li><span class="glyphicon glyphicon-file"></span> <a href="#">document.docx</a> <span class="text-muted">(752 kB)</span></li>
              	 </ul>
              	</p>
              </div>
              <div class="tab-pane fade active attachment-content" id="photo">
               	<br/>
	          	  <div class="row">
	          	      <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
	          	        <?= HTML::image('img/profile.png', array('class' => 'img-thumbnail')) ?>
	          	        <p><a href="#">picture.png</a> <span class="text-muted">(127 kB)</span></p>
	          	      </div><!--span-->
	          	      <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
	          	        <?= HTML::image('img/profile.png', array('class' => 'img-thumbnail')) ?>
	          	        <p><a href="#">picture.png</a> <span class="text-muted">(127 kB)</span></p>
	          	      </div><!--span-->
	          	      <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
	          	        <?= HTML::image('img/profile.png', array('class' => 'img-thumbnail')) ?>
	          	        <p><a href="#">picture.png</a> <span class="text-muted">(127 kB)</span></p>
	          	      </div><!--span-->
	          	      <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
	          	        <?= HTML::image('img/profile.png', array('class' => 'img-thumbnail')) ?>
	          	        <p><a href="#">picture.png</a> <span class="text-muted">(127 kB)</span></p>
	          	      </div><!--span-->
	          	      <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
	          	        <?= HTML::image('img/profile.png', array('class' => 'img-thumbnail')) ?>
	          	        <p><a href="#">picture.png</a> <span class="text-muted">(127 kB)</span></p>
	          	      </div><!--span-->
	          	      <div class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
	          	        <?= HTML::image('img/profile.png', array('class' => 'img-thumbnail')) ?>
	          	        <p><a href="#">picture.png</a> <span class="text-muted">(127 kB)</span></p>
	          	      </div><!--span-->
	          	  </div><!--/row-->
              </div>
            </div>
            
              
            </div><!--/span--> 
          </div><!--/row-->
          <div class="row attachment-content">
              <div class="col-lg-12">
              	 <p>
                  <?php if($is_attended) { ?>
                    <a href="#"><button type="button" class="btn btn-info cancel-book-btn">Cancel booking</button></a>
                  <?php } else { ?>
                    <a href="#"><button type="button" class="btn btn-primary book-conf-btn">Attend this seminar</button></a>
                  <?php } ?>
                 </p>
              </div><!--span-->
          </div><!--/row-->
          <div class="row">
            <div class="col-lg-8">
              <h4 class="text-muted">Discussion</h4>
              <hr style="margin-bottom: 0px; margin-top: 5px;">
              <div id="topics-container">
                <table class="table table-hover">
                  <tbody id="topics">
                    <?
                        foreach ($conference->topic->find_all() as $topic) 
                        { 
                          echo View::factory('discussion/topic_title')->bind('topic', $topic);
                        }
                       
                    ?>
                  </tbody>
                </table>
                <form role="form" id="topic-form">
                  <input type="hidden" name="conf_id" value="<?= $conference->id ?>">
                  <div class="form-group">
                    <input type="text" class="form-control" placeholder="Post your topic" name="title">
                  </div>
                  <div class="form-group">
                    <textarea class="form-control" rows="4" placeholder="And what you'd like to say" name="content"></textarea>
                  </div>
                  <div class="form-group text-right">
                    <button type="button" class="btn btn-primary" id="add-topic-btn">Submit</button>
                  </div>
                </form>
              </div>
              <div id="topic-detail-container">
                <p><small><a href="#" id="back-topic-link"><span class="glyphicon glyphicon-chevron-left"></span> Back to topics</a></small></p>
                <div id="topic-detail">
                  
                </div>
              </div>
            </div><!-- /span -->
            <div class="col-lg-4">
              <p><h4 class="text-muted">Attendees</h4></p>
              <p>
                <table class="table" id="attendee-list">
                  <?php if($conference->attendee->find_all()->count() != 0) { ?>
                    <?php foreach($conference->attendee->find_all() as $attendee) { ?>
                      <tr id="attendee-<?= $attendee->id ?>">
                        <td width="40px"><?php echo HTML::image('img/avatar.jpg', array('width'  => '40')) ?></td>
                        <td>
                          <p><a href="<?= URL::site('user/profile/'.$attendee->id) ?>"><strong><?= $attendee->get_fullname() ?></strong></a> <br/> <small class="text-muted"><?= $attendee->get_affiliation() ?></small></p>
                          <p></p>
                        </td>
                      </tr>
                    <?php } ?>
                  <?php } else { ?>
                    <tr id="attendee-placeholder"><td>There is no attendee right now</td></tr>
                  <?php } ?>
                </table>
              </p>
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
    <?php echo HTML::script('js/seminar.js') ?>
  </body>
</html>