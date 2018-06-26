<?php
defined('TYPO3_MODE') || die();

/**
 * Include Flexform
 */
$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['translation_pi1'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    'translation_pi1',
    'FILE:EXT:translation/Configuration/FlexForms/FlexFormPi1.xml'
);
