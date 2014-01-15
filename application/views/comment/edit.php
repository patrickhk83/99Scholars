<?php defined('SYSPATH') or die('No direct script access.'); ?>

<h3>Add your comment</h3>

<div class="comment-form clearfix">
<?php echo Form::open('comment/post/'); ?>
	 <div class="crow">
	 <?php echo Form::label("name", "Name"); ?>
	<div class="input-text">
	<?php echo Form::input("name", $comment->name); ?></div>
	 </div>
	<div class="crow-last">
	
	<?php echo Form::label("email", "Email"); ?>

	<div class="input-text"><?php echo Form::input("email", $comment->email); ?>
	</div></div>
	<div class="crow-text">
	<?php echo Form::label("comment", "Comment"); ?>

	<div class="input-textarea"><?php echo Form::textarea("comment", $comment->comment); ?></div>
	</div>
	<?php echo Form::hidden("article_id", $article->pk()); ?><br>
	 <div class="crow-sub"><div class="submit" value="Submit Comment"><?php echo Form::submit("submit", "Submit"); ?></div></div>
<?php echo Form::close(); ?>
</div>