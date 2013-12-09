<?php include Kohana::find_file('views', 'header') ?>

      <div class="row row-offcanvas row-offcanvas-right">
      
        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
          <div class="well sidebar-nav">
           <div class="blog-categories">
            <div class="b-title">Categories</div>
            <ul>
              <li> <?php foreach($category as $cat): ?> <a href="#">  <?php echo $cat->category_name; ?></a> <?php endforeach; ?></li> </ul>
          </div>  
			
	         </div><!--/.well -->
        </div><!--/span-->
        
        <div class="col-xs-12 col-sm-9">
            <div class="row">
            <div class="col-lg-12">
            
        <div id="left-side"  >
              
			    <?php foreach($art as $article): ?> 
          <div class="blog-post">
 
            <div class="blog-title clearfix"><a href="blog-post.html"><?php echo HTML::anchor("article/view/".$article->id, $article->article_title); ?></a><p class="float-right">Posted by: <span>Admin</span></p></div>
            <div class="blog-prew">
              <iframe src="<?php echo $article->image; ?>" width="100%" height="285"></iframe>
            </div>
            <div class="blog-prew-shadow"><!-- --></div>
            <div class="blog-options clearfix">
              <div class="b-posted float-left">Posted on: <span><?php echo $article->article_date; ?></span></div>
              <div class="b-category float-left">Category: <a href="#"><?php echo $article->category_id; ?></a></div>
              <div class="b-comments float-left"><a href="#">673 comments</a></div>
              <div class="b-views float-left"><span>2246 views</span></div>
            </div>
            <div class="blog-desc">
          
          <?php echo $article->article_summary; ?>   </div>
            <div class="blog-more clearfix">
              <div class="float-left"><a href="blog-post.html">View details</a></div>
            </div>
			
		
          </div>  <?php endforeach; ?>
				 <div class="bottom-navigation clearfix">
            <div class="paginate float-right clearfix">
              <a href="#" class="older"><?php echo $pagination; ?></a>
              
            </div>
          </div>
			  
          </div><!--/span-->
            </div>
          </div><!--/row-->
        </div><!--/span-->

      </div><!--/row-->


    </div><!--/.container-->



    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/offcanvas.js"></script>
    <script src="js/bootstrap-datepicker.js"></script>
    <script src="js/home.js"></script>
    <script src="js/jquery.infinitescroll.min.js"></script>
  </body>
</html>
