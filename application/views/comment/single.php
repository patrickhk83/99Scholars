<?php defined('SYSPATH') or die('No direct script access.'); ?>

<div class="comment">
	<span><?php echo $comment->name; ?> Posted at: <?php echo $comment->time; ?></span>
	<pre><?php echo $comment->comment; ?></pre>
	<?php echo HTML::anchor("comment/delete/".$comment->id, "Delete"); ?>

</div>
