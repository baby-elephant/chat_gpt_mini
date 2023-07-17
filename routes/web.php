<?php

use App\Http\Controllers\MainThreadController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::get('/', function () {return view('welcome');});
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::group(['middleware' => ['auth']], function() {
    Route::prefix('/main_thread')->group(function () {
        Route::get('/show', [MainThreadController::class, 'viewMainThread'])->name('view_main_thread_new');
        Route::get('/show/{chat_ulid}', [MainThreadController::class, 'viewMainThread'])->name('view_main_thread');
        Route::post('/save/user_prompt', [MainThreadController::class, 'saveUserPromtRequest'])->name('save_user_prompt');
        Route::post('/delete', [MainThreadController::class, 'deleteChat'])->name('delete_chat');
    });
    Route::get('/chat_gpt_stream_request/{parent_chat_history_id?}', [MainThreadController::class, 'chatGPTStreamRequest'])->name('chat_gpt_stream_request');
});
