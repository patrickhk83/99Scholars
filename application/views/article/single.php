<?php defined('SYSPATH') or die('No direct script access.'); ?>
	
<div id="content">
      <h2><span><?php echo $article->article_title; ?></span></h2>
      <div class="blog clearfix">
        <div id="left-side" class="float-left">
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
            
            <div class="post-tags">
              Tags: <a href="#">web design,</a> <a href="#">joomla,</a> <a href="#">brilliant theme,</a> <a href="#">wordpress,</a> <a href="#">unique,</a> <a href="#">creative</a> <a href="#">.pure real estate</a>
            </div>
            <div class="post-comments">
			<?php foreach ($article->comments->find_all() as $comment) : ?>
		<!-- showing a single comment -->
		<?php echo View::factory('comment/single', array('comment'=>$comment)); ?>
	<?php endforeach; ?>	


<!-- this practice should be preferable, instead of cluttering a single article page with everything -->
<?php echo View::factory('comment/edit', array('comment'=>new Model_Comment(),'article'=>$article )); ?> 

              <div class="comments-title">4 comments</div>
             
            </div>
            
          </div>
        </div>        
        <div id="right-side" class="float-left">
          <!-- Blog search -->
          <form action="#" enctype="multipart/form-data" method="post" class="search clearfix">
            <input type="text" name="keyword" value="Search in blog" class="search-input" />
            <input type="submit" name="submit" value="" class="submit-input" />
          </form>
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
          <div class="hot-property clearfix">
            <div class="b-title">Hot property</div>
            <div class="jcarousel-date-content float-left">
              <div class="l-off"><a href="#"><!-- --></a></div>
              <div class="l-image">
                <img src="images/property-images/2.jpg" alt="" title="" />
                <div class="l-image-hover">
                  <a href="#" class="l-lupa"><!-- --></a>
                  <a href="#" class="l-link"><!-- --></a>
                </div>
              </div>
              <div class="l-shadow"><!-- --></div>
              <div class="l-title"><a href="property-details.html">356 GEORGE ST, Waterloo, NSW 2017</a></div>
              <div class="l-features clearfix">
                <div class="l-bedrooms">4 Bedrooms</div>
                <div class="l-area">2416 m<sup>2</sup></div>
                <div class="l-baths">2 Baths</div>
                <div class="l-type">For Rent</div>
              </div>
              <div class="l-details clearfix">
                <div class="l-price">$1,499</div>
                <div class="l-view"><a href="property-details.html">View details</a></div>
              </div>
            </div>
          </div>
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
        </div>
      </div>
    <!-- Start SOCIAL FOOTER
      ========================================== -->
      <div class="social-footer clearfix">
        <div class="col float-left">
          <h2><span>Recent blog posts</span></h2>
          <div class="content">
            <div class="post clearfix">
              <div class="image float-left"><a href="#"><img src="images/posts/1.jpg" alt="" title="" /></a></div>
              <div class="post-det float-left">
                <a href="#"><span>Lorem ipsum dolor</span> consectetur adipiscing elit. Etiam</a>
                <p>November 7, 2012</p>
              </div>
            </div>
            <div class="post last clearfix">
              <div class="image float-left"><a href="#"><img src="images/posts/2.jpg" alt="" title="" /></a></div>
              <div class="post-det float-left">
                <a href="#"><span>Fermentum donec</span> ut rhoncus consectetur, diam dolor lacinia eros.</a>
                <p>November 4, 2012</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col float-left">
          <h2><span class="facebook">Facebook</span></h2>
          <div class="f-content">
            <div class="post">
              <div class="post-det">
                <a href="#"><span>Lorem ipsum dolor sit amet</span> consectetur adipiscing elit. Etiam egestas nulla sit amet.</a>
                <p>November 8, 2012</p>
              </div>
            </div>
            <div class="post last">
              <div class="post-det">
                <a href="#"><span>Fermentum donec gravida</span> nibh ut rhoncus consectetur, diam dolor lacinia eros.</a>
                <p>November 2, 2012</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col float-left">
          <h2><span class="twitter">Twitter</span></h2>
          <div class="t-content">
            <div class="post">
              <div class="post-det">
                <a href="#"><span>Lorem ipsum dolor sit</span> amet, consectetur adipiscing elit. Etiam egestas</a>
                <p>November 11, 2012</p>
              </div>
            </div>
            <div class="post last">
              <div class="post-det">
                <a href="#"><span>Fermentum donec</span> gravida, nibh ut rhoncus consectetur, diam dolor lacinia eros egestas.</a>
                <p>November 5, 2012</p>
              </div>
            </div>
          </div>
        </div>
        <div class="col float-left last">
          <h2><span class="tv">As seen on tv</span></h2>
          <div class="t-content">
            <iframe src="http://player.vimeo.com/video/16285298?title=0&amp;byline=0&amp;portrait=0" width="200" height="150" style="border: 3px solid #fff; -webkit-border-radius: 2px; -moz-border-radius: @2px; -ms-border-radius: 2px; -o-border-radius: 2px; border-radius: 2px;"></iframe>
          </div>
        </div>
      </div>
    </div>