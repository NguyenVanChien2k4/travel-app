<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginControllers;
use App\Http\Controllers\PagesControllers;
use App\Http\Controllers\TravelControllers;

Route::resource("/", LoginControllers::class);

Route::get("/register", [
    LoginControllers::class,
    'register'
])->name('register');

Route::post("/login", [
    LoginControllers::class,
    'checkLogin'
]);

Route::get("/home", [
    PagesControllers::class,
    'home'
]);

Route::resource("/travel", TravelControllers::class);

Route::get("/tour", [
    PagesControllers::class,
    'tour'
]);

Route::delete("/tour/{id}", [
    PagesControllers::class,
    'deleteBooking'
]);

Route::get("/booking", [
    PagesControllers::class,
    'booking'
]);

Route::post("/bookings", [
    PagesControllers::class,
    'addBooking'
]);

Route::get("/contacts", [
    PagesControllers::class,
    'contacts'
]);

Route::post("/contacts/save", [
    PagesControllers::class,
    'saveContacts'
]);

Route::get("/account", [
    PagesControllers::class,
    'account'
]);

Route::get("/accountShow", [
    PagesControllers::class,
    'showAccount'
]);

Route::put("/account-edit", [
    PagesControllers::class,
    'editAccount'
]);

Route::post("/avatarUpdate", [
    PagesControllers::class,
    'avatarUpdate'
]);
