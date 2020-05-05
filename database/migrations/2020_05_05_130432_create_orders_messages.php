<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersMessages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'order_messages',
            static function (Blueprint $table) {
                $table->id();

                $table->foreignId('order_id')
                    ->constrained('orders')
                    ->cascadeOnDelete();

                $table->foreignId('owner_id')
                    ->constrained('users')
                    ->cascadeOnDelete();

                $table->text('text');


                $table->timestamps();
            }
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_messages');
    }
}
