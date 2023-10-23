<?php


use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Sanctum\Sanctum;
use Illuminate\Support\Facades\Route;
use PHPUnit\Framework\Attributes\Group;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Validation\ValidationException;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*Route::get('categories', [App\http\Controllers\Api\CategoryController::class, 'index']);
Route::get('categories/{category}', [App\http\Controllers\Api\CategoryController::class, 'show']);*/

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::apiResource('categories', App\http\Controllers\Api\CategoryController::class);

    Route::apiResource('transactions', App\http\Controllers\Api\TransactionController::class);
});

/*Route::post('/Sanctum/token', function (Request $request) {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
        'device_name' => 'required',


    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Hash::check($request->password, $user->password)) {
        throw ValidationException::withMessages([
            'email' => ['The provider authentication incorrect'],
        ]);
    }
    return $user->createToken($request->device_name)->plainTextToken;
});*/

Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/auth/register', [AuthController::class, 'register']);
Route::post('/auth/logout', [AuthController::class, 'logout']);
