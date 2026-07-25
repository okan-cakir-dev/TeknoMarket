<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

Route::get('/', [ProductController::class, 'index']);

// Sepet İşlemleri
Route::post('/sepet/ekle/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/sepet/artir/{id}', [CartController::class, 'increase'])->name('cart.increase');
Route::post('/sepet/azalt/{id}', [CartController::class, 'decrease'])->name('cart.decrease');

// Ödeme Sayfasına Gitme Rotası
Route::get('/odeme', [CartController::class, 'checkoutPage'])->name('cart.checkout.page');

// Ödemeyi Tamamlama (Kartı Çekme) Rotası
Route::post('/odeme/tamamla', [CartController::class, 'checkout'])->name('cart.checkout');

// --- ÜYELİK SİSTEMİ ROTALARI ---
Route::get('/giris', [App\Http\Controllers\AuthController::class, 'showLogin'])->name('login');
Route::post('/giris', [App\Http\Controllers\AuthController::class, 'login']);

Route::get('/kayit', [App\Http\Controllers\AuthController::class, 'showRegister'])->name('register');
Route::post('/kayit', [App\Http\Controllers\AuthController::class, 'register']);

Route::post('/cikis', [App\Http\Controllers\AuthController::class, 'logout'])->name('logout');

// --- GİZLİ PATRON ODASI ŞİFRE EKRANI (KORUMASIZ) ---
Route::get('/admin/giris', [App\Http\Controllers\AdminController::class, 'loginPage'])->name('admin.login');
Route::post('/admin/kurulum', [App\Http\Controllers\AdminController::class, 'setupAdmin'])->name('admin.setup');
Route::post('/admin/giris', [App\Http\Controllers\AdminController::class, 'loginAdmin'])->name('admin.login.post');
Route::post('/admin/cikis', [App\Http\Controllers\AdminController::class, 'logoutAdmin'])->name('admin.logout');

// --- ASIL PATRON PANELİ (KORUMALI) ---
Route::middleware([\App\Http\Middleware\PatronKilidi::class])->group(function () {
    Route::get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin.index');
    Route::post('/admin/ekle', [App\Http\Controllers\AdminController::class, 'store'])->name('admin.store');
    Route::post('/admin/guncelle/{id}', [App\Http\Controllers\AdminController::class, 'update'])->name('admin.update');
    Route::post('/admin/sil/{id}', [App\Http\Controllers\AdminController::class, 'destroy'])->name('admin.destroy');
    Route::post('/admin/siparis/{id}/durum', [App\Http\Controllers\AdminController::class, 'updateOrderStatus'])->name('admin.order.status');
});
