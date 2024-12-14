<?php

use App\Http\Controllers\AdminController;
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
Route::any('/utilisateurs/clients', [AdminController::class, 'listUser']);

Route::get('/', function () {
    return view('pages.dashboard');
});
/*Route::get('/utilisateurs/clients', function () {
    return view('pages.utilisateurs.clients');
});*/
