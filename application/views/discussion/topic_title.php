<tr>
  <td>
    <p>
      <strong><a href="#" class="topic-title" onclick="showTopic(<?php echo $topic['id'] ?>)"><?php echo $topic['title'] ?></a></strong> 
      <br><small><a href="<?php echo URL::site('user/profile/'.$topic['author_id']) ?>"><?php echo $topic['author_name'] ?></a> <span class="text-muted"><?php echo $topic['last_update'] ?></span></small>
    </p>
  </td>
</tr>