<?php

include 'credentials.php';

return [
    'settings' => [
        'determineRouteBeforeAppMiddleware' => false,
        'displayErrorDetails' => true,
        'db' => [
            'driver'    => 'mysql',
            'host'      => $db_host,
            'database'  => $db_name,
            'username'  => $db_user,
            'password'  => $db_pass,
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
            'prefix'    => '',
        ]
    ],
];