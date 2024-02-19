<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{


    protected $fillable = ['name','passoward','parent_phone1','parent_phone2','birthdate', 'adress','Accuracy','school_id'];

    public function school() {
        return $this->belongsTo(School::class);
    }

// في نموذج Teacher
public function classes()
{
    return $this->hasMany(SchoolClass::class);
}




}
