<?php
$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    $api->group(['prefix' => 'admin'], function ($api) {
        $api->get('activity-logs', 'Vicoders\ActivityLog\Contracts\Controllers\Api\Admin\ActivityLogInterface@index');
    });
});
