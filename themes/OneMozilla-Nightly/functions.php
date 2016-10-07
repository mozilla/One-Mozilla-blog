<?php

function remove_onemozilla_theme_options() {
  remove_submenu_page('themes.php', 'theme_options');
}
add_action('admin_init', 'remove_onemozilla_theme_options', 11);

function remove_onemozilla_options() {
  remove_theme_support('custom-background');
}
add_action('after_setup_theme','remove_onemozilla_options', 100);

function child_theme_class($class) {
  $class[] = 'nightly';
  return $class;
}
add_filter('body_class', 'child_theme_class');
