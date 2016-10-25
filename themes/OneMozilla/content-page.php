<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <header class="entry-header">
    <h1 class="entry-title"><?php the_title(); ?></h1>
  <?php if ( get_option('onemozilla_share_pages') == 1 ) : ?>
    <div class="share">
      <div class="socialshare" data-type="small-bubbles" data-tweet-at="<?php echo get_option('onemozilla_tweet_at', 'firefox'); ?>"></div>
    </div>
  <?php endif; ?>
  <?php edit_post_link( __( 'Edit Page', 'onemozilla' ), '<p class="edit">', '</p>' ); ?>
  </header><!-- .entry-header -->

  <div class="entry-content">
    <?php the_content(); ?>
    <?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'onemozilla' ) . '</span>', 'after' => '</div>' ) ); ?>
  </div><!-- .entry-content -->
</article><!-- #post -->
