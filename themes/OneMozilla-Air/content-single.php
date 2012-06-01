<?php 
$date_format = get_option( 'date_format' );
$time_format = get_option( 'time_format' );
$eventdate = get_post_meta($post->ID, 'eventdate', true); 
?>
<script src="http://videos.mozilla.org/serv/air_mozilla/jwplayer.js"></script>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title"><?php the_title(); ?></h1>
  <?php if ($eventdate) : ?>
    <h2 class="event-date"><?php echo esc_attr($eventdate); ?></h2>
  <?php else : ?>
    <h2 class="event-date"><time class="published" datetime="<?php the_time('Y-m-d\TH:i:sP'); ?>"><?php the_time($date_format.' '.$time_format); ?></time></h2>
  <?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
    <?php edit_post_link( __( 'Edit Post', 'onemozilla' ), '<p class="edit">', '</p>' ); ?>
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-link"><span>' . __( 'Pages:', 'onemozilla' ) . '</span>', 'after' => '</div>' ) ); ?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
