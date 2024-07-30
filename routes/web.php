<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Administrador\AdministradorController;
use App\Http\Controllers\Administrador\OkrsController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ExtrasController;
use App\Http\Controllers\Lider\LiderController;
use App\Http\Controllers\Colaborador\ColaboradorController;
use App\Http\Controllers\OkrController;

Cache::flush();
Session::flush();
Artisan::call('cache:clear');

Route::get('/', function () {
    return view('login');
});

Route::get('login', [LoginController::class, 'Login'])->name('login');
Route::get('recuperarContrasena', [LoginController::class, 'RecuperarContrasena'])->name('recuperarContrasena');
Route::post('acceso', [LoginController::class, 'Acceso'])->name('acceso');
Route::post('recuperarAcceso', [LoginController::class, 'RecuperarAcceso'])->name('recuperarAcceso');

Auth::routes();

Route::group(['middleware' => 'revalidate'], function () {
    Cache::flush();
    Route::group(['middleware' => 'administrador'], function () {
        Cache::flush();
        Artisan::call('cache:clear');
        Route::get('administrador/home', [AdministradorController::class, 'Home'])->name('home');
    });
    Route::group(['middleware' => 'lider'], function () {
        Cache::flush();
        Artisan::call('cache:clear');
        Route::get('lider/home', [LiderController::class, 'Home'])->name('home');
    });
    Route::group(['middleware' => 'colaborador'], function () {
        Cache::flush();
        Artisan::call('cache:clear');
        Route::get('colaborador/home', [ColaboradorController::class, 'Home'])->name('home');
    });
    Route::group(['prefix' => 'administrador', 'namespace' => 'Administrador', 'middleware' => 'administrador'], function () {
        Cache::flush();
        Artisan::call('cache:clear');
        // Administración
        Route::get('areas', [AdministradorController::class, 'Areas'])->name('areas');
        Route::get('cargueMasivo', [AdministradorController::class, 'CargueMasivo'])->name('cargueMasivo');

        // OKRS
        Route::get('okrsOrganizacion', [OkrsController::class, 'OkrsOrganizacion'])->name('okrsOrganizacion');
        Route::post('guardarAvanceResultado', [ExtrasController::class, 'GuardarAvanceResultado'])->name('guardarAvanceResultado');
        Route::post('guardarAvanceIniciativa', [ExtrasController::class, 'GuardarAvanceIniciativa'])->name('guardarAvanceIniciativa');
        Route::get('verIniciativa', [ExtrasController::class, 'VerIniciativa'])->name('verIniciativa');
        Route::get('verKr', [ExtrasController::class, 'VerKr'])->name('verKr');
        

        //Extras
        Route::get('profileEmpleado', [ExtrasController::class, 'ProfileEmpleado'])->name('profileEmpleado');
        
        Route::get('logout', function () {
            Auth::logout();
            Session::flush();
            Artisan::call('cache:clear');
            Cache::flush();
            return Redirect::to('/')->with('mensaje_login', 'Salida Segura');
        });
    });

    Route::group(['prefix' => 'lider', 'namespace' => 'Lider', 'middleware' => 'lider'], function () {
        Cache::flush();
        Artisan::call('cache:clear');

        // OKRS
        Route::post('guardarAvanceResultado', [ExtrasController::class, 'GuardarAvanceResultado'])->name('guardarAvanceResultado');
        Route::post('guardarAvanceIniciativa', [ExtrasController::class, 'GuardarAvanceIniciativa'])->name('guardarAvanceIniciativa');

        //Extras
        Route::get('profileEmpleado', [ExtrasController::class, 'ProfileEmpleado'])->name('profileEmpleado');
        Route::get('logout', function () {
            Auth::logout();
            Session::flush();
            Artisan::call('cache:clear');
            Cache::flush();
            return Redirect::to('/')->with('mensaje_login', 'Salida Segura');
        });
    });

    Route::group(['prefix' => 'colaborador', 'namespace' => 'Colaborador', 'middleware' => 'colaborador'], function () {
        Cache::flush();
        Artisan::call('cache:clear');

        // OKRS
        Route::post('guardarAvanceResultado', [ExtrasController::class, 'GuardarAvanceResultado'])->name('guardarAvanceResultado');
        Route::post('guardarAvanceIniciativa', [ExtrasController::class, 'GuardarAvanceIniciativa'])->name('guardarAvanceIniciativa');
        
        //Extras
        Route::get('profileEmpleado', [ExtrasController::class, 'ProfileEmpleado'])->name('profileEmpleado');
        Route::get('logout', function () {
            Auth::logout();
            Session::flush();
            Artisan::call('cache:clear');
            Cache::flush();
            return Redirect::to('/')->with('mensaje_login', 'Salida Segura');
        });
    });

    // ADMINISTRACIÓN
    Route::post('crearArea', [AdminController::class, 'CrearArea'])->name('crearArea');
    Route::post('actualizarArea', [AdminController::class, 'ActualizarArea'])->name('actualizarArea');
    

    // OKRS
    Route::post('administrarIniciativa', [OkrController::class, 'AdministrarIniciativa'])->name('administrarIniciativa');
    Route::post('administrarKr', [OkrController::class, 'AdministrarKr'])->name('administrarKr');
});
