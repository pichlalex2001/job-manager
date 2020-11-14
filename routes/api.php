<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Jobs
    Route::apiResource('jobs', 'JobsApiController', ['except' => ['destroy']]);

    // Bewerbers
    Route::apiResource('bewerbers', 'BewerberApiController', ['except' => ['destroy']]);

    // Teams
    Route::apiResource('teams', 'TeamApiController');

    // Fragens
    Route::apiResource('fragens', 'FragenApiController');

    // Antwortens
    Route::apiResource('antwortens', 'AntwortenApiController');
});
