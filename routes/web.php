<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;

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

//Route::get('/', array('as'=> 'front.home', 'uses' => 'ItemController@itemView'));
Route::get('/', [ItemController::class, 'itemView']);
//Route::post('/update-items', array('as'=> 'update.items', 'uses' => 'ItemController@updateItems'));
Route::post('/update-items', [ItemController::class, 'updateItems'])->name('update.items');

Route::get('/dragdrop', [ItemController::class, 'show']);

Route::get('/workflow', [ItemController::class, 'workFlow']);

Route::get('/teste', function(){
    
    return view('teste');
});