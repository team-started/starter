<?php

$EM_CONF['starter'] = [
    'title' => 'Starter',
    'description' => '',
    'category' => 'plugin',
    'author' => 'Marc Fell, Christian Wolfram',
    'author_email' => 'marc@fell.hamburg, c.wolfram@chriwo.de',
    'state' => 'stable',
    'version' => '3.1.0',
    'constraints' => [
        'depends' => [
            'typo3' => '10.4.0-10.4.99',
            'content_defender' => '3.0.0-3.99.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
    'autoload' => [
        'psr-4' => [
            'StarterTeam\\Starter\\' => 'Classes',
        ],
    ],
];
