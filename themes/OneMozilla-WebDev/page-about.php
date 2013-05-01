<?php get_header(); ?>

    <div id="content-main" class="main" role="main">
      <?php while ( have_posts() ) : the_post(); ?>
        <?php get_template_part( 'content', 'page' ); ?>
      <?php endwhile; // end of the loop. ?>
      
      <!-- List authors -->
      <section class="about-authors">
        <h2><?php _e('Authors','mozwebdev') ?></h2>
        <?php echo dw_list_authors(); ?>
      </section>

    </div><!-- #content-main -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
