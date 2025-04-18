<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up()
  {
    Schema::create('head_osa_applications', function (Blueprint $table) {
      $table->id();
      $table->string('student_id'); // Use string() to store alphanumeric student_id
      $table->foreign('student_id')->references('student_id')->on('role_account')->onDelete('cascade');
      $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
      $table->string('department');
      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::dropIfExists('head_osa_applications');
  }
};
