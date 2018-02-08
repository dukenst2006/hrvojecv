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

///// GUEST ROUTES //////
Route::GET('/', function () {
    return view('welcome');
});

// INDEX PAGE
Route::GET('/test', function () {
    return view('carousel');
});

// LOGIN ROUTE
Route::GET('login/{hash}', 'Auth\LoginController@showLoginForm')->name('login');
Route::POST('login/{hash}', 'Auth\LoginController@login');

// REQUEST TO VIEW CV SUBMISSION ROUTE
Route::POST('accessrequest', 'AccessController@incomingRequest')->name('access');

Route::POST('lostLoginData', 'AccessController@sendForgottenLoginData')->name('lostLoginData');



////////// AUTH ROUTES //////////////
///
Route::group(['prefix' => 'cv', 'middleware' => 'auth'], function() {

    // DASHBOARD INDEX ROUTE
	Route::GET('/', 'HomeController@index')->name('home');
	
	// LOGOUT ROUTE
    Route::POST('logout', 'Auth\LoginController@logout')->name('logout');

    // Registration Routes
    Route::GET('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
    Route::POST('register', 'Auth\RegisterController@register');

    // PROJECTS ROUTES
    Route::resource('projects','ProjectController');

    // PERSONAL INFO ROUTES
    Route::resource('personal_info','Cv\PersonalInfoController', ['except' => ['show', 'delete']]);

    // WORK EXPERIENCE ROUTES
    Route::resource('work_experience','Cv\WorkExperienceController');

    // EDUCATION ROUTES
    Route::resource('education','Cv\EducationController', ['except' => ['delete', 'show']]);

    // LANGUAGE ROUTES
    Route::resource('language','Cv\LanguageController', ['except' => ['delete', 'show']]);

    // USER ROUTES
    Route::resource('users', 'UserController', ['except' => 'delete']);

    // JOB ROUTES
    Route::resource('job_offer', 'JobController');

    // SHOW USER POSTED JOB
    Route::GET('job_offer/{id}/show', 'JobController@userJobShow')->name('userJobShow');
    // TOGGLE USER JOB STATUS
    Route::POST('job_offer/{id}', 'JobController@toggleStatus')->name('toggleStatus');

    // USER MESSAGE ON JOB PAGE
    Route::POST('job_offer/{id}/send', 'MessageController@storeJobMessage')->name('job.message.send');
    // ADMIN MESSAGE ON JOB PAGE
    Route::POST('job_offer/{id}/admin_send', 'MessageController@storeAdminJobMessage')->name('job.admin.message');

    // CONTACT FORM ROUTES
    Route::GET('contact/{id}', 'MessageController@showContactForm')->name('contact.create');
    Route::POST('contact/{id}', 'MessageController@store')->name('contact.store');

    //ADMIN CONTACT MESSAGES
    Route::GET('contact_messages', 'MessageController@adminIndex')->name('contact.msg.index');
    Route::POST('contact_messages/send', 'MessageController@adminSend')->name('contact.admin.send');

    // SOURCE FILES ROUTES
    Route::GET('source_files', 'DownloadSourceController@sourceFilesIndex')->name('files.index');
    Route::GET('files/create', 'DownloadSourceController@create')->name('files.create');
    Route::POST('files', 'DownloadSourceController@store')->name('files.store');
    Route::DELETE('source_files/{filename}', 'DownloadSourceController@destroy')->name('files.destroy');
    Route::GET('download/{filename}/{type}', 'DownloadSourceController@downloadFile');

    // SCREENSHOTS ROUTES (ALL SAME AS FOR SOURCE FILES EXCEPT INDEX)
    Route::get('screenshots', 'DownloadSourceController@screenshotsIndex')->name('screenshots.index');

    // DOWNLOAD CV IN PDF
    Route::get('download_cv_in_pdf', 'DownloadSourceController@downloadPdfCv')->name('pdfCvDownload');

    //change password routes
    Route::get('change_password/{id}', 'UserController@userEditPassword')->name('change.password');
    Route::put('change_password/{id}', 'UserController@changePassword')->name('post.change.pass');

    // CHANGELOG
    Route::resource('changelog', 'ChangelogController');

    


});