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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();  // Project ID
            $table->string('name');  // Project Name
            $table->text('description')->nullable();  // Description
            $table->date('start_date');  // Start Date
            $table->date('end_date');  // End Date
            $table->string('status');  // Project Status
            $table->json('assigned_team_members')->nullable();  // Assigned Team Members (Array of IDs)
            $table->decimal('budget', 10, 2)->nullable();  // Budget
            $table->string('client')->nullable();  // Client/Stakeholder
            $table->string('priority')->nullable();  // Priority
            $table->json('attachments')->nullable();  // Attachments/Files (Array of file paths or URLs)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};
