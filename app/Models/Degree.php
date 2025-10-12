<?php

namespace App\Models;

use App\Models\Question;
use App\Models\Quizze;
use App\Models\Student;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Degree extends Model
{
    use HasFactory;
    protected $table = 'degrees';
    protected $fillable = [
        'student_id',
        'quizze_id',
        'question_id',
        'score',
        'date',
        'abuse',
    ];
    function student()
    {
        return $this->belongsTo(Student::class);
    }
    function quizze()
    {
        return $this->belongsTo(Quizze::class);
    }
    function question()
    {
        return $this->belongsTo(Question::class);
    }
}