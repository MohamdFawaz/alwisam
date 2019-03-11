<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $with = ['category'];
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

     public function questions()
     {
         return $this->hasMany(ExamQuestion::class,'exam_id');
     }

     public function category()
     {
         return $this->belongsTo(Category::class,'category_id');
     }

}
