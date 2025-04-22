<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoodMoralApplication extends Model
{
  use HasFactory;

  protected $fillable = [
    'fullname',
    'student_id',
    'status',
    'department',
    'reason',
    'course_completed',  // New field
    'graduation_date',    // New field
    'is_undergraduate',   // New field
    'last_course_year_level', // New field
    'last_semester_sy',   // New field
  ];

  /**
   * Get the student associated with the application.
   */
  public function student()
  {
    return $this->belongsTo(RoleAccount::class, 'student_id', 'student_id'); // Make sure 'role_account' is used
  }
}
