<?php
/**
 * Module Name: BlockEditor
 * Description: BlockEditor application
 * Namespace: BlockEditor
 *
 * @package vanilla-block-editor
 */

declare(strict_types=1);

namespace VanillaBlockEditor\BlockEditor;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Enqueue
 *
 * @since  1.0.0
 * @return void
 */
function enqueue() {
	$module_dir_path = module_dir_path( __FILE__ );
	$module_dir_url  = module_dir_url( __FILE__ );

	$dependencies = require $module_dir_path . 'js/build/index.asset.php';
	$dependencies = $dependencies['dependencies'];

	wp_enqueue_style( 'wp-components' );
	wp_enqueue_style( 'wp-edit-post' );
	wp_enqueue_media();

	// Include the frontend component so it can render inside Gutenberg.
	$js_url = $module_dir_url . 'js/build/index.js';
	$js_ver = filemtime( $module_dir_path . 'js/build/index.js' );
	wp_enqueue_script( 'blockeditorjs', $js_url, $dependencies, $js_ver, true );

	// Dequeue theme styles
	wp_dequeue_style( get_stylesheet() . '-style' );

}
add_action( 'init', __NAMESPACE__ . '\enqueue' );

function render_app_container() {
	echo '<div style="position:absolute; top:0; left: 0; width: 100vw; height: 100vh; z-index:99999; background-color: #fff" id="blockeditorapp"></div>';
}
add_action( 'wp_footer', __NAMESPACE__ . '\render_app_container' );
