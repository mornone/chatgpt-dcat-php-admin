<?php

declare(strict_types=1);
/**
 * This file is part of https://github.com/zhaohao19941221.
 */
namespace App\Models;

use Dcat\Admin\Traits\HasDateTimeFormatter;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\ChatgptQuestion.
 *
 * @property int $id
 * @property string $question 问题
 * @property string $ask 解决方案或回答
 * @property null|\Illuminate\Support\Carbon $created_at
 * @property null|\Illuminate\Support\Carbon $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|ChatgptQuestion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChatgptQuestion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ChatgptQuestion query()
 * @method static \Illuminate\Database\Eloquent\Builder|ChatgptQuestion whereAsk($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatgptQuestion whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatgptQuestion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatgptQuestion whereQuestion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ChatgptQuestion whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class ChatgptQuestion extends Model
{
    use HasDateTimeFormatter;

    protected $table = 'chatgpt_questions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'type', 'request_body', 'ask',
    ];
}
