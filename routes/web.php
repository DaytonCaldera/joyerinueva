<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\ResetPassword;
use App\Http\Controllers\ChangePassword;
use App\Http\Controllers\ArticuloController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\ContratosController;
use Illuminate\Support\Facades\Route;

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
	return redirect('/dashboard');
})->middleware('auth');
Route::get('/home', function () {
	return redirect('/dashboard');
})->middleware('auth');

// Route::get('/register', [RegisterController::class, 'create'])->middleware('guest')->name('register');
// Route::post('/register', [RegisterController::class, 'store'])->middleware('guest')->name('register.perform');
Route::get('/login', [LoginController::class, 'show'])->middleware('guest')->name('login');
Route::post('/login', [LoginController::class, 'login'])->middleware('guest')->name('login.perform');
Route::get('/reset-password', [ResetPassword::class, 'show'])->middleware('guest')->name('reset-password');
Route::post('/reset-password', [ResetPassword::class, 'send'])->middleware('guest')->name('reset.perform');
Route::get('/change-password', [ChangePassword::class, 'show'])->middleware('guest')->name('change-password');
Route::post('/change-password', [ChangePassword::class, 'update'])->middleware('guest')->name('change.perform');
Route::get('/dashboard', [HomeController::class, 'index'])->name('home')->middleware('auth');
Route::group(['middleware' => 'auth'], function () {
	Route::get('/virtual-reality', [PageController::class, 'vr'])->name('virtual-reality');
	Route::get('/rtl', [PageController::class, 'rtl'])->name('rtl');
	Route::get('/profile', [UserProfileController::class, 'show'])->name('profile');
	Route::post('/profile', [UserProfileController::class, 'update'])->name('profile.update');
	Route::get('/profile-static', [PageController::class, 'profile'])->name('profile-static');
	Route::get('/sign-in-static', [PageController::class, 'signin'])->name('sign-in-static');
	Route::get('/sign-up-static', [PageController::class, 'signup'])->name('sign-up-static');
	Route::get('/{page}', [PageController::class, 'index'])->name('page');
	Route::post('logout', [LoginController::class, 'logout'])->name('logout');

	Route::get('/admin/contratos', [ContratosController::class, 'index'])->name('contratos');
	Route::get('/admin/renovaciones', [HomeController::class, 'index'])->name('renovaciones');
	Route::get('/admin/clientes', [ClientesController::class, 'index'])->name('clientes');
	Route::get('/admin/usuarios', [HomeController::class, 'index'])->name('usuarios');
	Route::get('/admin/articulos', [ArticuloController::class, 'admin_view'])->name('articulos');

	/*
		Rutas para administracion de Familia - Categoria - Articulos
	*/
	Route::post('/admin/add/familia', [ArticuloController::class, 'add_familia'])->name('agregar.familia');
	Route::post('/admin/add/categoria', [ArticuloController::class, 'add_categoria'])->name('agregar.categoria');
	Route::post('/admin/add/articulo', [ArticuloController::class, 'add_articulo'])->name('agregar.articulo');

	/**
	 * Rutas para administracion de clientes
	 */
	Route::post('/admin/add/cliente', [ClientesController::class,'store'])->name('agregar.cliente');

	/**
	 * Rutas para administracion de contratos
	 */
	Route::get('admin/contratos/historial/{id}',[ContratosController::class,'history'])->name('contratos.cliente');
	Route::post('admin/add/contrato',[ContratosController::class,'store'])->name('agregar.contrato');
	Route::get('print/contrato', function(){
		return view('printable.contrato');
	})->name('print_contrato');


	/**
	 * Rutas para administracion general
	 */
	Route::get('/admin/parametros',[HomeController::class, 'index'])->name('parametros');

});
