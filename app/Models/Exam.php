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

    public function getActionAttribute()
    {
        $action  ="<div class=\"btn-group\" role=\"group\" aria-label=\"Basic example\">
                <a href='".route('backend.exam.edit',$this->id)."' type=\"button\" class=\"btn btn-secondary\"><i class=\"fa fa-cog\"></i></a>
              </div>";

        $action  .="<div class=\"btn-group\" role=\"group\" aria-label=\"Basic example\">
                <a href='".route('backend.exam.delete',$this->id)."' type=\"button\" class=\"btn btn-danger\"><i class=\"fa fa-trash\"></i></a>
              </div>";

//        $action  .="<div class=\"btn-group\" role=\"group\" aria-label=\"Basic example\">
//                <a type=\"button\" class=\"btn btn-info import\"><i class=\"fa fa-plus\"></i></a>
//              </div>
//              <input class=\"file-input\" type=\"file\" name=\"import\" style=\"display: none;\" />";

        $action  .= "<form method=\"POST\" action=\"".route('backend.exam.import')."\" enctype='multipart/form-data'>
                    ".csrf_field()."
                    ".method_field('POST')."
                    <input type='hidden' name='exam_id' value='".$this->id."'>
                    <div class='btn-group'>
                    <input type=\"file\" name=\"import\" id=\"file\" class=\"btn btn-danger\" style='width:100px;' '>
                    </div>
                    <button type=\"submit\">Import</button>
                </form>";
        return $action;
    }

}
