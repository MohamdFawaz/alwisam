<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $with = ['parentCategory'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $fillable = ['name','parent','image'];

    public function getImageAttribute($value)
    {
        if ($value) {

            return asset('public/images/category/' . $value);
        } else {
            return asset('public/images/category/no-image.jpg');
        }
    }

    public function child()
    {
        return $this->hasMany(Category::class,'parent')->select('id','name','image','parent');
    }

    public function parentCategory(){
        return $this->belongsTo(Category::class,'parent');
    }

    public function getActionAttribute()
    {
        $action  ="<div class=\"btn-group\" role=\"group\" aria-label=\"Basic example\">
                <a href='".route('backend.category.edit',$this->id)."' type=\"button\" class=\"btn btn-secondary\"><i class=\"fa fa-cog\"></i></a>
              </div>";
        return $action;
    }
}
