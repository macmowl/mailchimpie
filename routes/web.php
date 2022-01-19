<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailChimpController;

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

Route::get('/', [MailChimpController::class, 'manage'])->name('manage');

Route::prefix('subscriber')->group(function() {
    Route::get('/add', [MailChimpController::class, 'addSubscriber'])->name('subscriber.add');
    Route::post('/create', [MailChimpController::class, 'createSubscriber'])->name('subscriber.create');
    Route::get('/edit/{email}', [MailChimpController::class, 'editSubscriber'])->name('subscriber.edit');
    Route::post('/update/{email}', [MailChimpController::class, 'updateSubscriber'])->name('subscriber.update');
    Route::get('/delete/{email}', [MailChimpController::class, 'deleteSubscriber'])->name('subscriber.delete');
});
