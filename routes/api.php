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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

/* UNAUTHENTICATED  */
/* get all live chat channels - ADMIN  */
Route::get('chat/get-channels', [ChatController::class, 'index']);
/* add live chat message  */
Route::post('/chat/add-message', [ChatController::class, 'addMessage']);
/* update status message - read or not read */
Route::post('/chat/update-messages/{channel}', [ChatController::class, 'updateMessageStatus']);

/**AUTH HERE */
Route::post('/chat/close-chat/{channel}', [ChatController::class, 'closeChat']);
