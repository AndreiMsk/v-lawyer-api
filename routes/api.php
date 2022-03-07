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
/* get all live chat channels - ADMIN  */
Route::get('chat/get-channels', [ChatController::class, 'index']);
/* add live chat message  */
Route::post('/chat/add-message/{channel}/message/{message}', [ChatController::class, 'addMessage']);
/* update status message - read or not read */
Route::post('/chat/update-messages/{channel}', [ChatController::class, 'updateMessageStatus']);




