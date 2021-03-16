<?php
function hello_mytheme_fail_load_admin_notice() {

	if ( function_exists( 'mytheme_pro_load_plugin' ) ) {
		return;
	}

	$screen = get_current_screen();
	if ( isset( $screen->parent_file ) && 'plugins.php' === $screen->parent_file && 'update' === $screen->id ) {
		return;
	}

	if ( 'true' === get_user_meta( get_current_user_id(), '_hello_mytheme_install_notice', true ) ) {
		return;
	}

	$plugin = 'mytheme/mytheme.php';

	$installed_plugins = get_plugins();

	$is_mytheme_installed = isset( $installed_plugins[ $plugin ] );

	if ( $is_mytheme_installed ) {
		if ( ! current_user_can( 'activate_plugins' ) ) {
			return;
		}

		$message = __( 'Hello theme is a lightweight starter theme designed to work perfectly with mytheme Page Builder plugin.', 'hello-mytheme' );

		$button_text = __( 'Activate mytheme', 'hello-mytheme' );
		$button_link = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $plugin . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $plugin );
	} else {
		if ( ! current_user_can( 'install_plugins' ) ) {
			return;
		}

		$message = __( 'Hello theme is a lightweight starter theme. We recommend you use it together with mytheme Page Builder plugin, they work perfectly together!', 'hello-mytheme' );

		$button_text = __( 'Install mytheme', 'hello-mytheme' );
		$button_link = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=mytheme' ), 'install-plugin_mytheme' );
	}

	?>
	<style>
		.notice.hello-mytheme-notice {
			border-left-color: #9b0a46 !important;
			padding: 20px;
		}
		.rtl .notice.hello-mytheme-notice {
			border-right-color: #9b0a46 !important;
		}
		.notice.hello-mytheme-notice .hello-mytheme-notice-inner {
			display: table;
			width: 100%;
		}
		.notice.hello-mytheme-notice .hello-mytheme-notice-inner .hello-mytheme-notice-icon,
		.notice.hello-mytheme-notice .hello-mytheme-notice-inner .hello-mytheme-notice-content,
		.notice.hello-mytheme-notice .hello-mytheme-notice-inner .hello-mytheme-install-now {
			display: table-cell;
			vertical-align: middle;
		}
		.notice.hello-mytheme-notice .hello-mytheme-notice-icon {
			color: #9b0a46;
			font-size: 50px;
			width: 50px;
		}
		.notice.hello-mytheme-notice .hello-mytheme-notice-content {
			padding: 0 20px;
		}
		.notice.hello-mytheme-notice p {
			padding: 0;
			margin: 0;
		}
		.notice.hello-mytheme-notice h3 {
			margin: 0 0 5px;
		}
		.notice.hello-mytheme-notice .hello-mytheme-install-now {
			text-align: center;
		}
		.notice.hello-mytheme-notice .hello-mytheme-install-now .hello-mytheme-install-button {
			padding: 5px 30px;
			height: auto;
			line-height: 20px;
			text-transform: capitalize;
		}
		.notice.hello-mytheme-notice .hello-mytheme-install-now .hello-mytheme-install-button i {
			padding-right: 5px;
		}
		.rtl .notice.hello-mytheme-notice .hello-mytheme-install-now .hello-mytheme-install-button i {
			padding-right: 0;
			padding-left: 5px;
		}
		.notice.hello-mytheme-notice .hello-mytheme-install-now .hello-mytheme-install-button:active {
			transform: translateY(1px);
		}
		@media (max-width: 767px) {
			.notice.hello-mytheme-notice {
				padding: 10px;
			}
			.notice.hello-mytheme-notice .hello-mytheme-notice-inner {
				display: block;
			}
			.notice.hello-mytheme-notice .hello-mytheme-notice-inner .hello-mytheme-notice-content {
				display: block;
				padding: 0;
			}
			.notice.hello-mytheme-notice .hello-mytheme-notice-inner .hello-mytheme-notice-icon,
			.notice.hello-mytheme-notice .hello-mytheme-notice-inner .hello-mytheme-install-now {
				display: none;
			}
		}
	</style>
	<script>jQuery( function( $ ) {
			$( 'div.notice.hello-mytheme-install-mytheme' ).on( 'click', 'button.notice-dismiss', function( event ) {
				event.preventDefault();

				$.post( ajaxurl, {
					action: 'hello_mytheme_set_admin_notice_viewed'
				} );
			} );
		} );</script>
	<div class="notice updated is-dismissible hello-mytheme-notice hello-mytheme-install-mytheme">
		<div class="hello-mytheme-notice-inner">
			<div class="hello-mytheme-notice-icon">
				<img src="<?php echo esc_url( get_template_directory_uri() . '/assets/images/mytheme-logo.png' ); ?>" alt="mytheme Logo" />
			</div>

			<div class="hello-mytheme-notice-content">
				<h3><?php esc_html_e( 'Thanks for installing Hello Theme!', 'hello-mytheme' ); ?></h3>
				<p>
					<p><?php echo esc_html( $message ); ?></p>
					<a href="https://go.mytheme.com/hello-theme-learn/" target="_blank"><?php esc_html_e( 'Learn more about mytheme', 'hello-mytheme' ); ?></a>
				</p>
			</div>

			<div class="hello-mytheme-install-now">
				<a class="button button-primary hello-mytheme-install-button" href="<?php echo esc_attr( $button_link ); ?>"><i class="dashicons dashicons-download"></i><?php echo esc_html( $button_text ); ?></a>
			</div>
		</div>
	</div>
	<?php
}

function ajax_hello_mytheme_set_admin_notice_viewed() {
	update_user_meta( get_current_user_id(), '_hello_mytheme_install_notice', 'true' );
	die;
}

add_action( 'wp_ajax_hello_mytheme_set_admin_notice_viewed', 'ajax_hello_mytheme_set_admin_notice_viewed' );

if ( ! did_action( 'mytheme/loaded' ) ) {
	add_action( 'admin_notices', 'hello_mytheme_fail_load_admin_notice' );
}
