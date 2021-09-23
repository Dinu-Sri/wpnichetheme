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







/**
* Get a limited part of the content - sans html tags and shortcodes - 
* according to the amount written in $limit. Make sure words aren't cut in the middle
* @param int $limit - number of characters
* @return string - the shortened content
*/
function wpshout_the_short_content($limit) {
   $content = get_the_content();
   /* sometimes there are <p> tags that separate the words, and when the tags are removed, 
   * words from adjoining paragraphs stick together.
   * so replace the end <p> tags with space, to ensure unstickinees of words */
   $content = strip_tags($content);
   $content = strip_shortcodes($content);
   $content = trim(preg_replace('/\s+/', ' ', $content));
   $ret = $content; /* if the limit is more than the length, this will be returned */
   if (mb_strlen($content) >= $limit) {
      $ret = mb_substr($content, 0, $limit);
      // make sure not to cut the words in the middle:
      // 1. first check if the substring already ends with a space
      if (mb_substr($ret, -1) !== ' ') {
         // 2. If it doesn't, find the last space before the end of the string
         $space_pos_in_substr = mb_strrpos($ret, ' ');
         // 3. then find the next space after the end of the string(using the original string)
         $space_pos_in_content = mb_strpos($content, ' ', $limit);
         // 4. now compare the distance of each space position from the limit
         if ($space_pos_in_content != false && $space_pos_in_content - $limit <= $limit - $space_pos_in_substr) {
            /* if the closest space is in the original string, take the substring from there*/
            $ret = mb_substr($content, 0, $space_pos_in_content);
         } else {
            // else take the substring from the original string, but with the earlier (space) position
            $ret = mb_substr($content, 0, $space_pos_in_substr);
         }
      }
   }
   return $ret . '...';
}

function wpshout_update_post_excerpt($new_excerpt){
  $post = array(  
    'ID' => get_the_ID(),
    'post_excerpt' => $new_excerpt,
  );
  wp_update_post($post);
}

function wpshout_excerpt( $text ) {
  if( is_admin() ) {
    return $text;
  }
  if (! has_excerpt() ) {
    $text = wpshout_the_short_content(200);
  }
  wpshout_update_post_excerpt($text);
  return $text;
}

add_filter( 'wp_trim_excerpt', 'wpshout_excerpt' );





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

