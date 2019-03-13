<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamQuestion extends Model
{

    protected $with = ['exam'];

    protected $fillable = ['exam_id','description'];


    public function exam(){
        return $this->belongsTo(Exam::class,'exam_id');
    }

    public function answers(){
        return $this->hasMany(Answer::class,'question_id');
    }

    public function hint(){
        return $this->hasOne(QuestionHint::class, 'question_id');
    }
    public function getActionAttribute()
    {
        $action  ="<div class=\"btn-group\" role=\"group\" aria-label=\"Basic example\">
                <a href='".route('backend.questions.edit',$this->id)."' type=\"button\" class=\"btn btn-secondary\"><i class=\"fa fa-cog\"></i></a>
              </div>";
        $action  .="<div class=\"btn-group\" role=\"group\" aria-label=\"Basic example\">
                <a href='".route('backend.question.delete',$this->id)."' type=\"button\" class=\"btn btn-danger\"><i class=\"fa fa-trash\"></i></a>
              </div>";


        return $action;
    }
}
