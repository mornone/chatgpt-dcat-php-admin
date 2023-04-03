<?php

declare(strict_types=1);
/**
 * This file is part of https://github.com/zhaohao19941221.
 */
namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * Class ChatgptApiRequestLogType.
 */
final class ChatgptApiRequestLogType extends Enum implements LocalizedEnum
{
    public const CHAT = 1; // 聊天

    public const IMAGE_CREATE = 2; // 创建图片

    public const IMAGE_EDIT = 3; // 修改图片

    public const IMAGE_VARIATION = 4; // 图片变体
}
