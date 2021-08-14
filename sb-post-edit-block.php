<?php
/**
 * Plugin Name:       Post Edit block
 * Description:       Post edit block to allow direct editing of the post
 * Requires at least: 5.7
 * Requires PHP:      7.3
 * Version:           0.2.0
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
	oik_sb_sb_post_edit_block_load_plugin_textdomain();
	$args = [ 'render_callback' => 'oik_sb_sb_post_edit_block_dynamic_block'];
	$registered = register_block_type_from_metadata( __DIR__, $args );
	//bw_trace2( $registered, "registered" );
	/*
	 * Localise the script by loading the required strings for the build/index.js file
	 * from the locale specific .json file in the languages folder
	 */
	$ok = wp_set_script_translations( 'oik-sb-sb-post-edit-block-editor-script', 'sb-post-edit-block' , __DIR__ .'/languages' );
	//echo "?$ok?";

	//add_filter( 'load_script_textdomain_relative_path', 'oik_load_script_textdomain_relative_path', 10, 2);

}

function oik_sb_sb_post_edit_block_loaded() {
	add_action( 'init', 'oik_sb_sb_post_edit_block_block_init' );
}

function oik_sb_sb_post_edit_block_load_plugin_textdomain( $domain="sb-post-edit-block" ) {
	$languages_dir =  "$domain/languages";
	bw_trace2( $languages_dir, "languages dir" );
	$loaded = load_plugin_textdomain( $domain, false, $languages_dir );
	return $loaded;
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
	$html='';
	$url = get_edit_post_link();
	if ( !$url ) {
		// Workaround for Gutenberg issue #33401
		$html = '<span></span>';
		return $html;
	}
	$text = empty( $attributes['label']) ? __( '(Edit)', 'sb-post-edit-block' ) : $attributes['label'];


	$align_class_name   = empty( $attributes['textAlign'] ) ? '' : "has-text-align-{$attributes['textAlign']}";

	$extra_attributes = [ 'class' => $align_class_name ];
	$wrapper_attributes = get_block_wrapper_attributes( $extra_attributes );
	$link_wrapper_attributes = 'href=' . esc_url( $url );
	$html = sprintf(
		'<div %1$s><a %2$s>%3$s</a></div>',
		$wrapper_attributes,
		$link_wrapper_attributes,
		$text

	);
	return $html;
}

oik_sb_sb_post_edit_block_loaded();
