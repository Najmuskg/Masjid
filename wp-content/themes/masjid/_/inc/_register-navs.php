<?php

/**
	 * Registers navigation menus for use with wp_nav_menu function
	 * @link http://codex.wordpress.org/Function_Reference/register_nav_menus
	 */
	function wd_register_menus() {
		register_nav_menus(
			array(
				'primary' => __( 'Primary Menu (Mobile)' ),
				'mega_menu' => __( 'Mega Menu' ),
				'footer_menu' => __( 'Footer Menu' ),
				// etc.

			)
		);
	}
	add_action( 'init', 'wd_register_menus' );

?>
