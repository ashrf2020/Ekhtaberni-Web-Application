<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use App\Models\Section;
class Grade extends Model 
{
    use HasTranslations;
    protected $fillable = ["Name" , "Note"];
    protected $table = 'grades';
    public $timestamps = true;
    public $translatable = ['Name', 'Note'];
    public function Sections()
    {
        return $this->hasMany(Section::class, 'grade_id');
    }
}