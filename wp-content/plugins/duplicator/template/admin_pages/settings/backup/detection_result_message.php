<?php

defined("ABSPATH") or die("");

/**
 * Variables
 *
 * @var Duplicator\Core\Controllers\ControllersManager $ctrlMng
 * @var Duplicator\Core\Views\TplMng $tplMng
 */

$kickSettingLabel      = $tplMng->getDataValueStringRequired('kickSettingLabel');
$ajaxSettingLabel      = $tplMng->getDataValueStringRequired('ajaxSettingLabel');
$basicAuthSettingLabel = $tplMng->getDataValueStringRequired('basicAuthSettingLabel');
$ajaxUrl               = $tplMng->getDataValueStringRequired('ajaxUrl');
$sqlLockResult         = $tplMng->getDataValueStringRequired('sqlLockResult');
$fileLockResult        = $tplMng->getDataValueStringRequired('fileLockResult');
$kickoffResult         = $tplMng->getDataValueStringRequired('kickoffResult');
$basicAuthConfigured   = $tplMng->getDataValueBool('basicAuthConfigured');
$basicAuthUser         = $tplMng->getDataValueString('basicAuthUser');
$kickoffMismatch       = $tplMng->getDataValueBool('kickoffMismatch');
$lockMismatch          = $tplMng->getDataValueBool('lockMismatch');
?>
<b><?php esc_html_e('Settings Saved', 'duplicator'); ?></b>
<br><br>
<b><?php esc_html_e('Process Settings', 'duplicator'); ?></b><br>
<?php esc_html_e('Client-side Kickoff', 'duplicator'); ?>: <b><?php echo esc_html($kickSettingLabel); ?></b><br>
<?php esc_html_e('Server-to-Server Ajax', 'duplicator'); ?>: <b><?php echo esc_html($ajaxSettingLabel); ?></b>
(<?php echo esc_html($ajaxUrl); ?>)<br>
<?php esc_html_e('Password-Protected Access', 'duplicator'); ?>: <b><?php echo esc_html($basicAuthSettingLabel); ?></b>
<br><br>
<b><?php esc_html_e('Detection Results', 'duplicator'); ?></b><br>
<?php esc_html_e('SQL Lock', 'duplicator'); ?>: <b><?php echo esc_html($sqlLockResult); ?></b><br>
<?php esc_html_e('File Lock', 'duplicator'); ?>: <b><?php echo esc_html($fileLockResult); ?></b><br>
<?php esc_html_e('Client-side Kickoff', 'duplicator'); ?>: <b><?php echo esc_html($kickoffResult); ?></b><br>
<?php esc_html_e('Basic Authentication', 'duplicator'); ?>:
<b>
    <?php if ($basicAuthConfigured) {
        printf(
            esc_html_x('Enabled (user: %s)', '%s is the basic auth username', 'duplicator'),
            esc_html($basicAuthUser)
        );
    } else {
        esc_html_e('Disabled', 'duplicator');
    } ?>
</b>
<?php if ($lockMismatch) : ?>
    <br><br>
    <span class="alert-color">
        <b>⚠ <?php esc_html_e('Warning', 'duplicator'); ?>:</b>
        <?php esc_html_e(
            'Both process lock reliability tests failed.
            Concurrent backup workers may not be prevented, which can cause overlapping writes and server overload.
            Contact support if backups misbehave on this server.',
            'duplicator'
        ); ?>
    </span>
<?php endif; ?>
<?php if ($kickoffMismatch) : ?>
    <br><br>
    <span class="alert-color">
        <b>⚠ <?php esc_html_e('Warning', 'duplicator'); ?>:</b>
        <?php esc_html_e(
            'The loopback self-request test failed, but kickoff is forced to Server.
            Backup creation may not work. Keep this setting only if you are sure the server can reach itself
            or if instructed by support.',
            'duplicator'
        ); ?>
    </span>
<?php endif; ?>
