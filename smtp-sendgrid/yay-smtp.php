<?php
/**
 * Plugin Name: SMTP for SendGrid – YaySMTP
 * Plugin URI: https://yaycommerce.com/yaysmtp-wordpress-mail-smtp
 * Description: This plugin helps you send emails from your WordPress website via your SendGrid SMTP.
 * Version: 1.4
 * Author: YayCommerce
 * Author URI: https://yaycommerce.com
 * Text Domain: smtp-sendgrid
 * Domain Path: /i18n/languages/
 */

namespace YaySMTPSendgrid;

defined( 'ABSPATH' ) || exit;

// Define variables of SendGrid mailer - start
if ( ! defined( 'YAY_SMTP_SENDGRID_PREFIX' ) ) {
	define( 'YAY_SMTP_SENDGRID_PREFIX', 'yay_smtp_sendgrid' );
}

if ( ! defined( 'YAY_SMTP_SENDGRID_VERSION' ) ) {
	define( 'YAY_SMTP_SENDGRID_VERSION', '1.4' );
}

if ( ! defined( 'YAY_SMTP_SENDGRID_PLUGIN_URL' ) ) {
	define( 'YAY_SMTP_SENDGRID_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}

if ( ! defined( 'YAY_SMTP_SENDGRID_PLUGIN_PATH' ) ) {
	define( 'YAY_SMTP_SENDGRID_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
}

if ( ! defined( 'YAY_SMTP_SENDGRID_PLUGIN_BASENAME' ) ) {
	define( 'YAY_SMTP_SENDGRID_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
}

if ( ! defined( 'YAY_SMTP_SENDGRID_SITE_URL' ) ) {
	define( 'YAY_SMTP_SENDGRID_SITE_URL', site_url() );
}

// Define variables of SendGrid mailer - end

spl_autoload_register(
	function ( $class ) {
		$prefix   = __NAMESPACE__; // project-specific namespace prefix
		$base_dir = __DIR__ . '/includes'; // base directory for the namespace prefix

		$len = strlen( $prefix );
		if ( strncmp( $prefix, $class, $len ) !== 0 ) { // does the class use the namespace prefix?
			return; // no, move to the next registered autoloader
		}

		$relative_class_name = substr( $class, $len );

		// replace the namespace prefix with the base directory, replace namespace
		// separators with directory separators in the relative class name, append
		// with .php
		$file = $base_dir . str_replace( '\\', '/', $relative_class_name ) . '.php';

		if ( file_exists( $file ) ) {
			require $file;
		}
	}
);

if ( version_compare( get_bloginfo( 'version' ), '5.5-alpha', '<' ) ) {
	if ( ! class_exists( '\PHPMailer', false ) ) {
		require_once ABSPATH . 'wp-includes/class-phpmailer.php';
	}
} else {
	if ( ! class_exists( '\PHPMailer\PHPMailer\PHPMailer', false ) ) {
		require_once ABSPATH . 'wp-includes/PHPMailer/PHPMailer.php';
	}
	if ( ! class_exists( '\PHPMailer\PHPMailer\Exception', false ) ) {
		require_once ABSPATH . 'wp-includes/PHPMailer/Exception.php';
	}
	if ( ! class_exists( '\PHPMailer\PHPMailer\SMTP', false ) ) {
		require_once ABSPATH . 'wp-includes/PHPMailer/SMTP.php';
	}
}

function init() {
	Schedule::getInstance();
	Plugin::getInstance();
	I18n::getInstance();
}
add_action( 'plugins_loaded', 'YaySMTPSendgrid\\init' );

register_activation_hook( __FILE__, array( 'YaySMTPSendgrid\\Plugin', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'YaySMTPSendgrid\\Plugin', 'deactivate' ) );
