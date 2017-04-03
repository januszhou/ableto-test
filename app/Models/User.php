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
        'first_name', 'last_name', 'email', 'password', 'is_admin', 'token'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $appends = ['question_answer'];

    public function isAdmin()
    {
        return $this->is_admin == 1;
    }

    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getQuestionAnswerAttribute()
    {
        return $this->questionAnswer()->get();
    }

    /**
     * Start relationships section
     */
    public function questionAnswer()
    {
        return $this->hasMany('App\Models\UserAnswer', 'user_id', 'id');
    }
}
