<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

// Route::get('/', function () {
//     return view('welcome');
// });





//Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::get('admin', function () {
        return view('admin.admin_template');
    });
    
    route::get('dashboard','DashboardController@index')->name('dashboard');
    route::get('/','DashboardController@index')->name('/');
    Route::resource('roles', 'RoleController');
    Route::resource('users', 'UserController');
    Route::resource('department', 'DepartmentController');
    Route::resource('section', 'SectionController');
    Route::resource('assets', 'AssetsController');
    Route::resource('assetspatrol', 'AssetsPatrolController');

    Route::get('users.datauser', 'UserController@getData')->name('users.datauser');
    Route::get('usersd/{id}', 'UserController@destroy')->name('users.destroyd');
    Route::get('userss/getRegion','UserController@getRegion');
    Route::get('users.showProfile.{id}','UserController@showProfile')->name('users.showProfile');
    Route::patch('users.updateProfile.{id}','UserController@updateProfile')->name('users.updateProfile');

    Route::get('rolesd/{id}','RoleController@destroy')->name('roles.destroyd');
    Route::get('roles.dataroles', 'RoleController@getData')->name('roles.dataroles');
    
    Route::get('department.datadepartment','DepartmentController@getData')->name('department.datadepartment');
    
    Route::get('section.datasection','SectionController@getData')->name('section.datasection');

    Route::get('assets.dataassets','AssetsController@dataassets')->name('assets.dataassets');
    Route::get('assets.fileImport','AssetsController@fileImport')->name('assets.fileImport');
    Route::get('assets.prepatrol','AssetsController@prePatrol')->name('assets.prepatrol');
    Route::post('assets.import', 'AssetsController@import')->name('assets.import');

    Route::get('assetspatrol.searchAsset','AssetsPatrolController@searchAsset')->name('assetspatrol.searchAsset');
    Route::get('assetspatrol.export','AssetsPatrolController@export')->name('assetspatrol.export');

});
