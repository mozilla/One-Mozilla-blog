<?php 
// Count search results
global $wp_query;
$total_results = $wp_query->found_posts;

get_header(); ?>

  <div id="content-main" class="main" role="main">

	<?php if ( have_posts() ) : ?>

  <?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
  <h1 class="page-title">
  <?php if (is_category()) : ?><?php _e('Archive for ','onemozilla'); ?><?php single_cat_title(); ?>
  <?php elseif (is_tag()) : ?><?php _e('Posts tagged with ','onemozilla'); ?> &#8220;<?php single_tag_title(); ?>&#8221;
  <?php elseif (is_day()) : ?><?php _e('Posts from ','onemozilla'); ?> <?php the_time('F jS, Y'); ?>
  <?php elseif (is_month()) : ?><?php _e('Posts from ','onemozilla'); ?> <?php the_time('F, Y'); ?>
  <?php elseif (is_year()) : ?><?php _e('Posts from ','onemozilla'); ?> <?php the_time('Y'); ?>
  <?php elseif (is_author()) : ?><?php _e('Posts by ','onemozilla'); ?> <span><?php echo esc_html(get_userdata(intval($author))->display_name); ?></span>
  <?php elseif (is_search()) : ?><?php printf( __('We found %1s results for &ldquo;%2s&ldquo;','onemozilla'), $total_results, esc_html(get_search_query()) ); ?>
  <?php else : ?><?php _e('Archives','onemozilla'); ?>
  <?php endif; ?>
  </h1>
  
    <?php if (fc_show_posts_nav()) : ?>
    <nav class="nav-paging top">
      <ul role="navigation">
        <?php if ( $paged < $wp_query->max_num_pages ) : ?><li class="prev"><?php next_posts_link(__('Older posts','onemozilla')); ?></li><?php endif; ?>
        <?php if ( $paged > 1 ) : ?><li class="next"><?php previous_posts_link(__('Newer posts','onemozilla')); ?></li><?php endif; ?>
      </ul>
    </nav>
    <?php endif; ?>

		<?php /* Start the Loop */ ?>
		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'summary' ); ?>

		<?php endwhile; ?>
		
    <?php if (fc_show_posts_nav()) : ?>
    <nav class="nav-paging bottom">
      <ul role="navigation">
        <?php if ( $paged < $wp_query->max_num_pages ) : ?><li class="prev"><?php next_posts_link(__('Older posts','onemozilla')); ?></li><?php endif; ?>
        <?php if ( $paged > 1 ) : ?><li class="next"><?php previous_posts_link(__('Newer posts','onemozilla')); ?></li><?php endif; ?>
      </ul>
    </nav>
    <?php endif; ?>

	<?php else : ?>

		<article id="post-0" class="post no-results not-found">
			<header class="entry-header">
				<h1 class="entry-title"><?php _e( 'Nothing Found', 'onemozilla' ); ?></h1>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'onemozilla' ); ?></p>
				<?php get_search_form(); ?>
			</div><!-- .entry-content -->
		</article><!-- #post-0 -->

	<?php endif; ?>

	</div><!-- #content-main -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>