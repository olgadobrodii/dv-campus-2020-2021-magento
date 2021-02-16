<?php
return [
    'backend' => [
        'frontName' => 'admin'
    ],
    'queue' => [
        'consumers_wait_for_messages' => 1
    ],
    'crypt' => [
        'key' => '094eaf6e02f78155e0ced8fdbd6e8e82'
    ],
    'db' => [
        'table_prefix' => 'm2_',
        'connection' => [
            'default' => [
                'host' => 'mysql',
                'dbname' => 'olha_dobrodii_build_local',
                'username' => 'olha_dobrodii_build_local',
                'password' => 'rt67yu45h3ny',
                'model' => 'mysql4',
                'engine' => 'innodb',
                'initStatements' => 'SET NAMES utf8;',
                'active' => '1',
                'driver_options' => [
                    1014 => false
                ]
            ]
        ]
    ],
    'resource' => [
        'default_setup' => [
            'connection' => 'default'
        ]
    ],
    'x-frame-options' => 'SAMEORIGIN',
    'MAGE_MODE' => 'production',
    'session' => [
        'save' => 'files'
    ],
    'cache' => [
        'frontend' => [
            'default' => [
                'id_prefix' => '69d_'
            ],
            'page_cache' => [
                'id_prefix' => '69d_'
            ]
        ],
        'allow_parallel_generation' => false
    ],
    'lock' => [
        'provider' => 'db',
        'config' => [
            'prefix' => null
        ]
    ],
    'directories' => [
        'document_root_is_pub' => false
    ],
    'cache_types' => [
        'config' => 1,
        'layout' => 1,
        'block_html' => 1,
        'collections' => 1,
        'reflection' => 1,
        'db_ddl' => 1,
        'compiled_config' => 1,
        'eav' => 1,
        'customer_notification' => 1,
        'config_integration' => 1,
        'config_integration_api' => 1,
        'full_page' => 1,
        'config_webservice' => 1,
        'translate' => 1,
        'vertex' => 1
    ],
    'downloadable_domains' => [
        'olha-dobrodii-dev.local'
    ],
    'install' => [
        'date' => 'Mon, 23 Nov 2020 08:38:39 +0000'
    ],
    'system' => [
        'default' => [
            'web' => [
                'unsecure' => [
                    'base_url' => 'https://olha-dobrodii-dev.local/',
                    'base_link_url' => '{{unsecure_base_url}}',
                    'base_static_url' => 'https://olha-dobrodii-dev.local/static/',
                    'base_media_url' => 'https://olha-dobrodii-dev.local/media/'
                ],
                'secure' => [
                    'base_url' => 'https://olha-dobrodii-dev.local/',
                    'base_link_url' => '{{secure_base_url}}',
                    'base_static_url' => 'https://olha-dobrodii-dev.local/static/',
                    'base_media_url' => 'https://olha-dobrodii-dev.local/media/'
                ],
            ],
        ],
        'websites' => [
            'additional_website' => [
                'web' => [
                    'unsecure' => [
                        'base_url' => 'https://olha-dobrodii-dev.local/',
                        'base_link_url' => 'https://olha-dobrodii-dev.local/',
                        'base_static_url' => 'https://olha-dobrodii-dev.local/static/',
                        'base_media_url' => 'https://olha-dobrodii-dev.local/media/'
                    ],
                    'secure' => [
                        'base_url' => 'https://olha-dobrodii-dev.local/',
                        'base_link_url' => 'https://olha-dobrodii-dev.local/',
                        'base_static_url' => 'https://olha-dobrodii-dev.local/static/',
                        'base_media_url' => 'https://olha-dobrodii-dev.local/media/'
                    ]
                ]
            ]
        ]
    ]
];
