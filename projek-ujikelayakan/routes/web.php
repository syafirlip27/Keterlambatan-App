<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\RayonsController;
use App\Http\Controllers\RombelsController;
use App\Http\Controllers\StudentsController;
use App\Http\Controllers\LatesController;
use App\Models\students;
use Illuminate\Support\Facades\Auth;

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

Route :: get('/error-permission', function(){
    return view('errors.permission');
})->name('error.permission');


Route::middleware('IsGuest')->group(function () {
    Route::get('/', function () {
        return view('login');
    })->name('login');
    Route::post('/login', [UsersController::class, 'loginAuth'])->name('login.auth');

});

    Route::get('/logout', [UsersController::class, 'logout'])->name('logout');
Route::get('/error-permission', function () {
    return view('errors.permission');
})->name('error.permission');

Route::middleware(['IsLogin'])->group(function () {
    Route::get('/logout', [UsersController::class, 'logout'])->name('logout');
    Route::get('/home', function () {
        $student = students::all();
        $rayon_id = Auth::user()->rayon_id;
        $students = $student->where('rayon_id', $rayon_id);
        
        return view('home', compact('students'));
    })->name('home.page');
});

Route::middleware(['IsLogin', 'IsAdmin'])->group(function () {
Route::prefix('/rombel')->name('rombel.')->group(function () {
    Route::get('/index', [RombelsController::class, 'index'])->name('index');
    Route::get('/create', [RombelsController::class, 'create'])->name('create');
    Route::post('/store', [RombelsController::class, 'store'])->name('store');
    Route::get('/{id}', [RombelsController::class, 'edit'])->name('edit');
    Route::patch('/{id}', [RombelsController::class, 'update'])->name('update');
    Route::delete('/{id}', [RombelsController::class, 'destroy'])->name('delete');
});

Route::prefix('/user')->name('user.')->group(function () {
    Route::get('/index', [UsersController::class, 'index'])->name('index');
    Route::get('/create', [UsersController::class, 'create'])->name('create');
    Route::post('/store', [UsersController::class, 'store'])->name('store');
    Route::get('/{id}', [UsersController::class, 'edit'])->name('edit');
    Route::patch('/{id}', [UsersController::class, 'update'])->name('update');
    Route::delete('/{id}', [UsersController::class, 'destroy'])->name('delete');
    
});
Route::prefix('/rayon')->name('rayon.')->group(function () {
    Route::get('/index', [RayonsController::class, 'index'])->name('index');
    Route::get('/create', [RayonsController::class, 'create'])->name('create');
    Route::post('/store', [RayonsController::class, 'store'])->name('store');
    Route::get('/{id}', [RayonsController::class, 'edit'])->name('edit');
    Route::patch('/{id}', [RayonsController::class, 'update'])->name('update');
    Route::delete('/{id}', [RayonsController::class, 'destroy'])->name('delete');
});
Route::prefix('/student')->name('student.')->group(function () {
    Route::get('/index', [StudentsController::class, 'index'])->name('index');
    Route::get('/create', [StudentsController::class, 'create'])->name('create');
    Route::post('/store', [StudentsController::class, 'store'])->name('store');
    Route::get('/{id}', [StudentsController::class, 'edit'])->name('edit');
    Route::patch('/{id}', [StudentsController::class, 'update'])->name('update');
    Route::delete('/{id}', [StudentsController::class, 'destroy'])->name('delete');

});
Route::prefix('/late')->name('late.')->group(function () {
    Route::get('/rekap/detail/{student_id}', [LatesController::class, 'detail'])->name('detail');
    Route::get('/download/{id}', [LatesController::class, 'downloadPDF'])->name('download');
    Route::get('/export-excel', [LatesController::class, 'exportExcel'])->name('export-excel');
    Route::get('/rekap', [LatesController::class, 'rekap'])->name('rekap');
    Route::get('/index', [LatesController::class, 'index'])->name('index');
    Route::get('/create', [LatesController::class, 'create'])->name('create');
    Route::post('/store', [LatesController::class, 'store'])->name('store');
    Route::get('/{id}', [LatesController::class, 'edit'])->name('edit');
    Route::patch('/{id}', [LatesController::class, 'update'])->name('update');
    Route::delete('/{id}', [LatesController::class, 'destroy'])->name('delete');
});

Route::middleware(['IsLogin', 'IsPs'])->group(function () {
    Route::prefix('/ps')->name('ps')->group(function () {
        Route::prefix('/late')->name('late.')->group(function () {
            Route::get('/rekap/detail/{student_id}', [LatesController::class, 'detail'])->name('detail');
            Route::get('/download/{id}', [LatesController::class, 'downloadPDF'])->name('download');
            Route::get('/export-excel', [LatesController::class, 'exportExcel'])->name('export-excel');
            Route::get('/rekap', [LatesController::class, 'rekap'])->name('rekap');
            Route::get('/index', [LatesController::class, 'index'])->name('index');
        });
    });
});
});

