<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Models\Grade;
class Section extends Model 
{
    use HasTranslations;

    protected $table = 'sections';
    public $timestamps = true;
    protected $fillable = array('Name_Section', 'Status', 'grade_id', 'classes_id');
    public $translatable = ['Name_Section'];

    // علاقة بين الاقسام والصفوف لجلب اسم الصف في جدول الاقسام
    public function My_classs()
    {
        return $this->belongsTo('App\Models\Classe', 'classes_id');
    }
    // علاقة بين الاقسام والمراحل لجلب اسم المرحلة في جدول الاقسام
    public function Grades()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }
    // علاقة الاقسام مع المعلمين
    public function teachers()
    {
        return $this->belongsToMany('App\Models\Teacher','section_teacher');
    }
}