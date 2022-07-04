<?php

use App\Http\Controllers\SoruController;
use App\Http\Livewire\SoruForm;
use App\Http\Livewire\SoruList;
use App\Http\Livewire\Tree;
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
    Route::get('/soru-ekle', SoruForm::class);
    Route::post('/soru-insert', [SoruController::class, 'insert']);
    Route::get('/soru-view/{id}', [SoruController::class, 'view']);
});
