<?php

use Illuminate\Support\Facades\Route;
use App\http\Controllers\TestController;
use App\http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});


Route::resource("/user", UserController::class);
Route::controller(TestController::class)
    ->prefix("/test")
    ->name("test.")
    ->group(function () {
       Route::get("/","welcome")->name("welcome");
       Route::get("/hi/{name?}","hi")->name("hi");
    });
