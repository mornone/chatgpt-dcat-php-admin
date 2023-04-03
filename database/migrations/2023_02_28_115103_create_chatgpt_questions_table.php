<?php

declare(strict_types=1);
/**
 * This file is part of https://github.com/zhaohao19941221.
 */
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatgptQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('chatgpt_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('question')->default('')->comment('问题');
            $table->longText('ask')->comment('解决方案或回答');
            $table->timestamps();
            $table->comment('问题收录');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('chatgpt_questions');
    }
}
