<?php

declare(strict_types=1);
/**
 * This file is part of https://github.com/zhaohao19941221.
 */
use Dcat\Admin\OperationLog\Http\Controllers;
use Illuminate\Support\Facades\Route;

Route::get('auth/operation-logs', Controllers\LogController::class . '@index')->name('dcat-admin.operation-log.index');
Route::delete('auth/operation-logs/{id}', Controllers\LogController::class . '@destroy')->name('dcat-admin.operation-log.destroy');
