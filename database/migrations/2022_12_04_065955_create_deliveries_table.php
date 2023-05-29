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
        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->onDelete('cascade'); // Идентификатор заказа
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Идентификатор пользователя
            $table->boolean('order_is_completed')->default(false); // Пометка о том, выполнен ли зкаказ или нет
            $table->timestamps(); // Дата создания и редактирования
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
        Schema::dropIfExists('deliveries');
    }
};
