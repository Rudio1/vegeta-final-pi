<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductSelledHistoric extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_selled_historic', function (Blueprint $table) {
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
        Schema::dropIfExists('product_selled_historic');
    }
}
