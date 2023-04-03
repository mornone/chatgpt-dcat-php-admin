<?php

declare(strict_types=1);
/**
 * This file is part of https://github.com/zhaohao19941221.
 */
namespace Dcat\Admin\OperationLog;

use Dcat\Admin\Extend\ServiceProvider;
use Dcat\Admin\OperationLog\Http\Middleware\LogOperation;

class OperationLogServiceProvider extends ServiceProvider
{
    protected $middleware = [
        'middle' => [
            LogOperation::class,
        ],
    ];

    protected $menu = [
        [
            'title' => 'Operation Log',
            'uri' => 'auth/operation-logs',
        ],
    ];

    public function settingForm()
    {
        return new Setting($this);
    }
}
