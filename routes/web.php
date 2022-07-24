<?php

use App\Http\Controllers\SinavResimController;
use App\Http\Controllers\SoruController;
use App\Http\Livewire\GunlukSoru;
use App\Http\Livewire\SinavResimView;
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

    Route::get('/soru-add', [SoruController::class, 'add']);
    Route::get('/soru-edit/{id}', [SoruController::class, 'add']);
    Route::post('/soru-insert', [SoruController::class, 'insert']);
    Route::post('/soru-update/{id}', [SoruController::class, 'update']);

    Route::get('/soru-view/{id}', [SoruController::class, 'view'])->name(
        'soruview'
    );

    Route::get('/secenek-form/{id}/{secId}', [
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
    Route::get('/sinav-ekle', [SinavResimController::class, 'form']);
    Route::post('sinav-storefiles', [
        SinavResimController::class,
        'storefiles',
    ]);

    Route::get('/sinav-resim-view/{id}', SinavResimView::class)->name(
        'sinavresimview'
    );

    Route::get('/chartisan', function () {
        return view('chartisan', ['name' => 'James']);
    });
});
