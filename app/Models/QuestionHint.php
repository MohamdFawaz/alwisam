<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuestionHint extends Model
{
    protected $fillable = ['question_id','hint_text'];
}
