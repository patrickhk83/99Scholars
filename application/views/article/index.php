<?php defined('SYSPATH') or die('No direct script access.'); ?>
    <div id="content">  <div class="blog clearfix">
        <div id="left-side" class="float-left" style="float:left">
		
		  <?php foreach($art as $article): ?> 
          <div class="blog-post">
            <div class="blog-title clearfix"><a><?php echo HTML::anchor("article/view/".$article->id, $article->title); ?><p class="float-right">Posted by: <span>Admin</span></p></div>
           
            <div class="blog-prew-shadow"><!-- --></div>
            <div class="blog-options clearfix">
              <div class="b-posted float-left">Posted on: <span><?php echo $article->time; ?> </span></div>
              <div class="b-category float-left">Category: <a href="#"><?php echo HTML::anchor("article/edit/".$article->id, "Edit"); ?></a></div>
              <div class="b-comments float-left"><?php echo HTML::anchor("article/delete/".$article->id, "Delete"); ?></div>
              <div class="b-views float-left"><span>211 views</span></div>
            </div>
            <div class="blog-desc">
          <?php echo $article->content; ?>
		  </div>
           
          </div>
		  <?php endforeach; ?>
				 <div class="bottom-navigation clearfix">
            <div class="paginate float-right clearfix">
              <a href="#" class="older"><?php echo $pagination; ?></a>
              
            </div>
          </div>
             </div>
				

				
               
        <div id="right-side" class="float-left" style="float:right">
          
          <!-- #End // Start blog categories -->
          <div class="blog-categories">
            <div class="b-title">Categories</div>
            <ul>
              <li><a href="#">House / Vila</a></li>
              <li><a href="#">Studio</a></li>
              <li><a href="#">1 room apartment</a></li>
              <li><a href="#">Apartments with 2 bedrooms</a></li>
              <li class="active"><a href="#">Apartments with 3 bedrooms</a></li>
              <li><a href="#">Apartments with 4 bedrooms</a></li>
              <li><a href="#">Apartments with 5+ bedrooms</a></li>
              <li><a href="#">Lands</a></li>
              <li><a href="#">Comercial spaces</a></li>
              <li><a href="#">Office spaces</a></li>
              <li><a href="#">Industrial spaces</a></li>
            </ul>
          </div>
          <!-- #End // Start popular tags -->
          <div class="popular-tags clearfix">
            <div class="b-title">Popular tags</div>
              <a href="#">design</a>
              <a href="#">icon</a>
              <a href="#">grid</a>
              <a href="#">clean</a>
              <a href="#">illustration</a>
              <a href="#">typography</a>
              <a href="#">pure estate</a>
              <a href="#">high resolution</a>
              <a href="#">iphone</a>
              <a href="#">interface</a>
              <a href="#">joomla theme</a>
              <a href="#">portfolio</a>
              <a href="#">designer</a>
          </div>
          <!-- #End // Start hot property -->
         
          <!-- #End // Archive -->
          <div class="archive">
            <div class="b-title">Archive</div>
            <ul class="clearfix">
              <li><a href="#">Octomber<p class="float-right">(43)</p></a></li>
              <li><a href="#">September<p class="float-right">(91)</p></a></li>
              <li><a href="#">August<p class="float-right">(6)</p></a></li>
              <li><a href="#">July<p class="float-right">(24)</p></a></li>
              <li class="active"><a href="#">June<p class="float-right">(167)</p></a></li>
              <li><a href="#">May<p class="float-right">(19)</p></a></li>
              <li><a href="#">April<p class="float-right">(65)</p></a></li>
            </ul>
          </div>
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