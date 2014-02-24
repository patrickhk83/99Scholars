<?php include Kohana::find_file('views', 'header') ?>

      <div class="row row-offcanvas row-offcanvas-right">
      
        <div class="col-xs-6 col-sm-3 sidebar-offcanvas" id="sidebar" role="navigation">
          <div class="well sidebar-nav">
           <div class="blog-categories">
            <div class="b-title">Categories</div>
            <ul> </ul>
          </div>  
			
	         </div><!--/.well -->
        </div><!--/span-->
        
        <div class="col-xs-12 col-sm-9">
            <div class="row">
            <div class="col-lg-12">
            
        <div id="left-side"  >
              <h2><?php echo $article->article_title; ?></h2>
	
			 <div class="blog-post">
            <div class="blog-options clearfix">
              <div class="b-posted float-left">Posted on: <span><?php echo $article->article_date; ?></span></div>
			  <div class="b-category float-left">Category: <a href="#"><?php echo $article->category->category_name; ?> </a></div>
              <div class="b-comments float-left"><a href="#"><?php echo $article->comments->count_all();?> comments</a></div>
             </div>
            <div class="blog-prew">
              <iframe src="<?php echo $article->image; ?>" width="100%" height="285"></iframe>
            </div> <div class="blog-prew-shadow"><!-- --></div>
            <div class="blog-desc">
           <?php echo $article->article_content; ?>
		   </div>
		   

          
            <div class="post-comments">
              <div class="comments-title"><?php echo $article->comments->count_all();?>  comments</div>
              
                <?php foreach ($article->comments->find_all() as $comment) : ?>
              		
		              <?php echo View::factory('comment/single', array('comment'=>$comment)); ?> 
                <?php endforeach; ?>

                <?php echo View::factory('comment/edit', array('comment'=>new Model_Comment(),'article'=>$article, 'user'=>$user )); ?>
             
           
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
    <?php echo HTML::script('js/jquery.js') ?>
    <?php echo HTML::script('js/bootstrap.min.js') ?>
    <?php echo HTML::script('js/offcanvas.js') ?>
    <?php echo HTML::script('js/jquery-ui.js') ?>
    <?php echo HTML::script('js/lightbox-2.6.min.js') ?>
    <?php echo HTML::script('js/blog_articles.js') ?>
    <!-- Placed at the end of the document so the pages load faster -->
  </body>
</html>




