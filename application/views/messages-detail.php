<?php include Kohana::find_file('views', 'header') ?>
<?php
//echo "<pre>";
//print_r($id);
//die;
?>
<input type="hidden" id="conv-id" value="<?php echo $id ?>">
<div class="container">

      <div class="row row-offcanvas row-offcanvas-right" id="container-message-edit">
        
        <div class="col-xs-12 col-sm-12">
          
          <div class="row">
            <div class="col-lg-12">
              <div class="row">
                  <div class="col-lg-12">
                    <a href="../../messages"><button type="button" class="btn btn-default"><span class="glyphicon glyphicon-chevron-left"></span> Back</button></a>
                    <br><br>
                  </div><!--span-->
              </div><!--/row-->
	      <?php
	      if(!empty($user_msgs))
	      {
		    foreach($user_msgs as $username)
		    {
			 $name = $username['receivername'];
			 $name_back = $username['receiver_background'];
			 $receiverid = $username['receiver_id'];
			 break;
		    }
	      }
	      
	      ?>
	      
	      <input type="hidden" id="receiver-id" value="<?php echo $receiverid ?>">
              <strong><?php echo $name?></strong> <small class="text-muted"><?php echo $name_back?></small>
              <br><br>
              <table class="table">
                <tbody>
	       <?php
		    if(!empty($user_msgs))
		    {
			 foreach($user_msgs as $username)
			 {
			 ?>
			 
			 <tr>
			 <td width="40px"><img src="../../img/avatar.jpg" width="40"></td>
			 <td>
			   <strong><?php echo $username['sendername']?></strong>
			   <br><?php echo $username['message']?>
			 </td>
			 <td class="text-right">
			   <small class="text-muted"><?php echo $date1['created_date']=date('d/m/Y, g:i a', $username['created_date']); ?></small>
			 </td>
		       </tr>
			 
			 <?php
			 }
		    }
		    
	       ?>
		 <tr>
                  <td colspan="2">
                    <br>
                    <form role="form" id="form-message-edit">
                      <div class="form-group">
                        <textarea rows="3" class="form-control" placeholder="Type your message here" id="send_edit_message"></textarea>
                      </div>
                      <button type="button" id="message_edit_button" class="btn btn-primary">Send</button>
                    </form>
                  </td>
                </tr>
              </tbody></table>
            </div><!--/span-->            
          </div><!--/row-->
        </div><!--/span-->

      </div><!--/row-->

      <hr>

      <footer>
        <p>© 99Scholars 2013</p>
      </footer>

    </div>
<!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
	
	    <?php echo HTML::script('js/jquery.js') ?>
    <?php echo HTML::script('js/bootstrap.min.js') ?>
    <?php echo HTML::script('js/offcanvas.js') ?>
    <?php echo HTML::script('js/jquery-ui.js') ?>
	    <?php echo HTML::script('js/messages.js') ?>
	    
     </body>
</html>
