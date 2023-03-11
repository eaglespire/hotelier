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
        Schema::create('booking_histories', function (Blueprint $table) {
            $table->id();
            $table->string('firstname')->nullable();
            $table->string('lastname')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('title')->nullable();
            $table->string('gender')->nullable();
            $table->integer('uuid');
            $table->enum('mode',['online','offline'])->nullable();
            $table->integer('nights')->nullable();
            $table->date('arrival')->nullable();
            $table->date('departure')->nullable();
            $table->foreignId('room_category_id')->constrained()->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreignId('room_id')->constrained()->onUpdate('CASCADE')->onDelete('CASCADE');
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
        Schema::dropIfExists('booking_histories');
    }
};
