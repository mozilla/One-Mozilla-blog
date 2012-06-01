<?php 
$date_format = get_option( 'date_format' );
$time_format = get_option( 'time_format' );
$eventdate = get_post_meta($post->ID, 'eventdate', true); 
?>

<article id="feature-<?php the_ID(); ?>" <?php post_class('main-feature'); ?>>
  <header>
    <hgroup>
    <?php if (has_tag('live')) : ?>
      <h2 class="feature-type"><?php _e('Streaming Live Now','airmoz'); ?></h2>
    <?php else : ?>
      <h2 class="feature-type"><?php _e('Featured Video','airmoz'); ?></h2>
    <?php endif; ?>
      <h3 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permanent link to &ldquo;%s&rdquo;', 'onemozilla' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h3>
    </hgroup>
  <?php if ($eventdate) : ?>
    <p class="event-date"><?php echo esc_attr($eventdate); ?></p>
  <?php else : ?>
    <p class="event-date"><time class="published" datetime="<?php the_time('Y-m-d\TH:i:sP'); ?>"><?php the_time($date_format.' '.$time_format); ?></time></p>
  <?php endif; ?>
  </header>
	<div class="entry-summary">
    <a href="<?php the_permalink(); ?>">
    <?php if (has_post_thumbnail()) : ?>
      <?php the_post_thumbnail(array(160,160), array('alt' => "", 'title' => ""));?>
    <?php else : ?>
      <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/thumbnail.png" alt="" width="160" height="160" class="wp-post-image">
    <?php endif; ?>
		</a>
		<?php the_excerpt(); ?>
		<p class="watch"><a class="button" href="<?php the_permalink(); ?>"><?php _e('Watch Now','airmoz'); ?></a></p>
	</div><!-- .entry-summary -->
</article><!-- #post-<?php the_ID(); ?> -->
