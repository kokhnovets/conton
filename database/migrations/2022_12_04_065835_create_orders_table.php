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
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // Идентификатор
            $table->text('product_link'); // Ссылка на товар
            $table->string('appellation'); // Наименование товара
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Идентификатор пользователя
            $table->text('description')->nullable(); // Описание товара
            $table->unsignedInteger('count'); // Количество товаров
            $table->float('price'); // Цена одного товара
            $table->text('wishes')->nullable(); // Пожелания покупателя
            $table->text('delivery_from'); // Где заказать
            $table->text('where_to_deliver'); // Куда доставить
            $table->date('deliver_to'); // До какого числа доставить
            $table->float('award'); // Вознаграждение
            $table->float('commission'); // Комиссия Conton
            $table->float('total'); // Итоговая стоимость
            $table->boolean('order_status')->default(0); // Статус заказа
            $table->timestamps(); // Время создания заказа
            $table->softDeletes(); // Мягкое удаление заказа
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
