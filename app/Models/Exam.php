<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $fillable = ['title','category_id','exam_type_id','status','has_code'];

     public function code()
     {
         return $this->hasMany(ExamCode::class,'exam_id');
     }

}
