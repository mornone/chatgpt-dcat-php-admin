<?php

declare(strict_types=1);
/**
 * This file is part of https://github.com/zhaohao19941221.
 */
namespace App\Enums;

use BenSampo\Enum\Contracts\LocalizedEnum;
use BenSampo\Enum\Enum;

/**
 * GetImageType
 * Class GetImageType.
 */
final class GetImageType extends Enum implements LocalizedEnum
{
    public const URL = 'url'; // url

    public const BASE64 = 'base64'; // base64
}
