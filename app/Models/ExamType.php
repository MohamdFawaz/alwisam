<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExamType extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     public $timestamps = false;

     protected $fillable = ['name','sort'];

     public function scopeSort($query){
        return $query->orderBy('sort','ASC');
     }

    public function getActionAttribute()
    {
        $action  ="<div class=\"btn-group\" role=\"group\" aria-label=\"Basic example\">
                <a href='".route('backend.exam-type.edit',$this->id)."' type=\"button\" class=\"btn btn-secondary\"><i class=\"fa fa-cog\"></i></a>
              </div>";
        return $action;
    }
}
