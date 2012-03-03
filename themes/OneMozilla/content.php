	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permanent link to %s', 'onemozilla' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>

		<?php if ( 'post' == get_post_type() ) : // No posted date for Pages ?>
      <p class="entry-posted">
        <time class="published" title="<?php the_time('Y-m-d\TH:i:sP'); ?>" datetime="<?php the_time('Y-m-d\TH:i:sP'); ?>">
          <a class="posted-month" href="<?php echo get_month_link(get_the_time('Y'), get_the_time('m')); ?>" title="See all posts from <?php echo get_the_time('F, Y'); ?>"><?php the_time('M'); ?></a>
          <span class="posted-date"><?php the_time('j'); ?></span>
          <a class="posted-year" href="<?php echo get_year_link(get_the_time('Y'), get_the_time('y')); ?>" title="See all posts from <?php echo get_the_time('Y'); ?>"><?php the_time('Y'); ?></a>
        </time>
      </p>
		<?php endif; ?>
		<?php $options = onemozilla_get_theme_options();
    if ( $options['hide_author'] != 1 ) : ?>
		  <address class="vcard">Posted by <cite class="author fn"><a class="url" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) ?>" title="See all <?php the_author_posts() ?> posts by <?php the_author() ?>"><?php the_author() ?> <?php echo get_avatar(get_the_author_meta('user_email'), 24) ?></a></cite></address>
    <?php endif; ?>
      <?php $comment_count = get_comment_count($post->ID);
      if ( comments_open() || $comment_count['approved'] > 0 ) : ?>
        <p class="entry-comments"><a href="<?php comments_link() ?>" title="<?php comments_number('No comments yet','1 comment','% comments'); ?>"><?php comments_number('No responses yet','1 response','% responses'); ?></a></p>
      <?php endif; ?>
      
    <?php edit_post_link( __( 'Edit Post', 'onemozilla' ), '<p class="edit">', '</p>' ); ?>

		</header><!-- .entry-header -->

		<div class="entry-content">
		  <?php if (has_post_thumbnail()) { the_post_thumbnail('thumbnail', array('alt' => "", 'title' => "")); } ?>

			<?php the_content( __( 'Continue reading &hellip;', 'onemozilla' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<p class="pages" role="navigation"><span>' . __( 'Pages:', 'onemozilla' ) . '</span>', 'after' => '</p>' ) ); ?>
		</div><!-- .entry-content -->

  <?php if ( has_tag() || ( 'post' == get_post_type() ) ) : // No need for a footer if there's nothing to show ?>
		<footer class="entry-meta">
		<?php if (has_tag()) : ?>
		  <p class="meta"><b>Tags:</b> <?php $tags_list = the_tags('',', ',''); ?></p>
		<?php endif; ?>
      <p class="meta"><b>Categories:</b> <?php the_category(', ') ?></p>
		</footer><!-- #entry-meta -->
  <?php endif; ?>

	</article><!-- #post-<?php the_ID(); ?> -->
