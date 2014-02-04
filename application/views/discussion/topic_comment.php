<tr>
	<td width="60px">
		<?php echo HTML::image('img/avatar.jpg') ?>
	</td>
	<td>
		<p>
			<a href="<?php echo URL::site('user/profile/'.$comment['author_id']) ?>">
				<strong>
					<?php echo $comment['author_name'] ?>
				</strong>
			</a> 
			<small class="text-muted">
				Massachusetts Institute of Technology
			</small>
		</p>
		<p>
			<?php echo $comment['content'] ?>
		</p>
		<p>
			<small class="text-muted">
				<?php echo $comment['last_update'] ?>
			</small>
		</p>
	</td>
</tr>