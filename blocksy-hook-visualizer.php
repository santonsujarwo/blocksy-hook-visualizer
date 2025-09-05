<?php
/**
 * Plugin Name: Blocksy Hook Visualizer
 * Description: Helper plugin to display Blocksy hook positions on the front-end for developers.
 * Author: Your Name
 * Version: 1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Only show for logged-in admins
 */
function bhv_should_display_hooks() {
    return current_user_can( 'manage_options' );
}

/**
 * Output a label for the given hook
 */
function bhv_output_hook_label( $hook_name ) {
    if ( ! bhv_should_display_hooks() ) {
        return;
    }
    echo '<div style="
        background:rgba(0,0,0,0.7);
        color:#0f0;
        font-size:12px;
        padding:2px 6px;
        margin:2px 0;
        border:1px dashed #0f0;
        z-index:9999;
    ">Hook: ' . esc_html( $hook_name ) . '</div>';
}

/**
 * Register hook points
 */
function bhv_register_blocksy_hooks() {
    $hooks = [
        // General
        'blocksy:body:top',
        'blocksy:body:bottom',

        // Header
        'blocksy:header:before',
        'blocksy:header:top',
        'blocksy:header:bottom',
        'blocksy:header:after',

        // Content
        'blocksy:content:before',
        'blocksy:content:top',
        'blocksy:content:bottom',
        'blocksy:content:after',

        // Single
        'blocksy:single:before',
        'blocksy:single:top',
        'blocksy:single:bottom',
        'blocksy:single:after',

        // Archive
        'blocksy:archive:before',
        'blocksy:archive:top',
        'blocksy:archive:bottom',
        'blocksy:archive:after',

        // Sidebar
        'blocksy:sidebar:top',
        'blocksy:sidebar:bottom',

        // Footer
        'blocksy:footer:before',
        'blocksy:footer:top',
        'blocksy:footer:bottom',
        'blocksy:footer:after',

        // WooCommerce
        'blocksy:woocommerce:before',
        'blocksy:woocommerce:after',
        'blocksy:product:before',
        'blocksy:product:after',
    ];

    foreach ( $hooks as $hook ) {
        add_action( $hook, function() use ( $hook ) {
            bhv_output_hook_label( $hook );
        });
    }
}
add_action( 'init', 'bhv_register_blocksy_hooks' );
