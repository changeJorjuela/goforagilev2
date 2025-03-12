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
use App\Http\Controllers\ApiOKRsController;
use App\Http\Controllers\ApiAdminController;
use App\Http\Controllers\Lider\LiderController;
use App\Http\Controllers\Colaborador\ColaboradorController;
use App\Http\Controllers\OkrController;

Cache::flush();
Session::flush();
Artisan::call('cache:clear');

Route::middleware(['web'])->group(function () {
    Route::get('/', function () {
        return view('login');
    });

    Route::get('login', [LoginController::class, 'Login'])->name('login');
    Route::get('recuperarContrasena', [LoginController::class, 'RecuperarContrasena'])->name('recuperarContrasena');

    Route::post('acceso', [LoginController::class, 'Acceso'])->name('acceso');
    Route::post('recuperarAcceso', [LoginController::class, 'RecuperarAcceso'])->name('recuperarAcceso');
});

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
        Route::get('auditoriaGestion', [AdministradorController::class, 'AuditoriaGestion'])->name('auditoriaGestion');
        Route::get('cargueMasivo', [AdministradorController::class, 'CargueMasivo'])->name('cargueMasivo');
        Route::get('cargos', [AdministradorController::class, 'Cargos'])->name('cargos');
        Route::get('colaboradores', [AdministradorController::class, 'Colaboradores'])->name('colaboradores');
        Route::get('detalleColaboradorPc', [AdministradorController::class, 'DetalleColaboradorPc'])->name('detalleColaboradorPc');
        Route::get('detalleColaborador', [AdministradorController::class, 'DetalleColaborador'])->name('detalleColaborador');     

        // OKRS
        Route::get('okrsOrganizacion', [OkrsController::class, 'OkrsOrganizacion'])->name('okrsOrganizacion');
        Route::post('guardarAvanceResultado', [ApiOKRsController::class, 'GuardarAvanceResultado'])->name('guardarAvanceResultado');
        Route::post('guardarAvanceIniciativa', [ApiOKRsController::class, 'GuardarAvanceIniciativa'])->name('guardarAvanceIniciativa');
        Route::get('verIniciativa', [ApiOKRsController::class, 'VerIniciativa'])->name('verIniciativa');
        Route::get('verKr', [ApiOKRsController::class, 'VerKr'])->name('verKr');
        

        //Extras
        Route::get('profileEmpleado', [ApiAdminController::class, 'ProfileEmpleado'])->name('profileEmpleado');
        Route::post('eliminarColaborador', [ApiAdminController::class, 'EliminarColaborador'])->name('eliminarColaborador');
        Route::post('eliminarLider', [ApiAdminController::class, 'EliminarLider'])->name('eliminarLider');
        Route::get('listarAreas', [ApiAdminController::class, 'ListarAreasEmpresa'])->name('listarAreas');
        Route::get('listarUnidadOrganizativa', [ApiAdminController::class, 'ListarUnidadOrganizativaEmpresa'])->name('listarUnidadOrganizativa');
        Route::get('colaboradoresEmpresa', [ApiAdminController::class, 'ColaboradoresEmpresa'])->name('colaboradoresEmpresa');

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
        Route::post('guardarAvanceResultado', [ApiOKRsController::class, 'GuardarAvanceResultado'])->name('guardarAvanceResultado');
        Route::post('guardarAvanceIniciativa', [ApiOKRsController::class, 'GuardarAvanceIniciativa'])->name('guardarAvanceIniciativa');

        //Extras
        Route::get('profileEmpleado', [ApiAdminController::class, 'ProfileEmpleado'])->name('profileEmpleado');
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
        Route::post('guardarAvanceResultado', [ApiOKRsController::class, 'GuardarAvanceResultado'])->name('guardarAvanceResultado');
        Route::post('guardarAvanceIniciativa', [ApiOKRsController::class, 'GuardarAvanceIniciativa'])->name('guardarAvanceIniciativa');
        
        //Extras
        Route::get('profileEmpleado', [ApiAdminController::class, 'ProfileEmpleado'])->name('profileEmpleado');
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
    Route::post('eliminarArea', [AdminController::class, 'EliminarArea'])->name('eliminarArea');
    Route::post('crearCargo', [AdminController::class, 'CrearCargo'])->name('crearCargo');
    Route::post('actualizarCargo', [AdminController::class, 'ActualizarCargo'])->name('actualizarCargo');
    Route::post('eliminarCargo', [AdminController::class, 'EliminarCargo'])->name('eliminarCargo');
    Route::post('crearColaborador', [AdminController::class, 'CrearColaborador'])->name('crearColaborador');
    Route::post('actualizarColaborador', [AdminController::class, 'ActualizarColaborador'])->name('actualizarColaborador');
    Route::post('asignarLider', [AdminController::class, 'AsignarLider'])->name('asignarLider');

    // OKRS
    Route::post('administrarIniciativa', [OkrController::class, 'AdministrarIniciativa'])->name('administrarIniciativa');
    Route::post('administrarKr', [OkrController::class, 'AdministrarKr'])->name('administrarKr');
});
