<?php /* Functions for the Air Mozilla child theme */

function airmozilla_remove_parent_filters() {
  remove_filter( 'get_the_excerpt', 'onemozilla_custom_excerpt_more' );
  remove_filter( 'excerpt_more', 'onemozilla_auto_excerpt_more' );
  remove_action( 'widgets_init', 'onemozilla_widgets_init' );
}
add_action('after_setup_theme', 'airmozilla_remove_parent_filters'); 

function remove_onemozilla_options() {
	remove_custom_background();
	remove_custom_image_header();
}
add_action( 'after_setup_theme','remove_onemozilla_options', 100 );


/**
 * Register our sidebars and widgetized areas.
 */
function airmozilla_widgets_init() {

	register_sidebar( array(
		'name' => __( 'Sidebar Top', 'airmoz' ),
		'description' => __( 'Appears at the top of the sidebar, before the generated content', 'airmoz' ),
		'id' => 'sidebar-top',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Sidebar Bottom', 'airmoz' ),
		'description' => __( 'Appears at the bottom of the sidebar, after the generated content', 'airmoz' ),
		'id' => 'sidebar-bottom',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

}
add_action( 'widgets_init', 'airmozilla_widgets_init' );


/**
 * Returns a "Continue Reading" link for excerpts
 */
function airmozilla_continue_reading_link() {
	return ' <a class="go" href="'. esc_url( get_permalink() ) . '">' . __( 'See more', 'airmoz' ) . '</a>';
}

/**
 * Replaces "[…]" (appended to automatically generated excerpts) with an ellipsis and onemozilla_continue_reading_link().
 *
 * To override this in a child theme, remove the filter and add your own
 * function tied to the excerpt_more filter hook.
 */
function airmozilla_auto_excerpt_more( $more ) {
	return ' &hellip;' . airmozilla_continue_reading_link();
}
add_filter( 'excerpt_more', 'airmozilla_auto_excerpt_more', 20 );

/**
 * Adds a pretty "Continue Reading" link to custom post excerpts.
 *
 * To override this link in a child theme, remove the filter and add your own
 * function tied to the get_the_excerpt filter hook.
 */
function airmozilla_custom_excerpt_more( $output ) {
	if ( has_excerpt() && ! is_attachment() ) {
		$output .= airmozilla_continue_reading_link();
	}
	return $output;
}
add_filter( 'get_the_excerpt', 'airmozilla_custom_excerpt_more', 20 );


/**
 * Make a shortcode to simplify vidly multi-format video embeds
 * [vidly code="foo"] where 'foo' is the six character vidly string (there is no default so you must provide the vidly code).
 */
function airVidly($atts) {
  extract(shortcode_atts(array('code' => '#'), $atts));
  return '
  <video controls width="100%" controls preload="none" poster="http://cf.cdn.vid.ly/'.$code.'/poster.jpg">
    <source src="http://cf.cdn.vid.ly/'.$code.'/mp4.mp4" type="video/mp4">
    <source src="http://cf.cdn.vid.ly/'.$code.'/webm.webm" type="video/webm"> 
    <source src="http://cf.cdn.vid.ly/'.$code.'/ogv.ogv" type="video/ogg">
    <a target="_blank" href="http://vid.ly/'.$code.'"><img src="http://cf.cdn.vid.ly /'.$code.'/poster.jpg" width="500" alt=""></a>
  </video>';
   
}
add_shortcode('vidly', 'airVidly');

/**
 * Make a shortcode to simplify mibbit IRC embeds
 * [mibbit channel="foo"] where 'foo' (without the #) is the IRC channel to join (defaults to airmozilla).
 */
function airMibbit($atts) {
  extract(shortcode_atts(array('channel' => 'airmozilla'), $atts));
  return '<iframe style="border:0;" width="620" height="400" scrolling="no" src="https://widget.mibbit.com/?settings=e3979a1a8759093395094aa58b582c59&amp;server=irc.mozilla.org&amp;channel=%23'.$channel.'&amp;nick=visitor%3F%3F%3F&amp;noServerNotices=true&amp;noServerMotd=true&amp;autoConnect=true&amp;customprompt=Welcome%20To%20Air%20Mozilla%20Live"></iframe>';
}
add_shortcode('mibbit', 'airMibbit');

/**
 * Make a shortcode to simplify Edgecast JWPlayer embeds
 * [edgecast file="foo"] where 'foo' is the name of the Edgecast stream (there is no default, so you must provide a stream name).
 */
function airEdgecast($atts) {
  extract(shortcode_atts(array('file' => ''), $atts));
  return '
    <div id="player"></div>
    <script> 
    jwplayer("player").setup({ 
      "flashplayer":"http://videos.mozilla.org/serv/air_mozilla/player.swf", 
      "file":"'.$file.'", 
      "provider":"rtmp", 
      "streamer":"rtmp://fml.1237.edgecastcdn.net/201237/", 
      "rtmp.subscribe":"true", 
      "controlbar":"over", 
      "playlist":"none", 
      "dock":"true", 
      "icons":"true", 
      "quality":"true", 
      "autostart":"true", 
      "image":"http://videos.mozilla.org/serv/air_mozilla/PleaseStandBy.png", 
      "width":"620", 
      "height":"350" }); 
    </script>
  
  ';
}
add_shortcode('edgecast', 'airEdgecast');

/**
 * Make a shortcode to simplify Bitgravity embeds
 * [bitgravity feed="foo"] where 'foo' is the particular stream to embed (defaults to 'multibitrate')
 */
function airBitgravity($atts) {
  extract(shortcode_atts(array('feed' => 'multibitrate'), $atts));
  return '
  <iframe src="http://mozilla.live-s.cdn.bitgravity.com:1935/content:cdn-live/mozilla/live/'.$feed.'.smil?width=620&height=390&AutoPlay=true" width="620" height="390" scrolling="no" frameborder="0" style="border:0;"></iframe>
  ';
}
add_shortcode('bitgravity', 'airBitgravity');

?>
