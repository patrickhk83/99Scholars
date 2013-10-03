<?php defined('SYSPATH') or die('No direct script access.'); ?>

<h1>Articles</h1>

<?php foreach ($articles as $article) : ?>
<div class="row">
		              	  <p><strong><?php echo HTML::anchor("article/view/".$article->id, $article->title); ?></a></strong> </p><br><pre><?php echo $article->content; ?></pre><br>
		              
				<?php echo HTML::anchor("article/delete/".$article->id, "Delete"); ?>
					<?php echo HTML::anchor("article/edit/".$article->id, "Edit"); ?>	
	
	
</div>
<?php endforeach; ?>



	
		              	
		     