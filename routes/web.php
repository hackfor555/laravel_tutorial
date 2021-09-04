<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HelloController;
use Illuminate\Http\Request;
use App\Http\Middleware\HelloMiddleware;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/* Route::get('hello', function (Request $request) {
    $data = [
        'msg' => 'This is message recieved from routes',
        'id' => $request->id
    ];
    return view('hello.index', $data); */
Route::get('hello/', [HelloController::class, 'index']
)->middleware('helo');
    

Route::post('hello', [HelloController::class, 'post']);
    

?>