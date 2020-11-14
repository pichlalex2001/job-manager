<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Route::get('userVerification/{token}', 'UserVerificationController@approve')->name('userVerification');
Auth::routes();

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Jobs
    Route::post('jobs/parse-csv-import', 'JobsController@parseCsvImport')->name('jobs.parseCsvImport');
    Route::post('jobs/process-csv-import', 'JobsController@processCsvImport')->name('jobs.processCsvImport');
    Route::resource('jobs', 'JobsController', ['except' => ['destroy']]);

    // Bewerbers
    Route::post('bewerbers/parse-csv-import', 'BewerberController@parseCsvImport')->name('bewerbers.parseCsvImport');
    Route::post('bewerbers/process-csv-import', 'BewerberController@processCsvImport')->name('bewerbers.processCsvImport');
    Route::resource('bewerbers', 'BewerberController', ['except' => ['destroy']]);

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Teams
    Route::delete('teams/destroy', 'TeamController@massDestroy')->name('teams.massDestroy');
    Route::resource('teams', 'TeamController');

    // Fragens
    Route::delete('fragens/destroy', 'FragenController@massDestroy')->name('fragens.massDestroy');
    Route::post('fragens/parse-csv-import', 'FragenController@parseCsvImport')->name('fragens.parseCsvImport');
    Route::post('fragens/process-csv-import', 'FragenController@processCsvImport')->name('fragens.processCsvImport');
    Route::resource('fragens', 'FragenController');

    // Antwortens
    Route::delete('antwortens/destroy', 'AntwortenController@massDestroy')->name('antwortens.massDestroy');
    Route::post('antwortens/parse-csv-import', 'AntwortenController@parseCsvImport')->name('antwortens.parseCsvImport');
    Route::post('antwortens/process-csv-import', 'AntwortenController@processCsvImport')->name('antwortens.processCsvImport');
    Route::resource('antwortens', 'AntwortenController');

    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');
    Route::get('global-search', 'GlobalSearchController@search')->name('globalSearch');
    Route::get('team-members', 'TeamMembersController@index')->name('team-members.index');
    Route::post('team-members', 'TeamMembersController@invite')->name('team-members.invite');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
// Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
