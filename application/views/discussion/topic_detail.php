<div id="topic-header">
  <p><strong><?php echo $topic['title'] ?></strong></p>
</div>
<div id="topic-discussion">
  <table class="table">
    <tbody id="comments">
      <tr class="well">
        <td width="60px"><?php echo HTML::image('img/avatar.jpg') ?></td>
        <td>
          <p><a href="<?php echo URL::site('user/profile/'.$topic['author_id']) ?>"><strong><?php echo $topic['author_name'] ?></strong></a> <small class="text-muted">Massachusetts Institute of Technology</small></p>
          <p><?php echo $topic['content'] ?></p>
          <p><small class="text-muted"><?php echo $topic['last_update'] ?></small></p>
        </td>
      </tr>
      <?php if(isset($topic['comments'])) { ?>
        <?php foreach($topic['comments'] as $comment) 
          { 
            echo View::factory('discussion/topic_comment')->bind('comment', $comment);  
          } 
        ?>
      <?php } ?>
    </tobody>
  </table>
  <form role="form" id="comment-form">
    <input type="hidden" name="topic_id" value="<?php echo $topic['id'] ?>">
    <table class="table">
      <tbody>
        <tr>
          <td width="60px"><?php echo HTML::image('img/avatar.jpg') ?></td>
          <td>
            <p><textarea class="form-control" rows="4" placeholder="Type your comment here" name="comment"></textarea></p>
            <p class="text-right"><button type="button" class="btn btn-primary" id="add-comment-btn">Submit</button></p>
          </td>
        </tr>
      </tbody>
    </table>
  </form>
</div>