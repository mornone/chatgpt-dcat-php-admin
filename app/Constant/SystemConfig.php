<?php

declare(strict_types=1);
/**
 * This file is part of https://github.com/zhaohao19941221.
 */
namespace App\Constant;

/**
 * Class System.
 */
class SystemConfig
{
    public const TEMPERATURE = 'temperature'; // 温度

    public const MAX_TOKENS = 'max_tokens_userid'; // token长度

    public const PROXY_DOMAIN = 'proxy_domain'; // 代理

    public const PRESENCE_PENALTY = 'presence_penalty'; // -2.0和2.0之间的数字。正值会根据新标记到目前为止是否出现在文本中来惩罚它们，从而增加模型谈论新主题的可能性。

    public const FREQUENCY_PENALTY = 'frequency_penalty'; // 惩罚力度 0-2 越高越减少token消耗，避免重复字符，但是可能会不准确
}
