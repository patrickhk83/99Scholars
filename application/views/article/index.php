<?php include Kohana::find_file('views', 'header') ?>

      <div class="row row-offcanvas row-offcanvas-right">
      
        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
          <div class="well sidebar-nav">
           <div class="blog-categories">
            <div class="b-title">Categories</div>
            <ul>
             <?php foreach($category as $cat): ?>  <li> <a href="#">  <?php echo $cat->category_name; ?></a></li> <?php endforeach; ?> </ul>
          </div>  
			
	         </div><!--/.well -->
        </div><!--/span-->
        
        <div class="col-xs-12 col-sm-9">
            <div class="row">
            <div class="col-lg-12">
            
        <div id="left-side"  >
              
			    <?php foreach($art as $article): ?> 
          <div class="blog-post">
 
            <div class="blog-title clearfix"><a href="blog-post.html"><?php echo HTML::anchor("blogarticles/view/".$article->id, $article->article_title); ?></a><p class="float-right">Posted by: <span>Admin</span></p></div>
            <div class="blog-prew">
              <iframe src="<?php echo $article->image; ?>" width="100%" height="285"></iframe>
            </div>
            <div class="blog-prew-shadow"><!-- --></div>
            <div class="blog-options clearfix">
              <div class="b-posted float-left">Posted on: <span><?php echo $article->article_date; ?></span></div>
              <div class="b-category float-left">Category: <a href="#"><?php echo $article->category->category_name; ?> </a></div>
			  
              <div class="b-comments float-left"><a href="#"><?php echo $article->comments->count_all();?> comments</a></div>
            </div>
            <div class="blog-desc">
          
          <?php echo $article->article_summary; ?>   </div>
           
			
		
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
