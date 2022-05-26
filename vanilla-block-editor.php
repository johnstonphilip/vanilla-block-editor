<?php
/**
 * Plugin Name: Vanilla Block Editor
 * Plugin URI: philjohnston.ca
 * Description: A proof of concept for a minimal block editor on the frontend of a WordPress site.
 * Version: 1.0.0
 * Author: 
 * Author URI: 
 * Text Domain: vanilla-block-editor
 * Domain Path: languages
 * License: GPLv2 or later
 * License URI: 
 * Requires at least: 5.8
 * Requires PHP: 7.2
 * Network: 
 * Update URI: 
 * Namespace: VanillaBlockEditor
 *
 * @package vanilla-block-editor
 */

namespace VanillaBlockEditor;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Automatically include wp modules, which sit in the "wp-modules" directory.
 *
 * @return void
 */
function include_custom_modules() {
	$wp_modules = glob( plugin_dir_path( __FILE__ ) . 'wp-modules*/*' );

	foreach ( $wp_modules as $wp_module ) {
		$module_name = basename( $wp_module );
		$filename    = $module_name . '.php';
		$filepath    = $wp_module . '/' . $filename;

		if ( is_readable( $filepath ) ) {
			// If the module data exists, load it.
			require $filepath;
		} else {
			// Translators: The name of the module, and the filename that needs to exist inside that module.
			echo esc_html( sprintf( __( 'The module called "%1$s" has a problem. It needs a file called "%2$s" to exist in its root directory.', 'wpps' ), $module_name, $filename ) );
			exit;
		}
	}
}
add_action( 'plugins_loaded', __NAMESPACE__ . '\include_custom_modules' );
