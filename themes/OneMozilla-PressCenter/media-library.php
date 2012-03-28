<?php 
/*
Template Name: Media Library
*/

get_header(); ?>

<section id="content-main" class="main">

<h1 class="section-title"><?php _e('Media Library','mozpress'); ?></h1>

<?php if (have_posts()) : ?>

<?php if ( has_nav_menu('media_tabs') ) :
  wp_nav_menu( array(
    'menu' => 'Media Library', 
    'container' => 'nav',
    'container_class' => 'nav-tabs',
    'theme_location' => 'media_tabs',
    'fallback_cb' => false) 
    );
endif; ?>

<?php while (have_posts()) : the_post(); ?>
  <article class="media-page entry-content">
  <?php edit_post_link( __( 'Edit Page', 'onemozilla' ), '<p class="edit">', '</p>' ); ?>    
  <?php the_content(); ?>
    
  <?php if (is_page(get_page_by_path('media-library/bios')->ID)) : ?>
        
    <?php $bios = new WP_Query('post_type=bios&status=published&paged=0&orderby=menu_order&order=ASC');
      if ($bios->have_posts()) : ?>
      <ul class="gallery headshots">
    <?php while ($bios->have_posts()) : $bios->the_post(); ?>
    <?php 
      $position = get_post_meta($bios->post->ID, 'bio_position', true);
      $name = get_the_title();  
      if (has_post_thumbnail()) :
        $headshot = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
      endif;
    ?>
        <li class="vcard">
          <figure class="headshot">
            <a href="<?php echo $headshot[0]; ?>" class="photo" title="<?php _e('Download high resolution image of ','mozpress'); esc_attr(the_title()); ?>"><?php the_post_thumbnail('thumbnail', array('alt' => "", 'title' => "")); ?></a>
            <figcaption>
              <strong class="fn"><?php esc_attr(the_title()); ?></strong>
              <?php if ($position) : ?><span class="title"><?php echo esc_attr($position); ?></span><?php endif; ?>
              <a href="<?php the_permalink(); ?>" class="more"><?php _e('See bio','mozpress'); ?></a>
            </figcaption>
          </figure>
        </li>
    <?php endwhile; ?>
    </ul>
  <?php endif; wp_reset_query(); ?>
    
    <?php endif; ?>

    <?php wp_link_pages(array('before' => '<p class="pages"><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number', 'link_before' => '<b>', 'link_after' => '</b>')); ?>
  
  </article>
<?php endwhile; endif; ?>

</section>

<?php get_sidebar(); ?>

<?php if (is_page(get_page_by_path('media-library')->ID)) : ?>
<script type="text/javascript" src="<?php bloginfo('stylesheet_directory'); ?>/js/TabInterface.js"></script>
<script type="text/javascript">
  // <![CDATA[
  jQuery(document).ready(function(){
    var cabinets = Array();
    var collection = document.getElementsByTagName( '*' );
    var cLen = collection.length;
    for( var i=0; i<cLen; i++ ){
      if( collection[i] &&
          /\s*tabbed\s*/.test( collection[i].className ) ){
        cabinets.push( new TabInterface( collection[i], i ) );
      }
    }
  });
  // ]]>
</script>
<?php endif; ?>


<?php get_footer(); ?>
