<?php

declare(strict_types=1);
/**
 * This file is part of https://github.com/zhaohao19941221.
 */
namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ChatgptAskLibrary.
 *
 * @property int $id
 * @property int $api_id api_id
 * @property int $mode_id 训练模型id
 * @property string $request_body 问题
 * @property string $ask 回答
 * @property null|\Illuminate\Support\Carbon $created_at
 * @property null|\Illuminate\Support\Carbon $updated_at
 * @property null|\App\Models\ChatgptApi $api
 * @property null|\App\Models\ChatgptMode $mode
 * @method static \Illuminate\Database\Eloquent\Builder|ChatgptAskLibrary newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChatgptAskLibrary newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChatgptAskLibrary query()
 * @method static \Illuminate\Database\Eloquent\Builder|ChatgptAskLibrary whereApiId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatgptAskLibrary whereAsk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatgptAskLibrary whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatgptAskLibrary whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatgptAskLibrary whereModeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatgptAskLibrary whereRequestBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatgptAskLibrary whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ChatgptAskLibrary extends Model
{
    use HasDateTimeFormatter;

    protected $table = 'chatgpt_ask_libraries';

    /**
     * 关联模型.
     */
    public function mode(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ChatgptMode::class, 'id', 'mode_id');
    }

    /**
     * 关联api.
     */
    public function api(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(ChatgptApi::class, 'id', 'api_id');
    }
}
