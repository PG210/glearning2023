<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\CanResetPassword; 
use App\Notifications\UserResetPassword;



class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 
        'firstname', 
        'lastname', 
        'password',
        'username', 
        'sexo', 
        'email', 
        'level',
        'healt',
        'description',
        's_point',
        'i_point',
        'g_point',
        'position_id', 
        'areas_id', 
        'avatar_id', 
    ];
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function avatar()
    {
        return $this->belongsTo('App\Avatar');
    }
    public function level()
    {
        return $this->belongsTo('App\Level');
    }
        
    

    //many to many relationships
    public function positions()
    {
        return $this->belongsToMany('App\Position');
    }
    public function areas()
    {
        return $this->belongsToMany('App\Area');
    }
    public function gifts()
    {
        return $this->belongsToMany('App\Gift');
    }
    public function insignias()
    {
        return $this->belongsToMany('App\Insignia');
    }
    public function challenges()
    {
        return $this->belongsToMany('App\Challenge');
    }
    public function causes()
    {
        return $this->belongsToMany('App\Cause')->withTimestamps();
    }
    public function types()
    {
        return $this->belongsToMany('App\Type')->withPivot('user_id','id_areas');
    }
    public function subchapters()
    {
        return $this->belongsToMany('App\Subchapter');
    }


    public function sendPasswordResetNotification($token)
    {
        $this->notify(new UserResetPassword($token));
    }



}


