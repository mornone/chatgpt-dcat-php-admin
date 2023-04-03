<?php

declare(strict_types=1);
/**
 * This file is part of https://github.com/zhaohao19941221.
 */
namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * 模型状态
 * Class ChatgptModeStatus.
 */
final class ChatgptModeStatus extends Enum implements LocalizedEnum
{
    public const OFF = 0; // 关闭

    public const ON = 1; // 开启
}
