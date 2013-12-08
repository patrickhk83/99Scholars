<?php defined('SYSPATH') or die('No direct script access.'); ?>
 <div id="content">   <h2><span>Blog</span></h2>
    <div class="blog clearfix" >
        <div id="left-side" class="float-left" >
		
		  <?php foreach($art as $article): ?> 
          <div class="blog-post">
 
            <div class="blog-title clearfix"><a href="blog-post.html"><?php echo HTML::anchor("article/view/".$article->id, $article->article_title); ?></a><p class="float-right">Posted by: <span>Admin</span></p></div>
            <div class="blog-prew">
              <iframe src="<?php echo $article->image; ?>" width="666" height="285"></iframe>
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
             </div>
				

				
               
        <div id="right-side" class="float-left" >
          
          <!-- #End // Start blog categories -->
           <div class="blog-categories">
            <div class="b-title">Categories</div>
            <ul>
              <li> <?php foreach($category as $cat): ?> <a href="#">  <?php echo $cat->category_name; ?></a> <?php endforeach; ?></li> </ul>
          </div>
          <!-- #End // Start hot property -->
         
          <!-- #End // Archive -->
      
          <!-- #End // Stay informed -->
          <div class="b-stay-informed">
            <div class="b-title">Stay informed</div>
            <div class="content">
              <p>Don't worry, We don't spam ever!</p>
              <form name="newsletter" enctype="multipart/form-data" class="clearfix">
                <input type="text" name="email" class="newsletter-input" value="Enter your email here">
                <input type="submit" name="submit" value="" class="newsletter-submit" />
              </form>
            </div>
          </div>
        </div></div>   
     </div> 