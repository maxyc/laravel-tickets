<?php

use App\Order;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(
            'orders',
            static function (Blueprint $table) {
                $table->id();

                $table->string('title');
                $table->text('note');
                $table->string('file')->nullable();

                $table->string('status')->default(Order::STATUS_NEW);
                $table->boolean('is_read')->default(false);
                $table->boolean('has_answer')->default(false);

                $table->foreignId('owner_id')
                    ->constrained('users')
                    ->cascadeOnDelete();

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
        Schema::dropIfExists('orders');
    }
}
