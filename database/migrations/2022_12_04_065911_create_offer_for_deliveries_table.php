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
        Schema::create('offer_for_deliveries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade'); // Идентификатор заказа
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Идентификатор пользователя
            $table->text('message')->nullable(); // Сообщение
            $table->float('offer'); // Предложение от путешественника
            $table->timestamps(); // Время создания и изменения
            $table->softDeletes(); // Мягкое удаление предложения
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offer_for_deliveries');
    }
};
