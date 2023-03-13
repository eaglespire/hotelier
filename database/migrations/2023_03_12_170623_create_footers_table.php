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
        Schema::create('footers', function (Blueprint $table) {
            $table->id();
            $table->string('link')->nullable();
            $table->string('custom_link')->nullable();
            $table->string('icon')->nullable();
            $table->string('title')->nullable();
            $table->enum('column',['one','two','three','four']);
            $table->boolean('is_newsletter')->default(false)->nullable();
            $table->string('newsletter_text')->nullable();
            $table->string('newsletter_placeholder')->nullable();
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
        Schema::dropIfExists('footers');
    }
};
