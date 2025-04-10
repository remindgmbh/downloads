<?php

declare(strict_types=1);

use Remind\Extbase\Utility\Dto\PluginType;
use Remind\Extbase\Utility\PluginUtility;
use TYPO3\CMS\Extbase\Utility\ExtensionUtility;

defined('TYPO3') || die;

(function (): void {
    $selectionListSignature = ExtensionUtility::registerPlugin(
        'Downloads',
        'SelectionList',
        'LLL:EXT:rmnd_downloads/Resources/Private/Language/locallang_tca.xlf:selectionList',
        '',
    );

    PluginUtility::addTcaType(
        $selectionListSignature,
        PluginType::SELECTION_LIST,
        'tx_downloads_domain_model_download'
    );

    $groupSelectionListSignature = ExtensionUtility::registerPlugin(
        'Downloads',
        'GroupSelectionList',
        'LLL:EXT:rmnd_downloads/Resources/Private/Language/locallang_tca.xlf:selectionList',
        '',
    );

    PluginUtility::addTcaType(
        $groupSelectionListSignature,
        PluginType::SELECTION_LIST,
        'tx_downloads_domain_model_group'
    );
})();
