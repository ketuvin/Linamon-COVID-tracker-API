<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->group(function() {
    
    Route::post('login', 'Api\AuthController@login');
    Route::get('barangays', 'Api\BarangayController@showAllBrgy');
    Route::get('puis', 'Api\PuiController@showAllPui');
    Route::get('pums', 'Api\PumController@showAllPum');
    Route::get('covid-cases', 'Api\LaCovidCaseController@showAllCovidCases');

    Route::group(['middleware' => 'auth:api'], function() {
        Route::post('logout', 'Api\AuthController@logout');
        Route::post('users', 'Api\UserController@createUser');
        Route::get('users', 'Api\UserController@showAllUsers');
        Route::delete('users', 'Api\UserController@deleteUser');
        Route::get('users/{user_id}', 'Api\UserController@showUser');
        Route::put('users/{user_id}', 'Api\UserController@updateUser');
        Route::get('roles', 'Api\RoleController@showAllRoles');
        Route::post('roles', 'Api\RoleController@createRole');
        Route::delete('roles', 'Api\RoleController@deleteRole');
        Route::get('roles/{role_id}', 'Api\RoleController@showRole');
        Route::put('roles/{role_id}', 'Api\RoleController@updateRole');
        Route::post('barangays', 'Api\BarangayController@createBrgy');
        Route::delete('barangays', 'Api\BarangayController@deleteBrgy');
        Route::put('barangays/{barangay_id}', 'Api\BarangayController@updateBrgy');
        Route::post('puis', 'Api\PuiController@createPui');
        Route::delete('puis', 'Api\PuiController@deletePui');
        Route::get('puis/{pui_id}', 'Api\PuiController@showPui');
        Route::put('puis/{pui_id}', 'Api\PuiController@updatePui');
        Route::get('puis/barangays/{barangay_id}', 'Api\PuiController@showAllPuiByBrgy');
        Route::post('pums', 'Api\PumController@createPum');
        Route::delete('pums', 'Api\PumController@deletePum');
        Route::get('pums/{pum_id}', 'Api\PumController@showPum');
        Route::put('pums/{pum_id}', 'Api\PumController@updatePum');
        Route::get('pums/barangays/{barangay_id}', 'Api\PumController@showAllPumByBrgy');
        Route::post('covid-cases', 'Api\LaCovidCaseController@createCovidCase');
        Route::delete('covid-cases', 'Api\LaCovidCaseController@deleteCovidCase');
        Route::get('covid-cases/{covid_case_id}', 'Api\LaCovidCaseController@showCovidCase');
        Route::put('covid-cases/{covid_case_id}', 'Api\LaCovidCaseController@updateCovidCase');
        Route::get('covid-cases/barangays/{barangay_id}', 'Api\LaCovidCaseController@showAllCovidCasesByBrgy');
    });
});