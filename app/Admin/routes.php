<?php

declare(strict_types=1);
/**
 * This file is part of https://github.com/zhaohao19941221.
 */
use App\Admin\Controllers\ChatgptApiController;
use App\Admin\Controllers\ChatgptApiRequestLogController;
use App\Admin\Controllers\ChatgptAskLibraryController;
use App\Admin\Controllers\ChatgptChatController;
use App\Admin\Controllers\ChatgptImageCreateController;
use App\Admin\Controllers\ChatgptImageEditController;
use App\Admin\Controllers\ChatgptImageVariationController;
use App\Admin\Controllers\ChatgptModeController;
use App\Admin\Controllers\ChatgptQuestionController;
use Dcat\Admin\Admin;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;

Admin::routes();

Route::group([
    'prefix' => config('admin.route.prefix'),
    'namespace' => config('admin.route.namespace'),
    'middleware' => config('admin.route.middleware'),
], function (Router $router) {
    $router->get('/', 'HomeController@index');
    $router->resource('chatgpt/apis', ChatgptApiController::class);
    $router->resource('chatgpt/modes', ChatgptModeController::class);
    $router->resource('chatgpt/ask-libs', ChatgptAskLibraryController::class);
    $router->resource('chatgpt/request-logs', ChatgptApiRequestLogController::class);
    $router->resource('chatgpt/chat', ChatgptChatController::class);
    $router->resource('/chatgpt/image-create', ChatgptImageCreateController::class);
    $router->resource('/chatgpt/image-edit', ChatgptImageEditController::class);
    $router->resource('/chatgpt/image-variation', ChatgptImageVariationController::class);
    $router->resource('/chatgpt/questions', ChatgptQuestionController::class);
});

Route::group([
    'prefix' => config('admin.route.prefix'),
    'namespace' => config('admin.route.namespace'),
    'middleware' => ['cors'],
], function (Router $router) {
    $router->post('chatgpt/chat-process', 'ChatgptChatController@process');
    $router->post('chatgpt/image-create-process', 'ChatgptImageCreateController@process');
    $router->post('chatgpt/image-edit-process', 'ChatgptImageEditController@process');
    $router->post('chatgpt/image-variation-process', 'ChatgptImageVariationController@process');
});
