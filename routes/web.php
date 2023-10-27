<?php

use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('index');
// });
Route::get('/',[TodoController::class,'index'])->name('index');
Route::post('/add',[TodoController::class,'addlist'])->name('add.list');
Route::get('/edit',[TodoController::class,'Editlist'])->name('edit.list');
Route::put('/update',[TodoController::class,'updatelist'])->name('update.list');
Route::delete('delete',[TodoController::class,'deletelist'])->name('delete.list');
Route::get('/pagination',[TodoController::class,'Paginate'])->name('pagination.list');



