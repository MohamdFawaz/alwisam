<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $fillable = ['content','image'];

    public function getImageAttribute($value)
    {
        if ($value) {
            return asset('public/images/notification/' . $value);
        } else {
            return asset('public/images/notification/no-image.jpg');
        }
    }

}
