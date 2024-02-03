<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pain_user', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('pain_id')->unsigned()->index();
            $table->bigInteger('user_id')->unsigned()->index();
            $table->text('description');
            $table->timestamp('when');
            $table->foreign('pain_id')->references('id')->on('pains')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
