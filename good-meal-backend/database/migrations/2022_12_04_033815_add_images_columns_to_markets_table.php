<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up() {
    Schema::table('markets', function (Blueprint $table) {
      $table->string('logo')->after('address');
      $table->string('cover')->after('logo');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down() {
    Schema::table('markets', function (Blueprint $table) {
      $table->dropColumn('logo');
      $table->dropColumn('cover');
    });
  }
};
