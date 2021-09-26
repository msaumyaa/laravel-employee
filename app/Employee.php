<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    protected $fillable = ['fname','lname','company_id','email','phone'];

    public function company()
    {
        return $this->belongsTo(Companies::class);   
    }
}
