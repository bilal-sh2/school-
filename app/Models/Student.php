<?php

// في ملف Student.php في مجلد app\Models

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = [
        'name', 'passoward','class_id', 'parent_phone1', 'parent_phone2', 'birthdate', 'address',
        // يمكنك إضافة المزيد من الأعمدة حسب الحاجة
    ];

    public function schoolClass()
    {
        return $this->belongsTo(SchoolClass::class, 'class_id');
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'student_subjects')->withPivot('grade');
    }
// في ملف Student.php

public function absences() {
    return $this->hasMany(Absence::class);
}

    
}
