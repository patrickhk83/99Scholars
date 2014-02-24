<?php defined('SYSPATH') or die('No direct script access.'); ?>
<div class="comm clearfix">
	<div class="comm-user"><!-- --></div>
	<div class="comm-cont">
		<div class="clearfix">
			<div class="user">
				<?php echo $comment->author->get_fullname(); ?> said:
			</div>
			<div class="reply">
				<a href="#"><?php echo $comment->time; ?></a>
				<?php
					if(Service_Login::is_login() && Auth::instance()->get_user()->is_admin())
					{
				?>
			    <div style="float: right;">
					<span title="delete" onclick="delete_comment(<?php echo $comment->id; ?>)" class="glyphicon glyphicon-trash" style="cursor: pointer;"></span>
				</div>
				<?php
					}
				?>	
			</div>
		</div>
		<div class="continut"  style="overflow: auto;">
			<?php echo $comment->comment; ?>
		</div>
	</div>

</div>

