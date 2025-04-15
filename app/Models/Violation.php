<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Violation extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
      'offense_type',
      'description',
    ];

}
