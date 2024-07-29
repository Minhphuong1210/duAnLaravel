<?php

use App\Http\Controllers\Admin\DanhMucController;
use App\Http\Controllers\Admin\SanPhamController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\CheckRoleAdminMiddleware;
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

// trang sản phẩm 
Route::get('/', [ProductController::class, 'trangchuSanPham'])->name('trangChu');
Route::get('/product/detail/{id}/{danh_muc_id}', [ProductController::class, 'chiTietSanPham'])->name('chiTietSanPham');
Route::get('/category/{id}',[ProductController::class, 'cate'])->name('cate');
// tìm kiếm sản phẩm
// Route::get('/search', [ProductController::class, 'search'])->name('search');
Route::post('/search', [ProductController::class, 'search'])->name('search');

// Giỏ hàng 
Route::get('/list-cart', [CartController::class, 'listCart'])->name('cart.listCart');
Route::post('/add-to-cart', [CartController::class, 'addCart'])->name('cart.addCart');
Route::post('/update-cart', [CartController::class, 'updateCart'])->name('cart.updateCart');


// đăng nhập đăng ký
Route::get('login', [AuthController::class, 'showFormLogin']);
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'showFormRegister'])->name('showFormRegister');
Route::post('/register', [AuthController::class, 'register'])->name('register');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// route admin
Route::middleware(['auth', 'auth.admin'])
    ->prefix('admins')
    ->as('admins.')
    ->group(function () {
        Route::get('/',function(){
            return view('admins.dashboard');
        });
        Route::prefix('danhmucs')
        ->as('danhmucs.')
        ->group(function(){
            Route::get('/', [DanhMucController::class, 'index'])->name('index');
            Route::get('/create', [DanhMucController::class, 'create'])->name('create');
            Route::post('/store', [DanhMucController::class, 'store'])->name('store');
            Route::get('/show/{id}', [DanhMucController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [DanhMucController::class, 'edit'])->name('edit');
            Route::put('/{id}/update', [DanhMucController::class, 'update'])->name('update');
            Route::delete('/{id}/destroy', [DanhMucController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('sanphams')
        ->as('sanphams.')
        ->group(function(){
            Route::get('/', [SanPhamController::class, 'index'])->name('index');
            Route::get('/create', [SanPhamController::class, 'create'])->name('create');
            Route::post('/store', [SanPhamController::class, 'store'])->name('store');
            Route::get('/show/{id}', [SanPhamController::class, 'show'])->name('show');
            Route::get('/{id}/edit', [SanPhamController::class, 'edit'])->name('edit');
            Route::put('/{id}/update', [SanPhamController::class, 'update'])->name('update');
            Route::delete('/{id}/destroy', [SanPhamController::class, 'destroy'])->name('destroy');
        });
    });
