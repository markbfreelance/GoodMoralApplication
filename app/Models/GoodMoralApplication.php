<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoodMoralApplication extends Model
{
  use HasFactory;

  protected $fillable = ['fullname','student_id', 'status', 'department'];

  /**
   * Get the student associated with the application.
   */
  public function student()
  {
    return $this->belongsTo(RoleAccount::class, 'student_id', 'student_id'); // Make sure 'role_account' is used
  }
}
