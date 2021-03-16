<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}

if ( ! function_exists( 'mytheme_theme_do_location' ) || ! mytheme_theme_do_location( 'footer' ) ) {
	get_template_part( 'template-parts/footer' );
}
?>

<?php wp_footer(); ?>
<?php if( function_exists('slbd_display_widgets') ) { echo slbd_display_widgets(); } ?>

</body>
</html>
