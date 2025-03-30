<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoleAccount extends Authenticatable
{
  use HasFactory;

  protected $table = 'role_account'; // Specify the table name explicitly
  protected $fillable = [
    'email',
    'password',
    'account_type',
    'student_id',
    'fullname',
    'status',
  ];

  protected $hidden = [
    'password', // Hide the password from being returned
  ];

  // Optionally, define any additional methods or relationships
}
