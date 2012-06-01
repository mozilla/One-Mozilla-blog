<?php get_header(); ?>

<nav id="nav-bios">
<?php $nav = new WP_Query('post_type=bios&status=published&paged=0&orderby=menu_order&order=ASC');
  if ($nav->have_posts()) : ?>
  <ul>
<?php while ($nav->have_posts()) : $nav->the_post(); ?>
<?php $position = get_post_meta($nav->post->ID, 'bio_position', true); ?>
    <li>
      <a href="<?php the_permalink(); ?>"><?php esc_attr(the_title()); ?> <?php if ($position) : ?><span><?php echo $position; ?></span><?php endif; ?></a>
    </li>
<?php endwhile; ?>
  </ul>
<?php endif; wp_reset_query(); ?>
</nav>

<section id="content-main" class="main hfeed">

<?php $wp_query->query('post_type=bios&posts_per_page=1&paged=0&orderby=menu_order&order=ASC');
  if (have_posts()) : while (have_posts()) : the_post(); ?>
<?php
  $position = get_post_meta($post->ID, 'bio_position', true);
  $blog_name = get_post_meta($post->ID, 'bio_blog_name', true);
  $blog_url = get_post_meta($post->ID, 'bio_blog_url', true);
  $twitter = get_post_meta($post->ID, 'bio_twitter', true);
if (has_post_thumbnail()) :
  $headshot = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'single-post-thumbnail' );
endif;
?>
  <article class="hentry vcard bio" id="bio-<?php the_ID(); ?>">
    <?php if (has_post_thumbnail()) : ?>
      <figure class="bio-image photo"><a href="<?php echo $headshot[0]; ?>"><?php the_post_thumbnail('thumbnail', array('alt' => "", 'title' => "")); ?></a></figure>
    <?php endif; ?>
    <hgroup>
      <h1 class="entry-title fn"><?php esc_attr(the_title()); ?></h1>
    <?php if ($position) : ?>
      <h2 class="bio-position title"><?php echo esc_attr($position); ?></h2>
    <?php endif; ?>
    </hgroup>
    <div class="entry-content">
      <?php the_content('Read the rest of this entry &raquo;'); ?>
      <?php if ($blog_url) : ?>
        <p class="bio-extra"><?php _e('Website','mozpress'); ?>: <a href="<?php echo esc_html($blog_url); ?>" rel="external" class="url"><?php echo esc_attr($blog_name); ?></a></p>
      <?php endif; ?>
      <?php if ($twitter) : ?>
        <p class="bio-extra"><?php _e('Twitter','mozpress'); ?>: <a href="//twitter.com/<?php echo urlencode($twitter); ?>" rel="external" class="url nickname">@<?php echo esc_attr($twitter); ?></a></p>
      <?php endif; ?>
      <?php if (has_post_thumbnail()) : ?>
        <p class="bio-extra"><a href="<?php echo $headshot[0]; ?>"><?php _e('Download high-res JPEG','mozpress'); ?></a></p>
      <?php endif; ?>
    </div>

    <?php wp_link_pages(array('before' => '<p class="pages"><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number', 'link_before' => '<b>', 'link_after' => '</b>')); ?>  
  </article>
<?php endwhile; endif; ?>

</section>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
