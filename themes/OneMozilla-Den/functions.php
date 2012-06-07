<?php

function remove_onemozilla_options() {
	remove_custom_background();
}
add_action( 'after_setup_theme','remove_onemozilla_options', 100 );


wp_enqueue_script('sharewindow', get_stylesheet_directory_uri().'/js/sharewindow.js', array('jquery'));


/*********
* Generate bit.ly/mzl.la shortlinks for posts.
* Requires a bit.ly username and API key defined as constants in a 'bitly-config.php' file in the theme directory
*/

if ( file_exists( get_stylesheet_directory() . '/bitly-config.php' ) )
	require( get_stylesheet_directory() . '/bitly-config.php' );

if (defined('BITLY_USERNAME') && defined('BITLY_APIKEY')) :

  function mozShortlink() {
    global $post;
    
    $short_url = json_decode(file_get_contents('http://api.bit.ly/v3/shorten?login='.BITLY_USERNAME.'&apiKey='.BITLY_APIKEY.'&longURL='.urlencode(get_permalink($post->ID)).'&format=json'));
    
    if($short_url->status_code=="200") {
      $short_url = $short_url->data->url;
    }
    else {
      $short_url = "Bit.ly Error! ".$short_url->status_txt;
    }
  
    do_action('mozShortlink');
    return $short_url;
  }
  
  function mozShortlink_metabox() {
    if(is_admin()) {
      add_meta_box('mzllaurl',__('Short URL','short-url'),'show_mozShortlinkbox','post','side');
      add_meta_box('mzllaurl',__('Short URL','short-url'),'show_mozShortlinkbox','page','side');
    }
  }
  
  function show_mozShortlinkbox() {
    echo '<label for="mzllaurl">'.__('Shortened URL','short-url-label').': '.mozShortlink().'</label><br/><br/>';
  }

  add_filter( 'get_shortlink', 'mozShortlink', 10, 3 );
  add_action('publish_post','mozShortlink');
  add_action('publish_page','mozShortlink');
  add_action('do_meta_boxes','mozShortlink_metabox');

endif;

?>
