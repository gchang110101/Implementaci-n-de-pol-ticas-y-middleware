<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Models\User;
use App\Http\Controllers\ApiAuthController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

//rutas a acceder para el GET y el POST de productos; en el contexto el middleware según 
//políticas de roles (admin y readonly)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->middleware('role:readonly');
    Route::post('/products', [ProductController::class, 'store'])->middleware('role:admin');
});

//Route::post('/login', [AuthenticatedSessionController::class, 'store']);

/*Route::post('/login', function (Request $request) {
    $credentials = $request->only('email', 'password');

    if (!Auth::attempt($credentials)) {
        return response()->json(['message' => 'Invalid login details'], 401);
    }

    $user = User::where('email', $request->email)->firstOrFail();
    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
        'access_token' => $token,
        'token_type' => 'Bearer',
    ]);
});
*/

//Route::post('/login', [AuthenticatedSessionController::class, 'store']);

// Ruta de login para API
Route::post('/login', [ApiAuthController::class, 'login']);

// Rutas protegidas con middleware auth:sanctum y middleware de rol
Route::middleware(['auth:sanctum', 'role:readonly'])->group(function () {
    Route::get('/products', [ProductController::class, 'index']); // Admin y readonly pueden ver productos
});

Route::middleware(['auth:sanctum', 'role:admin'])->group(function () {
    Route::post('/products', [ProductController::class, 'store']); // Solo admin puede crear productos
});