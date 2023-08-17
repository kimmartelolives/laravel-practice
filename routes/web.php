<?php

use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

// Route::get();
// Route::post();
// Route::put();       // papalitan buong data
// Route::patch();     // papalitan small portion ng data
// Route::delete();
// Route::option();

//common routes naming
//index - show all data or students
//show - show a single data or student
//create - show a form to add new user
//store - store  data
//edit - show form to edit a data
//update - update  data
//destroy - delete data

//home route view
// Route::get('/', [StudentController::class, 'index']);
Route::get('/', [StudentController::class, 'index'])->middleware('auth');


//login route view
// Route::get('/login', [UserController::class, 'login']);
Route::get('/login', [UserController::class, 'login'])->name('login')->middleware('guest');
//login-process route
Route::post('/login/process', [UserController::class, 'process']);


//register route view
Route::get('/register',[UserController::class, 'register']);


//store route for register form - register.blade.php
Route::post('/store', [UserController::class, 'store']);


//logout route
Route::post('/logout', [UserController::class, 'logout']);

//add new student route
Route::get('/add/student',[StudentController::class, 'create']);
//store route for register form - create.blade.php
Route::post('/add/student',[StudentController::class, 'store']);

//view students from index.blade.php
Route::get('/student/{student}',[StudentController::class, 'show']);
//process edit galing edit.blade.php
Route::put('/student/{student}',[StudentController::class, 'update']);

//delete route nasa edit.blade.php
Route::delete('/student/{student}',[StudentController::class, 'destroy']);

/*
OR OR
group route for studentcontroller
Route::controller(StudentController::class)->group(function(){

    Route::get('/', 'index')->middleware('auth');
    Route::get('/add/student', 'create');
    Route::post('/add/student', 'store');
    Route::get('/student/{student}', 'show');
    Route::put('/student/{student}', 'update');
    Route::delete('/student/{student}', 'destroy');
    


});

Route::controller(UserController::class)->group(function(){

    Route::get('/login', 'login'])->name('login')->middleware('guest');
    Route::post('/login/process', 'process']);
    Route::get('/register', 'register']);
    Route::post('/store', 'store']);
    Route::post('/logout', 'logout']);

})
*/

//composer require intervention/image

