<nav class="nav-global">
    <div class="content">
		<span class="mozilla-logo">
		  <a href="https://www.mozilla.org/">Mozilla</a>
		</span>
		<?php wp_nav_menu( array( 'theme_location' => 'top', 'container' => 'nav', 'container_id' => 'nav-top', 'fallback_cb' => 'false', ) ); ?>
	</div>
</nav>
<header id="masthead" <?php if (get_header_image()) : ?>class="image"<?php endif; ?>>
    <hgroup>
        <div class="wrap">
            <?php if ( (is_front_page()) && ($paged < 1) ) : ?>
              <h1 id="site-title"><span><?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?></span></h1>
            <?php else : ?>
              <h1 id="site-title"><span><a href="<?php echo esc_url( home_url('/') ); ?>" rel="home" title="<?php _e('Go to the front page', 'onemozilla'); ?>"><?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?></a></span></h1>
            <?php endif; ?>
            <?php if (get_bloginfo('description','display')) : ?>
              <h2 id="site-description"><span><?php echo esc_attr( get_bloginfo('description', 'display') ); ?></span></h2>
            <?php endif; ?>
        </div>
    </hgroup>
</header><!-- #masthead -->
