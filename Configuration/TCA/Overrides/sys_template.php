<?php
defined('TYPO3') || die('Access denied.');

\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
    'formwebhooksend',
    'Configuration/TypoScript',
    'Form Webhook Send'
);
