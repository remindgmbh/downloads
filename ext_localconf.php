<?php

declare(strict_types=1);

use Remind\Downloads\Controller\DownloadController;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

defined('TYPO3') || die('Access denied.');

(function (): void {
    ExtensionUtility::configurePlugin(
        'Downloads',
        'SelectionList',
        [DownloadController::class => 'selectionList'],
        [],
        ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
    );

    ExtensionUtility::configurePlugin(
        'Downloads',
        'GroupSelectionList',
        [DownloadController::class => 'groupSelectionList'],
        [],
        ExtensionUtility::PLUGIN_TYPE_CONTENT_ELEMENT
    );
})();
