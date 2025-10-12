<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Religion extends Model
{
    use HasFactory, HasTranslations;

    protected $fillable = [
        'name'
    ];

    protected $table = 'religions';
    
    public $translatable = ['name'];

    // Relationship with students (if you have students table)
    // public function students()
    // {
    //     return $this->hasMany(Student::class, 'religion_id');
    // }
}
