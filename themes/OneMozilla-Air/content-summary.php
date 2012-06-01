<?php 
$date_format = get_option( 'date_format' );
$time_format = get_option( 'time_format' );
$eventdate = get_post_meta($post->ID, 'eventdate', true); 
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h2 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permanent link to &ldquo;%s&rdquo;', 'onemozilla' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h2>
	</header>

	<div class="entry-summary">
  <?php if ($eventdate) : ?>
    <p class="event-date"><?php echo esc_attr($eventdate); ?></p>
  <?php else : ?>
    <p class="event-date"><time class="published" datetime="<?php the_time('Y-m-d\TH:i:sP'); ?>"><?php the_time($date_format.' '.$time_format); ?></time></p>
  <?php endif; ?>
    <a href="<?php the_permalink(); ?>">
  <?php if (has_post_thumbnail()) : ?>
    <?php the_post_thumbnail(array(68,68), array('alt' => "", 'title' => ""));?>
  <?php else : ?>
    <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/thumbnail-sm.png" alt="" width="68" height="68" class="wp-post-image">
  <?php endif; ?>
    </a>
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
</article><!-- #post-<?php the_ID(); ?> -->
