<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    $dir_base_path = base_path().'/';
    $dir_base_path = str_replace('\\', '/', $dir_base_path);
    $dir_weka_class_path = $dir_base_path.'dependency/weka.jar';
    return $dir_weka_class_path;
});

Route::prefix('admin')->name('admin.')->group(function(){
    Route::get('dashboard/chart', 'DashboardController@getChartBidangXRekomendasi')->name('dashboard.chart');
    Route::resource('dashboard', DashboardController::class);
    Route::get('dataset/splitdata', 'DatasetController@splitData')->name('dataset.splitdata');
    Route::get('dataset/applymodel', 'DatasetController@applyModel')->name('dataset.applymodel');
    Route::resource('dataset', DatasetController::class);
    Route::get('training/train', 'DataTrainingController@trainData')->name('training.train');
    Route::resource('training', DataTrainingController::class);
    Route::get('testing/test', 'DataTestingController@testData')->name('testing.test');
    Route::get('testing/cof', 'DataTestingController@getConfusionMatrix')->name('testing.cof');
    Route::resource('testing', DataTestingController::class);
    Route::get('decisiontree/usemodel', 'DecisionTreeController@useModel')->name('decisiontree.usemodel');
    Route::resource('decisiontree', DecisionTreeController::class);
    Route::get('recommendation/createbytree/{id}', 'RecommendationController@createBYtree')->name('recommendation.createbytree');
    Route::resource('recommendation', RecommendationController::class);
    Route::resource('configuration', ConfigurationController::class);
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
