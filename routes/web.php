<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Auth::routes();
// Admin

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

    // Audit Logs
    Route::resource('audit-logs', 'AuditLogsController', ['except' => ['create', 'store', 'edit', 'update', 'destroy']]);

    // Events
    Route::delete('events/destroy', 'EventsController@massDestroy')->name('events.massDestroy');
    Route::post('events/media', 'EventsController@storeMedia')->name('events.storeMedia');
    Route::post('events/ckmedia', 'EventsController@storeCKEditorImages')->name('events.storeCKEditorImages');
    Route::post('events/parse-csv-import', 'EventsController@parseCsvImport')->name('events.parseCsvImport');
    Route::post('events/process-csv-import', 'EventsController@processCsvImport')->name('events.processCsvImport');
    Route::resource('events', 'EventsController');

    // Topics
    Route::delete('topics/destroy', 'TopicsController@massDestroy')->name('topics.massDestroy');
    Route::post('topics/parse-csv-import', 'TopicsController@parseCsvImport')->name('topics.parseCsvImport');
    Route::post('topics/process-csv-import', 'TopicsController@processCsvImport')->name('topics.processCsvImport');
    Route::resource('topics', 'TopicsController');

    // Boards
    Route::delete('boards/destroy', 'BoardController@massDestroy')->name('boards.massDestroy');
    Route::post('boards/media', 'BoardController@storeMedia')->name('boards.storeMedia');
    Route::post('boards/ckmedia', 'BoardController@storeCKEditorImages')->name('boards.storeCKEditorImages');
    Route::post('boards/parse-csv-import', 'BoardController@parseCsvImport')->name('boards.parseCsvImport');
    Route::post('boards/process-csv-import', 'BoardController@processCsvImport')->name('boards.processCsvImport');
    Route::resource('boards', 'BoardController');

    // Speakers
    Route::delete('speakers/destroy', 'SpeakersController@massDestroy')->name('speakers.massDestroy');
    Route::post('speakers/media', 'SpeakersController@storeMedia')->name('speakers.storeMedia');
    Route::post('speakers/ckmedia', 'SpeakersController@storeCKEditorImages')->name('speakers.storeCKEditorImages');
    Route::post('speakers/parse-csv-import', 'SpeakersController@parseCsvImport')->name('speakers.parseCsvImport');
    Route::post('speakers/process-csv-import', 'SpeakersController@processCsvImport')->name('speakers.processCsvImport');
    Route::resource('speakers', 'SpeakersController');

    // Schedules
    Route::delete('schedules/destroy', 'ScheduleController@massDestroy')->name('schedules.massDestroy');
    Route::post('schedules/parse-csv-import', 'ScheduleController@parseCsvImport')->name('schedules.parseCsvImport');
    Route::post('schedules/process-csv-import', 'ScheduleController@processCsvImport')->name('schedules.processCsvImport');
    Route::resource('schedules', 'ScheduleController');

    // Sponsors
    Route::delete('sponsors/destroy', 'SponsorsController@massDestroy')->name('sponsors.massDestroy');
    Route::post('sponsors/media', 'SponsorsController@storeMedia')->name('sponsors.storeMedia');
    Route::post('sponsors/ckmedia', 'SponsorsController@storeCKEditorImages')->name('sponsors.storeCKEditorImages');
    Route::post('sponsors/parse-csv-import', 'SponsorsController@parseCsvImport')->name('sponsors.parseCsvImport');
    Route::post('sponsors/process-csv-import', 'SponsorsController@processCsvImport')->name('sponsors.processCsvImport');
    Route::resource('sponsors', 'SponsorsController');

    // Exhibitions
    Route::delete('exhibitions/destroy', 'ExhibitionController@massDestroy')->name('exhibitions.massDestroy');
    Route::post('exhibitions/media', 'ExhibitionController@storeMedia')->name('exhibitions.storeMedia');
    Route::post('exhibitions/ckmedia', 'ExhibitionController@storeCKEditorImages')->name('exhibitions.storeCKEditorImages');
    Route::resource('exhibitions', 'ExhibitionController');

    // Exhibition Details
    Route::delete('exhibition-details/destroy', 'ExhibitionDetailsController@massDestroy')->name('exhibition-details.massDestroy');
    Route::post('exhibition-details/media', 'ExhibitionDetailsController@storeMedia')->name('exhibition-details.storeMedia');
    Route::post('exhibition-details/ckmedia', 'ExhibitionDetailsController@storeCKEditorImages')->name('exhibition-details.storeCKEditorImages');
    Route::resource('exhibition-details', 'ExhibitionDetailsController');

    // Event Attendees
    Route::delete('event-attendees/destroy', 'EventAttendeesController@massDestroy')->name('event-attendees.massDestroy');
    Route::resource('event-attendees', 'EventAttendeesController', ['except' => ['create', 'store', 'edit', 'update']]);

    // Specialties
    Route::delete('specialties/destroy', 'SpecialtiesController@massDestroy')->name('specialties.massDestroy');
    Route::post('specialties/parse-csv-import', 'SpecialtiesController@parseCsvImport')->name('specialties.parseCsvImport');
    Route::post('specialties/process-csv-import', 'SpecialtiesController@processCsvImport')->name('specialties.processCsvImport');
    Route::resource('specialties', 'SpecialtiesController');

    // Contacts
    Route::delete('contacts/destroy', 'ContactsController@massDestroy')->name('contacts.massDestroy');
    Route::resource('contacts', 'ContactsController');

    // Organizers
    Route::delete('organizers/destroy', 'OrganizersController@massDestroy')->name('organizers.massDestroy');
    Route::post('organizers/media', 'OrganizersController@storeMedia')->name('organizers.storeMedia');
    Route::post('organizers/ckmedia', 'OrganizersController@storeCKEditorImages')->name('organizers.storeCKEditorImages');
    Route::resource('organizers', 'OrganizersController');

    // Countries
    Route::delete('countries/destroy', 'CountriesController@massDestroy')->name('countries.massDestroy');
    Route::resource('countries', 'CountriesController');

    // Cities
    Route::delete('cities/destroy', 'CitiesController@massDestroy')->name('cities.massDestroy');
    Route::post('cities/parse-csv-import', 'CitiesController@parseCsvImport')->name('cities.parseCsvImport');
    Route::post('cities/process-csv-import', 'CitiesController@processCsvImport')->name('cities.processCsvImport');
    Route::resource('cities', 'CitiesController');

    Route::get('system-calendar', 'SystemCalendarController@index')->name('systemCalendar');
    Route::get('global-search', 'GlobalSearchController@search')->name('globalSearch');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
// Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
    }
});
