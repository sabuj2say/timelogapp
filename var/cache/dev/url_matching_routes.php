<?php

/**
 * This file has been auto-generated
 * by the Symfony Routing Component.
 */

return [
    false, // $matchHost
    [ // $staticRoutes
        '/time/log' => [[['_route' => 'app_time_log', '_controller' => 'App\\Controller\\TimeLogController::index'], null, null, null, false, false, null]],
        '/export' => [[['_route' => 'export_time_log', '_controller' => 'App\\Controller\\TimeLogController::exportTimeLog'], null, null, null, false, false, null]],
        '/calculate-totals' => [[['_route' => 'calculate_totals', '_controller' => 'App\\Controller\\TimeLogController::calculateTotals'], null, ['GET' => 0], null, false, false, null]],
        '/create' => [[['_route' => 'create_time_log', '_controller' => 'App\\Controller\\TimeLogController::createTimeLog'], null, null, null, false, false, null]],
        '/view' => [[['_route' => 'create_view_log', '_controller' => 'App\\Controller\\TimeLogController::viewTimeLogs'], null, null, null, false, false, null]],
    ],
    [ // $regexpList
        0 => '{^(?'
                .'|/_error/(\\d+)(?:\\.([^/]++))?(*:35)'
                .'|/edit/([^/]++)(*:56)'
                .'|/delete/([^/]++)(*:79)'
            .')/?$}sDu',
    ],
    [ // $dynamicRoutes
        35 => [[['_route' => '_preview_error', '_controller' => 'error_controller::preview', '_format' => 'html'], ['code', '_format'], null, null, false, true, null]],
        56 => [[['_route' => 'edit_time_log', '_controller' => 'App\\Controller\\TimeLogController::editTimeLog'], ['id'], ['GET' => 0, 'POST' => 1], null, false, true, null]],
        79 => [
            [['_route' => 'delete_time_log', '_controller' => 'App\\Controller\\TimeLogController::deleteTimeLog'], ['id'], ['GET' => 0], null, false, true, null],
            [null, null, null, null, false, false, 0],
        ],
    ],
    null, // $checkCondition
];
