<?php include Kohana::find_file('views', 'header') ?>
<input type="hidden" id="conf-id" value="<?= $conference->id ?>">
<input type="hidden" id="user-id" value="<?php echo $userid ?>">
<div class="row row-offcanvas row-offcanvas-right">
        
        <div class="col-xs-12 col-sm-12">
          <div class="row">
            <div class="col-lg-12">
              <div class="row">
                  <div class="col-lg-12 seminar">
                    <p><h2><?= $conference->name ?></h2></p>
                    <p><strong>Speaker : </strong> <a href="<?= URL::site('user') ?>"><?= $conference->seminar->speaker ?></a></p>
                  </div><!--span-->
              </div><!--/row-->
              <div class="row">
                  <div class="col-lg-8">
                    <p><strong class="seminardate"><?= $conference->get_start_date() ?>, <?= $conference->seminar->get_time_duration() ?></strong><br></p>
                    <?= HTML::image('img/location2.png', array('class' => 'fleft locationimg')) ?>
                      <p class="seminarloc"><?= $conference->conference_venue->venue_address->address ?>, <?= $conference->seminar->organizer->name ?><br>
                      <?= $conference->conference_venue->venue_address->get_short_location() ?> <span class="text-muted">(<a href="http://maps.google.com/maps?q=<?= $conference->seminar->organizer->name ?>" target="_blank">view map</a>)</span></p>
                  </div><!--span-->
                  <div class="col-lg-4">
                    <p class="text-right">
                      <?php if($is_attended) { ?>
                        <button type="button" class="btn btn-info cancel-book-btn">Cancel booking</button>
                      <?php } else { ?>
                        <button type="button" class="btn btn-primary book-conf-btn attend-btn">Attend this seminar</button>
                      <?php } ?>
                      
                    </p>
                  </div>
              </div><!--/row-->
              
              
            </div><!--/span--> 
          </div><!--/row--> 
          <div class="row">
            <div class="col-lg-12">
            
            <ul class="nav nav-tabs hidden-xs" id="attachment-tab">
              <li><a href="#info" data-toggle="tab">Info</a></li>
              <li><a href="#video" data-toggle="tab">Videos</a></li>
              <li><a href="#file" data-toggle="tab">Files</a></li>
              <li><a href="#photo" data-toggle="tab">Photos</a></li>
            </ul>
            <div class="visible-xs btn-group">
                <button class="mobuser-dropdown dropdown-toggle" data-target="#" data-backdrop="static" data-toggle="dropdown">
                    <span class="dropdown-label user-label">Overview</span>
                    <span class="caret" style="border-top-color: #fff;"></span>
                </button>
            <ul class="dropdown-menu text-center text-sm mobuser-dropmenu">
                <li><a href="#info" data-toggle="tab">Info</a></li>
                <li><a href="#video" data-toggle="tab">Videos</a></li>
                <li><a href="#file" data-toggle="tab">Files</a></li>
                <li><a href="#photo" data-toggle="tab">Photos</a></li>
            </ul>
            </div>
            <div class="tab-content">
              <div class="tab-pane fade active attachment-content" id="info">
                <div class="row">
                    <div class="col-lg-8">
                        <h4>Event Type</h4>
                        <p><?= $conference->conference_type->name ?></p>
                        <h4>Cateogry</h4>
                        <p><?= $conference->category->conference_category->name ?></p>
                        <!--p><h4>Description</h4></p>
              	        <p><?= $conference->description ?></p-->
                        <h4>Abstract</h4>
                        <p><?= $conference->seminar->abstract ?></p>
                    </div><!--span-->
                    <div class="col-lg-4 share-btn-container">
                    <div class="row">
                      <div class="well well-sm share-box"><p><strong>share with :</strong> <a href="https://www.facebook.com/sharer/sharer.php?u=<?= URL::site(Request::detect_uri(),true)  ?>" target="_blank">Facebook</a> | <a href="http://twitter.com/intent/tweet?url=<?= URL::site(Request::detect_uri(),true)  ?>" target="_blank">Twitter</a></p>  </div>
                    </div><!--span-->
                    <div class="row">
                        <h3 class="text-muted">Attendees</h3>

                        <table class="table attendee-table" id="attendee-list">
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
                    </div>
                    </div>
                </div><!--/row-->
              </div>
              <div class="tab-pane fade active attachment-content" id="video">
              	<div class="row">
              	    <div class="col-lg-6 col-md-8 col-sm-12 col-xs-12">
			<br>
			<?php
			$login = Service_Login::is_login();
			if(!empty($login)){
			?>
			<button type="button" class="btn btn-default" id="add-video-btn">Add video</button>
			<?php
			}
			?>
			<br><br>
              	      <div class="" id="flex-video">
			<?php
			if(!empty($videos)){
				foreach($videos as $video)
				{
					?><div id="<?php echo $video['videoid']?>"><iframe width="560" height="315" src="http://www.youtube.com/embed/<?php echo $video['videoid']?>?rel=0&controls=1" frameborder="0" allowfullscreen></iframe>
					<?php
					if(!empty($userid) && $userid == $video['users']){
					?>
					<p class="text-right" onclick="deletevideo('<?php echo $id?>','<?php echo $video['videoid']?>');"><a href="#">delete</a></p>
					<?php }?> 
					</div>
					<?php
				}
			}
			?>
		      </div>
              	    </div><!--span-->
              	</div><!--/row-->
              </div>
              <div class="tab-pane fade attachment-content" id="file">
		<p>
                  <br>
			<?php
			$login = Service_Login::is_login();
			if(!empty($login)){
			?>
                  <button type="button" class="btn btn-default" id="add-file-btn">Add file</button>
			<?php
			}
			?>
                  <br>
                 </p>
		<table class="table">
                  <tbody>
			<?php
			if(!empty($files)){
				$baseurl = URL::base();
				$upload= $baseurl."file/".$id."/attachment";
				$i = 1;
				foreach($files as $file)
				{
					$upload1=$upload."/".$file['name'];
					?><tr id="conf<?php echo $i ?>"><td><span class="glyphicon glyphicon-file"></span></td><td><a href="<?php echo $upload1;?>"><strong><?php echo $file['name']?></strong></a> <span class="text-muted">(<?php echo $file['size']?>)</span><br><span class="text-muted" id="conf_text<?php echo $i ?>"><?php echo $file['desc']?></span></td><td>
					<?php
					if(!empty($userid) && $userid == $file['users']){
					?>
					<span style="cursor: pointer;" class="glyphicon glyphicon-pencil file-edit-btn" title="edit" onclick="editfile('<?php echo $file['name']?>','<?php echo $id?>','<?php echo $file['desc']?>','conf_text<?php echo $i ?>');"></span>
					<span title="delete" onclick="deletefile('<?php echo $file['name']?>','<?php echo $id?>','conf<?php echo $i ?>');" class="glyphicon glyphicon-trash" style="cursor: pointer;"></span></td></tr>
					<?php
					}
					$i++;
				}
			}
			?>
                 </tbody></table>
              </div>
              <div class="tab-pane fade active attachment-content" id="photo">
               		<br/>
		<?php
		$login = Service_Login::is_login();
		if(!empty($login)){
		?>
		<button type="button" class="btn btn-default" id="add-photo-btn">Add photo</button>
		<?php
		}
		?>
		<br/>  <br/>
	          	  <div class="row">
			<?php
			if(!empty($photos)){
				$baseurl = URL::base();
				$i = 1;
				foreach($photos as $photo)
				{
				?>
	          	      <div id="photo<?php echo $i ?>" class="col-lg-2 col-md-3 col-sm-4 col-xs-6">
				<a id="photo_text<?php echo $i ?>" href="<?php echo $baseurl?>gallery/<?php echo $id?>/photos/<?php echo $photo['name']?>"  data-lightbox="roadtrip" title="<?php echo $photo['desc']?>">  <img class="img-thumbnail" src="<?php echo $baseurl?>gallery/<?php echo $id?>/thumb/<?php echo $photo['name']?>" /></a>
				<?php
				if(!empty($userid) && $userid == $photo['users']){
				?>
	          	         <p class="text-center"><span style="cursor: pointer;" class="glyphicon glyphicon-pencil photo-edit-btn" title="edit" onclick="editphoto('<?php echo $photo['name']?>','<?php echo $id?>','<?php echo $photo['desc']?>','photo_text<?php echo $i ?>');"></span><span style="cursor: pointer;margin-left: 5px;" class="glyphicon glyphicon-trash" title="delete" onclick="deletephoto('<?php echo $photo['name']?>','<?php echo $id?>','photo<?php echo $i ?>');"></span></p>
				<?php
				}
				?>
	          	      </div>
			      <?php
			      $i++;
				}
			}
			?>
	          	</div>
              </div>
            </div>
            
              
            </div><!--/span--> 
          </div><!--/row-->
          <div class="row attachment-content">
              <div class="col-lg-2">
              	 <p>
                  <?php if($is_attended) { ?>
                    <a href="#"><button type="button" class="btn btn-info cancel-book-btn">Cancel booking</button></a>
                  <?php } else { ?>
                    <a href="#"><button type="button" class="btn btn-primary book-conf-btn attend-btn">Attend this seminar</button></a>
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
                    <button type="button" class="btn btn-primary topic-btn" id="add-topic-btn">Submit</button>
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
    <?php echo HTML::script('js/lightbox-2.6.min.js') ?>
    <?php echo HTML::script('js/seminar.js') ?>
	
	<div class="ui-dialog ui-widget ui-widget-content ui-corner-all ui-front ui-draggable ui-resizable" tabindex="-1" role="dialog" aria-describedby="video-upload-container" style="position: absolute; height: auto; width: 600px; top: 268px; left: 376px; display: none;" aria-labelledby="ui-id-1-2"><div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix"><span class="ui-dialog-title"></span><button class="ui-dialog-titlebar-close"></button></div><div id="video-upload-container" class="ui-dialog-content ui-widget-content" style="display: block; width: auto; min-height: 88px; max-height: none; height: auto;">
                       <form role="form" class="form-inline" id="form-video">
                        <div class="form-group">
                          <input type="text" class="form-control" placeholder="YouTube Video's id" name="videoid"> 
                        </div>
                        <div class="form-group"><button type="button" class="btn btn-default" id="add_video">Add</button></div>
                        <p class="help-block">If video's url is http://www.youtube.com/watch?v=abcd123, the id is "abcd123"</p>
                       </form>
                     </div><div class="ui-resizable-handle ui-resizable-n" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-w" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-sw" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-ne" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-nw" style="z-index: 90;"></div></div>
    <div class="ui-dialog ui-widget ui-widget-content ui-corner-all ui-front ui-draggable ui-resizable" tabindex="-1" role="dialog" aria-describedby="file-upload-container" aria-labelledby="ui-id-2" style="position: absolute; height: auto; width: 600px; top: 163px; left: 376px; display: none;"><div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix"><span id="ui-id-2" class="ui-dialog-title"></span><button class="ui-dialog-titlebar-close"></button></div>
		<div id="file-upload-container" class="ui-dialog-content ui-widget-content" style="display: block; width: auto; min-height: 88px; max-height: none; height: auto;">
                 <form role="form" action="<?php echo URL::site('conference/uploadfile') ?>" class="form-inline" id="form-file" method="post" enctype="multipart/form-data">
                  <div class="form-group">
			<input type="hidden" name="hidden" value="<?php echo $id ?>">
                    <input type="file" name="file[]" multiple id="filename">
                    <small class="help-block">- Only these file types are allowed: .doc, .docx, .xls, .xlsx, .ppt, .pptx, .pdf, .txt and .rtf</small>
                    <small class="help-block">- Maximum file size is 25 MB</small>
                    <textarea class="form-control" rows="3" name="filedesc" placeholder="File description (optional)"></textarea>
                  </div>
                  <button type="submit" class="btn btn-default" id="add_file">Upload</button>
                 </form>
               </div>
		<div id="file-edit-container" style="display: block; width: auto; min-height: 87px; max-height: none; height: auto;" class="ui-dialog-content ui-widget-content">
                 <form role="form" class="form-inline" id="form-edit">
                  <div class="form-group">
                    <label id="filename1"></label>
                    <textarea rows="3" id="filedesc" class="form-control"></textarea>
                  </div>
		  <button type="button" class="btn btn-default" id="edit_file">Edit</button>
                 </form>
               </div>
		<div id="photo-upload-container" style="display: block; width: auto; min-height: 88px; max-height: none; height: auto;" class="ui-dialog-content ui-widget-content">
                    <form role="form" action="<?php echo URL::site('conference/uploadphoto') ?>" class="form-inline" id="form-photo" method="post" enctype="multipart/form-data">
			<input type="hidden" name="hidden1" value="<?php echo $id ?>">
                    <div class="form-group">
                      <input type="file" name="file[]" multiple id="filename">
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control"  name="photodesc"  placeholder="Photo's caption (optional)">
                    </div>
                    <button type="submit" class="btn btn-default" >Upload</button>
                   </form>
                 </div>
		<div id="photo-edit-container" class="ui-dialog-content ui-widget-content" style="display: block; width: auto; min-height: 87px; max-height: none; height: auto;">
                   <form role="form">
                    <div class="form-group">
			<input type="hidden" id="hiddenval" value="">
			<input type="hidden" id="hiddenname" value="">
                      <input type="text" id="photodesc1" class="form-control" value="">
                    </div>
                    <button id="edit_photo" type="button" class="btn btn-default">Edit</button>
                   </form>
                 </div>
	<div class="ui-resizable-handle ui-resizable-n" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-w" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-sw" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-ne" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-nw" style="z-index: 90;"></div></div>
  </body>
</html>