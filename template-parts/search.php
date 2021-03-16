<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}
?>
<main class="site-main" role="main">
	<?php if ( apply_filters( 'hello_mytheme_page_title', true ) ) : ?>
		<header class="page-header">
			<h1 class="entry-title">
				<?php esc_html_e( 'Search results for: ', 'hello-mytheme' ); ?>
				<span><?php echo get_search_query(); ?></span>
			</h1>
		</header>
	<?php endif; ?>
	<div class="page-content">
		<?php if ( have_posts() ) : ?>
			<?php
			while ( have_posts() ) :
				the_post();
				printf( '<h2><a href="%s">%s</a></h2>', esc_url( get_permalink() ), esc_html( get_the_title() ) );
				the_post_thumbnail();
				the_excerpt();
			endwhile;
			?>
		<?php else : ?>
			<p><?php esc_html_e( 'It seems we can\'t find what you\'re looking for.', 'hello-mytheme' ); ?></p>
		<?php endif; ?>
	</div>

	<?php wp_link_pages(); ?>

	<?php
	global $wp_query;
	if ( $wp_query->max_num_pages > 1 ) :
		?>
		<nav class="pagination" role="navigation">
			<?php ?>
			<div class="nav-previous"><?php next_posts_link( sprintf( __( '%s older', 'hello-mytheme' ), '<span class="meta-nav">&larr;</span>' ) ); ?></div>
			<?php ?>
			<div class="nav-next"><?php previous_posts_link( sprintf( __( 'newer %s', 'hello-mytheme' ), '<span class="meta-nav">&rarr;</span>' ) ); ?></div>
		</nav>
	<?php endif; ?>
</main>