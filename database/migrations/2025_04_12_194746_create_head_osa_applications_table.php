<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up()
  {
    Schema::create('head_osa_applications', function (Blueprint $table) {
      $table->id();

      // Foreign key to Good Moral Application
      $table->unsignedBigInteger('application_id');
      $table->foreign('application_id')->references('id')->on('good_moral_applications')->onDelete('cascade');

      // Direct student_id reference for easy access
      $table->string('student_id');
      $table->foreign('student_id')->references('student_id')->on('role_account')->onDelete('cascade');

      // Status of the application
      $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');

      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::dropIfExists('head_osa_applications');
  }
};
