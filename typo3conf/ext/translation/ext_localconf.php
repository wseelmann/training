<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function () {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'In2code.Translation',
            'Pi1',
            [
                'Trans' => 'list,detail,new,create,edit,update,delete'
            ],
            // non-cacheable actions
            [
                'Trans' => 'list,new,create,edit,update,delete'
            ]
        );

        // wizards
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
            'mod {
            wizards.newContentElement.wizardItems.plugins {
                elements {
                    pi1 {
                        icon = ' . \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath('translation') . 'Resources/Public/Icons/user_plugin_pi1.svg
                        title = LLL:EXT:translation/Resources/Private/Language/locallang_db.xlf:tx_translation_domain_model_pi1
                        description = LLL:EXT:translation/Resources/Private/Language/locallang_db.xlf:tx_translation_domain_model_pi1.description
                        tt_content_defValues {
                            CType = list
                            list_type = translation_pi1
                        }
                    }
                }
                show = *
            }
       }'
        );
    }
);
