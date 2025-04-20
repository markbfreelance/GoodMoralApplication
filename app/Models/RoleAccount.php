<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class RoleAccount extends Authenticatable
{
  use HasFactory;

  protected $table = 'role_account'; // Specify the table name explicitly
  protected $fillable = [
    'email',
    'password',
    'account_type',
    'student_id',
    'department',
    'fullname',
    'status',
  ];

  protected $hidden = [
    'password', // Hide the password from being returned
  ];
  public function setfullnameAttribute($value)
  {
    $this->attributes['fullname'] = strtoupper($value);
  }
  public function studentInfo()
  {
    return $this->belongsTo(StudentRegistration::class, 'student_id', 'student_id',);
  }
}
