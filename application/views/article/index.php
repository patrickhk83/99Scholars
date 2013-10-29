<?php defined('SYSPATH') or die('No direct script access.'); ?>

<h1>Articles</h1>

<?php foreach($art as $article): ?> 
<div class="row">
     <p><strong><a><?php echo HTML::anchor("blog/article/view/".$article->id, $article->title); ?></a></strong> </p><br><pre><?php echo $article->content; ?> <p>Posted on: <?php echo $article->time; ?> by <b>Admin</b></p></pre><br>
		              
</div>
<?php endforeach; ?>
<?php echo $pagination; ?>
	
	              	
		     