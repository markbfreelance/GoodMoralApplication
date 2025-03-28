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
        Schema::create('student_registrations', function (Blueprint $table) {
            $table->id(); // Auto-increment primary key
            $table->string('Fname'); // First name of the student
            $table->string('Lname'); // Last name of the student
            $table->string('Email')->unique(); // Email (unique)
            $table->string('Password'); // Password (hashed)
            $table->string('Status'); // Password (hashed)
            $table->string('AccountType')->nullable(); // Phone number (optional)
            $table->string('YearLevel')->nullable(); // Year Level (e.g., 1st Year, 2nd Year)
            $table->timestamps(); // Created_at & updated_at
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_registrations');
    }
};
