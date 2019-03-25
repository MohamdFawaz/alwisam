<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserProgress extends Model
{
    protected $fillable = ['user_id','question_id','exam_id','is_correct'];

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }

    public function exam()
    {
        return $this->belongsTo(Exam::class,'exam_id');
    }
}
