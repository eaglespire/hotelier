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
            $table->foreignId('guest_id')->constrained()->onUpdate('CASCADE')->onDelete('CASCADE');
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
