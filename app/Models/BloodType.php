<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloodType extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'notes'
    ];

    protected $table = 'blood_types';

    // Relationship with students (if you have students table)
    // public function students()
    // {
    //     return $this->hasMany(Student::class, 'blood_type_id');
    // }
}