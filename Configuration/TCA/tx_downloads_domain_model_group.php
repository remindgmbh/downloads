<?php

declare(strict_types=1);

return [
    'columns' => [
        'description' => [
            'config' => [
                'enableRichtext' => true,
                'eval' => 'trim',
                'max' => 256,
                'type' => 'text',
            ],
            'label' => 'LLL:EXT:rmnd_downloads/Resources/Private/Language/locallang_tca.xlf:description',
        ],
        'downloads' => [
            'config' => [
                'foreign_table' => 'tx_downloads_domain_model_download',
                'foreign_table_where' => 'AND {#tx_downloads_domain_model_download}.{#sys_language_uid} IN (-1,0)',
                'MM' => 'tx_downloads_domain_model_download_group_mm',
                'multiple' => 0,
                'renderType' => 'selectMultipleSideBySide',
                'size' => 5,
                'type' => 'select',
            ],
            'exclude' => 0,
            'l10n_display' => 'defaultAsReadonly',
            'l10n_mode' => 'exclude',
            'label' => 'LLL:EXT:rmnd_downloads/Resources/Private/Language/locallang_tca.xlf:downloads',
        ],
        'hidden' => [
            'config' => [
                'items' => [
                    [
                        'invertStateDisplay' => true,
                        0 => '',
                        1 => '',
                    ],
                ],
                'renderType' => 'checkboxToggle',
                'type' => 'check',
            ],
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.enabled',
        ],
        'image' => [
            'config' => [
                'allowed' => 'common-image-types',
                'maxitems' => 1,
                'type' => 'file',
            ],
            'label' => 'LLL:EXT:rmnd_downloads/Resources/Private/Language/locallang_tca.xlf:image',
        ],
        'l10n_diffsource' => [
            'config' => [
                'default' => '',
                'type' => 'passthrough',
            ],
        ],
        'l10n_parent' => [
            'config' => [
                'default' => 0,
                'foreign_table' => 'tx_downloads_domain_model_group',
                'foreign_table_where' =>
                    'AND {#tx_downloads_domain_model_group}.{#pid}=###CURRENT_PID###'
                    . ' AND {#tx_downloads_domain_model_group}.{#sys_language_uid} IN (-1,0)',
                'items' => [
                    [
                        '',
                        0,
                    ],
                ],
                'renderType' => 'selectSingle',
                'type' => 'select',
            ],
            'displayCond' => 'FIELD:sys_language_uid:>:0',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.l18n_parent',
        ],
        'l10n_source' => [
            'config' => [
                'type' => 'passthrough',
            ],
        ],
        'name' => [
            'config' => [
                'eval' => 'trim',
                'max' => 256,
                'required' => true,
                'size' => 20,
                'type' => 'input',
            ],
            'label' => 'LLL:EXT:rmnd_downloads/Resources/Private/Language/locallang_tca.xlf:name',
        ],
        'sys_language_uid' => [
            'config' => [
                'type' => 'language',
            ],
            'exclude' => true,
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.language',
        ],
        't3ver_label' => [
            'config' => [
                'type' => 'none',
            ],
            'displayCond' => 'FIELD:t3ver_label:REQ:true',
            'label' => 'LLL:EXT:core/Resources/Private/Language/locallang_general.xlf:LGL.versionLabel',
        ],
    ],
    'ctrl' => [
        'crdate' => 'crdate',
        'delete' => 'deleted',
        'enablecolumns' => [
            'disabled' => 'hidden',
        ],
        'iconfile' => 'EXT:rmnd_downloads/Resources/Public/Icons/tx_downloads_domain_model_download.svg',
        'label' => 'name',
        'languageField' => 'sys_language_uid',
        'origUid' => 't3_origuid',
        'sortby' => 'sorting',
        'title' => 'LLL:EXT:rmnd_downloads/Resources/Private/Language/locallang_tca.xlf:downloadGroup',
        'translationSource' => 'l10n_source',
        'transOrigDiffSourceField' => 'l10n_diffsource',
        'transOrigPointerField' => 'l10n_parent',
        'tstamp' => 'tstamp',
        'versioningWS' => true,
    ],
    'types' => [
        0 => [
            'showitem' => '
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                    name,
                    description,
                    downloads,
                    image,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
                    sys_language_uid,
                    l10n_parent,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                    hidden,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
            ',
        ],
    ],
];
