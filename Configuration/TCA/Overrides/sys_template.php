<?php

declare(strict_types=1);

defined('TYPO3') || die;

use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;

(function (): void {
    ExtensionManagementUtility::addStaticFile(
        'rmnd_downloads',
        'Configuration/TypoScript',
        'REMIND - Downloads Extension'
    );
})();
