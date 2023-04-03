<?php

declare(strict_types=1);
/**
 * This file is part of https://github.com/zhaohao19941221.
 */
namespace App\Models;

use Dcat\Admin\Models\Administrator;
use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ChatgptApiRequestLog.
 *
 * @property int $id
 * @property int $user_id 用户id
 * @property int $type 类型  1聊天 2生成图片 3编辑图片
 * @property string $request_body 查询内容
 * @property string $ask 回复内容
 * @property null|\Illuminate\Support\Carbon $created_at
 * @property null|\Illuminate\Support\Carbon $updated_at
 * @property null|Administrator $administrator
 * @property null|\App\Models\ChatgptApi $api
 * @property null|\App\Models\ChatgptMode $mode
 * @method static \Illuminate\Database\Eloquent\Builder|ChatgptApiRequestLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChatgptApiRequestLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChatgptApiRequestLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|ChatgptApiRequestLog whereAsk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatgptApiRequestLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatgptApiRequestLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatgptApiRequestLog whereRequestBody($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatgptApiRequestLog whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatgptApiRequestLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatgptApiRequestLog whereUserId($value)
 * @mixin \Eloquent
 */
class ChatgptApiRequestLog extends Model
{
    use HasDateTimeFormatter;

    protected $table = 'chatgpt_api_request_logs';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'type', 'request_body', 'ask',
    ];

    /**
     * 关联用户.
     */
    public function administrator(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Administrator::class, 'id', 'user_id');
    }

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
