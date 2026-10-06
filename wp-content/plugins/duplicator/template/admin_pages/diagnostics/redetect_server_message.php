<?php

defined("ABSPATH") or die("");

/**
 * Variables
 *
 * @var Duplicator\Core\Controllers\ControllersManager $ctrlMng
 * @var Duplicator\Core\Views\TplMng $tplMng
 */

if (!$tplMng->dataValueExists('redetectRan')) {
    return;
}

$messageClasses = [
    'notice',
    'dupli-admin-notice',
    'is-dismissible',
    'dupli-diagnostic-action-redetect-server',
];

if (!$tplMng->getDataValueBool('redetectRan')) { ?>
    <div id="message" class="<?php echo esc_attr(implode(' ', array_merge($messageClasses, ['notice-warning']))); ?>">
        <p>
            <?php esc_html_e(
                'Server detection tests skipped: a backup is currently in progress. Try again when no backup is running.',
                'duplicator'
            ); ?>
        </p>
    </div>
    <?php
    return;
}

$lockSql      = $tplMng->getDataValueBool('redetectLockSql');
$lockFile     = $tplMng->getDataValueBool('redetectLockFile');
$loopbackPass = $tplMng->getDataValueBool('redetectLoopbackPass');

$isWarning        = (!$lockSql && !$lockFile) || !$loopbackPass;
$messageClasses[] = ($isWarning ? 'notice-warning' : 'notice-success');

$sqlLockMessage = sprintf(
    /* translators: %s is PASS or FAIL */
    __('SQL Lock: %s.', 'duplicator'),
    $lockSql ? __('PASS', 'duplicator') : __('FAIL', 'duplicator')
);
$fileLockMessage = sprintf(
    /* translators: %s is PASS or FAIL */
    __('File Lock: %s.', 'duplicator'),
    $lockFile ? __('PASS', 'duplicator') : __('FAIL', 'duplicator')
);

if ($loopbackPass) {
    $kickoffMessage = __('Kickoff self-request: PASS. The server can trigger build steps by itself (server-side kickoff).', 'duplicator');
} else {
    $kickoffMessage = __(
        'Kickoff self-request: FAIL. The server cannot reach itself,
        so builds will rely on the browser staying open (client-side kickoff).',
        'duplicator'
    );
}

?>
<div id="message" class="<?php echo esc_attr(implode(' ', $messageClasses)); ?>">
    <p><b><?php esc_html_e('Server detection tests completed.', 'duplicator'); ?></b></p>
    <p><?php echo esc_html($sqlLockMessage); ?><br><?php echo esc_html($fileLockMessage); ?></p>
    <p><?php echo esc_html($kickoffMessage); ?></p>
</div>
