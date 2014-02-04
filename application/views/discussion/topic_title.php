<tr>
	<td>
    	<p>
      		<strong>
      			<a href="#" class="topic-title" onclick="showTopic(<?= $topic->id ?>)">
      				<?= $topic->title ?>
      			</a>
      		</strong> 
      		<br />
      		<small>
      			<a href="<?= URL::site('user/profile/'.$topic->created_by) ?>">
      				<?= $topic->author->get_fullname() ?>
      			</a> 
      			<span class="text-muted">
      				<?= $topic->author->get_affiliation() ?>
      			</span> 
      		</small>
      		<br/>
      		<small class="text-muted">
      			<?= Util_Date::time_elapsed($topic->created_date).' ago' ?>
      		</small>
    	</p>
  	</td>
</tr>