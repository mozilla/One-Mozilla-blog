<?php $theme_options = onemozilla_get_theme_options(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
  <header class="entry-header">
    <h1 class="entry-title"><?php the_title(); ?></h1>
  <?php if ( $theme_options['share_posts'] == 1 ) : ?>
    <div class="share">
      <div class="socialshare" data-type="small-bubbles"></div>
    </div>
  <?php endif; ?>
  </header><!-- .entry-header -->

  <div class="entry-content">
    <?php edit_post_link( __( 'Edit Page', 'onemozilla' ), '<p class="edit">', '</p>' ); ?>
    <?php the_content(); ?>
    <?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'onemozilla' ) . '</span>', 'after' => '</div>' ) ); ?>
  </div><!-- .entry-content -->
</article><!-- #post -->
