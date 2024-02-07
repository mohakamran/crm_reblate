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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('Emp_Code');
            $table->string('Emp_Full_Name');
            $table->string('Emp_Email');
            $table->string('Emp_Phone');
            $table->string('Emp_Designation');
            $table->string('Emp_Status');
            $table->string('Emp_Shift_Time');
            $table->date('Emp_Joining_Date');
            $table->string('Emp_Address');
            $table->string('Emp_Image');
            $table->string('Emp_Relation');
            $table->string('Emp_Relation_Name');
            $table->string('Emp_Relation_Phone');
            $table->string('Emp_Relation_Address');
            $table->string('Emp_Bank_Name');
            $table->string('Emp_Bank_IBAN');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
