<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MyprojectController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\Menus\CrudTablesController;
use App\Http\Controllers\tablefilesController;
use App\Http\Controllers\CrudController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\TableController;
use App\Http\Controllers\jane227Controller;


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

Route::get('/dashboard', function () {
    return view('admin.dashboard');
});



//Menus routes
Route::get('/CRUD', function () {
    return view('Menus.Create.CRUD');
});
Route::get('/CRUD', [tablefilesController::class, 'ProjectName'])->name('Menus.Create.CRUD');

Route::get('/nonCrud', function () {
    return view('Menus.Create.NonCRUD');
});






Route::get('/myprofil', function () {
    return view('admin.editmyprofil');
});




Route::post('/generate-crud', [tablefilesController::class, 'generateFiles'])->name('generate-crud');

Route::get('/password', function () {
    return view('admin.changepassword');
})->middleware('auth')->name('admin.changepassword');

Route::get('/home', [HomeController::class, 'index'])->name('home');


Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('admin.dashboard');

Route::get('/dashboard', [DashboardController::class, 'showTableNames'])->name('admin.dashboard');


Route::get('/settings', [SettingsController::class, 'settings'])->name('admin.settings');


Route::post('/myprofil', [ProfileController::class, 'updateName'])->name('admin.editmyprofil');

Route::get('/myprofil', [ProfileController::class, 'editmyprofil'])->name('admin.editmyprofil');

Route::middleware('auth')->group(function () {
    Route::get('/password', [\App\Http\Controllers\Auth\ResetPasswordController::class, 'password'])
        ->name('admin.changepassword');



    Route::post('/password', [\App\Http\Controllers\Auth\ResetPasswordController::class, 'changePassword'])
    ->name('admin.changepassword')
    ->middleware('auth');
});



    Route::post('/myprofil', [ProfileController::class, 'updateName'])->name('admin.editmyprofil');

    Route::get('/myprofil', [ProfileController::class, 'editmyprofil'])->name('admin.editmyprofil');


   //Route::post('/register', [\App\Http\Controllers\Auth\RegisterController::class, 'create1'])->name('auth.register');


   Route::get('/myproject', [MyprojectController::class, 'index'])->name('admin.myproject');


   Route::post('/settings', [SettingsController::class, 'update'])->name('admin.settings');

    Auth::routes();

  



    


<<<<<<< HEAD
Route::get('/table1', [table1Controller::class]);
=======
  
    Route::get('/table/{table}/{view}',  [TableController::class, 'show']);

   Route::get('/table/{table}/{view}', [jane227Controller::class,'show']);
   
  Route::post('/table/{table}/{view}', 'App\Http\Controllers\jane227Controller@store');

   ///Route::post('/table/{table}', [TableController::class, 'store'])->name('table.store');

<<<<<<< HEAD
//Route::resource('/tale/{table}/{view}', [productController::class]);
//Route::resource('/tale/{table}/{view}', [table4Controller::class]);
=======
>>>>>>> 4a8b2689f99360825dcb8174684648bda4f38714
>>>>>>> 3f9c43ed850c1a4e3083c9f050616cad93aa6e0b
