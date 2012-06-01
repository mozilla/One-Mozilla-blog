<?php

function presscenter_remove_parent_filters() {
  remove_filter( 'get_the_excerpt', 'onemozilla_custom_excerpt_more' );
  remove_filter( 'excerpt_more', 'onemozilla_auto_excerpt_more' );
}
add_action('after_setup_theme', 'presscenter_remove_parent_filters'); 


/*********
* Set up At a Glance post type
*/ 
function create_type_glance() {
	register_post_type( 'ataglance',
		array(
			'labels' => array(
				'name' => __('At a Glance'),
				'singular_name' => __('At a Glance Item'),
				'add_new' => __('Add New'),
		    'add_new_item' => __('Add New At a Glance Item'),
		    'edit_item' => __('Edit Item'),
		    'view_item' => __('View Item'),
    		'search_items' => __('Search At a Glance Items'),
		    'not_found' =>  __('Nothing found'),
		    'not_found_in_trash' => __('Nothing found in Trash'),
		    'parent_item_colon' => ''
			),
		'public' => true,
		'has_archive' => true,
		'rewrite' => array('slug' => 'ataglance'),
		'publicly_queryable' => true,
		'show_ui' => true,
		'menu_position' => 5,
		'show_in_nav_menus' => false,
		'capability_type' => 'post',
		'hierarchical' => false,
		'supports' => array('title','revisions','editor','page-attributes')
		)
	);
}
add_action( 'init', 'create_type_glance' );


/*********
* Set up speaker bio post type
*/ 
function create_type_bios() {
	register_post_type( 'bios',
		array(
			'labels' => array(
				'name' => __('Speaker Bios'),
				'singular_name' => __('Bio'),
				'add_new' => __('Add New'),
		    'add_new_item' => __('Add New Speaker Bio'),
		    'edit_item' => __('Edit Bio'),
		    'view_item' => __('View Bio'),
    		'search_items' => __('Search Bios'),
		    'not_found' =>  __('Nothing found'),
		    'not_found_in_trash' => __('Nothing found in Trash'),
		    'parent_item_colon' => ''
			),
		'public' => true,
		'has_archive' => true,
		'rewrite' => array('slug' => 'bios'),
		'publicly_queryable' => true,
		'show_ui' => true,
		'menu_position' => 5,
		'show_in_nav_menus' => false,
		'capability_type' => 'post',
		'hierarchical' => false,
		'supports' => array('title','thumbnail','revisions','editor','custom-fields','page-attributes')
		)
	);
}
add_action( 'init', 'create_type_bios' );


/*********
* Add custom fields to bio posts
*/
function bio_position(){
  global $post;
  $custom = get_post_custom($post->ID);
  $bio_position = $custom["bio_position"][0];
  ?>
  <p class="moz-field">
    <label><?php _e('Title/Position', 'mozpress'); ?></label>
    <input type="text" id="bio_position" name="bio_position" value="<?php echo $bio_position; ?>" />
  </p>
  <?php
}

function bio_elsewhere(){
  global $post;
  $custom = get_post_custom($post->ID);
  $bio_blog_name = $custom["bio_blog_name"][0];
  $bio_blog_url = $custom["bio_blog_url"][0];
  $bio_twitter = $custom["bio_twitter"][0];
  ?>
  <ul>
    <li class="moz-field">
      <label><?php _e('Blog Name', 'mozpress'); ?></label>
      <input type="text" id="bio_blog_name" name="bio_blog_name" value="<?php echo esc_attr($bio_blog_name); ?>" />
    </li>
    <li class="moz-field">
      <label><?php _e('Blog URL', 'mozpress'); ?> <i>(<?php _e('full URL, including "http://"', 'mozpress'); ?>)</i></label>
      <input type="url" id="bio_blog_url" name="bio_blog_url" value="<?php echo esc_attr($bio_blog_url); ?>" />
    </li>
    <li class="moz-field">
      <label><?php _e('Twitter Name', 'mozpress'); ?></label>
      @<input type="text" id="bio_twitter" name="bio_twitter" value="<?php echo esc_attr($bio_twitter); ?>" />
    </li>
  </ul>
  <?php
}

function admin_init_bios(){
  add_meta_box("bio_position", "Position", "bio_position", "bios", "normal", "high");
  add_meta_box("bio_blog", "Elsewhere", "bio_elsewhere", "bios", "normal", "high");
}
add_action("admin_init", "admin_init_bios");
 
function save_bio_details(){
  global $post;
  update_post_meta($post->ID, "bio_position", $_POST["bio_position"]);
  update_post_meta($post->ID, "bio_blog_name", $_POST["bio_blog_name"]);
  update_post_meta($post->ID, "bio_blog_url", $_POST["bio_blog_url"]);
  update_post_meta($post->ID, "bio_twitter", $_POST["bio_twitter"]);
}
add_action('save_post', 'save_bio_details'); 


/*********
* Add position column to bio listing
*/
function bios_edit_columns($columns){
  $columns = array(
    "cb" => "<input type=\"checkbox\" />",
    "title" => "Speaker Bio",
    "bio_position" => "Position",
  ); 
  return $columns;
}
function bios_custom_columns($column){
  global $post;
  switch ($column) {
    case "bio_position":
      $custom = get_post_custom();
      echo $custom["bio_position"][0];
      break;
  }
}
add_action("manage_posts_custom_column",  "bios_custom_columns");
add_filter("manage_edit-bio_columns", "bios_edit_columns");

/*********
 * Create a special role for Translators
 */
$trancando = array(
  'read' =>  true, 
  'edit_posts' => true,
  'edit_pages' => true,
  'edit_published_posts' => true,
  'edit_published_pages' => true,
  'edit_others_posts' => true,
  'edit_others_pages' => true,
  'upload_files' => true
);

remove_role('translator'); // remove it first to prevent duplicates, then add
add_role( 'translator', 'Translator', $trancando );


/*********
* Register menu locations
*/
if ( function_exists('register_nav_menus') ) :
  register_nav_menus( array(
  	'nav_press_center' => 'Press Center Nav',
  	'connect' => 'Connect With Us',
  	'media_tabs' => 'Media Library Tabs'
  ) );
endif;

?>
