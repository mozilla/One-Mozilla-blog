
	</div><!-- #content -->
</div></div><!-- /.wrap /#page -->

<footer id="site-info" role="contentinfo">
  <div class="wrap">
    <p id="foot-logo">
      <a class="top" href="#page"><?php _e('Return to top', 'onemozilla'); ?></a>
      <a class="logo" href="http://mozilla.org" rel="external">Mozilla</a>
    </p>
    
    <p id="colophon">
      <?php printf(__('Except where otherwise <a href="%1s" rel="external">noted</a>, content on this site is licensed under the <a href="%2s" rel="external license">Creative Commons Attribution Share-Alike License v3.0</a> or any later version.', 'onemozilla'), esc_attr('http://www.mozilla.org/en-US/about/legal.html#site'), esc_attr('http://creativecommons.org/licenses/by-sa/3.0/') ); ?>
    </p>
    
    <nav id="nav-meta">
      <ul role="navigation">
        <li><a href="http://www.mozilla.org/contact/" rel="external"><?php _e('Contact Us', 'onemozilla'); ?></a></li>
        <li><a href="http://www.mozilla.org/en-US/privacy" rel="external"><?php _e('Privacy Policy', 'onemozilla'); ?></a></li>
        <li><a href="http://www.mozilla.org/<?php echo get_bloginfo('language')?>/about/legal.html" rel="external"><?php _e('Legal Notices', 'onemozilla'); ?></a></li>
        <li><a href="http://www.mozilla.org/<?php echo get_bloginfo('language')?>/legal/fraud-report/index.html" rel="external"><?php _e('Report Trademark Abuse', 'onemozilla'); ?></a></li> 
      </ul>
    </nav>
  </div>
</footer>

<script src="//www.mozilla.org/tabzilla/media/js/tabzilla.js"></script>

<?php if ( is_singular() && get_option('require_name_email') ) : ?>
<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/fc-checkcomment.js"></script>
<script type="text/javascript">jQuery("#comment-form").submit(function() { return fc_checkform(<?php if ($req) : echo "'req'"; endif; ?>); });</script>
<?php endif; ?>


<?php wp_footer(); ?>

</body>
</html>
