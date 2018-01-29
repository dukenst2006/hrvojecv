<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title', 'user_id', 'mainLanguage', 'requiredFw', 'desiredSkills', 'desiredAdditional', 'yearsExp', 'description', 'contract', 'salaryRange', 'exactSalary', 'remote', 'location', 'benefits', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    public function User()
    {
        return $this->belongsTo('App\User', 'user_id');
    }
}
