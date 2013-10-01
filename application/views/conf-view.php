<?php include Kohana::find_file('views', 'header') ?>

      <div class="row row-offcanvas row-offcanvas-right">
        
        <div class="col-xs-12 col-sm-12">
          <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>
          <div class="jumbotron">
            <h2><?php echo $conf['name'] ?></h2>
            <p><?php echo $conf['description'] ?></p>
            <p><button class="btn btn-primary btn-lg">Book this conference</button> <button class="btn btn-default btn-lg">Add this conference to my list</button></p>
            <p></p>
          </div>
          <div class="row">
            <div class="col-lg-10 col-lg-offset-1">
              <div class="row">
                <div class="col-lg-6">
                  <p><h4>Conference Dates</h4></p>
                  <p><?php echo $conf['start_date']." - ".$conf['end_date']  ?></p>
                </div>
                <div class="col-lg-6">
                  <p><h4>Submission Deadline</h4></p>
                  <p><?php echo $conf['deadline'] ?></p>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <p><h4>Notification of Acceptance</h4></p>
                  <p><?php echo $conf['accept_notify'] ?></p>
                </div>
                <div class="col-lg-6">
                  <p><h4>Registration Dates</h4></p>
                  <p><?php echo $conf['regis_start']." - ".$conf['regis_end']  ?></p>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <p><h4>Type</h4></p>
                  <p><?php echo $conf['type'] ?></p>
                </div>
                <div class="col-lg-6">
                  <p><h4>Category</h4></p>
                  <p><?php 
                        foreach ($conf['category'] as $category) 
                        {
                          echo $category;

                          if(end($conf['category']) != $category)
                          {
                              echo ", ";
                          }
                        }
                      ?>
                  </p>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <p><h4>Organizer</h4></p>
                  <p><?php echo $conf['organizer'] ?></p>
                </div>
                <div class="col-lg-6">
                  <p><h4>Website</h4></p>
                  <p><?php echo $conf['website'] ?></p>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <p><h4>Contact Person</h4></p>
                  <p><?php echo $conf['contact_person'] ?></p>
                </div>
                <div class="col-lg-6">
                  <p><h4>Contact Email</h4></p>
                  <p><?php echo $conf['contact_email'] ?></p>
                </div>
              </div>
              <div class="row">
                <div class="col-lg-6">
                  <p><h4>Venue</h4></p>
                  <p><?php echo $conf['venue']['name']." ".$conf['venue']['address']." ".$conf['venue']['city']." ".$conf['venue']['state']." ".$conf['venue']['postal_code']." ".$conf['venue']['country'] ?></p>
                </div>
                <div class="col-lg-6">
                </div>
              </div>
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
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="offcanvas.js"></script>
  </body>
</html>
