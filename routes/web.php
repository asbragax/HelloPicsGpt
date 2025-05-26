<?php

use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProdutoController;


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

Route::get('/entrar', function () {
    return view('client.login');
})->name('client.login');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->get('/dashboard-cliente', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }

    return view('client.dashboard');
})->name('client.dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Redireciona para o Google
Route::get('/auth/google', function () {
    return Socialite::driver('google')->redirect();
})->name('google.login');

// Callback do Google
Route::get('/auth/google/callback', function () {
    $googleUser = Socialite::driver('google')->stateless()->user();

    $user = User::firstOrCreate(
        ['email' => $googleUser->getEmail()],
        [
            'name' => $googleUser->getName(),
            'password' => bcrypt(uniqid()), // senha fake
            'email_verified_at' => now(),
        ]
    );

    Auth::login($user, true);

    return redirect()->route('client.dashboard');
});

Route::middleware(['auth', 'is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Pedidos
    Route::get('/pedidos', [OrderController::class, 'index'])->name('pedidos.index');
    Route::get('/pedidos/{id}', [OrderController::class, 'show'])->name('pedidos.show');
    Route::put('/pedidos/{id}', [OrderController::class, 'update'])->name('pedidos.update');


    // Usuários
    Route::resource('usuarios', UserController::class)->names('usuarios');


    //Produtos
    Route::resource('produtos', ProdutoController::class)->names('produtos');
    Route::post('produtos/{produto}/fotos', [\App\Http\Controllers\Admin\ProdutoFotoController::class, 'store'])->name('produtos.fotos.store');
    Route::delete('produtos/fotos/{id}', [\App\Http\Controllers\Admin\ProdutoFotoController::class, 'destroy'])->name('produtos.fotos.destroy');
    Route::post('produtos/fotos/{id}/principal', [\App\Http\Controllers\Admin\ProdutoFotoController::class, 'marcarPrincipal'])->name('produtos.fotos.principal');

    // Molduras
    Route::resource('molduras', \App\Http\Controllers\Admin\MolduraController::class);
});



require __DIR__ . '/auth.php';
