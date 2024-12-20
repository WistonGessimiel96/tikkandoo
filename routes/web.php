<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserApiController;
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
Route::any('/utilisateurs/clients/{id?}', [AdminController::class, 'listUser']);
Route::any('/utilisateurs/type-utilisateur/{id?}', [AdminController::class, 'listTypeUser']);
Route::any('/forfaits/tickets/{id?}', [AdminController::class, 'listForfaitTicket']);
Route::any('/forfaits/abonnements/{id?}', [AdminController::class, 'listForfaitAbonnement']);

Route::get('/', function () {
    return view('pages.dashboard');
});

Route::any('/api/loginClient', [UserApiController::class, 'indexLogin']);
Route::any('/api/checkStatus', [UserApiController::class, 'indexCheck']);
Route::get('/api/getTicket', [UserApiController::class, 'getTicket']);
Route::get('/api/getAbonnement', [UserApiController::class, 'getAbonnement']);
Route::any('/api/register', [UserApiController::class, 'register']);
/*Route::get('/utilisateurs/clients', function () {
    return view('pages.utilisateurs.clients');
});*/
