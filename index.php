<?php

/**
 * Plugin Name: Prime Wrestling 
 * Description: This contains the custom functionality for the Prime Wrestling Marketing and Ecommerce Site
 * .
 * Version:     1.0.0
 * Author:      Ingenuity Software Labs
 */

// Plugin directory


if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}
define('PWS_PLUGIN_DIR', plugin_dir_path(__FILE__));

// Plugin Locale
define('PWS_PLUGIN_LOCALE', 'prime-plugin');

use Carbon_Fields\Container;
use Carbon_Fields\Field;

add_action('after_setup_theme', 'crb_load');

function crb_load()
{
    require_once('vendor/autoload.php');
    \Carbon_Fields\Carbon_Fields::boot();
}




/*
 * CUSTOM POST TYPES
 */
// Add "Technique" custom post type
function create_techniques_cpt()
{
    $labels = array(
        'name' => __('Techniques'),
        'singular_name' => __('Technique')
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'rewrite' => array('slug' => 'techniques'),
        'label' => __('Techniques', 'text_domain'),
        'description' => __('Techniques', 'text_domain'),
        'supports' => array('title', 'editor', 'excerpt', 'publicize', 'thumbnail', 'trackbacks', 'revisions', 'custom-fields', 'page-attributes',),
        'taxonomies' => array('file-under', 'category', 'series'),
        'hierarchical' => false,
        'menu_position' => 7,
        'menu_icon' => 'dashicons-book',
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'page',
        'show_in_rest' => true,
    );
    register_post_type('techniques', $args);
}
add_action('init', 'create_techniques_cpt');


// Add "Camp" custom post type
function create_camps_cpt()
{
    $labels = array(
        'name' => __('Camps'),
        'singular_name' => __('Camp')
    );
    $args = array(
        'labels' => $labels,
        'public' => true,
        'has_archive' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'rewrite' => array('slug' => 'camps'),
        'label' => __('Camps', 'text_domain'),
        'description' => __('Camps', 'text_domain'),
        'supports' => array('title', 'editor', 'excerpt', 'publicize', 'thumbnail', 'trackbacks', 'revisions', 'custom-fields', 'page-attributes',),
        'taxonomies' => array('category', 'type'),
        'hierarchical' => false,
        'menu_position' => 8,
        'menu_icon' => 'dashicons-universal-access',
        'show_in_admin_bar' => true,
        'show_in_nav_menus' => true,
        'can_export' => true,
        'exclude_from_search' => false,
        'publicly_queryable' => true,
        'capability_type' => 'page',
        'show_in_rest' => true,
    );
    register_post_type('Camps', $args);
}
add_action('init', 'create_Camps_cpt');

add_action('carbon_fields_register_fields', 'crb_attach_technique_meta');
function crb_attach_technique_meta()
{
    Container::make('post_meta', __('Technique Meta'))
    ->where('post_type', '=', 'shop_order')
    ->add_fields(
        array(
        
            Field::make('text', 'subtotal', __('Subtotal')),
            Field::make('text', 'total', __('Total')),
        )
    );
}
