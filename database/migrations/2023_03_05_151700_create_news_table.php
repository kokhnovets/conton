<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id(); // Идентификатор
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Идентификатор пользователя
            $table->string('title'); // Название новости
            $table->text('content'); // Контент
            $table->string('preview'); // Превью
            $table->timestamps(); // Время создания и обновления
            $table->softDeletes(); // Мягкое удаление
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('news');
    }
};
