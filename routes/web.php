<?php

use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\KepalaWarehouseController;
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
Route::get('/', [AdminAuthController::class, 'index'])->name('login');
Route::post('/proses', [AdminAuthController::class, 'doLogin'])->name('proses.login');
Route::get('/logout', [AdminAuthController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth', 'role:admin,Dokter']], function(){
    Route::get('beranda', [AdminController::class, 'beranda'])->name('beranda');
    Route::get('workOrder', [AdminController::class, 'kepalaProjectWorkorder'])->name('workorder.keproj');
    Route::get('workOrder/accepted/{id}', [AdminController::class, 'kepalaProjectAccepted'])->name('accepted.keproj');
    Route::get('cetakLP', [AdminController::class, 'cetakLP'])->name('cetak.laporanProject');
});

Route::group(['middleware' => ['auth', 'role:admin,Dokter']], function(){
    Route::get('user-Management', [AdminController::class, 'userManagement'])->name('user-Management');
    Route::post('user-Management', [AdminController::class, 'storeUser'])->name('user-Management.store');
    Route::delete('user-Management/{id}', [AdminController::class, 'destroyUser'])->name('user.delete');
    Route::get('update-User/{id}/edit', [AdminController::class, 'updateUser'])->name('update-User');
    Route::post('update-User/{id}/edit', [AdminController::class, 'updatedUser'])->name('updated-User');
    Route::get('warehouse-Management', [AdminController::class, 'warehouseManagement'])->name('warehouse-Management.admin');
    Route::post('warehouse-Management', [AdminController::class, 'storeWarehouse'])->name('warehouse-Management.store');
    Route::delete('warehouse-Management/{id}', [AdminController::class, 'destroyWarehouse'])->name('warehouse.delete');
    Route::get('update-Warehouse/{id}/edit', [AdminController::class, 'updateWarehouse'])->name('update-Warehouse');
    Route::post('update-Warehouse/{id}/edit', [AdminController::class, 'updatedWarehouse'])->name('updated-Warehouse');
    Route::get('data-Management', [AdminController::class, 'dataManagement'])->name('data-Management');
    Route::post('data-Management', [AdminController::class, 'storeData'])->name('data-Management.store');
    Route::post('data-Management/{id}', [AdminController::class, 'updateTindakan'])->name('data-Management.update');
    Route::get('update-Warehouse/{id}/edit', [AdminController::class, 'updateWarehouse'])->name('update-Warehouse');
    Route::post('update-Warehouse/{id}/edit', [AdminController::class, 'updatedWarehouse'])->name('updated-Warehouse');
    Route::delete('Project-Management/{id}', [AdminController::class, 'destroyProject'])->name('project.delete');
    Route::get('history', [AdminController::class, 'history'])->name('history.admin');
    Route::get('history/edit/{id}', [AdminController::class, 'updatePMB'])->name('history-edit.admin');
    Route::post('history/edit/{id}', [AdminController::class, 'updatedPMB'])->name('history-edit-store.admin');
    Route::delete('history/delete/{id}', [AdminController::class, 'destroyPMB'])->name('history-delete-store.admin');
    Route::get('cetakLaporan', [AdminController::class, 'cetakLaporan'])->name('cetak.laporan');
    Route::get('cetakLaporanPMB', [AdminController::class, 'cetakLaporanPMB'])->name('cetak.laporan.PMB');

    // Route::get('warehouse-Management', [AdminController::class, 'warehouseManagement'])->name('warehouse-Management.admin');
    // Route::post('warehouse-Management', [AdminController::class, 'storeWarehouse'])->name('warehouse-Management.store');
});

Route::group(['middleware' => ['auth', 'role:kepala_warehouse']], function(){
    Route::get('warehouse-Management/kepala', [KepalaWarehouseController::class, 'index'])->name('warehouse-Management.kepala');
    Route::get('history/kepala', [KepalaWarehouseController::class, 'indexHistory'])->name('history.kepala');
    // Route::post('warehouse-Management', [AdminController::class, 'storeWarehouse'])->name('warehouse-Management.store');
    // Route::delete('warehouse-Management/{id}', [AdminController::class, 'destroyWarehouse'])->name('warehouse.delete');
    Route::get('update-Warehouse/edit/{id}', [KepalaWarehouseController::class, 'updateWarehouse'])->name('update-Warehouse.kepala');
    Route::post('update-Warehouse/edit/', [KepalaWarehouseController::class, 'updatedWarehouse'])->name('updated-Warehouse.kepala');
    Route::get('cetak-history/masuk', [KepalaWarehouseController::class, 'cetakHistoryMasuk'])->name('cetak-history.masuk');
    Route::get('cetak-history/keluar', [KepalaWarehouseController::class, 'cetakHistoryKeluar'])->name('cetak-history.keluar');
});

Route::group(['middleware' => ['auth', 'role:admin,Dokter,direktur']], function(){
    // Route::get('update-Warehouse/{id}/edit', [AdminController::class, 'updateWarehouse'])->name('update-Warehouse');
    // Route::post('update-Warehouse/{id}/edit', [AdminController::class, 'updatedWarehouse'])->name('updated-Warehouse');
    Route::get('data-Management', [AdminController::class, 'dataManagement'])->name('data-Management');
    Route::get('update-Data/{id}/edit', [AdminController::class, 'updateData'])->name('update-Data');
    Route::post('update-Data/{id}/edit', [AdminController::class, 'updatedData'])->name('updated-Data');
});



