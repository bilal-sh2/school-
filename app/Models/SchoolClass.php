<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolClass extends Model
{
    protected $fillable = ['name', 'school_id','teacher_id'];
    
    public function teacher()
{
    return $this->belongsTo(Teacher::class);
}


public function students()
{
    return $this->hasMany(Student::class);
}
}
