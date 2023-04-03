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
//        Schema::create('chatgpt_modes', function (Blueprint $table) {
//            $table->bigIncrements('id');
//            $table->string('name')->default('')->comment('模型名称');
//            $table->unsignedTinyInteger('status')->default(1)->comment('mode状态 1开启 0关闭');
//            $table->timestamps();
//            $table->index('name', 'name');
//            $table->index('status', 'status');
//            $table->comment('训练模型');
//        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
//        Schema::dropIfExists('chatgpt_modes');
    }
};
