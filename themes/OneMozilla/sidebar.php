<div id="content-sub" class="sub sidebar widgets" role="complementary">

<?php if ( !is_active_sidebar('sidebar') ) : ?>
  <?php $options = onemozilla_get_theme_options();
  /* If we're showing authors, show the bio in the sidebar */
  if ( ($options['hide_author'] != 1) && (is_single() || is_author()) ) : ?>
    <aside class="widget vcard author-bio">
      <h3 class="widget-title">
      <?php if (get_the_author_meta('description')) : ?><?php _e('About','onemozilla'); ?><?php endif; ?>
      <?php if (get_the_author_meta('user_url')) : ?>
        <a class="url fn author" rel="external me" href="<?php the_author_meta('user_url'); ?>"><?php esc_html(the_author()); ?>
        <?php if (function_exists('get_avatar')) : echo ('<span class="photo">'.get_avatar( get_the_author_meta('user_email'), 68 ).'</span>'); endif; ?>
        </a>
      <?php else : ?>
        <a class="url fn author" href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php esc_html(the_author()); ?>
        <?php if (function_exists('get_avatar')) : echo ('<span class="photo">'.get_avatar( get_the_author_meta('user_email'), 68 ).'</span>'); endif; ?>
        </a>
      <?php endif; ?>
      <?php if (get_the_author_meta('twitter_username')) : ?>
        <?php echo '<span><a href="http://twitter.com/'.get_the_author_meta('twitter_username').'" class="url" rel="external me">@'.get_the_author_meta('twitter_username').'</a></span>'; ?>
      <?php endif; ?>
      </h3>
      
      <?php if (get_the_author_meta('description')) : ?>
      <p><?php esc_html(the_author_meta('description')); ?></p>
      <?php endif; ?>
      
      <?php if (!is_author()) :
        if (get_the_author_meta('first_name')) : 
          $name = esc_html(get_the_author_meta('first_name')); // Use the first name if there is one
        else : 
          $name = esc_html(the_author()); // Fall back to the display name
        endif;
      ?>    
      <p><a class="url go" href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php _e('More from ' . $name, 'onemozilla'); ?></a></p>
      <?php endif; ?>
    </aside>
  <?php endif; ?>
  
  <?php if ( !is_front_page() ) :
    /* Set up a custom loop for the three most recent featured posts */
    $featured = new WP_Query( array('posts_per_page' => 3, 'meta_key' => '_fc_featuredpost', 'meta_value' => 1) );
    if( $featured->have_posts() ) : ?>
    <aside class="featured-posts">
      <h3 class="widget-title"><?php _e('Featured', 'onemozilla'); ?></h3>
      <ul class="hfeed">
    <?php while($featured->have_posts()): $featured->the_post(); ?>
        <li id="feature-<?php the_ID(); ?>" class="hentry feature">
          <h4 class="entry-title entry-summary">
            <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permanent link to &ldquo;%s&rdquo;', 'onemozilla' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
              <span class="feature-img">
              <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('thumbnail', array('alt' => "", 'title' => "")); ?>
              <?php else : ?>
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/featured.png" alt="" width="160" height="160" class="wp-post-image">
              <?php endif; ?>
              </span>
              <?php the_title(); ?>
            </a>
          </h4>
        </li>
    <?php endwhile; ?>
      </ul>
    </aside>
    <?php else: endif; ?>
  <?php endif; ?>


  <aside id="categories" class="widget widget_categories">
    <h3 class="widget-title"><?php _e('Categories', 'onemozilla'); ?></h3>
    <ul>
      <?php wp_list_categories('show_count=0&title_li='); ?>
    </ul>
  </aside>
  <?php include (TEMPLATEPATH . '/searchform.php'); ?>
    
<?php else : ?>
  
  <?php $options = onemozilla_get_theme_options();
  /* If we're showing authors, show the bio in the sidebar */
  if ( ($options['hide_author'] != 1) && (is_single() || is_author()) ) : ?>
    <aside class="widget vcard author-bio">
      <h3 class="widget-title">
      <?php if (get_the_author_meta('description')) : ?><?php _e('About','onemozilla'); ?><?php endif; ?>
      <?php if (get_the_author_meta('user_url')) : ?>
        <a class="url fn author" rel="external me" href="<?php the_author_meta('user_url'); ?>"><?php esc_html(the_author()); ?>
        <?php if (function_exists('get_avatar')) : echo ('<span class="photo">'.get_avatar( get_the_author_meta('user_email'), 68 ).'</span>'); endif; ?>
        </a>
      <?php else : ?>
        <a class="url fn author" href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php esc_html(the_author()); ?>
        <?php if (function_exists('get_avatar')) : echo ('<span class="photo">'.get_avatar( get_the_author_meta('user_email'), 68 ).'</span>'); endif; ?>
        </a>
      <?php endif; ?>
      <?php if (get_the_author_meta('twitter_username')) : ?>
        <?php echo '<span><a href="http://twitter.com/'.get_the_author_meta('twitter_username').'" class="url" rel="external me">@'.get_the_author_meta('twitter_username').'</a></span>'; ?>
      <?php endif; ?>
      </h3>
      
      <?php if (get_the_author_meta('description')) : ?>
      <p><?php esc_html(the_author_meta('description')); ?></p>
      <?php endif; ?>
      
      <?php if (!is_author()) :
        if (get_the_author_meta('first_name')) : 
          $name = esc_html(get_the_author_meta('first_name')); // Use the first name if there is one
        else : 
          $name = esc_html(the_author()); // Fall back to the display name
        endif;
      ?>    
      <p><a class="url go" href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php _e('More from ' . $name, 'onemozilla'); ?></a></p>
      <?php endif; ?>
    </aside>
  <?php endif; ?>
    
    <?php dynamic_sidebar( 'sidebar' ); ?>
    
  <?php if ( !is_front_page() ) :
    /* Set up a custom loop for the three most recent featured posts */
    $featured = new WP_Query( array('posts_per_page' => 3, 'meta_key' => '_fc_featuredpost', 'meta_value' => 1) );
    if( $featured->have_posts() ) : ?>
    <aside class="featured-posts">
      <h3 class="widget-title"><?php _e('Featured', 'onemozilla'); ?></h3>
      <ul class="hfeed">
    <?php while($featured->have_posts()): $featured->the_post(); ?>
        <li id="feature-<?php the_ID(); ?>" class="hentry feature">
          <h4 class="entry-title entry-summary">
            <a href="<?php the_permalink(); ?>" title="<?php printf( esc_attr__( 'Permanent link to &ldquo;%s&rdquo;', 'onemozilla' ), the_title_attribute( 'echo=0' ) ); ?>" rel="bookmark">
              <span class="feature-img">
              <?php if (has_post_thumbnail()) : ?>
                <?php the_post_thumbnail('thumbnail', array('alt' => "", 'title' => "")); ?>
              <?php else : ?>
                <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/featured.png" alt="" width="160" height="160" class="wp-post-image">
              <?php endif; ?>
              </span>
              <?php the_title(); ?>
            </a>
          </h4>
        </li>
    <?php endwhile; ?>
      </ul>
    </aside>
    <?php else: endif; ?>
  <?php endif; ?>

<?php endif; ?>
</div><!-- #content-sub -->
