<?php include Kohana::find_file('views', 'header') ?>
<?php

//print_r($message_data );

//foreach($message_data as $names)
//{
   //  print_r($names['created_date']) ."<br />";
	// $date1['created_date']=date('Y-m-d g:i a', $names['created_date']);
	//echo  $date1['created_date']."<br />";
//}
	

// Create connection

//echo "<pre>";
//foreach($userlist as $names)
//{
//     print_r($names['lastname']);
//}
//die;
?>
 <div class="container" id="container-message">

      <div class="row row-offcanvas row-offcanvas-right">
        
        <div class="col-xs-12 col-sm-12">
          
          <div class="row">
            <div class="col-lg-12">
              <div class="row">
                  <div class="col-lg-12">
                    <button type="button" class="btn btn-success" id="add-message-btn"><span class="glyphicon glyphicon-plus-sign"></span> New Message</button>
                    <br><br>
                  </div><!--span-->
              </div><!--/row-->
              <table class="table">
			   <tr>
                  <th width="40px"></th>
                  <th width="300px"></th>
                  <th>Message</th>
                  <th></th>
                </tr>
			<?php
			if(!empty($message_data)){
			 foreach($message_data as $names)
			 {
			 if($names['status']== 0){
			 ?>
			   <tr class="active">
			<?php
			 }else {
			 ?>
			 <tr class="">
			 <?php
			 }
			 ?>
					   <td><img src="img/avatar.jpg" width="40"/></td>
					   <td>
					     <strong><?php echo $names['receivername']?></strong>
					     <br><small class="text-muted"><?php echo $names['receiver_background']?></small>
					   </td>
					   <td>
					     <?php
					     if($names['user']== 'Yes'){
						  echo "<span class='glyphicon glyphicon-share-alt text-muted'></span>";
					     }
					     ?>
					     <a href="messages/conversation/<?php echo $names['conversationid']?>" style="cursor: pointer;color: rgb(78, 78, 229);"><?php echo $names['message']; ?><a/></td>
					   <td><small class="text-muted"><?php echo $date1['created_date']=date('d/m/Y, g:i a', $names['created_date']); ?></small></td>
					 </tr>
			 
			 <?php }
			 }
			 ?>	  
			  
			  
               
              
               <!-- <tr>
                  <td><img src="img/avatar.jpg" width="40"/></td>
                  <td>
                    <strong>Sheldon Cooper</strong>
                    <br> <small class="text-muted">Queen's University</small>
                  </td>
                  <td><a href="messages-detail.html">Thanks for your reply.</a></td>
                  <td><small class="text-muted">01/12/2013, 01:29PM</small></td>
                </tr>
                <tr>
                  <td><img src="img/avatar.jpg" width="40"/></td>
                  <td>
                    <strong>John Doe</strong>
                    <br><small class="text-muted">University of California, Los Angeles</small>
                  </td>
                  <td><span class="glyphicon glyphicon-share-alt text-muted"></span><a href="messages-detail.html"> Hi, how are you?</a></td>
                  <td><small class="text-muted">01/12/2013, 01:29PM</small></td>
                </tr>-->
              </table>
            </div><!--/span-->            
          </div><!--/row-->
        </div><!--/span-->

      </div><!--/row-->
      
<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
	
	    <?php echo HTML::script('js/jquery.js') ?>
    <?php echo HTML::script('js/bootstrap.min.js') ?>
    <?php echo HTML::script('js/offcanvas.js') ?>
    <?php echo HTML::script('js/jquery-ui.js') ?>
    <?php echo HTML::script('js/schedule.js') ?>
	    <?php echo HTML::script('js/messages.js') ?>

	<div class="ui-dialog ui-widget ui-widget-content ui-corner-all ui-front ui-draggable ui-resizable" style="position: absolute; height: auto; width: 450px; top: 200px; left: 458px; display: none;" tabindex="-1" role="dialog" aria-describedby="new-message-container" aria-labelledby="ui-id-1"><div class="ui-dialog-titlebar ui-widget-header ui-corner-all ui-helper-clearfix"><span id="ui-id-1" class="ui-dialog-title">Send new message</span><button class="ui-button ui-widget ui-state-default ui-corner-all ui-button-icon-only ui-dialog-titlebar-close" role="button" aria-disabled="false" title="close"><span class="ui-button-icon-primary ui-icon ui-icon-closethick"></span><span class="ui-button-text">close</span></button></div>
	  <div id="new-message-container" style="display: none; width: auto; min-height: 88px; max-height: none; height: auto;" class="ui-dialog-content ui-widget-content">
         <form role="form" id="form-message">
          <div class="form-group">
            <select class="form-control" id="receiver_name">
	       <?php
	       foreach($userlist as $value)
	       { ?>
		    <option value="<?php echo $value['id']?>"><?php echo $value['firstname']?> <?php echo $value['lastname']?></option>
	       <?php }
	       ?>
            </select>
          </div>
          <div class="form-group">
            <textarea rows="3" class="form-control" placeholder="Type your message here" id="send_message"></textarea>
          </div>

          <div class="form-group">
            <button type="button" id="message_button" class="btn btn-default">Send</button>
          </div>
          
         </form>
       </div><div class="ui-resizable-handle ui-resizable-n" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-e" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-s" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-w" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-se ui-icon ui-icon-gripsmall-diagonal-se" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-sw" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-ne" style="z-index: 90;"></div><div class="ui-resizable-handle ui-resizable-nw" style="z-index: 90;"></div></div>

  </body>
</html>
