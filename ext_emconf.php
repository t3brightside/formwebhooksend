<?php

$EM_CONF[$_EXTKEY] = [
    'title' => 'Form Webhook Send',
    'description' => 'Webhook form finisher',
    'category' => 'fe',
    'author' => 'Tanel Põld',
    'author_email' => 'tanel@brightside.ee',
    'author_company' => 'Brightside OÜ / t3brightside.com',
    'state' => 'stable',
    'clearCacheOnLoad' => true,
    'version' => '1.0.4',
    'constraints' => [
        'depends' => [
            'typo3' => '12.4.0-13.9.99',
            'form' => '12.4.0-13.9.99',
        ],
    ],
    'autoload' => [
        'psr-4' => [
            'Brightside\\Formwebhooksend\\' => 'Classes'
        ]
    ],
];
