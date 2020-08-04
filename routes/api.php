<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Events
    Route::post('events/media', 'EventsApiController@storeMedia')->name('events.storeMedia');
    Route::apiResource('events', 'EventsApiController');

    // Topics
    Route::apiResource('topics', 'TopicsApiController');

    // Boards
    Route::post('boards/media', 'BoardApiController@storeMedia')->name('boards.storeMedia');
    Route::apiResource('boards', 'BoardApiController');

    // Speakers
    Route::post('speakers/media', 'SpeakersApiController@storeMedia')->name('speakers.storeMedia');
    Route::apiResource('speakers', 'SpeakersApiController');

    // Schedules
    Route::apiResource('schedules', 'ScheduleApiController');

    // Sponsors
    Route::post('sponsors/media', 'SponsorsApiController@storeMedia')->name('sponsors.storeMedia');
    Route::apiResource('sponsors', 'SponsorsApiController');

    // Exhibitions
    Route::post('exhibitions/media', 'ExhibitionApiController@storeMedia')->name('exhibitions.storeMedia');
    Route::apiResource('exhibitions', 'ExhibitionApiController');

    // Exhibition Details
    Route::post('exhibition-details/media', 'ExhibitionDetailsApiController@storeMedia')->name('exhibition-details.storeMedia');
    Route::apiResource('exhibition-details', 'ExhibitionDetailsApiController');

    // Event Attendees
    Route::apiResource('event-attendees', 'EventAttendeesApiController', ['except' => ['store', 'update']]);

    // Specialties
    Route::apiResource('specialties', 'SpecialtiesApiController');

    // Contacts
    Route::apiResource('contacts', 'ContactsApiController');

    // Organizers
    Route::post('organizers/media', 'OrganizersApiController@storeMedia')->name('organizers.storeMedia');
    Route::apiResource('organizers', 'OrganizersApiController');

    // Countries
    Route::apiResource('countries', 'CountriesApiController');

    // Cities
    Route::apiResource('cities', 'CitiesApiController');
});
