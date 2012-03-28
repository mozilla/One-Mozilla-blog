<?php $options = onemozilla_get_theme_options(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permanent link to &ldquo;%s&rdquo;', 'onemozilla' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php esc_attr(the_title()); ?></a></h2>

	<?php if ( 'post' == get_post_type() ) : // No posted date for Pages ?>
    <p class="entry-posted">
      <time class="published" title="<?php the_time('Y-m-d\TH:i:sP'); ?>" datetime="<?php the_time('Y-m-d\TH:i:sP'); ?>">
        <span class="posted-month"><?php the_time('M'); ?></span>
        <span class="posted-date"><?php the_time('j'); ?></span>
        <span class="posted-year"><?php the_time('Y'); ?></span>
      </time>
    </p>
	<?php endif; ?>
	</header>

	<div class="entry-summary">
  <?php if (has_post_thumbnail()) : ?><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(68,68), array('alt' => "", 'title' => ""));?></a><?php endif; ?>
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->

</article><!-- #post-<?php the_ID(); ?> -->
