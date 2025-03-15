<?php
use YaySMTPSendgrid\Helper\Utils;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$templatePart = YAY_SMTP_SENDGRID_PLUGIN_PATH . 'includes/Views/template-part';
?>

<div class="yay-sidenav yay-smtp-test-mail-drawer">
  <a href="javascript:void(0)" class="closebtn">&times;</a>
  <div class="yay-smtp-layout-activity-panel-content">
	<div class="yay-smtp-activity-panel-header">
	  <h3 class="yay-smtp-activity-panel-header-title">Send Email</h3>
	</div>
	<div class="yay-smtp-activity-panel-content">
	  <div class="yay-smtp-card-body test-email">
		<div class="setting-label">
		  <label for="yay_smtp_test_mail_address">Email Address</label>
		</div>
		<div class="setting-field">
		  <input type="text" id="yay_smtp_test_mail_address" class="yay-smtp-test-mail-address" value=<?php echo esc_attr( Utils::getAdminEmail() ); ?>>
		  <div class="error-message-email" style="display:none"></div>
		</div>
	  </div>
	  <div>
		<p class="notify-mailer-setting-complete" style="display:<?php echo $isMailerComplete ? 'none' : 'block'; ?>">Mailer is not completed. Please completed Mailer Settings first!</p>
		<button type="button" class="yay-smtp-button yay-smtp-send-mail-action" <?php echo ! $isMailerComplete ? 'disabled' : ''; ?>>Send Email</button>
	  </div>
	</div>
  </div>
  <?php Utils::getTemplatePart( $templatePart, 'debug' ); ?>
</div>
