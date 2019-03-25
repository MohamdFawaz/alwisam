<?php

namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','user_image','phone','email','dob','user_status','activate_code','firebase_token','jwt_token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getUserImageAttribute($value)
    {
        if ($value) {
            return asset('public/images/profile/' . $value);
        } else {
            return asset('public/images/profile/no-image.jpg');
        }
    }

    public function setUserImageAttribute($value)
    {
        if($value){
            $img_name = time().rand(1111,9999).'.'.$value->getClientOriginalExtension();
            $value->move(public_path('images/profile/'),$img_name);
            $this->attributes['user_image'] = $img_name ;
        }
    }

    public function getNameAttribute($value)
    {
        return ucwords($value);
    }


}
