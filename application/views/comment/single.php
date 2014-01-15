<?php defined('SYSPATH') or die('No direct script access.'); ?>
<div class="comm clearfix">
                <div class="comm-user"><!-- --></div>
                  <div class="comm-cont">
                  <div class="clearfix">
                    <div class="user"><?php echo $comment->name; ?> said:</div>
                    <div class="reply"><a href="#"><?php echo $comment->time; ?></a></div><br>
                  </div>
                  <div class="continut"><?php echo $comment->comment; ?></div>
                </div>
              </div>
