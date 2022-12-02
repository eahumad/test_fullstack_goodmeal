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
        Schema::create('good_market', function (Blueprint $table) {
            $table->id();
						$table->integer('good_id')->references('id')->on('goods');
						$table->integer('market_id')->references('id')->on('markets');
						$table->integer('normal_price');
						$table->integer('good_meal_price');
						$table->integer('stock');
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
        Schema::dropIfExists('good_market');
    }
};
