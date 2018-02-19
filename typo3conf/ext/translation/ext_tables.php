<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function () {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
            'In2code.Translation',
            'Pi1',
            'Translationlist'
        );

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
            'translation',
            'Configuration/TypoScript',
            'translation'
        );

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addLLrefForTCAdescr(
            'tx_translation_domain_model_trans',
            'EXT:translation/Resources/Private/Language/locallang_csh_tx_translation_domain_model_trans.xlf'
        );
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::allowTableOnStandardPages(
            'tx_translation_domain_model_trans'
        );
    }
);
