<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamQuestion extends Model
{
    protected $with = ['answers'];

    protected $fillable = ['exam_id','description'];

    public function answers(){
        return $this->hasMany(Answer::class,'question_id');
    }
}
