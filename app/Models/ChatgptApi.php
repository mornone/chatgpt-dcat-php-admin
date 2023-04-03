<?php

declare(strict_types=1);
/**
 * This file is part of https://github.com/zhaohao19941221.
 */
namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ChatgptApi.
 *
 * @property int $id
 * @property string $name api名称
 * @property string $url api路径
 * @property int $status api开启状态 1开启 0关闭
 * @property null|\Illuminate\Support\Carbon $created_at
 * @property null|\Illuminate\Support\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ChatgptApi newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChatgptApi newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChatgptApi query()
 * @method static \Illuminate\Database\Eloquent\Builder|ChatgptApi whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatgptApi whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatgptApi whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatgptApi whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatgptApi whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatgptApi whereUrl($value)
 * @mixin \Eloquent
 */
class ChatgptApi extends Model
{
    use HasDateTimeFormatter;

    protected $table = 'chatgpt_apis';
}
