<?php

declare(strict_types=1);
/**
 * This file is part of https://github.com/zhaohao19941221.
 */
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class() extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('chatgpt_api_request_logs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id')->default(0)->comment('用户id');
//            $table->unsignedBigInteger('mode_id')->default(0)->comment('模型id');
//            $table->unsignedBigInteger('api_id')->default(0)->comment('模型id');
            $table->unsignedTinyInteger('type')->default(1)->comment('类型  1聊天 2生成图片 3编辑图片');
            $table->string('request_body')->default('')->comment('查询内容');
            $table->longText('ask')->comment('回复内容');
            $table->timestamps();
//            $table->index('api_id', 'api_id');
//            $table->index('mode_id', 'mode_id');
            $table->index('user_id', 'user_id');
            $table->index('type', 'type');
            $table->index('request_body', 'request_body');

            $table->comment('用户api请求日志记录');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('chatgpt_api_request_logs');
    }
};
