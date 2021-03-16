<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}

define( 'MYTHEME_VERSION', '2.3.1' );

if ( ! isset( $content_width ) ) {
	$content_width = 800; 
}

if ( ! function_exists( 'mytheme_setup' ) ) {
	
	function mytheme_setup() {
		$hook_result = apply_filters_deprecated( 'mytheme_hello_theme_load_textdomain', [ true ], '2.0', 'mytheme_load_textdomain' );
		if ( apply_filters( 'mytheme_load_textdomain', $hook_result ) ) {
			load_theme_textdomain( 'hello-mytheme', get_template_directory() . '/languages' );
		}

		$hook_result = apply_filters_deprecated( 'mytheme_hello_theme_register_menus', [ true ], '2.0', 'mytheme_register_menus' );
		if ( apply_filters( 'mytheme_register_menus', $hook_result ) ) {
			register_nav_menus( array( 'menu-1' => __( 'Primary', 'hello-mytheme' ) ) );
		}

		$hook_result = apply_filters_deprecated( 'mytheme_hello_theme_add_theme_support', [ true ], '2.0', 'mytheme_add_theme_support' );
		if ( apply_filters( 'mytheme_add_theme_support', $hook_result ) ) {
			add_theme_support( 'post-thumbnails' );
			add_theme_support( 'automatic-feed-links' );
			add_theme_support( 'title-tag' );
			add_theme_support(
				'html5',
				array(
					'search-form',
					'comment-form',
					'comment-list',
					'gallery',
					'caption',
				)
			);
			add_theme_support(
				'custom-logo',
				array(
					'height'      => 100,
					'width'       => 350,
					'flex-height' => true,
					'flex-width'  => true,
				)
			);

			
			add_editor_style( 'editor-style.css' );
			add_theme_support( 'align-wide' );
			$hook_result = apply_filters_deprecated( 'mytheme_hello_theme_add_woocommerce_support', [ true ], '2.0', 'mytheme_add_woocommerce_support' );
			if ( apply_filters( 'mytheme_add_woocommerce_support', $hook_result ) ) {
				// WooCommerce in general.
				add_theme_support( 'woocommerce' );
				// Enabling WooCommerce product gallery features (are off by default since WC 3.0.0).
				// zoom.
				add_theme_support( 'wc-product-gallery-zoom' );
				// lightbox.
				add_theme_support( 'wc-product-gallery-lightbox' );
				// swipe.
				add_theme_support( 'wc-product-gallery-slider' );
			}
		}
	}
}
add_action( 'after_setup_theme', 'mytheme_setup' );

if ( ! function_exists( 'mytheme_scripts_styles' ) ) {
		function mytheme_scripts_styles() {
		$enqueue_basic_style = apply_filters_deprecated( 'mytheme_hello_theme_enqueue_style', [ true ], '2.0', 'mytheme_enqueue_style' );
		$min_suffix          = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';

		if ( apply_filters( 'mytheme_enqueue_style', $enqueue_basic_style ) ) {
			wp_enqueue_style(
				'hello-mytheme',
				get_template_directory_uri() . '/style' . $min_suffix . '.css',
				[],
				MYTHEME_VERSION
			);
		}

		if ( apply_filters( 'mytheme_enqueue_theme_style', true ) ) {
			wp_enqueue_style(
				'hello-mytheme-theme-style',
				get_template_directory_uri() . '/theme' . $min_suffix . '.css',
				[],
				MYTHEME_VERSION
			);
		}
	}
}
add_action( 'wp_enqueue_scripts', 'mytheme_scripts_styles' );

if ( ! function_exists( 'mytheme_register_mytheme_locations' ) ) {

	function mytheme_register_mytheme_locations( $mytheme_theme_manager ) {
		$hook_result = apply_filters_deprecated( 'mytheme_hello_theme_register_mytheme_locations', [ true ], '2.0', 'mytheme_register_mytheme_locations' );
		if ( apply_filters( 'mytheme_register_mytheme_locations', $hook_result ) ) {
			$mytheme_theme_manager->register_all_core_location();
		}
	}
}
add_action( 'mytheme/theme/register_locations', 'mytheme_register_mytheme_locations' );

if ( ! function_exists( 'mytheme_content_width' ) ) {

	function mytheme_content_width() {
		$GLOBALS['content_width'] = apply_filters( 'mytheme_content_width', 800 );
	}
}
add_action( 'after_setup_theme', 'mytheme_content_width', 0 );

if ( is_admin() ) {
	require get_template_directory() . '/includes/admin-functions.php';
}

if ( ! function_exists( 'mytheme_check_hide_title' ) ) {

	function mytheme_check_hide_title( $val ) {
		if ( defined( 'MYTHEME_VERSION' ) ) {
			$current_doc = \MYTHEME\Plugin::instance()->documents->get( get_the_ID() );
			if ( $current_doc && 'yes' === $current_doc->get_settings( 'hide_title' ) ) {
				$val = false;
			}
		}
		return $val;
	}
}
add_filter( 'mytheme_page_title', 'mytheme_check_hide_title' );

if ( ! function_exists( 'mytheme_body_open' ) ) {
	function mytheme_body_open() {
		if ( function_exists( 'wp_body_open' ) ) {
			wp_body_open();
		} else {
			do_action( 'wp_body_open' );
		}
	}
}

function ourWidgetsInit(){
	register_sidebar(array(
		'name' => 'Sidebar',
		'id' => 'sidebar1'
	));
}
add_action('widgets_init', 'ourWidgetsInit');