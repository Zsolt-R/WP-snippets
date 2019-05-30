<?php
/**
* @url https://github.com/WordPress/WordPress/blob/master/wp-includes/blocks.php
* @url https://developer.wordpress.org/reference/hooks/render_block_data/
*/
function conditional_youtube_stream_js_render(){   
    $content = get_post_field('post_content', get_the_ID());  
    
    // Check if a specific block type is used in the content area
    if ( has_block( 'wps-blocks/wrapper-block' ) ) {
         
        // Get blocks array
        $blocks = parse_blocks( $content );        
        
        foreach ( $blocks as $block ) {
            $source_block = $block;
            
            // Get the block data
            $block = apply_filters( 'render_block_data', $block, $source_block );
            
            // Check for the target block-type
            if($block['blockName'] === 'wps-blocks/wrapper-block'){
            
                // Check if the block has a particular setting
                if( isset($block['attrs']['streamVideoUrl']) ){
                    wp_enqueue_script('wps_vc_video_bg');
                }
            } 
        }
    }
}
add_action( 'wp_enqueue_scripts', 'conditional_youtube_stream_js_render' );
