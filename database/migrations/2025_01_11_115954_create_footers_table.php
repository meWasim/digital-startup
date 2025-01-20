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
        Schema::create('footers', function (Blueprint $table) {
            $table->id();
        $table->unsignedBigInteger('user_id');
        $table->unsignedBigInteger('template_id');
        $table->string('about_us_title')->nullable();
        $table->text('about_us_text')->nullable();
        $table->string('footer_logo')->nullable();
        $table->string('email')->nullable();
        $table->string('phone')->nullable();
        $table->text('address')->nullable();
        $table->json('useful_links')->nullable(); // Store links as JSON
        $table->json('social_links')->nullable(); // Store social links as JSON
        $table->string('footer_text')->nullable();
        $table->string('developer_name')->nullable();
        $table->string('developer_link')->nullable();
        $table->timestamps();

        $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        $table->foreign('template_id')->references('id')->on('templates')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('footers');
    }
};
