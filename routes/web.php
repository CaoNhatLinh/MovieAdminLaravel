<?php

use App\Http\Controllers\admin\Movie\MovieController;
use App\Http\Controllers\admin\TapPhim\TapPhimController;
use App\Http\Controllers\admin\NguoiDung\AuthController;
use App\Http\Controllers\admin\NguoiDung\NguoiDungController;
use App\Http\Controllers\admin\TheLoai\TheLoaiController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('movie.index');
});
//AUTH
Route::GET('/admin', [AuthController::class, 'index'])->name('auth.admin');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout');


// Phim
Route::group(['prefix' => 'movie'], function () {
Route::get("", [MovieController::class, 'index'])->name("movie.index");
Route::get("/createView", [MovieController::class, 'createView'])->name("movie.createView");
Route::post("/create", [MovieController::class, 'create'])->name("movie.create");
Route::get("/editView/{id}", [MovieController::class, 'editView'])->name("movie.editView");
Route::post("/edit/{id}", [MovieController::class, 'edit'])->name("movie.edit");
Route::get("/detailView/{id}", [MovieController::class, 'detailView'])->name("movie.detailView");
Route::get('/delete/{id}', [MovieController::class, 'delete'])->name('movie.delete');
});
//Tap Phim
Route::group(['prefix' => 'TapPhim'], function () {
Route::get("/createView/{id}", [TapPhimController::class, 'createView'])->name("TapPhim.createView");
Route::post("/create/{id}", [TapPhimController::class, 'create'])->name("TapPhim.create");
Route::post("/edit/{id}", [TapPhimController::class, 'edit'])->name("TapPhim.edit");
Route::get('/delete/{MaTapPhim}', [TapPhimController::class, 'delete'])->name('TapPhim.delete');
});

Route::group(['prefix' => 'theloai'], function () {
    Route::get('', [TheLoaiController::class, 'index'])->name('theloai.index');
    Route::post("/create", [TheLoaiController::class, 'create'])->name("theloai.create");
    Route::post("/edit", [TheLoaiController::class, 'edit'])->name("theloai.edit");
    Route::get("/delete/{id}", [TheLoaiController::class, 'delete'])->name("theloai.delete");
});


Route::group(['prefix' => 'user'], function () {
    Route::get("", [NguoiDungController::class, 'index'])->name('user.index');
    Route::get("/createView", [NguoiDungController::class, 'createView'])->name("user.createView");
    Route::post("/create", [NguoiDungController::class, 'create'])->name("user.create");
    Route::get("/editView/{id}", [NguoiDungController::class, 'editView'])->name("user.editView");
    Route::post("/edit/{id}", [NguoiDungController::class, 'edit'])->name("user.edit");
    Route::get("/detailView/{id}", [NguoiDungController::class, 'detailView'])->name("user.detailView");
    Route::get("/delete/{id}", [NguoiDungController::class, 'delete'])->name("user.delete");
    Route::get("/resetpassword/{id}", [NguoiDungController::class, 'resetpassword'])->name("user.resetpassword");
});