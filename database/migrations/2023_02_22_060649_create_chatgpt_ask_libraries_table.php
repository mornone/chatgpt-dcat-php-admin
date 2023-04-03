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
//        Schema::create('chatgpt_ask_libraries', function (Blueprint $table) {
//            $table->bigIncrements('id');
//            $table->unsignedInteger('api_id')->default(0)->comment('api_id');
//            $table->unsignedInteger('mode_id')->default(0)->comment('训练模型id');
//            $table->string('request_body')->comment('问题');
//            $table->text('ask')->comment('回答');
//            $table->timestamps();
//            $table->index('api_id', 'api_id');
//            $table->index('mode_id', 'mode_id');
//            $table->index('request_body', 'request_body');
//            $table->comment('聊天回答缓存话术');
//        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
//        Schema::dropIfExists('chatgpt_ask_libraries');
    }
};
