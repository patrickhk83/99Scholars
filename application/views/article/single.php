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
              <div class="b-posted float-left">Posted on: <span>24.11.2012</span></div>
              <div class="b-category float-left">Category: <a href="#">Selling Apartments</a></div>
              <div class="b-comments float-left"><a href="#">62 comments</a></div>
              <div class="b-views float-left"><span>211 views</span></div>
            </div>
            <div class="blog-prew"><a href="images/blog/1.jpg" title=""><img src="images/blog/1.jpg" alt="" title="" /></a></div>
            <div class="blog-prew-shadow"><!-- --></div>
            <div class="blog-desc">
           <?php echo $article->article_content; ?>
		   </div>
		   

          
            <div class="post-comments">
              <div class="comments-title">4 comments</div>
			  <?php foreach ($article->comments->find_all() as $comment) : ?>
		<!-- showing a single comment -->
		<?php echo View::factory('comment/single', array('comment'=>$comment)); ?>
	<?php endforeach; ?>
              
<!-- this practice should be preferable, instead of cluttering a single article page with everything -->
<?php echo View::factory('comment/edit', array('comment'=>new Model_Comment(),'article'=>$article )); ?>
              
           
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




