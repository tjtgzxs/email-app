<?php

use Illuminate\Routing\Router;

Admin::routes();

Route::group([
    'prefix'        => config('admin.route.prefix'),
    'namespace'     => config('admin.route.namespace'),
    'middleware'    => config('admin.route.middleware'),
    'as'            => config('admin.route.prefix') . '.',
], function (Router $router) {
    $router->resource('emails', \App\Admin\Controllers\EmailController::class);
    $router->get('/', 'HomeController@index')->name('home');
    $router->resource('folders', \App\Admin\Controllers\FolderController::class);
    $router->resource('nicks', \App\Admin\Controllers\NickController::class);
});
