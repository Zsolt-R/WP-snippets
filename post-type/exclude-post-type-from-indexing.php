<?php
/**
*	 Exclude post type from indexing
**/
function seo_nofollow_pty(){
    $nofollow = '';
    $post_type = get_post_type();
    $exclude_array = array('testimonial');

    if(is_single() && in_array($post_type,$exclude_array)){
        $nofollow = '<meta name="robots" content="noindex,nofollow">';
    }

   echo $nofollow;
}
add_action('wp_head','seo_nofollow_pty');