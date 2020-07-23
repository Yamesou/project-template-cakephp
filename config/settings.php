<?php

/**
 * Database Settings
 *
 * The Settings configuration has four level that are being used to build the UI as per below:
 * - Level 0 - Tab label
 * - Level 1 - Column label
 * - Level 2 - Section label
 * - Level 3 - Field label
 *
 * For each field the following can be defined:
 * - alias - Configuration key that will be stored in database.
 * - type - Can be integer, string, list or boolean.
 * - (optional) selectOptions - Array with [value => label] in case of type list.
 * - scope - Whether the settings can be applied on application level, on user level or both.
 * - help - Text to be displayed as a help message under each field
 */

return [
    'Settings' => [
        'Available Options' => [
            'APIs' => [
                'Keys' => [
                    'Google Maps' => [
                        'alias' => 'CsvMigrations.GoogleMaps.ApiKey',
                        'type' => 'string',
                        'scope' => [
                            'app',
                        ],
                    ],
                ],
            ],
            'Email' => [
                'General' => [
                    'Transport' => [
                        'alias' => 'EmailTransport.default.className',
                        'type' => 'list',
                        'selectOptions' => [
                            'Mail' => 'Mail',
                            'Smtp' => 'Smtp',
                            'Debug' => 'Debug',
                        ],
                        'scope' => [
                            'app',
                        ],
                    ],
                ],
                'SMTP' => [
                    'Host' => [
                        'alias' => 'EmailTransport.default.host',
                        'type' => 'string',
                        'help' => '',
                        'scope' => [
                            'app',
                        ],
                    ],
                    'Port' => [
                        'alias' => 'EmailTransport.default.port',
                        'type' => 'integer',
                        'help' => '',
                        'scope' => [
                            'app',
                        ],
                    ],
                    'Timeout' => [
                        'alias' => 'EmailTransport.default.timeout',
                        'type' => 'integer',
                        'help' => '',
                        'scope' => [
                            'app',
                        ],
                    ],
                    'Username' => [
                        'alias' => 'EmailTransport.default.username',
                        'type' => 'string',
                        'help' => '',
                        'scope' => [
                            'app',
                        ],
                    ],
                    'Password' => [
                        'alias' => 'EmailTransport.default.password',
                        'type' => 'string',
                        'help' => '',
                        'scope' => [
                            'app',
                        ],
                    ],
                    'TLS' => [
                        'alias' => 'EmailTransport.default.tls',
                        'type' => 'boolean',
                        'help' => '',
                        'scope' => [
                            'app',
                        ],
                    ],
                ],
            ],
            'Authentication' => [
                'LDAP' => [
                    'Enabled' => [
                        'alias' => 'Ldap.enabled',
                        'type' => 'boolean',
                        'help' => '',
                        'scope' => [
                            'app',
                        ],
                    ],
                    'Username' => [
                        'alias' => 'Ldap.username',
                        'type' => 'string',
                        'help' => '',
                        'scope' => [
                            'app',
                        ],
                    ],
                    'Password' => [
                        'alias' => 'Ldap.password',
                        'type' => 'string',
                        'help' => '',
                        'scope' => [
                            'app',
                        ],
                    ],
                    'Host' => [
                        'alias' => 'Ldap.host',
                        'type' => 'string',
                        'help' => '',
                        'scope' => [
                            'app',
                        ],
                    ],
                    'Port' => [
                        'alias' => 'Ldap.port',
                        'type' => 'integer',
                        'help' => '',
                        'scope' => [
                            'app',
                        ],
                    ],
                    'Version' => [
                        'alias' => 'Ldap.version',
                        'type' => 'integer',
                        'help' => '',
                        'scope' => [
                            'app',
                        ],
                    ],
                    'Domain' => [
                        'alias' => 'Ldap.domain',
                        'type' => 'string',
                        'help' => '',
                        'scope' => [
                            'app',
                        ],
                    ],
                    'BaseDN' => [
                        'alias' => 'Ldap.baseDn',
                        'type' => 'string',
                        'help' => '',
                        'scope' => [
                            'app',
                        ],
                    ],
                    'Filter' => [
                        'alias' => 'Ldap.filter',
                        'type' => 'string',
                        'help' => '',
                        'scope' => [
                            'app',
                        ],
                    ],
                ],
            ],
            'Development' => [
                'Development' => [
                    'Dashboard Menu Order Value' => [
                        'alias' => 'Menu.dashboard_menu_order_value',
                        'view' => 'dashboard',
                        'type' => 'string',
                        'help' => '',
                        'scope' => [
                            'user',
                            'app',
                        ],
                    ],
                    'AdminLTE skin color' => [
                        'alias' => 'Theme.skin',
                        'view' => 'theme',
                        'type' => 'string',
                        'help' => '',
                        'scope' => [
                            'user',
                            'app',
                        ],
                    ],
                ],
                'Troubleshooting' => [
                    'Debug' => [
                        'alias' => 'debug',
                        'type' => 'boolean',
                        'help' => 'Use this with caution! All errors will be displayed and debug messages will be logged.',
                        'scope' => [
                            'app',
                        ],
                    ],
                ],
            ],
            'Region & Language' => [
                'Region & Language' => [
                    'Locale' => [
                        'alias' => 'App.defaultLocale',
                        'type' => 'list',
                        'selectOptions' => [
                            'en_US' => 'English (US)',
                            'it_IT' => 'Italian',
                        ],
                        'help' => 'Choose system locale',
                        'scope' => [
                            'user',
                            'app',
                        ],
                    ],
                ],
            ],
            'File Upload' => [
                'File Upload' => [
                    'Theme' => [
                        'alias' => 'CsvMigrations.BootstrapFileInput.defaults.theme',
                        'type' => 'list',
                        'selectOptions' => [
                            '' => 'Default',
                            'explorer' => 'Explorer',
                        ],
                        'help' => 'Select theme',
                        'scope' => [
                            'app',
                        ],
                    ],
                ],
                'Dropzone Settings' => [
                    'Enable Dropzone' => [
                        'alias' => 'CsvMigrations.BootstrapFileInput.defaults.dropZoneEnabled',
                        'type' => 'boolean',
                        'help' => 'Enable dropzone area',
                        'scope' => [
                            'app',
                        ],
                    ],
                    'Enable dropzone click' => [
                        'alias' => 'CsvMigrations.BootstrapFileInput.defaults.browseOnZoneClick',
                        'type' => 'boolean',
                        'help' => 'Allow uplaod files when clicking dropzone area',
                        'scope' => [
                            'app',
                        ],
                    ],
                ],
            ],
        ],
    ],
];
