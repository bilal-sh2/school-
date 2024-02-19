<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{

    protected $fillable = [
        'name'
        // يمكنك إضافة المزيد من الأعمدة حسب الحاجة
    ];
    public function students()
    {
        return $this->belongsToMany(Student::class, 'student_subjects')->withPivot('grade');
    }}
