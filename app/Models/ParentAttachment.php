<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParentAttachment extends Model
{
    use HasFactory;
    
    protected $fillable = ['file_name', 'parent_id'];
    
    // Relationship with MyParent
    public function parent()
    {
        return $this->belongsTo(MyParent::class, 'parent_id');
    }
}