<?php

function remove_onemozilla_theme_options() {
 remove_submenu_page('themes.php', 'theme_options');
}
add_action('admin_init', 'remove_onemozilla_theme_options', 11);

function remove_onemozilla_options() {
	remove_custom_background();
}
add_action('after_setup_theme','remove_onemozilla_options', 100);

function mozweb_remove_parent_filters() {
  remove_filter('mce_css', 'fc_editor_style');
}
add_action('after_setup_theme', 'mozweb_remove_parent_filters'); 


function child_theme_class($class) {
  $class[] = 'webdev';
  return $class;
}
add_filter('body_class', 'child_theme_class');

/*********
* Style the visual editor to match the theme styles
*/
function mozweb_editor_style($url) {
  if ( !empty($url) ) {
    $url .= ',';
  }
  $url .= trailingslashit( get_stylesheet_directory_uri() ) . 'mozweb-editor-style.css';
  return $url;
}
add_filter('mce_css', 'mozweb_editor_style');

/*********
* Adds "Twitter" and "Github" fields to the user profile form
*/
function additional_contactmethods($user_contactmethods) {
  $user_contactmethods['twitter'] = 'Twitter Username';
  $user_contactmethods['github'] = 'Github Username';
  return $user_contactmethods;
}
add_filter('user_contactmethods', 'additional_contactmethods');

/*********
* Shows Twitter, Github, and Website links for authors
*/
function dw_get_author_meta($authorID = null) {
  $twitterHandle = get_the_author_meta('twitter', $authorID);
  $githubUser = get_the_author_meta('github', $authorID);
  $website = get_the_author_meta('url', $authorID);

  if($website || $githubUser || $twitterHandle):
    echo '<ul class="author-links">';
    if($website):
      echo '<li><a href="', $website, '" class="website" rel="me">', str_replace('http://', '', $website), '</a></li>';
    endif;
    if($twitterHandle):
      echo '<li><a href="//twitter.com/', $twitterHandle, '" class="twitter" rel="me">@', $twitterHandle, '</a></li>';
    endif;
    if($githubUser):
      echo '<li><a href="//github.com/', $githubUser, '" class="github" rel="me">Github</a></li>';
    endif;
    echo '</ul>';
  endif;
}

/*********
* Returns author listing HTML
* Only lists authors who have published posts
*/
function dw_list_authors() {
  global $wpdb;

  $users = get_users(array());

  // Do a custom query to get post counts for everyone
  // This will save hundreds of queries over "WordPress-style" code
  $postsByUsersQuery = 'SELECT post_author, COUNT(*) as count FROM '.$wpdb->posts.' p WHERE post_type="post" AND post_status="publish" GROUP BY post_author';
  $postsByUsersResult = $wpdb->get_results($postsByUsersQuery, ARRAY_A);
  $postsByUsersIndex = array();
  foreach($postsByUsersResult as $result) {
    $postsByUsersIndex[$result['post_author']] = array('count'=>$result['count']);
  }

  // Sort by number of posts
  foreach($users as $user) {
    $count = $postsByUsersIndex[$user->ID]['count'];
    if($count == '') { $count = 0; }
    $user->total_posts = $count;
  }
  usort($users, 'sort_objects_by_property');
  $users = array_reverse($users);

  $author_list = array();

  // Generate output for authors
  foreach($users as $index=>$user) {
    if($user->total_posts > 0) {
      $item = '<li class="vcard">';
      $item.= '<h3><a class="url" href="'.get_author_posts_url($user->ID).'">';
      if (function_exists('get_avatar')) {
        $item.= get_avatar($user->user_email, 48);
      }
      $item.= '<cite class="fn">'.$user->display_name.'</cite> <b class="post-count">'.$user->total_posts.' post'.($user->total_posts > 1 ? 's' : '').'</b></a></h3>';
      if ($user->description) {
        $item.= '<p class="desc">'.$user->description.'</p>';
      }
      $item.= '</li>';

      array_push($author_list, $item);

    }
  }

  $return = '<ul class="author-list">'.implode('', $author_list).'</ul>';

  return $return;
}

/*********
* Sorts WordPress users by Object key (total posts)
*/
function sort_objects_by_property($a, $b) {
  if($a->total_posts == $b->total_posts){ return 0 ; }
  return ($a->total_posts < $b->total_posts) ? -1 : 1;
}

/*********
* Custom colors for WP-Syntax
*/
function fc_custom_geshi_styles(&$geshi) {
  $geshi->enable_classes();
  $geshi->enable_keyword_links(true);
  return true;
}
add_action('wp_syntax_init_geshi', 'fc_custom_geshi_styles');


?>
