<?php

declare(strict_types=1);
/**
 * This file is part of https://github.com/zhaohao19941221.
 */
namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ChatgptMode.
 *
 * @property int $id
 * @property string $name 模型名称
 * @property int $status mode状态 1开启 0关闭
 * @property null|\Illuminate\Support\Carbon $created_at
 * @property null|\Illuminate\Support\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ChatgptMode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChatgptMode newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChatgptMode query()
 * @method static \Illuminate\Database\Eloquent\Builder|ChatgptMode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatgptMode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatgptMode whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatgptMode whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatgptMode whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ChatgptMode extends Model
{
    use HasDateTimeFormatter;

    protected $table = 'chatgpt_modes';
}
