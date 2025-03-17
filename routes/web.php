<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\SupplierController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\ReturPembelianController;
use App\Http\Controllers\LaporanReturController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\PengeluaranController;
use App\Http\Controllers\SaldoAwalController;
use App\Http\Controllers\LaporanController;
use App\Exports\LaporanExport;


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
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

// dashboardbootstrap
Route::get('/dashboardbootstrap', function () {
    return view('dashboardbootstrap');
})->middleware(['auth'])->name('dashboardbootstrap');

// Sebelum route resource
// // return view('supplier.view');
// Route::get('/supplier', [SupplierController::class, 'index'])->name('supplier.index');
// Route::get('/supplier/create', [SupplierController::class, 'create'])->name('supplier.create');
// Route::post('/supplier', [SupplierController::class, 'store'])->name('supplier.store');
// Route::get('/supplier/{supplier}/edit', [SupplierController::class, 'edit'])->name('supplier.edit');
// Route::put('/supplier/{supplier}', [SupplierController::class, 'update'])->name('supplier.update');
// Route::delete('/supplier/{id}', [SupplierController::class, 'destroy'])->name('supplier.destroy');
// Route::delete('/supplier/{supplier}', [SupplierController::class, 'destroy'])->name('supplier.destroy');


// // Route untuk master data barang
// Route::get('/barang', 'BarangController@index')->name('barang.index');
// Route::get('/barang', [BarangController::class, 'index'])->name('barang.index');
// Route::get('/barang/create', [BarangController::class, 'create'])->name('barang.create');
// Route::post('/barang', [BarangController::class, 'store'])->name('barang.store');
// Route::get('/barang/{barang}', [BarangController::class, 'show'])->name('barang.show');
// Route::get('/barang/{barang}/edit', [BarangController::class, 'edit'])->name('barang.edit');
// Route::put('/barang/{barang}', [BarangController::class, 'update'])->name('barang.update');
// Route::delete('/barang/destroy/{barang}', [BarangController::class, 'destroy'])->name('barang.destroy');
// Route::post('/barang/create', [BarangController::class, 'store']);
// Route::delete('/barang/{id}', 'BarangController@destroy')->name('barang.destroy');

// // return pembelian
// Route::get('/returpembelian', [ReturPembelianController::class, 'index'])->name('returpembelian.index');
// Route::get('/returpembelian/create', [ReturPembelianController::class, 'create'])->name('returpembelian.create');
// Route::post('/returpembelian', [ReturPembelianController::class, 'store'])->name('returpembelian.store');
// Route::get('/returpembelian/{returpembelian}/edit', [ReturPembelianController::class, 'edit'])->name('returpembelian.edit');
// Route::put('/returpembelian/{returpembelian}', [ReturPembelianController::class, 'update'])->name('returpembelian.update');
// Route::delete('/returpembelian/{returpembelian}', [ReturPembelianController::class, 'destroy'])->name('returpembelian.destroy');
// Route::DELETE('/returpembelian/destroy/{returpembelian}', [ReturPembelianController::class, 'destroy'])->name('returpembelian.destroy');

// route ke master data staff
// Route::get('/staff/create', [StaffController::class, 'create'])->name('staff.create');
// Route::post('/staff', [StaffController::class, 'store'])->name('staff.store');
// Route::get('/staff', [StaffController::class, 'index'])->name('staff.index');
// Route::put('/staff/{staff}', 'StaffController@update')->name('staff.update');
// Route::get('/staff/{staff}/edit', [StaffController::class, 'edit'])->name('staff.edit');
// Route::get('/staff/destroy/{id}', [App\Http\Controllers\StaffController::class,'destroy'])->middleware(['auth']);

Route::middleware(['auth'])->group(function () {
    Route::get('/staff', [StaffController::class, 'index'])->name('staff.index');
    Route::get('/staff/create', [StaffController::class, 'create'])->name('staff.create');
    Route::post('/staff', [StaffController::class, 'store'])->name('staff.store');
    Route::get('/staff/{staff}/edit', [StaffController::class, 'edit'])->name('staff.edit');
    Route::put('/staff/{staff}', [StaffController::class, 'update'])->name('staff.update');
    Route::delete('/staff/{staff}', [StaffController::class, 'destroy'])->name('staff.destroy');
});

// route ke master data akun
Route::middleware(['auth'])->group(function () {
    Route::get('/akun', [AkunController::class, 'index'])->name('akun.index');
    Route::get('/akun/create', [AkunController::class, 'create'])->name('akun.create');
    Route::post('/akun', [AkunController::class, 'store'])->name('akun.store');
    Route::get('/akun/{akun}/edit', [AkunController::class, 'edit'])->name('akun.edit');
    Route::put('/akun/{akun}', [AkunController::class, 'update'])->name('akun.update');
    Route::delete('/akun/{akun}', [AkunController::class, 'destroy'])->name('akun.destroy');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/saldo_awal', [SaldoAwalController::class, 'index'])->name('saldo_awal.index');
    Route::get('/saldo_awal/create', [SaldoAwalController::class, 'create'])->name('saldo_awal.create');
    Route::post('/saldo_awal', [SaldoAwalController::class, 'store'])->name('saldo_awal.store');
    Route::get('/saldo_awal/{saldo_awal}/edit', [SaldoAwalController::class, 'edit'])->name('saldo_awal.edit');
    Route::put('/saldo_awal/{saldo_awal}', [SaldoAwalController::class, 'update'])->name('saldo_awal.update');
    Route::delete('/saldo_awal/{saldo_awal}', [SaldoAwalController::class, 'destroy'])->name('saldo_awal.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/pengeluaran', [PengeluaranController::class, 'index'])->name('pengeluaran.index');
    Route::get('/pengeluaran/create', [PengeluaranController::class, 'create'])->name('pengeluaran.create');
    Route::post('/pengeluaran', [PengeluaranController::class, 'store'])->name('pengeluaran.store');
    Route::get('/pengeluaran/{pengeluaran}/edit', [PengeluaranController::class, 'edit'])->name('pengeluaran.edit');
    Route::put('/pengeluaran/{pengeluaran}', [PengeluaranController::class, 'update'])->name('pengeluaran.update');
    Route::delete('/pengeluaran/{pengeluaran}', [PengeluaranController::class, 'destroy'])->name('pengeluaran.destroy');
});
Route::resource('pengeluaran', PengeluaranController::class);

Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');


Route::get('/laporan/laporanretur', [LaporanReturController::class, 'laporanretur'])->name('laporanretur');
Route::get('/laporan/laporanretur/{periode}', [LaporanReturController::class, 'viewlaporanretur'])->name('laporan.viewlaporanretur');

Route::get('/laporan/cetak-pdf', [LaporanController::class, 'cetakPDF'])->name('laporan.cetak.pdf');
Route::get('/laporan/cetak-excel', [LaporanController::class, 'cetakExcel'])->name('laporan.cetak.excel');
require __DIR__.'/auth.php';