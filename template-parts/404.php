<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; 
}
?>
<main class="site-main" role="main">
	<?php if ( apply_filters( 'hello_mytheme_page_title', true ) ) : ?>
		<header class="page-header">
			<h1 class="entry-title"><?php esc_html_e( 'The page can&rsquo;t be found.', 'hello-mytheme' ); ?></h1>
		</header>
	<?php endif; ?>
	<div class="page-content">
		<p><?php esc_html_e( 'It looks like nothing was found at this location.', 'hello-mytheme' ); ?></p>
	</div>

</main>
