<?php
defined('TYPO3_MODE') || die('Access denied.');

call_user_func(
    function () {

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'In2code.Translation',
            'Pi1',
            [
                'Trans' => 'list,list2,detail,new,create,edit,update,delete'
            ],
            // non-cacheable actions
            [
                'Trans' => 'list,list2,new,create,edit,update,delete'
            ]
        );
        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
            'In2code.Translation',
            'Pi2',
            [
                'News' => 'list'
            ],
            // non-cacheable actions
            [
                'News' => 'list'
            ]
        );

        // wizards
        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig(
            'mod {
            wizards.newContentElement.wizardItems.plugins {
                elements {
                    pi1 {
                        icon = typo3conf/ext/translation/Resources/Public/Icons/user_plugin_pi1.svg
                        title = Translationlist
                        description = Translationlist
                        tt_content_defValues {
                            CType = list
                            list_type = translation_pi1
                        }
                    }
                    pi2 {
                        icon = typo3conf/ext/translation/Resources/Public/Icons/user_plugin_pi1.svg
                        title = News
                        description = Newslist
                        tt_content_defValues {
                            CType = list
                            list_type = translation_pi2
                        }
                    }
                }
                show = *
            }
       }'
        );

        /**
         * CommandController
         */
        $GLOBALS['TYPO3_CONF_VARS']['SC_OPTIONS']['extbase']['commandControllers'][] =
            \In2code\Translation\Command\TranslationNewsImportCommandController::class;
    }
);
