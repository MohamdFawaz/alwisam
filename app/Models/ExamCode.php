<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamCode extends Model
{
    protected $fillable = ['exam_id','code','user_id'];
}
