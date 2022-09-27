<?php

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

Route::group(['prefix'=>'member'], function () {
    Route::get('index', [App\Http\Controllers\MemberController::class,'index'])->name('member.index');
    Route::get('create', [App\Http\Controllers\MemberController::class,'create'])->name('member.create');
    Route::post('store', [App\Http\Controllers\MemberController::class,'store'])->name('member.store');
    Route::get('show/{id}', [App\Http\Controllers\MemberController::class,'show'])->name('member.show');
    Route::get('edit/{id}', [App\Http\Controllers\MemberController::class,'edit'])->name('member.edit');
    Route::post('update/{id}', [App\Http\Controllers\MemberController::class,'update'])->name('member.update');
    Route::post('destroy/{id}', [App\Http\Controllers\MemberController::class,'destroy'])->name('member.destroy');
    Route::get('search', [App\Http\Controllers\MemberController::class,'search'])->name('member.search');
});
