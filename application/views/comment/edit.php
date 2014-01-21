<?php defined('SYSPATH') or die('No direct script access.'); ?>

<h3>Add your comment</h3>

<div class="comment-form clearfix">
<?php echo Form::open('comment/post/'); ?>

	<?php if(isset($user)) { ?>
		<span class="text-muted">Comment as <?= $user->get_fullname() ?></span>

		<div class="crow-text">

		<div class="input-textarea"><?php echo Form::textarea("comment", $comment->comment); ?></div>
		</div>
		<?php echo Form::hidden("article_id", $article->pk()); ?>
		<?php echo Form::hidden("user", $user->pk()); ?><br>
		 <div class="crow-sub"><div class="submit" value="Submit Comment"><?php echo Form::submit("submit", "Submit"); ?></div></div>
	<?php } else { ?>
		Please <a href="<?= URL::site('login/email') ?>">login</a> or <a href="<?= URL::site('signup') ?>">register</a> before posting your comment
	<?php } ?>

	 
	
<?php echo Form::close(); ?>
</div>