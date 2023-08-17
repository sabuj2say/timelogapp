<?php

// This file has been auto-generated by the Symfony Routing Component.

return [
    '_preview_error' => [['code', '_format'], ['_controller' => 'error_controller::preview', '_format' => 'html'], ['code' => '\\d+'], [['variable', '.', '[^/]++', '_format', true], ['variable', '/', '\\d+', 'code', true], ['text', '/_error']], [], [], []],
    'app_time_log' => [[], ['_controller' => 'App\\Controller\\TimeLogController::index'], [], [['text', '/time/log']], [], [], []],
    'edit_time_log' => [['id'], ['_controller' => 'App\\Controller\\TimeLogController::editTimeLog'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/edit']], [], [], []],
    'delete_time_log' => [['id'], ['_controller' => 'App\\Controller\\TimeLogController::deleteTimeLog'], [], [['variable', '/', '[^/]++', 'id', true], ['text', '/delete']], [], [], []],
    'export_time_log' => [[], ['_controller' => 'App\\Controller\\TimeLogController::exportTimeLog'], [], [['text', '/export']], [], [], []],
    'calculate_totals' => [[], ['_controller' => 'App\\Controller\\TimeLogController::calculateTotals'], [], [['text', '/calculate-totals']], [], [], []],
    'create_time_log' => [[], ['_controller' => 'App\\Controller\\TimeLogController::createTimeLog'], [], [['text', '/create']], [], [], []],
    'create_view_log' => [[], ['_controller' => 'App\\Controller\\TimeLogController::viewTimeLogs'], [], [['text', '/view']], [], [], []],
];
