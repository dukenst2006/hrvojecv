<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Education extends Model
{
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'institution', 'title', 'period', 'add_info', 'accomplishments'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
}
