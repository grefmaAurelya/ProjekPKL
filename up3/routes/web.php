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

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

   


Route::get('dashboard', function () {
   return view('layouts.master');
});



Route::group(['middleware' => 'auth'], function () {
    // Route::resource('categories','CategoryController');
    // Route::get('/apiCategories','CategoryController@apiCategories')->name('api.categories');
    // Route::get('/exportCategoriesAll','CategoryController@exportCategoriesAll')->name('exportPDF.categoriesAll');
    // Route::get('/exportCategoriesAllExcel','CategoryController@exportExcel')->name('exportExcel.categoriesAll');
    // Route::get('/exportCategory/{id}','CategoryController@exportCategory')->name('exportPDF.categories');

    // Route::resource('barangs','BarangController');
    
    // Route::get('/apiBarangs','BarangController@apiBarangs')->name('api.barangs');
    // Route::get('/exportBarangsAll','BarangController@exportBarangsAll')->name('exportPDF.barangsAll');
    // Route::get('/exportBarangsAllExcel','BarangController@exportExcel')->name('exportExcel.barangsAll');

    // Route::resource('spbdists','SpbdistController');
    // //Route::get('/spbdistsprodview','SpbdistController@prodfunct');
    // //Route::get('/spbdistfindProductName','SpbdistController@findProductName');
    // Route::get('/apiSpbdists','SpbdistController@apiSpbdists')->name('api.spbdists');
    // Route::get('/exportSpbdistsAll','SpbdistController@exportSpbdistsAll')->name('exportPDF.spbdistsAll');
    // Route::get('/exportSpbdistsAllExcel','SpbdistController@exportExcel')->name('exportExcel.spbdistsAll');

    Route::resource('pabrikans','PabrikanController');
    Route::get('/apiPabrikans','PabrikanController@apiPabrikan')->name('api.pabrikans');

    Route::resource('prks','PrkController');
    Route::get('/apiPrks','PrkController@apiPrks')->name('api.prks');

    Route::resource('spbs','SpbController');
    Route::get('/apiSpbs','SpbController@apiSpbs')->name('api.spbs');

    Route::resource('niagas','NiagaController');
    Route::get('/apiNiagas','NiagaController@apiNiaga')->name('api.niagas');
    Route::get('/exportNiagasAll','NiagaController@exportNiagasAll')->name('exportPDF.niagasAll');
    Route::get('/exportNiagasAllExcel','NiagaController@exportExcel')->name('exportExcel.niagasAll');

    Route::resource('distribusies','DistribusiController');
    Route::get('/apiDistribusies','DistribusiController@apiDistribusi')->name('api.distribusies');
    Route::get('/exportDistribusiesAll','DistribusiController@exportDistribusiesAll')->name('exportPDF.distribusiesAll');
    Route::get('/exportDistribusiesAllExcel','DistribusiController@exportExcel')->name('exportExcel.distribusiesAll');

    // Route::resource('rkapDistribusies','RkapDistribusiController');
    // Route::get('/apiRkapDistribusies','RkapDistribusiController@apiRkapDistribusi')->name('api.rkapDistribusies');
    // Route::get('/exportRkapDistribusiesAll','RkapDistribusiController@exportRkapDistribusiesAll')->name('exportPDF.rkapDistribusiesAll');
    // Route::get('/exportRkapDistribusiesAllExcel','RkapDistribusiController@exportExcel')->name('exportExcel.rkapDistribusiesAll');

    Route::resource('rkapDist','RkapDistribusiController');
    Route::get('/apiRkapDist','RkapDistribusiController@apiRkapDist')->name('api.rkapDist');
    Route::get('/exportRkapDistribusiAll','RkapDistribusiController@exportRkapDistribusiAll')->name('exportPDF.rkapDistribusiAll');
    Route::get('/exportRkapDistribusiAllExcel','RkapDistribusiController@exportExcel')->name('exportExcel.rkapDistribusiAll');
    
    Route::resource('rkapNiaga','RkapNiagaController');
    Route::get('/apiRkapNiaga','RkapNiagaController@apiRkapNiaga')->name('api.rkapNiaga');
    Route::get('/exportRkapNiagaAll','RkapNiagaController@exportRkapNiagaAll')->name('exportPDF.rkapNiagaAll');
    Route::get('/exportRkapNiagaAllExcel','RkapNiagaController@exportExcel')->name('exportExcel.rkapNiagaAll');
    
    Route::resource('penetapanNiaga','PenetapanNiagaController');
    Route::get('/apiPenetapanNiaga','PenetapanNiagaController@apiPenetapanNiaga')->name('api.penetapanNiaga');
    Route::get('/exportPenetapanNiagaAll','PenetapanNiagaController@exportPenetapanNiagaAll')->name('exportPDF.penetapanNiagaAll');
    Route::get('/exportPenetapanNiagaAllExcel','PenetapanNiagaController@exportExcel')->name('exportExcel.penetapanNiagaAll');
    
    Route::resource('penetapanDist','PenetapanDistribusiController');
    Route::get('/apiPenetapanDist','PenetapanDistribusiController@apiPenetapanDist')->name('api.penetapanDist');
    Route::get('/exportPenetapanDistribusiAll','PenetapanDistribusiController@exportPenetapanDistribusiAll')->name('exportPDF.penetapanDistribusiAll');
    Route::get('/exportPenetapanDistribusiAllExcel','PenetapanDistribusiController@exportExcel')->name('exportExcel.penetapanDistribusiAll');
    
    Route::resource('spbDist','SpbDistribusiController');
    Route::get('/apiSpbDist','SpbDistribusiController@apiSpbDist')->name('api.spbDist');
    Route::get('/exportSpbDistribusiAll','SpbDistribusiController@exportSpbDistribusiAll')->name('exportPDF.spbDistribusiAll');
    Route::get('/exportSpbDistribusiAllExcel','SpbDistribusiController@exportExcel')->name('exportExcel.spbDistribusiAll');
    
    // Route::resource('pemasoks','PemasokController');
    // Route::get('/apiPemasoks','PemasokController@apiPemasoks')->name('api.pemasoks');
    // Route::post('/importPemasoks','PemasokController@ImportExcel')->name('import.pemasoks');
    // Route::get('/exportPemasoksAll','PemasokController@exportPemasoksAll')->name('exportPDF.pemasoksAll');
    // Route::get('/exportPemasoksAllExcel','PemasokController@exportExcel')->name('exportExcel.pemasoksAll');


    // Route::resource('pemakais','PemakaiController');
    // Route::get('/apiPemakais','PemakaiController@apiPemakais')->name('api.pemakais');
    // Route::post('/importPemakais','PemakaiController@ImportExcel')->name('import.pemakais');
    // Route::get('/exportPemakaisAll','PemakaiController@exportPemakaisAll')->name('exportPDF.pemakaisAll');
    // Route::get('/exportPemakaisAllExcel','PemakaiController@exportExcel')->name('exportExcel.pemakaisAll');

    // Route::resource('barangsOut','BarangKeluarController');
    // Route::get('/apiBarangsOut','BarangKeluarController@apiBarangsOut')->name('api.barangsOut');
    // Route::get('/exportBarangKeluarAll','BarangKeluarController@exportBarangKeluarAll')->name('exportPDF.barangKeluarAll');
    // Route::get('/exportBarangKeluarAllExcel','BarangKeluarController@exportExcel')->name('exportExcel.barangKeluarAll');
    // Route::get('/exportBarangKeluar/{id}','BarangKeluarController@exportBarangKeluar')->name('exportPDF.barangKeluar');

    // Route::resource('barangsIn','BarangMasukController');
    // Route::get('/apiBarangsIn','BarangMasukController@apiBarangsIn')->name('api.barangsIn');
    // Route::get('/exportBarangMasukAll','BarangMasukController@exportBarangMasukAll')->name('exportPDF.barangMasukAll');
    // Route::get('/exportBarangMasukAllExcel','BarangMasukController@exportExcel')->name('exportExcel.barangMasukAll');
    // Route::get('/exportBarangMasuk/{id}','BarangMasukController@exportBarangMasuk')->name('exportPDF.barangMasuk');

    Route::resource('user', 'UserController');  
});

