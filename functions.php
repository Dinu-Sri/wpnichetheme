<?php function simple_theme_setup(){
	// Featured Image Support
	add_theme_support('post-thumbnails');
	
	//Menus
    register_nav_menus(array('primary' => __('Primary Menu')));
}


add_action('after_setup_theme', 'simple_theme_setup');

	// Excerpt Length
	function set_excerpt_length(){
		return 25;
}

add_filter('excerpt_length', 'set_excerpt_length');

//Widget Locations
      function init_widgets($id){
          register_sidebar(array(
              'name' => 'Sidebar',
              'id' => 'sidebar',
              'before_widget' => '<div class="side-widget">',
              'after_widget' => '</div>',
              'before_title' => '<h3>',
              'after_title' => '</h3>'
          ));
      }

      add_action('widgets_init', 'init_widgets');





//Remove all emoji in WP..................

      function disable_emoji_feature() {
  
  // Prevent Emoji from loading on the front-end
  remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
  remove_action( 'wp_print_styles', 'print_emoji_styles' );

  // Remove from admin area also
  remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
  remove_action( 'admin_print_styles', 'print_emoji_styles' );

  // Remove from RSS feeds also
  remove_filter( 'the_content_feed', 'wp_staticize_emoji');
  remove_filter( 'comment_text_rss', 'wp_staticize_emoji');

  // Remove from Embeds
  remove_filter( 'embed_head', 'print_emoji_detection_script' );

  // Remove from emails
  remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );

  // Disable from TinyMCE editor. Currently disabled in block editor by default
  add_filter( 'tiny_mce_plugins', 'disable_emojis_tinymce' );

  /** Finally, prevent character conversion too
         ** without this, emojis still work 
         ** if it is available on the user's device
   */

  add_filter( 'option_use_smilies', '__return_false' );

}

function disable_emojis_tinymce( $plugins ) {
  if( is_array($plugins) ) {
    $plugins = array_diff( $plugins, array( 'wpemoji' ) );
  }
  return $plugins;
}

add_action('init', 'disable_emoji_feature');

add_filter( 'option_use_smilies', '__return_false' );

//Remove all emoji in WP..................

