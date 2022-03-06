<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;

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

/* UNAUTHENTICATED  */
// Route::get('/chat', [ChatController::class, 'index']);


// Route::post('/chat/{channel?}', [ChatController::class, 'join']);

Route::get('chat/get-channels', [ChatController::class, 'index']);
Route::post('/chat/add-message/{channel}/message/{message}', [ChatController::class, 'addMessage']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


