<?php
/**
* wp list pluck
* Pluck a certain field out of each object in a list
* @link https://codex.wordpress.org/Function_Reference/wp_list_pluck
*/
// EX.
  $foods = array(
	array(
		'id'  => 4,
		'name'  => 'Banana',
		'color' => 'Yellow',
	),
	array(
		'id'  => '5',
		'name'  => 'Apple',
		'color' => 'Red',
	),
	array(
		'id'  => 2,
		'name'  => 'Lettuce',
		'color' => 'Green',
	),
	array(
		'id'  => '7',
		'name'  => 'Apple',
		'color' => 'Red',
	),
);

// The names of each food can easily be "plucked" from the $foods array using  wp_list_pluck();
$food_names = wp_list_pluck( $foods, 'name' );

// returns 
array(
	'Banana',
	'Apple',
	'Lettuce',
	'Apple'
);

/* ------------------------------------------------------------------------------------ */

/**
* Stripping Shortcodes!
*
* There might be some cases that you need the shortcodes of the text to be omitted: You may use part of the content 
* for a "Next Post" preview, you may have switched to a new theme and don't want to display texts of shortcodes 
* that are not run anymore, and so on.
*/
function remove_shortcode_from_index( $content ) {
    if ( is_home() )
        $content = strip_shortcodes( $content );
    return $content;
}
add_filter( 'the_content', 'remove_shortcode_from_index' );

/* ------------------------------------------------------------------------------------ */

/**
* Enqueueing Inline CSS
* Ex. include a variable, inline style for your plugin or theme.
*/
$custom_style_file = get_template_directory_uri() . '/css/custom_style.css';
 
function custom_styles() {
    wp_enqueue_style( 'custom-style', $custom_style_file );
    $headline_font_weight = get_theme_mod( 'headline-font-weight' );
    $custom_style = '.headline { font-weight: ' . $headline_font_weight . '; }';
    wp_add_inline_style( 'custom-inline-style', $custom_style );
}
add_action( 'wp_enqueue_scripts', 'custom_styles' );

/* ------------------------------------------------------------------------------------ */

/**
* Splitting the Parts Before & After The More Tag
* Ex. Let's say that you're in the single.php file and you're going to display an ad between the intro and the rest of the article.
*/

while( have_posts() ) : the_post();
 
$content_parts = get_extended( get_the_content() );
 
echo '<h1 class="post-title">' . get_the_title() . '</h1>';
echo '<p class="intro">' . $content_parts['main'] . '</p>';
echo '<!-- Paste your ad code here. -->';
echo '<div class="article">' . $content_parts['extended'] . '</div>';
 
endwhile;

/* ------------------------------------------------------------------------------------ */

/**
* Use add_action with parameters
* Pass argument to the callback function inside add_action
* Use PHP anonymous functions with 'use' keyword.
*/

//EX. Callback function
function wps_theme_site_logo($class = false) {
	//... function content ...
}

// Add argument to function
$css_class = 'u-lap-and-up-hide';
add_action('wps_theme_header_left',function() use ($css_class){
     wps_theme_site_logo('u-lap-and-up-hide');
});
