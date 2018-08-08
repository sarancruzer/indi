<?php
//DB configurations and other third party configuration
return [
    'settings' => [
		 'displayErrorDetails' => true,
        // View settings
        'view' => [
            'template_path' => __DIR__ . '/templates',
            'twig' => [
                'cache' => __DIR__ . '/../cache/twig',
                'debug' => true,
                'auto_reload' => true,
            ],
        ],
        // monolog settings
        'logger' => [
            'name' => 'app',
            'path' => __DIR__ . '/../logs/app.log',
        ],
        'doctrine' => [
            'meta' => [
                'entity_path' => [
                    'app/Entities'
                ],
                'auto_generate_proxies' => true,
                'proxy_dir' =>  __DIR__.'/../cache/proxies',
                'cache' => null,
            ],
            'connection' => [
                'driver'   => 'pdo_mysql',
                'host'     => 'localhost',
                'dbname'   => 'indigenous',
                'user'     => 'root',
                'password' => '',
				//Dev site config
				/* 'host'     => '127.0.0.1',
                'dbname'   => 'devmasterlive;charset=utf8',
                'user'     => 'writeuser',
                'password' => 'Rc6zArt&54SqTq)9', */
            ]
        ]
    ],
];
