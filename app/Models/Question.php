<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Quizze;

class Question extends Model
{
    public function quizze()
    {
        // Return a default Quizze instance if the relationship is missing to avoid null errors in views
        return $this->belongsTo(Quizze::class)->withDefault();
    }
}
