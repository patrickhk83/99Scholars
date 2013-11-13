<?php defined('SYSPATH') or die('No direct script access.'); ?>

<div class="wrap">
		
			<div id="main">
				<h2 class="inner">Blog</h2>
			<div id="page">
				
				<!-- blog post -->
				<?php foreach($art as $article): ?> 
				<div class="blog-post">
				<p class="blog-date"><span><?php echo $article->time; ?> </span><br /></p>
					<div class="blog-body">
						<h3><a><?php echo HTML::anchor("article/view/".$article->id, $article->title); ?></a></h3>	
						<p><?php echo $article->content; ?></p>
						<?php echo HTML::anchor("article/edit/".$article->id, "Edit"); ?>	<?php echo HTML::anchor("article/delete/".$article->id, "Delete"); ?>
					</div>
					<div class="clear"></div>
				</div><?php endforeach; ?>
<?php echo $pagination; ?>
				<!-- /blog post -->
		
			</div>
		
			</div>
			<!-- /main -->
			
			<!-- side -->
			<div id="side">
				<h4>Latest News</h4>
				
				<div class="news">
					<h5><a href="#">News title</a></h5>
					<p>Nunc commodo euismod massa quis vestibulum, proin mi nibh, dignissim.</p>
				</div>
							
				<div id="quote">
					<h4>Request a Free Quote</h4>
					<p>Phasellus diam sapien, fermentum a eleifend non, luctus non augue.</p>
				</div>
			</div>
			<!-- /side -->
		</div>
			

	
	              	
		     