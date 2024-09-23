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
        Schema::table('do_list', function (Blueprint $table) {
            $table->string('approval')->nullable(); // Stores "approved" or "not approved"
            $table->text('disapproval_reason')->nullable(); // Stores the reason for disapproval
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('do_list', function (Blueprint $table) {
            //
        });
    }
};
