<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contacts extends Model
{
    protected $fillable = [
        'name', 'age','affiliation', 'address', 'sex', 'mobile_no','district'
    ];
}
