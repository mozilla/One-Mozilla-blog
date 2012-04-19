<?php get_header(); ?>

	<div id="content-main" class="main" role="main">

<?php if ( (is_front_page()) && ($paged < 1) ) : ?>

  <?php
	 /* Get last 10 sticky posts */
    $sticky = get_option( 'sticky_posts' );
    query_posts( array( 'posts_per_page' => 10, 'post__in'  => $sticky, 'ignore_sticky_posts' => 1 ) );
    if ( $sticky[0] ) :
      while ( have_posts() ) : the_post(); ?>
       
       <?php get_template_part( 'content', 'featured' ); ?>
    	
      <?php endwhile; wp_reset_query(); ?>
      <h2 class="section-title"><?php _e('Recent Videos','airmoz'); ?></h2>
    <?php endif; ?>
<?php endif; ?>

	<?php 
	 query_posts( array( 'post__not_in'  => get_option( 'sticky_posts' ), 'ignore_sticky_posts' => 0, 'paged' => get_query_var('paged') ) );
	 if ( have_posts() ) : 
	   while ( have_posts() ) : the_post(); ?>
  
    <?php get_template_part( 'content', 'summary' ); ?>
  
  <?php endwhile; ?>

    <?php if (fc_show_posts_nav()) : ?>
    <nav class="nav-paging">
      <ul role="navigation">
        <?php if ( $paged < $wp_query->max_num_pages ) : ?><li class="prev"><?php next_posts_link(__('Older videos','airmoz')); ?></li><?php endif; ?>
        <?php if ( $paged > 1 ) : ?><li class="next"><?php previous_posts_link(__('Newer videos','airmoz')); ?></li><?php endif; ?>
      </ul>
    </nav>
    <?php endif; ?>

	<?php else : ?>

		<article id="post-0" class="post no-results not-found">
			<header class="entry-header">
				<h1 class="entry-title"><?php _e( 'Nothing Found', 'onemozilla' ); ?></h1>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<p><?php _e( 'Sorry, we couldn&#8217;t find any results for the requested archive. Perhaps try searching?', 'onemozilla' ); ?></p>
				<?php get_search_form(); ?>
			</div><!-- .entry-content -->
		</article><!-- #post-0 -->

	<?php endif;   
	rewind_posts(); 
  wp_reset_query(); ?>

	</div><!-- #content-main -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>