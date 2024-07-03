<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\ResumeReactionController;

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

//Company
Route::group(['prefix' => 'companies'],function() {
    Route::get('/', [CompanyController::class, 'index']);
    Route::post('/', [CompanyController::class, 'store']);
    Route::get('/{id}', [CompanyController::class, 'show']);
    Route::patch('/{id}', [CompanyController::class, 'update']);
    Route::delete('/{id}', [CompanyController::class, 'delete']);
});

//Resume
Route::group(['prefix' => 'resumes'],function() {
    Route::get('/', [ResumeController::class, 'index']);
    Route::post('/', [ResumeController::class, 'store']);
    Route::get('/{id}', [ResumeController::class, 'show']);
    Route::patch('/{id}', [ResumeController::class, 'update']);
    Route::delete('/{id}', [ResumeController::class, 'delete']);
});

Route::get('most-positive-reactions', [ResumeController::class, 'mostPositiveReactions']);

//Resume Reaction
Route::group(['prefix' => 'resume-reactions'],function() {
    Route::get('/', [ResumeReactionController::class, 'index']);
    Route::post('/', [ResumeReactionController::class, 'store']);
    Route::get('/{id}', [ResumeReactionController::class, 'show']);
    Route::patch('/{id}', [ResumeReactionController::class, 'update']);
    Route::delete('/{id}', [ResumeReactionController::class, 'delete']);
});
