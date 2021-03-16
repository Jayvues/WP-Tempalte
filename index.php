<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}

get_header();

$is_mytheme_theme_exist = function_exists( 'mytheme_theme_do_location' );

if ( is_singular() ) {
	if ( ! $is_mytheme_theme_exist || ! mytheme_theme_do_location( 'single' ) ) {
		get_template_part( 'template-parts/single' );
	}
} elseif ( is_archive() || is_home() ) {
	if ( ! $is_mytheme_theme_exist || ! mytheme_theme_do_location( 'archive' ) ) {
		get_template_part( 'template-parts/archive' );
	}
} elseif ( is_search() ) {
	if ( ! $is_mytheme_theme_exist || ! mytheme_theme_do_location( 'archive' ) ) {
		get_template_part( 'template-parts/search' );
	}
} else {
	if ( ! $is_mytheme_theme_exist || ! mytheme_theme_do_location( 'single' ) ) {
		get_template_part( 'template-parts/404' );
	}
}

get_footer();
