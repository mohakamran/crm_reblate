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
        Schema::create('table_login_details', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('email')->unique();
            $table->string('emp_code');
            $table->string('employee_type');

            // String columns for (Employees, Expenses, Clients, Invoices, Salary Slips, Tasks, Attendance)
            $table->string('employees_access')->nullable();
            $table->string('expenses_access')->nullable();
            $table->string('clients_access')->nullable();
            $table->string('invoices_access')->nullable();
            $table->string('salary_slips_access')->nullable();
            $table->string('tasks_access')->nullable();
            $table->string('attendance_access')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('table_login_details');
    }
};
