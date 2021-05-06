<?php
/**
 * Plugin Name:       Post Edit block
 * Description:       Post edit block to allow direct editing of the post
 * Requires at least: 5.7
 * Requires PHP:      7.0
 * Version:           0.0.0
 * Author:            bobbingwide
 * License:           GPLv3
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       sb-post-edit-block
 *
 * @package           oik-sb
 */

/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/block-editor/tutorials/block-tutorial/writing-your-first-block-type/
 */
function oik_sb_sb_post_edit_block_block_init() {
	register_block_type_from_metadata( __DIR__ );
}
add_action( 'init', 'oik_sb_sb_post_edit_block_block_init' );
