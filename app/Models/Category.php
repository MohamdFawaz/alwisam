<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
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

}
