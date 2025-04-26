<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NotifArchive extends Model
{
    use HasFactory;

    protected $table = 'notifarchives'; // Table name

    protected $fillable = [
        'student_id',
        'reference_number',
        'number_of_copies',
        'status',
        'fullname',
        'department',
        'reason',
        'application_status',
        'course_completed',
        'graduation_date',
        'is_undergraduate',
        'last_course_year_level',
        'last_semester_sy',
    ];

    // If you're working with timestamps
    public $timestamps = true;
}
