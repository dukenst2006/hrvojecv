<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PersonalInfo extends Model
{
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'surname', 'gender', 'dob', 'pob', 'street', 'house_no', 'postcode', 'state', 'tel', 'mob', 'email', 'skype', 'nationality', 'current_residence', 'position', 'summary', 'key_skills'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
}
