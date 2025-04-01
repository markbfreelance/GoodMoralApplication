<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoodMoralApplicationsTable extends Migration
{
  public function up()
  {
    Schema::create('good_moral_applications', function (Blueprint $table) {
      $table->id();
      $table->foreignId('student_id')->constrained('role_account')->onDelete('cascade'); // Corrected to 'role_account' (singular)
      $table->enum('status', ['pending', 'approved', 'rejected'])->default('pending');
      $table->timestamps();
    });
  }

  public function down()
  {
    Schema::dropIfExists('good_moral_applications');
  }
}
