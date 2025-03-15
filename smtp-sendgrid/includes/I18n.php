<?php
namespace YaySMTPSendgrid;

defined( 'ABSPATH' ) || exit;

class I18n {
	protected static $instance = null;

	public static function getInstance() {
		if ( null == self::$instance ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	private function __construct() {
		add_action( 'init', array( $this, 'loadPluginTextdomain' ) );
	}

	public function loadPluginTextdomain() {
		if ( function_exists( 'determine_locale' ) ) {
			$locale = determine_locale();
		} else {
			$locale = is_admin() ? get_user_locale() : get_locale();
		}
		unload_textdomain( 'smtp-sendgrid' );
		load_textdomain( 'smtp-sendgrid', YAY_SMTP_SENDGRID_PLUGIN_PATH . '/i18n/languages/smtp-sendgrid-' . $locale . '.mo' );
		load_plugin_textdomain( 'smtp-sendgrid', false, YAY_SMTP_SENDGRID_PLUGIN_PATH . '/i18n/languages/' );
	}
}
