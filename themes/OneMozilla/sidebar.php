<div id="content-sub" class="sub sidebar widgets" role="complementary">
<?php
	/* There are two sidebars, and the second is optional.
	 * If neither of the sidebars is active, fall back to the default single sidebar.
	 */
?>

<?php if ( !is_active_sidebar('sidebar') ) : ?>
  <aside id="categories" class="widget">
    <h3 class="widget-title"><?php _e('Categories', 'onemozilla'); ?></h3>
    <ul>
      <?php wp_list_categories('show_count=0&title_li='); ?>
    </ul>
  </aside>
  <?php include (TEMPLATEPATH . '/searchform.php'); ?>
    
<?php else : ?>
  
  <?php $options = onemozilla_get_theme_options();
  /* If we're showing authors, show the bio in the sidebar */
  if ( ($options['hide_author'] != 1) && ( is_single() || is_author() ) ) : ?>
    <aside class="widget vcard author-bio">
      <h3 class="widget-title fn author">
      <?php if (get_the_author_meta('user_url')) : ?>
        <a class="url" rel="external me" href="<?php the_author_meta('user_url'); ?>"><?php the_author(); ?>
        <?php if (function_exists('get_avatar')) : echo ('<span class="photo">'.get_avatar( get_the_author_meta('user_email'), 48 ).'</span>'); endif; ?>
        </a>
      <?php else : ?>
        <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php the_author(); ?>
        <?php if (function_exists('get_avatar')) : echo ('<span class="photo">'.get_avatar( get_the_author_meta('user_email'), 48 ).'</span>'); endif; ?>
        </a>
      <?php endif; ?>
      <?php if (get_the_author_meta('twitter_username')) : ?>
        <?php echo '<span><a href="http://twitter.com/'.get_the_author_meta('twitter_username').'" class="url" rel="external me">@'.get_the_author_meta('twitter_username').'</a></span>'; ?>
      <?php endif; ?>
      </h3>
      
      <?php if (get_the_author_meta('description')) : ?>
      <h4><?php _e('About the Author', 'onemozilla'); ?></h4>
      <p><?php esc_html(the_author_meta('description')); ?></p>
      <?php endif; ?>
      
      <?php if (!is_author()) :
        if (get_the_author_meta('first_name')) : 
          $name = esc_html(get_the_author_meta('first_name')); // Use the first name if there is one
        else : 
          $name = the_author(); // Fall back to the display name
        endif;
      ?>    
      <p><a class="url go" href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>"><?php _e('More from ' . $name, 'onemozilla'); ?></a></p>
      <?php endif; ?>
    </aside>
  <?php endif; ?>
    
    <?php dynamic_sidebar( 'sidebar' ); ?>

<?php endif; ?>
</div><!-- #content-sub -->
