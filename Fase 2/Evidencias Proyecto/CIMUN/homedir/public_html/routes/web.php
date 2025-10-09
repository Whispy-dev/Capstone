<?php
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\IncidentsController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\TransportController;
use App\Http\Controllers\RecordController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\UserPositionController;
use App\Http\Controllers\LlamaController;

/*
|--------------------------------------------------------------------------
| Rutas Públicas
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/ia', [LlamaController::class, 'index'])->name('llama.index');

/*
|--------------------------------------------------------------------------
| Rutas de Perfil (Requieren Autenticación)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    // Dashboard principal
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    
    // Perfil con controlador (CORREGIDO - eliminadas rutas duplicadas)
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/avatar', [ProfileController::class, 'updateAvatar'])->name('profile.update.avatar');

    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Otras páginas protegidas
    Route::get('/setting', fn() => view('setting'))->name('setting');
    Route::get('/email', fn() => view('email'))->name('email');
    Route::get('/file_manager', fn() => view('file_manager'))->name('file_manager');
    Route::get('/gallery', fn() => view('gallery'))->name('gallery');

    /*
    |--------------------------------------------------------------------------
    | Rutas de Calendario y Eventos (Agenda del Alcalde)
    |--------------------------------------------------------------------------
    */
    // Vista principal del calendario
    Route::get('/calendario', [EventController::class, 'index'])->name('calendar.index');
    
    // Ruta para obtener eventos en formato JSON (para FullCalendar básico)
    Route::get('/events/data', [EventController::class, 'getEvents'])->name('events.data');

    // CRUD de eventos (rutas web estándar)
    Route::prefix('events')->name('events.')->group(function () {
        Route::get('/create', [EventController::class, 'create'])->name('create');  // Mostrar formulario crear
        Route::post('/', [EventController::class, 'store'])->name('store');         // Crear evento
        Route::get('/{id}', [EventController::class, 'show'])->name('show');        // Ver detalle evento
        Route::get('/{id}/edit', [EventController::class, 'edit'])->name('edit');   // Mostrar formulario editar
        Route::put('/{id}', [EventController::class, 'update'])->name('update');    // Actualizar evento
        Route::delete('/{id}', [EventController::class, 'destroy'])->name('destroy'); // Eliminar evento
    });
    
    Route::prefix('funcionarios')->name('workers.')->group(function () {
        Route::get('/', [WorkerController::class, 'index'])->name('index');  // Mostrar funcionarios
        Route::get('/{id}', [WorkerController::class, 'show'])->name('show'); // Ver detalle del funcionario
    });
    
    Route::prefix('transporte')->name('transports.')->group(function () {
        Route::get('/', [TransportController::class, 'index'])->name('index');
        Route::get('/{id}', [TransportController::class, 'show'])->name('show');
    });
    
    Route::prefix('marcar')->name('records.')->group(function () {
        Route::get('/', [RecordController::class, 'index'])->name('index');
        Route::get('/{id}', [RecordController::class, 'show'])->name('show');
    });
    
    
    Route::prefix('areas')->name('areas.')->group(function () {
        Route::get('/', [AreaController::class, 'index'])->name('index');  // Mostrar formulario crear
        Route::post('/', [AreaController::class, 'store'])->name('store');  // Crear Area
        Route::get('/{id}', [AreaController::class, 'show'])->name('show'); // Ver detalle del area
        Route::delete('/{id}', [AreaController::class, 'destroy'])->name('destroy'); // Eliminar area
    });
    
    
    
    Route::resource('positions', PositionController::class);

    // Asignar cargo a usuario
    //Route::post('positions/assign', [PositionController::class, 'assignToUser'])->name('positions.assignToUser');
    
    // Remover cargo de usuario
    //Route::post('positions/remove', [PositionController::class, 'removeFromUser'])->name('positions.removeFromUser');
    
    Route::prefix('users')->group(function () {
        Route::get('/', [UserPositionController::class, 'index'])->name('users.index');
        Route::get('{user}/positions', [UserPositionController::class, 'index'])->name('users.positions');
        Route::get('{user}/positions/assign', [UserPositionController::class, 'create'])->name('positions.assignToUserForm');
        Route::post('{user}/positions/assign', [UserPositionController::class, 'store'])->name('positions.assignToUser');
        Route::post('positions/remove', [UserPositionController::class, 'destroy'])->name('positions.removeFromUser');
    });

});

/*
|--------------------------------------------------------------------------
| Rutas de Incidencias (CRUD)
|--------------------------------------------------------------------------
*/
Route::prefix('incidencias')->name('incidents.')->middleware(['auth'])->group(function () {
    Route::get('/export', [IncidentsController::class, 'export'])->name('export');
    Route::get('/', [IncidentsController::class, 'index'])->name('index');
    Route::post('/', [IncidentsController::class, 'store'])->name('store');
    Route::get('/{id}', [IncidentsController::class, 'show'])->name('show');
    Route::put('/{id}', [IncidentsController::class, 'update'])->name('update');
    Route::delete('/{id}', [IncidentsController::class, 'destroy'])->name('destroy');
    Route::patch('/{id}/status', [IncidentsController::class, 'updateStatus'])->name('updateStatus');
    Route::post('/{id}/comments', [IncidentsController::class, 'addComment'])->name('comments.store');
    Route::get('/{id}/comments', [IncidentsController::class, 'getComments'])->name('comments.index');
    Route::delete('/{incidentId}/comments/{commentId}', [IncidentsController::class, 'deleteComment'])->name('comments.destroy');
});



/*
|--------------------------------------------------------------------------
| Rutas de autenticación
|--------------------------------------------------------------------------
*/


require __DIR__.'/auth.php';

