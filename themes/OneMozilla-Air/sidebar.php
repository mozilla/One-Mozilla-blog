<?php
$date_format = get_option( 'date_format' );
$time_format = get_option( 'time_format' );
?>
<div id="content-sub" class="sub sidebar widgets" role="complementary">
  <aside id="current-time" class="widget">
    <h3 class="widget-title"><?php _e('Current Time', 'airmoz'); ?></h3>
    <p class="datetime"><time datetime="<?php echo date('Y-m-d\TH:i:sP'); ?>">
      <span class="time"><?php echo date($time_format); ?></span>
      <span class="date"><?php echo date($date_format); ?></span>
    </time></p>

    <script>
    if (jQuery) {
      jQuery(document).ready(function(){
        currentTime();
        setInterval('currentTime()', 60000 );
      });
    
      function currentTime() {
        var currentTime = new Date();
        var currentHours = currentTime.getUTCHours();
        var currentMinutes = currentTime.getUTCMinutes();
        
        // Add leading zeroes when needed
        currentHours = ( currentHours < 10 ? "0" : "" ) + currentHours;
        currentMinutes = ( currentMinutes < 10 ? "0" : "" ) + currentMinutes;
        
        var currentTimeString = currentHours + ":" + currentMinutes + " UTC";
        jQuery("#current-time .time").text(currentTimeString);
      }
    }
    </script>
  </aside>

<?php if ( is_active_sidebar('sidebar-top') ) : ?>

  <?php dynamic_sidebar( 'sidebar-top' ); ?>

<?php else : endif; ?>

<?php
// Show up to 10 non-sticky posts tagged "live" (we should almost never have more than a few)
  $liveposts = get_posts( 
    array(
      'numberposts' => 10,
      'orderby' => 'date',
      'tag' => 'live',
      'post__not_in' => get_option('sticky_posts')
    )
  );
 if ($liveposts) : ?>
  <aside id="also-live" class="widget more-posts hfeed">
    <h3 class="widget-title"><?php _e('Also Live Now','airmoz'); ?></h3>
    <ul>
 <?php
  foreach ($liveposts as $post) :
    setup_postdata($post);
  $shortdesc = get_post_meta($post->ID, 'short_description', true);
  $eventdate = get_post_meta($post->ID, 'eventdate', true);
 ?>
      <li class="hentry live">
        <h4 class="entry-title"><a href="<?php the_permalink() ?>">
        <span class="video-thumb">
        <?php if (has_post_thumbnail()) : ?>
        <?php the_post_thumbnail(array(160,160), array('alt' => "", 'title' => ""));?>
        <?php else : ?>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/thumbnail-short.png" alt="" width="160" height="160" class="wp-post-image">
        <?php endif; ?>
        </span>
          <?php the_title(); ?>
        </a></h4>
      <?php if ($eventdate) : ?>
        <p class="event-date"><?php echo esc_attr($eventdate); ?></p>
      <?php else : ?>
        <p class="event-date"><time class="published" datetime="<?php the_time('Y-m-d\TH:i:sP'); ?>"><?php the_time($date_format.' '.$time_format); ?></time></p>
      <?php endif; ?>
      <?php if ($shortdesc) : ?>
        <p class="entry-summary"><?php echo esc_attr($shortdesc); ?></p>
      <?php endif; ?>
      </li>
  <?php endforeach; ?>
    </ul>
  </aside>
<?php endif; ?>


<?php
// Show the last 3 non-sticky posts in the "featured" category
  $featured_cat = get_category_by_slug('featured')->term_id;
  $featuredposts = get_posts( 
    array(
      'numberposts' => 3,
      'orderby' => 'date',
      'category' => $featured_cat,
      'post__not_in' => get_option('sticky_posts')
    )
  );
 
 if ($featuredposts) : ?>
  <aside id="also-featured" class="widget more-posts hfeed">
    <h3 class="widget-title"><?php _e('Featured Videos','airmoz'); ?></h3>
    <ul>
 <?php
  foreach ($featuredposts as $post) :
    setup_postdata($post);
    $shortdesc = get_post_meta($post->ID, 'short_description', true);
    $eventdate = get_post_meta($post->ID, 'eventdate', true);
 ?>
      <li class="hentry featured">
        <h4 class="entry-title"><a href="<?php the_permalink() ?>">
          <span class="video-thumb">
        <?php if (has_post_thumbnail()) : ?>
          <?php the_post_thumbnail(array(160,160), array('alt' => "", 'title' => ""));?>
        <?php else : ?>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/thumbnail-short.png" alt="" width="160" height="160" class="wp-post-image">
        <?php endif; ?>
          </span>
          <?php the_title(); ?>
        </a></h4>
      <?php if ($eventdate) : ?>
        <p class="event-date"><?php echo esc_attr($eventdate); ?></p>
      <?php else : ?>
        <p class="event-date"><time class="published" datetime="<?php the_time('Y-m-d\TH:i:sP'); ?>"><?php the_time($date_format.' '.$time_format); ?></time></p>
      <?php endif; ?>
      <?php if ($shortdesc) : ?>
        <p class="entry-summary"><?php echo esc_attr($shortdesc); ?></p>
      <?php endif; ?>
      </li>
  <?php endforeach; ?>
    </ul>
  </aside>
<?php endif; ?>

<?php
// Show the next 3 pending posts
  $upcoming = get_posts( 
    array(
      'numberposts' => 3,
      'orderby' => 'date',
      'order' => 'ASC',
      'post_status' => 'future'
    )
  );
 
 if ($upcoming) : ?>
  <aside id="also-featured" class="widget more-posts hfeed">
    <h3 class="widget-title"><?php _e('Upcoming','airmoz'); ?></h3>
    <ul>
 <?php
  foreach ($upcoming as $post) :
    setup_postdata($post);
    $shortdesc = get_post_meta($post->ID, 'short_description', true);
    $eventdate = get_post_meta($post->ID, 'eventdate', true);
 ?>
      <li class="hentry featured">
        <h4 class="entry-title">
          <span class="video-thumb">
        <?php if (has_post_thumbnail()) : ?>
          <?php the_post_thumbnail(array(160,160), array('alt' => "", 'title' => ""));?>
        <?php else : ?>
          <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/thumbnail-short.png" alt="" width="160" height="160" class="wp-post-image">
        <?php endif; ?>
          </span>
          <?php the_title(); ?>
        </h4>
      <?php if ($eventdate) : ?>
        <p class="event-date"><?php echo esc_attr($eventdate); ?></p>
      <?php else : ?>
        <p class="event-date"><time class="published" datetime="<?php the_time('Y-m-d\TH:i:sP'); ?>"><?php the_time($date_format.' '.$time_format); ?></time></p>
      <?php endif; ?>
      <?php if ($shortdesc) : ?>
        <p class="entry-summary"><?php echo esc_attr($shortdesc); ?></p>
      <?php endif; ?>
      </li>
  <?php endforeach; ?>
    </ul>
  </aside>
<?php endif; ?>

<?php if ( is_active_sidebar('sidebar-bottom') ) : ?>

  <?php dynamic_sidebar( 'sidebar-bottom' ); ?>

<?php else : endif; ?>

</div><!-- #content-sub -->
