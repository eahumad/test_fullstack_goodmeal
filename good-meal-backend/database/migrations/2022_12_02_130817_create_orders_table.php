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
            $table->id();
						$table->integer('number')->unique()->nullable();
            $table->integer('market_id')->references('id')->on('markets');
						$table->date('ordered_at');
						$table->date('pick_up_date');
						$table->integer('delivery_price');
						$table->string('order_status_code')->references('code')->on('order_status');
            $table->timestamps();
						$table->softDeletes();
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
