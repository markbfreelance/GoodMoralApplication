<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeadOSAApplication extends Model
{
  use HasFactory;

  protected $table = 'head_osa_applications'; // ✅ Explicit table name

  protected $fillable = [
    'application_id',
    'student_id',
    'department',
    'status',
  ];

  public function student()
  {
    return $this->belongsTo(RoleAccount::class, 'student_id', 'student_id');
  }
}
