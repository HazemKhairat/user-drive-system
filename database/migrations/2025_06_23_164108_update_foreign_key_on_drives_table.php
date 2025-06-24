<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('drives', function (Blueprint $table) {
            // Drop existing foreign key
            $table->dropForeign(['user_id']);

            // Re-add foreign key with cascade delete
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('drives', function (Blueprint $table) {
            $table->dropForeign(['user_id']);

            // Re-add original foreign key without cascade
            $table->foreign('user_id')
                ->references('id')->on('users');
        });
    }

};
