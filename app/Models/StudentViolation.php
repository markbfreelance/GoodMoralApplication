<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentViolation extends Authenticatable
{
  use HasFactory;

  protected $table = 'student_violations'; // Specify the table name if it's not the plural form of the model name

  protected $fillable = [
    'first_name',
    'last_name',
    'student_id',
    'status',
    'offense_type',
    'added_by',
    'violation',
    'unique_id',
    'department',
  ];

  /**
   * Relationship: A student violation belongs to a student.
   */
}
