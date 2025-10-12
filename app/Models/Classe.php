<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;

class Classe extends Model 
{
    use HasTranslations;

    protected $table = 'classes';
    public $timestamps = true;
    
    protected $fillable = array('Name_Classe', 'grade_id');
    
    public $translatable = ['Name_Classe'];

    public function Grade()
    {
        return $this->belongsTo(Grade::class, 'grade_id');
    }
}