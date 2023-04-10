<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsPosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments_posts', function (Blueprint $table) {
            $table->id();
            $table->longtext('comment');
            $table->Integer('assessment');
            $table->foreignId('email_user')->constrained('users');
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
        Schema::table('comments_posts', function (Blueprint $table) {
            $table->dropForeign(['email_user']);
        });
        Schema::dropIfExists('comments_posts');
    }
}
