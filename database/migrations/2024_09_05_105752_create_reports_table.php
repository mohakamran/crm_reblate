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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->string('employee_id'); 
            $table->string('month');
            $table->year('year');
            $table->text('tasks_completed');
            $table->text('projects_worked_on')->nullable();
            $table->text('goals_achieved')->nullable();
            $table->text('challenges_faced')->nullable();
            $table->text('goals_for_next_month')->nullable();
            $table->text('admin_comments')->nullable();
            $table->text('manager_comments')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
