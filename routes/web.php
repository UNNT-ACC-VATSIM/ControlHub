<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/unnt', function () {
    return view('unnt');
});

Route::get('/home', function () {
    return view('home');
});