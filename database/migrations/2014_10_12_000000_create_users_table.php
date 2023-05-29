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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('user_type')->default('user'); // Тип пользователя (user - обычный пользователь)
            $table->string('first_name'); // Имя
            $table->string('last_name'); // Фамилия
            $table->string('email')->unique(); // Электронный адрес
            $table->timestamp('email_verified_at')->nullable(); // Верификация почты
            $table->string('password'); // Пароль
            $table->string('phone')->unique()->nullable(); // Номер телефона
            $table->string('where_from')->nullable(); // Откуда
            $table->string('where')->nullable(); // Куда
            $table->text('photo_profile_path')->nullable(); // Путь аватарки
            $table->text('about_me')->nullable(); // О себе
            $table->rememberToken(); // Токен для запоминания аккаунта в браузере
            $table->timestamps(); // Время создания и изменения аккаунта
            $table->softDeletes(); // Мягкое удаление (когда удален аккаунт)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
