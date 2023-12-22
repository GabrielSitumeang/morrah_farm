<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\KerbauController;
use App\Http\Controllers\OngkirController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\HomeSliderController;
use App\Http\Controllers\UserRatingController;
use App\Http\Controllers\AkunPembeliController;
use App\Http\Controllers\BerandaManagerController;
use App\Http\Controllers\BerandaPembeliController;
use App\Http\Controllers\PesananPembeliController;
use App\Http\Controllers\ProduksiProdukController;
use App\Http\Controllers\BerandaPeternakController;
use App\Http\Controllers\BerandaProduksiController;
use App\Http\Controllers\AdminAkunSettingController;
use App\Http\Controllers\LaporanPenjualanController;
use App\Mail\KirimPesan;

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

Route::group(['middleware' => 'prevent-back-history'], function () {


    //MANAGER
    Route::prefix('manager')->middleware(['auth', 'auth.manager'])->group(function () {
        //ini route khusus untuk Manager
        Route::get('beranda', [BerandaManagerController::class, 'index'])->name('manager.beranda');
        Route::get('customer', [BerandaManagerController::class, 'customer'])->name('manager.customer');
        Route::resource('user', UserController::class);
        Route::resource('produk', ProdukController::class);
        Route::get('produk-edit-stok/{id}', [ProdukController::class, 'editStok'])->name('produk.edit.stok');
        Route::get('produk-edit-kadaluwarsa/{id}', [ProdukController::class, 'editKadaluwarsa'])->name('produk.edit.kadaluwarsa');
        Route::resource('about', AboutController::class);
        Route::resource('home-sliders', HomeSliderController::class);
        Route::get('/akun-manager/{id}/edit', [AdminAkunSettingController::class, 'edit'])->name('akun-manager.edit');
        Route::put('/akun-manager/{id}', [AdminAkunSettingController::class, 'update'])->name('akun-manager.update');
        Route::resource('cetaklaporan', LaporanPenjualanController::class);


        //BLOGS
        Route::get('/blog', [BlogController::class, 'index'])->name('blog.manager');
        Route::get('/blog/create', [BlogController::class, 'create'])->name('blog.create');
        Route::post('/blog/post', [BlogController::class, 'store'])->name('blog.store');
        // Route untuk menampilkan halaman edit blog
        Route::get('/blog/edit/{id}', [BlogController::class, 'edit'])->name('blog.edit');

        // Route untuk menghandle aksi update blog
        Route::put('/blog/update/{id}', [BlogController::class, 'update'])->name('blog.update');

        // Route untuk menghandle aksi hapus blog
        Route::delete('/blog/delete/{id}', [BlogController::class, 'destroy'])->name('blog.delete');

        Route::get('/order-details', [PesanController::class, 'orderDetails'])->name('order.detail');
        Route::get('/confirm-order-process/{id}', [PesanController::class, 'confirmOrdersProcess'])->name('order.confirm.process');
        Route::get('/result-file/{id}', [PesanController::class, 'resultFile'])->name('result.file');
        Route::get('/detail-pembelian/{id}', [PesanController::class, 'detailPembelian'])->name('detail.pembelian');

        // Route::get('/confirm-photo', [PesanController::class, 'confirmPhoto'])->name('confirm.photo');
        // Route::post('/confirm-photo-process/{id}', [PesanController::class, 'confirmPhotoProcess'])->name('confirm.photo.process');

        Route::get('/tracking', [PesanController::class, 'tracking'])->name('order.tracking');
        Route::get('/form-tracking/{id}', [PesanController::class, 'formTracking'])->name('form.tracking');
        Route::post('/form-tracking-process/{id}', [PesanController::class, 'formTrackingProcess'])->name('form.tracking.process');

        Route::get('/order-finish', [PesanController::class, 'orderResult'])->name('order.finish');
        Route::get('/order-finish/{id}', [PesanController::class, 'orderResultUpload'])->name('order.finish.upload');

        Route::get('kerbau', [BerandaManagerController::class, 'kerbau'])->name('manager.kerbau');
        Route::get('susu', [BerandaManagerController::class, 'susu'])->name('manager.susu');
        Route::get('laporan-produksi', [BerandaManagerController::class, 'laporanProduksi'])->name('manager.laporan-produksi');
        Route::get('/susu/search', 'BerandaManagerController@sususearch')->name('susu.search');
        Route::get('/kerbau/search', 'BerandaManagerController@kerbausearch')->name('kerbau.search');
        Route::get('/laporan-produksi/search', 'BerandaManagerController@laporanProduksiSearch')->name('laporan-produksi.search');

        Route::get('/ongkir', [OngkirController::class, 'index'])->name('ongkir.manager');
        Route::get('/ongkir/create', [OngkirController::class, 'create'])->name('ongkir.create');
        Route::post('/ongkir/post', [OngkirController::class, 'store'])->name('ongkir.store');
        Route::get('/ongkir/edit/{id}', [OngkirController::class, 'edit'])->name('ongkir.edit');
        Route::put('/ongkir/update/{id}', [OngkirController::class, 'update'])->name('ongkir.update');
        Route::delete('/ongkir/delete/{id}', [OngkirController::class, 'destroy'])->name('ongkir.delete');


        // Rute untuk laporan
        Route::get('laporan', [BerandaManagerController::class, 'laporan'])->name('manager.laporan');
        Route::get('cetak-laporan', [BerandaManagerController::class, 'cetakLaporan'])->name('cetak-laporan');
        Route::get('/cetak-laporan-form', [BerandaManagerController::class, 'cetakForm'])->name('cetak-laporan-form');

        Route::get('/ongkir', [OngkirController::class, 'index'])->name('ongkir.manager');
        Route::get('/ongkir/create', [OngkirController::class, 'create'])->name('ongkir.create');
        Route::post('/ongkir/post', [OngkirController::class, 'store'])->name('ongkir.store');
        Route::get('/ongkir/edit/{id}', [OngkirController::class, 'edit'])->name('ongkir.edit');
        Route::put('/ongkir/update/{id}', [OngkirController::class, 'update'])->name('ongkir.update');
        Route::delete('/ongkir/delete/{id}', [OngkirController::class, 'destroy'])->name('ongkir.delete');
    });



    //PRODUKSI
    Route::prefix('produksi')->middleware(['auth', 'auth.produksi'])->group(function () {
        //ini route khusus untuk produksi
        Route::get('beranda', [BerandaProduksiController::class, 'index'])->name('produksi.beranda');
        // Route::get('customer', [BerandaProduksiController::class, 'customer'])->name('produksi.customer');
        Route::resource('produksiproduk', ProduksiProdukController::class);
        Route::get('produksi-edit-stok/{id}', [ProduksiProdukController::class, 'editStok'])->name('produksi.edit.stok');
        Route::get('produksi-edit-kadaluwarsa/{id}', [ProduksiProdukController::class, 'editKadaluwarsa'])->name('produksi.edit.kadaluwarsa');
        Route::put('produksi-update-kadaluwarsa/{id}', 'ProduksiProdukController@updateKadaluwarsa')->name('produksi.update.kadaluwarsa');
        Route::delete('produk-delete-kadaluwarsa/{id}', 'ProdukController@deleteKadaluwarsa')->name('produksi.delete.kadaluwarsa');
        Route::get('/akun-produksi/{id}/edit', [AdminAkunSettingController::class, 'edit'])->name('akun-produksi.edit');
        Route::put('/akun-produksi/{id}', [AdminAkunSettingController::class, 'update'])->name('akun-produksi.update');
        Route::resource('laporan-inventori', LaporanInventoriProduksiController::class);
        // Route::get('packing-pesanan', [ProduksiProdukController::class, 'packing']);
        Route::get('/confirm-photo', [PesanController::class, 'confirmPhoto'])->name('confirm.photo');
        Route::post('/confirm-photo-process/{id}', [PesanController::class, 'confirmPhotoProcess'])->name('confirm.photo.process');
        Route::get('/produksi-detail-pembelian/{id}', [PesanController::class, 'produksidetailPembelian'])->name('produksi.detail.pembelian');
        /*Route::get('beranda-laporan',[LaporanInventoriProduksiController::class, 'index'])->name('beranda-laporan');
        Route::get('create-laporan',[LaporanInventoriProduksiController::class, 'create'])->name('create-laporan');
        Route::post('simpan-laporan',[LaporanInventoriProduksiController::class, 'store'])->name('simpan-laporan');
        Route::get('delete-laporan',[LaporanInventoriProduksiController::class, 'destroy'])->name('delete-laporan');
        Route::get('/laporan/{nama_produk}/edit',[LaporanInventoriProduksiController::class, 'edit'])->name('laporan.edit');
        Route::put('update-laporan',[LaporanInventoriProduksiController::class, 'update'])->name('update-laporan');*/
    });

    //PETERNAK
    Route::prefix('peternak')->middleware(['auth', 'auth.peternak'])->group(function () {
        //ini route khusus untuk peternak
        Route::get('beranda', [BerandaPeternakController::class, 'index'])->name('peternak.beranda');
        //Route::get('peternak', [KerbauController::class, 'index'])->name('peternak.kerbau.blade');
        // Route::get('peternak', [SusuPeternakController::class, 'index'])->name('peternak.susu.blade');
        Route::resource('kerbau', KerbauController::class);

        Route::resource('susu', SusuController::class);

        Route::get('/akun-peternak/{id}/edit', [AdminAkunSettingController::class, 'edit'])->name('akun-peternak.edit');
        Route::put('/akun-peternak/{id}', [AdminAkunSettingController::class, 'update'])->name('akun-peternak.update');


        //TAKS
        Route::get('/task', [TaskKaryawanController::class, 'index'])->name('task.peternak');

        Route::get('/task/create', [TaskKaryawanController::class, 'create'])->name('task.create');
        Route::post('/task/post', [TaskKaryawanController::class, 'store'])->name('task.store');


        Route::get('/task/{id}', [TaskKaryawanController::class, 'show'])->name('task.show');
        Route::post('/task/{id} ', [TaskKaryawanController::class, 'updateStatus'])->name('index.selesai');
    });








    //USER
    // Route::get('/beranda', [BerandaPembeliController::class, 'index'])->name('pembeli.beranda');
    Route::get('produk', [BerandaPembeliController::class, 'product'])->name('pembeli.produk');
    // Route::get('detailproduk/{id}', [PesananPembeliController::class, 'index'])->name('pembeli.detailproduk');
    // Route::post('pesan/{id}', [PesananPembeliController::class, 'pesan']);

    Route::get('blog', [BerandaPembeliController::class, 'blog'])->name('pembeli.blog');
    Route::get('blogdetail/{id}', [BerandaPembeliController::class, 'blogdetail']);
    Route::get('about', [BerandaPembeliController::class, 'about'])->name('pembeli.about');
    Route::get('visimisi', [BerandaPembeliController::class, 'visimisi'])->name('pembeli.visimisi');
    Route::get('galeri', [BerandaPembeliController::class, 'galeri'])->name('pembeli.galeri');
    Route::get('contact', [BerandaPembeliController::class, 'contact'])->name('pembeli.contact');

    // Routing untuk menampilkan form edit user
    Route::get('/akun-pembeli/{id}', [AkunPembeliController::class, 'edit'])->name('akun-pembeli.edit');

    // Routing untuk memperbarui data user
    Route::put('/akun-pembeli/{id}', [AkunPembeliController::class, 'update'])->name('akun-pembeli.update');

    // Route::get('/email', [EmailController::class, 'kirim']);
    // Route::get('/attach', [EmailController::class, 'attach']);


    Route::get('/pembeli/keranjang/{id}', [PesananPembeliController::class, 'index'])->name('pembeli.pesan.produk');
    Route::post('pesan-process/{id}', [PesananPembeliController::class, 'pesan']);
    Route::get('keranjang', [PesananPembeliController::class, 'cart'])->name('pembeli.keranjang');
    // Route::delete('check-out/{id}', [PesananPembeliController::class, 'delete'])->name('produk.delete');
    Route::post('/produk/delete/{id}', 'PesananPembeliController@delete')->name('produk.delete');
    Route::post('konfirmasi-check-out', [PesananPembeliController::class, 'konfirmasi'])->name('check-out.update');
    Route::get('/history/{id}', [HistoryController::class, 'historyDetail'])->name('history');
    Route::get('pesanan', [HistoryController::class, 'index'])->name('history.detail');
    Route::get('pesanan/{id}', [HistoryController::class, 'detail']);
    Route::get('/upload/{id}', [HomeController::class, 'upload'])->name('upload');
    Route::post('/upload-process/{id}', [HomeController::class, 'uploadProcess'])->name('upload.process');
    Route::get('/review', [ReviewController::class, 'index'])->name('review');
    Route::get('/berikan-ulasan/{id}', [ReviewController::class, 'store'])->name('berikan.ulasan');
    Route::post('/berikan-ulasan-process/{id}', [ReviewController::class, 'storeReviewProcess'])->name('berikan.ulasan.process');
    Route::post('/add-rating', [UserRatingController::class, 'store']);
    Route::get('/', [BerandaPembeliController::class, 'index'])->name('pembeli.beranda');
    Route::get('/reviewpembeli', [BerandaPembeliController::class, 'review'])->name('review.pembeli');
    Route::post('kirim-emal', [BerandaPembeliController::class, 'kirimemail'])->name('kirim.email');
    Auth::routes();
    Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');

    Route::get('logout', [LoginController::class, 'logout']);
}); //prevent-back-history
