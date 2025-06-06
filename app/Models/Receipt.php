<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
  use HasFactory;

  protected $table = 'receipt';

  protected $fillable = [
    'document_path',
    'reference_num',
  ];
}
