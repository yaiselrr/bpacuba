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
Route::get('/', 'HomeController@index')->name('home')->middleware('visitors');

Route::prefix('home')->namespace('Home')->name('home.')->group(function () {
    Route::get('/about', 'AboutController@index')->name('about');
    Route::get('/survey', 'SurveyController@create')->name('survey');
    Route::get('/search', 'SearchController@index')->name('search');
    Route::post('/survey/store', 'SurveyController@store')->name('survey.store');
    Route::get('/notes', 'StaticController@notes')->name('notes');
    Route::get('/questions', 'QuestionsController@index')->name('questions');
    Route::get('/service/{service}', 'ServicesController@index')->name('service');
    Route::post('/service/store', 'ServicesController@store')->name('service.store');
    Route::get('/info/{info}', 'GeneralInfoController@index')->name('info');
    Route::get('/atms', 'AtmController@index')->name('atms');
    Route::get('/news', 'NewsController@index')->name('news');
    Route::get('/news/{news}', 'NewsController@show')->name('news.details');
    Route::get('/downloads', 'DownloadsController@index')->name('downloads');
    Route::get('/apps', 'AppsController@index')->name('apps');
    Route::get('/service/{service}/{slug}', 'ServicesController@page')->name('pages');
    Route::get( '/download/{file}/{id}', 'DownloadsController@download')->name('download');
    Route::get('/offices', 'OfficesController@index')->name('offices');
    Route::get('/contact', 'ContactController@index')->name('contact');
    Route::post('/contact-store', 'ContactController@store')->name('contact.store');
});
Route::get('/login', 'BpaController@showLoginForm')->name('login');
Route::post('/login', 'BpaController@login');
Route::post('/logout', 'BpaController@logout')->name('logout');

Route::prefix('admin')->middleware('auth')->name('admin.')->group(function () {
    Route::get('/', 'AdminController@index')->name('index');
    Route::name('manager.')->group(function () {
        Route::resource('/users', 'Admin\UsersController',
            ['except'=>['show']]);
        Route::get('/users/password-reset/{user}/edit', 'Admin\UsersController@editPassword')
            ->name('users.password-reset');
        Route::put('/users/password-reset/{user}', 'Admin\UsersController@updatePassword')
            ->name('users.password-update');
        Route::resource('/roles', 'Admin\RolesController',
            ['except'=>['show']]);
    });

    Route::name('nomenclator.')->group(function () {
        Route::resource('/type-offices', 'Admin\OfficesTypeController',
            ['except'=>['show']]);
        Route::resource('/ranks', 'Admin\RanksController',
            ['except'=>['show']]);
        Route::resource('/provinces', 'Admin\ProvincesController',
            ['except'=>['show']]);
        Route::resource('/municipalities', 'Admin\MunicipalitiesController',
            ['except'=>['show']]);
    });
    Route::name('content.')->group(function () {
        Route::resource('/news', 'Admin\NewsController',
            ['except'=>['show']]);
        Route::resource('/downloads', 'Admin\DownloadsController',
            ['except'=>['show']]);
        Route::resource('/questions', 'Admin\QuestionsController',
            ['except'=>['show']]);
        Route::resource('/apps', 'Admin\AppsController',
            ['except'=>['show']]);
        Route::resource('/staff', 'Admin\StaffController',
            ['except'=>['show']]);
        Route::resource('/socials', 'Admin\SocialController',
            ['except'=>['show']]);
        Route::resource('/contacts', 'Admin\ContactsController',
            ['except'=>['create','store','destroy','show']]);
        Route::resource('/sucursal', 'Admin\SucursalController',
            ['except'=>['show']]);
        Route::resource('/carousels', 'Admin\CarouselsController',
            ['except'=>['show']]);
        Route::resource('/links', 'Admin\LinksController',
            ['except'=>['show']]);
        Route::resource('/atms', 'Admin\AtmController',
            ['except'=>['show']]);
        Route::resource('/offices', 'Admin\OfficesController',
            ['except'=>['show']]);
        Route::resource('/pages', 'Admin\PagesController',
            ['except'=>['show']]);
//        Route::resource('/surveys', 'Admin\SurveysController',
//            ['except'=>['show']]);
        Route::resource('/squestions', 'Admin\SurveyQuestionsController',
            ['except'=>['show']]);
//        Route::resource('/consults', 'Admin\ConsultsController',
//            ['except'=>['create','store','destroy','show']]);
        Route::resource('/electronic-bank', 'Admin\ElectronicBankController',
            ['except'=>['create','store','destroy']]);
        Route::resource('/corporative-bank', 'Admin\CorporativeBankController',
            ['except'=>['create','store','destroy','show']]);
        Route::resource('/personal-bank', 'Admin\PersonalBankController',
            ['except'=>['create','store','destroy','show']]);
        Route::resource('/tcp-cna', 'Admin\TcpCnaController',
            ['except'=>['create','store','destroy','show']]);
        Route::resource('/taxes', 'Admin\TaxesController',
            ['except'=>['create','store','destroy','show']]);
        Route::resource('/international-activity', 'Admin\InternationalController',
            ['except'=>['create','store','destroy','show']]);
        Route::resource('/interes', 'Admin\InteresController',
            ['except'=>['create','store','destroy','show']]);
        Route::resource('/terms', 'Admin\TermsController',
            ['except'=>['create','store','destroy','show']]);
        Route::resource('/finances-info', 'Admin\FinancesController',
            ['except'=>['create','store','destroy','show']]);
        Route::resource('/about-us', 'Admin\AboutController',
            ['except'=>['create','store','destroy','show']]);
        Route::get('/statics', 'Admin\StaticsController@index')
            ->name('statics.index');
        Route::get('/statics/{static}/edit', 'Admin\StaticsController@edit')
            ->name('statics.edit');
        Route::put('/statics/{static}', 'Admin\StaticsController@update')
            ->name('statics.update');
    });

});