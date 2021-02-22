<?php

use App\Http\Controllers\SupplierController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/supplier', [SupplierController::class, 'index'])->name('supplier.index');
Route::get('/supplier/add', [SupplierController::class, 'create'])->name('supplier.add');
Route::get('/supplier/livesearch', [SupplierController::class, 'livesearch'])->name('livesearch');
Route::post('/supplier/save', [SupplierController::class, 'store'])->name('supplier.save');
// Route::get('/supplier/search',[SupplierController@search])->name('supplier.search');
Route::get('/supplier/edit/{supplier_id}', [SupplierController::class, 'singleSupplier'])->name('supplier.edit');
Route::post('/supplier/edit/{supplier_id}/update', [SupplierController::class, 'update'])->name('supplier.update');
Route::get('/supplier/delete/{supplier_id}', [SupplierController::class, 'delete'])->name('supplier.delete');
require __DIR__.'/auth.php';
