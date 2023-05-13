<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SellProductHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_selleds_historic', function (Blueprint $table) {
            $table->id();
            $table->foreignId('old_user_id')->constrained('users');
            $table->foreignId('new_user_id')->constrained('users');
            $table->foreignId('product_selleds_id')->constrained('product_selleds');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_selleds_history', function (Blueprint $table) {
            $table->drop(['old_user_id']);
            $table->drop(['new_user_id']);
            $table->drop(['product_selleds_id']);
        });

        Schema::dropIfExists('product_selleds_history');
    }
}