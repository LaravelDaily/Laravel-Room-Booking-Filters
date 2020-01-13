<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:api']], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Hotels
    Route::apiResource('hotels', 'HotelsApiController');

    // Room Types
    Route::apiResource('room-types', 'RoomTypesApiController');

    // Rooms
    Route::apiResource('rooms', 'RoomsApiController');

    // Bookings
    Route::apiResource('bookings', 'BookingsApiController');
});
