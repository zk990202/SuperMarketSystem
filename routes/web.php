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
    return view('welcome');
});

Route::group(['middleware' => 'RoleControlAdmin'], function (){
    //查看商品信息
    Route::get('/select-page/products', 'MainController@selectPageProducts');
    Route::get('/select-page/sales', 'MainController@selectPageSales');
    //查看销售信息
    Route::post('/select/products', 'MainController@selectProducts');
    Route::post('/select/sales', 'MainController@selectSales');
});


Route::group(['middleware' => 'RoleControlManagement'], function (){
    //下架商品
    Route::get('/drop-off-page', ['uses' => 'MainController@dropOffPage', 'as' => 'drop-off-page']);
    Route::post('/drop-off', 'MainController@dropOff');

    //统计销售情况
    Route::get('/statistics/day', 'MainController@statisticsDay');
    Route::get('/statistics/week', 'MainController@statisticsWeek');
    Route::get('/statistics/month', 'MainController@statisticsMonth');
    Route::get('/statistics/season', 'MainController@statisticsSeason');
    Route::get('/statistics/year', 'MainController@statisticsYear');
    //导出Excel
    Route::post('/excel/export', 'MainController@excelExport');
});


Route::group(['middleware' => 'RoleControlPurchase'], function (){
    //对缺货的商品进行进货
    Route::get('/purchase-page', 'MainController@purchasePage');
    Route::post('/purchase', 'MainController@purchase');
});


Route::group(['middleware' => 'RoleControlCustomer'], function (){
    //模拟销售
    Route::get('/sale-page', 'MainController@salePage');
    Route::post('/sale', 'MainController@sale');
});



Route::get('test', 'MainController@test');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
