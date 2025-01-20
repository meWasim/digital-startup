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
        Schema::create('about_us', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Associates the content with a user
            $table->unsignedBigInteger('template_id'); // Foreign key for templates
            $table->text('our_story')->nullable(); // Content for 'Our Story'
            $table->text('mission')->nullable(); // Content for 'Mission'
            $table->text('vision')->nullable(); // Content for 'Vision'
            $table->string('image_path')->nullable(); // Path to the image file
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('template_id')->references('id')->on('templates')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about_us');
    }
};
