<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SalesManagerOrderController;

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

// Rutas públicas
Route::get('/', function () {
    return view('welcome');
});

Route::get('/como-funciona', function () {
    return view('how-it-works');
});

// Routes for packages
Route::get('/paquetes', [App\Http\Controllers\PackageController::class, 'index'])->name('packages.index');
Route::get('/paquetes/crear', [App\Http\Controllers\PackageController::class, 'create'])->name('packages.create')->middleware('auth');
Route::post('/paquetes', [App\Http\Controllers\PackageController::class, 'store'])->name('packages.store')->middleware('auth');
Route::get('/paquetes/{id}', [App\Http\Controllers\PackageController::class, 'show'])->name('packages.show');

// Eliminamos la ruta pública de perfil
// Route::get('/perfil', function () {
//     return view('profile.index');
// });

// Rutas que requieren autenticación
Route::middleware(['auth'])->group(function () {
    // Aquí podrías añadir otras rutas que requieran autenticación
    // Añadimos la ruta de perfil manejada por el controlador
    Route::get('/perfil', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');
    Route::get('/perfil/editar', [App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/perfil', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');
    Route::post('/orders', [OrderController::class, 'store'])->name('orders.store');
});

// Rutas de autenticación (usando nuestras vistas Blade)
Route::get('/registro', function () {
    return view('auth.register');
});

Route::post('/registro', function () {
    // Aquí necesitaríamos la lógica para registrar un usuario
    return redirect('/login')->with('status', 'Registro temporalmente procesado. Lógica de backend pendiente.');
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::post('/login', function () {
    // Aquí necesitaríamos la lógica para iniciar sesión
    return 'Intento de inicio de sesión temporalmente procesado. Lógica de backend pendiente.';
});

// Rutas de información
Route::get('/sobre-nosotros', function () {
    return view('about');
});

Route::get('/contacto', function() {
    return view('contacto');
})->name('contacto');

Route::post('/contacto', function(Illuminate\Http\Request $request) {
    $request->validate([
        'nombre' => 'required|string|max:255',
        'email' => 'required|email',
        'mensaje' => 'required|string',
    ]);
    // Aquí podrías enviar un correo o guardar el mensaje en la base de datos
    // Por ahora solo mostramos un mensaje de éxito
    return redirect()->route('contacto')->with('success', '¡Tu mensaje ha sido enviado! Nos pondremos en contacto contigo pronto.');
})->name('contacto.enviar');

Route::get('/terminos', function () {
    return view('terms');
});

Route::get('/privacidad', function () {
    return view('privacy');
});

Route::middleware(['auth', 'can:isSalesManager'])->prefix('sales-manager')->name('sales_manager.')->group(function () {
    Route::get('/orders', [SalesManagerOrderController::class, 'index'])->name('orders.index');
    Route::put('/orders/{order}/status', [SalesManagerOrderController::class, 'updateStatus'])->name('orders.updateStatus');
});

Auth::routes();
