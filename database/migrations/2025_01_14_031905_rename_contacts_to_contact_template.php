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
        // Schema::table('contact_template', function (Blueprint $table) {
            Schema::rename('contacts', 'contact_template');
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::rename('contact_template', 'contacts');
    }
};
