<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class StudentRegistration extends Authenticatable
{
  use HasFactory;

  protected $table = 'student_registrations';

  protected $fillable = [
    'fname',
    'lname',
    'email',
    'department',
    'password',
    'status',
    'student_id',
    'account_type',
    'year_level',
  ];


  protected $hidden = [
    'password',
  ];
}
