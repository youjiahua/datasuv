<?php

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
 
Route::group([
    'namespace' => 'Admin',
    'domain' => env('APP_URL'),
    'middleware' => ['admin.auth']
],function(){      
    Route::any('/{class?}/{action?}/{args?}', function($class='Home', $action='__invoke', $args=[NULL]) {
        $class = ucfirst($class);
        $path = "\\App\\Http\\Controllers\\Admin\\";
        $path .= $class . "Controller";
        if(is_string($args)){ $args = [$args]; }
        
        $ctrl = App::make($path); 
        return App::call([$ctrl, $action], $args);
    });
});