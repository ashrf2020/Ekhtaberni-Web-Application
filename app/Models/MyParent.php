<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Translatable\HasTranslations;
use Illuminate\Foundation\Auth\User as Authenticatable;

class MyParent extends Authenticatable
{
    use HasTranslations;
    use HasFactory;
    
    public $translatable = ['Name_Father','Jop_Father','Name_Mother','Jop_Mother'];
    protected $table = 'my_parents';
    protected $guarded=[];
    
    // Relationship with ParentAttachment
    public function attachments()
    {
        return $this->hasMany(ParentAttachment::class, 'parent_id');
    }
}