<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;

class online_classe extends Model
{
    //protected $guarded=[];
    public $fillable= ['Grade_id','Classroom_id','section_id','user_id','meeting_id','topic','start_at','duration','password','start_url','join_url'];
    
    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'start_at' => 'datetime',
    ];

    public function grade()
    {
        return $this->belongsTo('App\Models\Grade', 'Grade_id');
    }


    public function classroom()
    {
        return $this->belongsTo('App\Models\Classe', 'Classroom_id');
    }


    public function section()
    {
        return $this->belongsTo('App\Models\Section', 'section_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}