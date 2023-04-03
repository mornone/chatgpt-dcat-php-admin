<?php

declare(strict_types=1);
/**
 * This file is part of https://github.com/zhaohao19941221.
 */
use App\Enums\ChatgptApiRequestLogType;
use App\Enums\ChatgptApiStatus;
use App\Enums\ChatgptModeStatus;

return [
    ChatgptApiStatus::class => [
        ChatgptApiStatus::OFF => '关闭',
        ChatgptApiStatus::ON => '开启',
    ],
    ChatgptModeStatus::class => [
        ChatgptModeStatus::OFF => '关闭',
        ChatgptModeStatus::ON => '开启',
    ],
    ChatgptApiRequestLogType::class => [
        ChatgptApiRequestLogType::CHAT => '聊天',
        ChatgptApiRequestLogType::IMAGE_CREATE => '创建图片',
        ChatgptApiRequestLogType::IMAGE_EDIT => '修改图片',
        ChatgptApiRequestLogType::IMAGE_VARIATION => '图片变体',
    ],
];
