<?php
/**
 * Plugin Name:       Post Edit block
 * Description:       Post edit block to allow direct editing of the post
 * Requires at least: 5.7
 * Requires PHP:      7.3
 * Version:           0.1.0
 * Author:            bobbingwide
 * License:           GPLv3
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       sb-post-edit-block
 *
 * @package           sb-post-edit-block
 */

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/block-editor/tutorials/block-tutorial/writing-your-first-block-type/
 */
function oik_sb_sb_post_edit_block_block_init() {
	$args = [ 'render_callback' => 'oik_sb_sb_post_edit_block_dynamic_block'];
	$registered = register_block_type_from_metadata( __DIR__, $args );
	//echo __DIR__. "?$registered?";
}

function oik_sb_sb_post_edit_block_loaded() {
	add_action( 'init', 'oik_sb_sb_post_edit_block_block_init' );
}
/**
 * Implements the Post Edit block.
 *
 * If the user is authorised return a post edit link for the current post.
 *
 * @param array $attributes Block attributes
 * @return string
 */
function oik_sb_sb_post_edit_block_dynamic_block( $attributes ) {
	//bw_trace2();
	$html='';
	$url = get_edit_post_link();
	if ( !$url ) {
		// Workaround for Gutenberg issue #33401
		$html = '<span></span>';
		return $html;
	}
	//	$class='bw_edit';
	$text = empty( $attributes['label']) ? __( '(Edit)', 'sb-post-edit-block' ) : $attributes['label'];
	//	$link ='<a class="' . esc_attr( $class ) . '" href="' . esc_url( $url ) . '">' . $text . '</a>';
	//}

	$align_class_name   = empty( $attributes['textAlign'] ) ? '' : "has-text-align-{$attributes['textAlign']}";

	$extra_attributes = [ 'class' => $align_class_name ];
	$wrapper_attributes = get_block_wrapper_attributes( $extra_attributes );
	$extra_attributes['href'] = esc_url( $url );
	$link_wrapper_attributes = get_block_wrapper_attributes( $extra_attributes );

	$html = sprintf(
		'<div %1$s><a %2$s>%3$s</a></div>',
		$wrapper_attributes,
		$link_wrapper_attributes,
		$text

	);
	return $html;
}

oik_sb_sb_post_edit_block_loaded();
