<?php

return [
    'folder_name' => 'legacy',
    'middlewares' => [
        \Legacy\Middleware\MigratedRoutes::class,
        \Legacy\Middleware\SessionGlobal::class
    ],
    'migrated_routes' => []
];
