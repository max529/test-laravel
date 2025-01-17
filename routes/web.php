<?php

use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {

    $user1 = new User();
    $user1->email;

    $ctrl = new UserController();
    $user2 = $ctrl->test();
    $user2->email;

    return view('welcome');
});
