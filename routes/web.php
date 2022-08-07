<?php

use App\Http\Controllers\KagitSinavController;
use App\Http\Controllers\SoruController;
use App\Http\Livewire\GunlukSoru;
use App\Http\Livewire\Harun;
use App\Http\Livewire\KagitSinavlar;
use App\Http\Livewire\KagitSinavView;
use App\Http\Livewire\SoruList;
use App\Http\Livewire\Tree;
use App\Http\Livewire\Yeni;
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

Route::get('lang/{lang}', [
    'as' => 'lang.switch',
    'uses' => 'App\Http\Controllers\LanguageController@switchLang',
]);

Route::get('/dashboard', function () {
    return view('dashboard');
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

require __DIR__ . '/auth.php';

Route::get('/kapsam', Tree::class);

Route::middleware(['auth'])->group(function () {
    Route::get('/soru-list', SoruList::class);
    Route::get('/soru/{action}/{id}', Yeni::class);

    Route::get('/esoru/{id}', [SoruController::class, 'view'])->name(
        'soruview'
    );
    Route::get('/esoru-form/{id?}', [SoruController::class, 'form']);
    Route::post('/soru-insert', [SoruController::class, 'insert']);
    Route::post('/soru-update/{id}', [SoruController::class, 'update']);
    Route::get('/esoru-publish/{id}', [SoruController::class, 'publish']);

    // Route::get('/item/form/{id?}', [ItemController::class, 'form']);
    // Route::post('/item/c/{id?}', [ItemController::class, 'crud-c']);
    // Route::get('/item/r/{id?}', [ItemController::class, 'crud-c']);
    // Route::post('/item/u/{id}', [ItemController::class, 'crud-u']);
    // Route::post('/item/d/{id}', [ItemController::class, 'crud-d']);

    Route::get('/esoru/secenek-form/{id}/{secId?}', [
        SoruController::class,
        'secenekForm',
    ]);
    Route::post('/secenek-ins/{id}', [SoruController::class, 'insertSecenek']);
    Route::post('/secenek-upd/{id}/{secId}', [
        SoruController::class,
        'updateSecenek',
    ]);

    Route::post('/secenek-del/{id}/{secId}', [
        SoruController::class,
        'deleteSecenek',
    ]);

    Route::get('/gunluk-soru/{tur}', GunlukSoru::class);
    Route::get('/kagit-sinav/{id?}', [KagitSinavController::class, 'form']);
    Route::post('sinav-storefiles/{id?}', [
        KagitSinavController::class,
        'storefiles',
    ]);

    Route::get('/kagit-sinav-view/{id}', KagitSinavView::class)->name(
        'viewkagitsinav'
    );

    Route::get('/kagit-sinavlar', KagitSinavlar::class);

    Route::get('/harun', Harun::class);

    // Route::get('/harun', function () {
    //     return view('chartisan', ['name' => 'James']);
    // });
});
