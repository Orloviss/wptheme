<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * Удаляем лишние виджеты на дашборде.
 */
function wptheme_cleanup_dashboard() {
 	remove_action('welcome_panel', 'wp_welcome_panel');

	remove_meta_box('dashboard_activity', 'dashboard', 'normal');        // Активность
	remove_meta_box('dashboard_primary', 'dashboard', 'side');           // Новости WordPress
}
add_action( 'wp_dashboard_setup', 'wptheme_cleanup_dashboard', 100 );
