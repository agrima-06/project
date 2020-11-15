<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','lname', 'userId' ,'email', 'password','role','img'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function Homeworks()
    {
        return $this->hasMany('App\Homework');
    }
    public function student()
    {
        return $this->hasOne('App\Student');
    }
    public function teacher()
    {
        return $this->hasOne('App\Teacher');
    }
    public function practiceQuestion()
    {
        return $this->hasMany('App\PracticeQuestion');
    }
    public function schoolstaff()
    {
        return $this->hasOne('App\Schoolstaff');
    }
    public function objectivetests()
    {
        return $this->hasMany('App\Objectivetest');
    }
    public function testresults()
    {
        return $this->hasMany('App\Testresult');
    }
}
