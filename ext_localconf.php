<?php
defined('TYPO3') || die();

call_user_func(function () {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTypoScriptSetup(
        trim('
            module.tx_form {
                settings {
                    yamlConfigurations {
                        100898989 = EXT:formwebhooksend/Configuration/Yaml/FormBE.yaml
                    }
                }
            }
        ')
    );
});
