	<header id="masthead" role="banner">
		<hgroup>
    <?php if ( (is_front_page()) && ($paged < 1) ) : ?>
      <h1 id="site-title" class="home"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo-airmo-lg.png" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"></h1>
    <?php else : ?>
      <h1 id="site-title"><a href="<?php echo esc_url( home_url('/') ); ?>" rel="home" title="<?php _e('Go to the front page', 'onemozilla'); ?>"><img src="<?php echo get_stylesheet_directory_uri(); ?>/img/logo-airmo-md.png" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>"></a></h1>
    <?php endif; ?>
		</hgroup>
	  <a href="http://www.mozilla.org/" id="tabzilla">Mozilla</a>
	</header><!-- #masthead -->
