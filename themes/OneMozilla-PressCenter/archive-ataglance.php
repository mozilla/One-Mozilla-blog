<?php get_header(); ?>

<section id="content-main" class="main hfeed">

<h1 class="section-title"><?php _e('Mozilla At a Glance','mozpress'); ?></h1>

<?php $wp_query->query('post_type=ataglance&orderby=menu_order&order=ASC&paged=0');
  if (have_posts()) : while (have_posts()) : the_post(); ?>
<?php $alt = ($alt) ? "" : "odd"; ?>
  <div class="ataglance-items expander-item <?php echo $alt; ?>" id="glance-<?php the_ID(); ?>">
    <h3 class="expander-header"><a href="#"><?php esc_attr(the_title()); ?></a></h1>
    <div class="expander-content">
      <?php the_content('Read the rest of this entry &raquo;'); ?>
    </div>
  </div>
<?php endwhile; endif; ?>

</section>

<script type="text/javascript">
if (jQuery) {

  jQuery(document).ready(function(){
    jQuery(".expander-content").hide();
    jQuery(".expander-header a").addClass("closed").attr("title", "Open");
  });
  
  jQuery(".expander-header a").click(function(){
    jQuery(this).toggleClass('closed').toggleClass('open').blur();
    jQuery(this).parents(".expander-item").find(".expander-content").slideToggle('fast');
    if (jQuery(this).attr('title') == 'Open' ) {
      jQuery(this).attr('title', 'Close');
    }
    return false;
  });

}
</script>

<?php get_sidebar(); ?>
<?php get_footer(); ?>
