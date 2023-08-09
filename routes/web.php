<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

//Admin routes
Route::prefix('admin')->middleware(['auth'])->group(function () {
    //CRUD - Users
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('users.show');
    
    Route::get('/user/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/user/create', [UserController::class, 'store'])->name('users.store');

    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::post('/users/{id}/edit', [UserController::class, 'update'])->name('users.update');

    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    //CRUD - Groups
    Route::get('/groups', [GroupController::class, 'index'])->name('groups.index');
    Route::get('/groups/{id}', [GroupController::class, 'show'])->name('groups.show');
    
    Route::get('/group/create', [GroupController::class, 'create'])->name('groups.create');
    Route::post('/group/create', [GroupController::class, 'store'])->name('groups.store');

    Route::get('/groups/{id}/edit', [GroupController::class, 'edit'])->name('groups.edit');
    Route::post('/groups/{id}/edit', [GroupController::class, 'update'])->name('groups.update');

    Route::delete('/groups/{id}', [GroupController::class, 'destroy'])->name('groups.destroy');

    //CRUD - Courses
    Route::get('/courses', [CourseController::class, 'index'])->name('courses.index');
    Route::get('/courses/{id}', [CourseController::class, 'show'])->name('courses.show');
    
    Route::get('/course/create', [CourseController::class, 'create'])->name('courses.create');
    Route::post('/course/create', [CourseController::class, 'store'])->name('courses.store');

    Route::get('/courses/{id}/edit', [CourseController::class, 'edit'])->name('courses.edit');
    Route::post('/courses/{id}/edit', [CourseController::class, 'update'])->name('courses.update');

    Route::delete('/courses/{id}', [CourseController::class, 'destroy'])->name('courses.destroy');
});
// Route::get('/groups', [GroupController::class, 'list']);

Route::get('/user/{user}', function (User $user) {
    return $user;
});
    

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
