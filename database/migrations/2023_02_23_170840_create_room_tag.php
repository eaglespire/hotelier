<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('room_tag', function (Blueprint $table) {
            $table->id();

            $table->foreignId('room_id')->constrained()->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->foreignId('tag_id')->constrained()->onDelete('CASCADE')->onUpdate('CASCADE');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('room_tag');
    }
};
