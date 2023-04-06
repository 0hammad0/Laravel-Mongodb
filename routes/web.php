<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserController::class, "index"]);
Route::get('/show', [UserController::class, "show"]);
Route::post('/checkEmail', [UserController::class, "checkEmail"])->name('checkEmail');
Route::post('/confirmCode', [UserController::class, "confirmCode"])->name('confirmCode');

Route::get('/changeemail', [UserController::class, "changeEmail"])->name('change.email');
Route::post('/newEmail', [UserController::class, "newEmail"])->name('newEmail');

Route::get('/renewLicens', [UserController::class, "renewLicens"])->name('renew.licens')->middleware('throttle:limit');
Route::get('/home', [UserController::class, 'back'])->name('back');

Route::get('/removeUser', [UserController::class, "removeUser"])->name('remove.user');



Route::post('/storeEmail', [UserController::class, "storeEmail"])->name('saveEmail');
