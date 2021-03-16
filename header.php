<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<?php $viewport_content = apply_filters( 'mytheme_viewport_content', 'width=device-width, initial-scale=1' ); ?>
	<meta name="viewport" content="<?php echo esc_attr( $viewport_content ); ?>">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php
mytheme_body_open();

if ( ! function_exists( 'mytheme_theme_do_location' ) || ! mytheme_theme_do_location( 'header' ) ) {
	get_template_part( 'template-parts/header' );
}
