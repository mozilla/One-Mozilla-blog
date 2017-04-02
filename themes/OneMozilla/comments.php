<?php // Do not delete these lines
  if (!empty($_SERVER['SCRIPT_FILENAME']) && 'comments.php' == basename($_SERVER['SCRIPT_FILENAME']))
    die ('Please do not load this page directly. Thanks!');

  /* Get the number of comments */
  $comment_count = get_comments_number($post->ID);

  /* This variable is for alternating comment background */
  $oddcomment = 'alt';
?>
<?php /* You can start editing here. */ ?>

<?php if ( have_comments() || comments_open() || pings_open() ) : // If there are comments OR comments are open OR pings are open ?>

<section id="comments">
<?php if ( post_password_required() ) : ?>
  <p class="nopassword"><?php _e( 'This post is password protected. Enter the password to view any comments.', 'onemozilla' ); ?></p>
</section><!-- #comments -->
<?php
    /* Stop the rest of comments.php from being processed,
     * but don't kill the script entirely -- we still have
     * to fully load the template.
     */
    return;
  endif;
?>

  <header class="comments-head">
    <h2><?php if($comment_count > 0) { printf(_n( '1 response', '%d responses', $comment_count, 'onemozilla'), $comment_count); } else { _e('No responses yet', 'onemozilla'); } ?></h2>
    <?php if (comments_open()) : ?><p class="cmt-post"><a href="#respond"><?php _e('Post a comment','onemozilla'); ?></a></p><?php endif; ?>
  </header>

<?php if ( have_comments() ) : // If there are comments ?>
  <ol id="comment-list" class="comment-list hfeed <?php if (get_option('show_avatars')) echo 'av'; // provides a style hook when avatars are enabled ?>">
  <?php wp_list_comments('type=all&style=ol&callback=onemozilla_comment'); // Comment template is in functions.php ?>
  </ol>

  <?php if ( get_comment_pages_count() > 1 ) : // If comment paging is enabled and there are enough comments to paginate, show the comment paging ?>
    <p class="pages"><?php _e('More comments:', 'onemozilla'); paginate_comments_links(); ?></p>
  <?php endif; ?>

<?php endif; ?>

<?php if ( !comments_open() && pings_open() ) : // If comments are closed but pings are open ?>
  <p class="comments-closed pings-open">
    <?php
    /* L10N: 'trackbacks' are when another website refers to this blog post with a link notification */
    printf( __( 'Comments are closed, but <a href="%1$s" title="Trackback URL for this post">trackbacks</a> are open.', 'onemozilla' ), get_trackback_url() ); ?>
  </p>
<?php endif; ?>

<?php
  comment_form( array(
    'id_form' => 'comment-form',
  ) );
?>

</section><?php // end #comments ?>

<?php endif; // if you delete this the sky will fall on your head ?>
