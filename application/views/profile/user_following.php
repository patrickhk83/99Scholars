<div class="row">
    <div class="col-lg-8">
    	<table class="table">
        <?php if($following->count() > 0) { ?>
          <?php foreach($following as $user) { ?>
            <tr>
            <td width="40px"><?php echo HTML::image('img/avatar.jpg', array('width'  => '40')) ?></td>
            <td>
              <a href="<?= URL::site('user/profile/'.$user->id) ?>"><strong><?= $user->get_fullname() ?></strong></a>
              <br><small class="text-muted"><?= $user->get_affiliation() ?></small>
            </td>
            <td>
              <?php if($user->id === $current_user) { ?>
                <button type="button" class="btn btn-default">It's you!</button>
              <?php } else if($user->is_followed_by($current_user)) { ?>
                <button type="button" class="btn btn-warning" onclick="unfollowUser(<?= $user->id ?>, this)">Unfollow</button>
              <?php } else { ?>
                <button type="button" class="btn btn-success" onclick="followUser(<?= $user->id ?>, this)">Follow</button>
              <?php } ?>
              
            </td>
            </tr>
          <?php } ?>
        <?php } else { ?>
          <tr><td>There is no following for this user</td></tr>
        <?php } ?>
        </table>
    </div><!--span-->
</div><!--/row-->