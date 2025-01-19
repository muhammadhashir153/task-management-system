<?php

use App\Http\Controllers\TaskControllerApi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Route to get all tasks for the authenticated user
Route::get('/tasks', [TaskControllerApi::class, 'index']);

// Route to create a new task
Route::post('/tasks', [TaskControllerApi::class, 'store']);

// Route to get a specific task by ID
Route::get('/tasks/{id}', [TaskControllerApi::class, 'show']);

// Route to update a task by ID
Route::put('/tasks/{id}', [TaskControllerApi::class, 'update']);

// Route to delete a task by ID
Route::delete('/tasks/{id}', [TaskControllerApi::class, 'destroy']);
