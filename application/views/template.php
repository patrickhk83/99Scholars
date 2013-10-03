<?php include Kohana::find_file('views', 'header') ?>

      <div class="row row-offcanvas row-offcanvas-right">
      
        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
          <div class="well sidebar-nav">
            <ul class="nav">
             <li><?php echo HTML::anchor("article", "All Blog Articles"); ?></li>
			<li><?php echo HTML::anchor("article/edit", "New Article"); ?></li>
            </ul>
          </div><!--/.well -->
        </div><!--/span-->
        
        <div class="col-xs-12 col-sm-9">
          <p class="pull-right visible-xs">
            <button type="button" class="btn btn-primary btn-xs" data-toggle="offcanvas">Toggle nav</button>
          </p>
          <div class="jumbotron">
            <h2>Blog</h2>
            <p>99Scholars Blog</p>
            <p><a href="<?php echo URL::site('article/edit') ?>"><button type="button" class="btn btn-primary btn-lg">New article</button></a></p>
          </div>
          <div class="row">
           <!--/span-->
            <div class="row conf-list">
	            <div class="col-lg-12">

	               	<?php echo $content; ?>
					<!--/row-->
	              
	            </div><!--/span-->
            </div><!--/row-->
            
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
    <script src="js/offcanvas.js"></script>
  </body>
</html>
