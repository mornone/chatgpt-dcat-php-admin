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
//        Schema::create('chatgpt_apis', function (Blueprint $table) {
//            $table->bigIncrements('id');
//            $table->string('name')->unique()->comment('api名称');
//            $table->string('url')->unique()->comment('api路径');
//            $table->unsignedTinyInteger('status')->default(1)->comment('api开启状态 1开启 0关闭');
//            $table->timestamps();
//            $table->index('status', 'status');
//            $table->comment('api列表');
//        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
//        Schema::dropIfExists('chatgpt_apis');
    }
};
