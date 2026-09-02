<?php


use App\Http\Controllers\TodoController;


Route::get("/",[TodoController::class,"index"]);

Route::post('/todos', [TodoController::class, 'store']);
