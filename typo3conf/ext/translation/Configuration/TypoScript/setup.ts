plugin.tx_translation_pi1 {
    view {
        templateRootPaths.0 = EXT:translation/Resources/Private/Templates/
        templateRootPaths.1 = {$plugin.tx_translation_pi1.view.templateRootPath}
        partialRootPaths.0 = EXT:translation/Resources/Private/Partials/
        partialRootPaths.1 = {$plugin.tx_translation_pi1.view.partialRootPath}
        layoutRootPaths.0 = EXT:translation/Resources/Private/Layouts/
        layoutRootPaths.1 = {$plugin.tx_translation_pi1.view.layoutRootPath}
    }
    persistence {
        #storagePid = {$plugin.tx_translation_pi1.persistence.storagePid}
        #recursive = 1
    }
    features {
        #skipDefaultArguments = 1
        # if set to 1, the enable fields are ignored in BE context
        ignoreAllEnableFieldsInBe = 0
        # Should be on by default, but can be disabled if all action in the plugin are uncached
        requireCHashArgumentForActionArguments = 0
    }
    mvc {
        #callDefaultActionIfActionCantBeResolved = 1
    }
    settings {
        # Add default sorting
        sorting.field = subjectFrom
        sorting.order = ASC
    }
}

page.includeCSS.training = EXT:translation/Resources/Public/Css/Training.css

# Open RSS with /index.php?id=27&type=1519224173
rssTranslationNews = PAGE
rssTranslationNews {
    typeNum = 1519224173
    config {
        additionalHeaders.10.header = Content-Type: application/rss+xml
        disableAllHeaderCode = 1
        disablePrefixComment = 1
        xhtml_cleaning = 0
        admPanel = 0
        debug = 0
    }

    10 = USER
    10 {
        userFunc = TYPO3\CMS\Extbase\Core\Bootstrap->run
        extensionName = Translation
        pluginName = Pi2
        vendorName = In2code
        controller = News
        action = rss
        switchableControllerActions.News.1 = rss
        persistence.storagePid = 26
    }
}
