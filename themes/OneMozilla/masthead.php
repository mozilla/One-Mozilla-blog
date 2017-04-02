  <header id="masthead" <?php if (get_header_image()) : ?>class="image"<?php endif; ?>>
    <hgroup>
    <?php if ( has_nav_menu( 'mobile' ) ) : ?>
      <span id="nav-mobile-toggle"></span>
      <?php wp_nav_menu( array( 'theme_location' => 'mobile', 'container' => 'nav', 'container_id' => 'nav-mobile', 'fallback_cb' => 'false', ) ); ?>
    <?php endif; ?>
    <?php if ( (is_front_page()) && ($paged < 1) ) : ?>
      <h1 id="site-title"><?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?></h1>
    <?php else : ?>
      <h1 id="site-title"><a href="<?php echo esc_url( home_url('/') ); ?>" rel="home" title="<?php _e('Go to the front page', 'onemozilla'); ?>"><?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?></a></h1>
    <?php endif; ?>
    <?php if (get_bloginfo('description','display')) : ?>
      <h2 id="site-description"><?php echo esc_attr( get_bloginfo('description', 'display') ); ?></h2>
    <?php endif; ?>
    </hgroup>

    <span id="tabzilla">
      <a href="https://www.mozilla.org/">Mozilla</a>
    </span>

    <?php wp_nav_menu( array( 'theme_location' => 'top', 'container' => 'nav', 'container_id' => 'nav-top', 'fallback_cb' => 'false', ) ); ?>

  </header><!-- #masthead -->
