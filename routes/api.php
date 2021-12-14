<?php

use App\Http\Controllers\UserApiController;
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

//get api for show users
Route::get('/users/{id?}', [UserApiController::class, 'showUser']);

//post api for add users
Route::post('/add-user', [UserApiController::class, 'addUser']);

//post api for add multiple users
Route::post('/add-multiple-user', [UserApiController::class, 'addMultipleUser']);

//put api for update users details
Route::put('/update-user-details/{id}', [UserApiController::class, 'updateUserDetails']);

//patch api for update single record
Route::patch('/update-single-record/{id}', [UserApiController::class, 'updateSingleRecord']);

//Delete api for delete single user
Route::delete('/delete-single-user/{id}', [UserApiController::class, 'deleteSingleUser']);

//Delete api for delete single user with json
Route::delete('/delete-single-user-with-json', [UserApiController::class, 'deleteUserJson']);

//Delete api for delete multiple user
Route::delete('/delete-multiple-user/{ids}', [UserApiController::class, 'deleteMultipleUser']);

//Delete api for delete multiple user with json
Route::delete('/delete-multiple-user-with-json', [UserApiController::class, 'deleteMultipleUserJson']);


Route::post('/register-api-using-passport', [UserApiController::class, 'registerUserUsingPassport']);

Route::post('/login-api-using-passport', [UserApiController::class, 'loginUserUsingPassport']);
