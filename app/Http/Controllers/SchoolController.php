<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Teacher;

class SchoolController extends Controller
{
    /**
     * عرض قائمة المدارس.
     */
    public function index()
    {
        $schools = School::all();
        return view('schools.index', compact('schools'));
    }

    /**
     * عرض النموذج لإنشاء مدرسة جديدة.
     */
    public function create()
    {
        return view('schools.create');
    }

    /**
     * تخزين مدرسة جديدة في قاعدة البيانات.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'location' => 'required|string',
        ]);

        School::create($request->all());

        return redirect()->route('school.index')->with('success', 'تم إنشاء المدرسة بنجاح.');
    }

    /**
     * عرض مدرسة محددة.
     */

     // في نموذج المدرسة School.php
// في نموذج المدرسة (School.php)
public function teachers()
{
    return $this->hasMany(Teacher::class, 'school_id');
}

public function show($id)
{
    // قم بالحصول على بيانات المدرسة باستخدام الـ $id
    $school = School::find($id);

    // تأكد من أن تم العثور على المدرسة قبل إرسالها إلى العرض
    if ($school) {
        // إرسال الـ $id والـ $school إلى العرض
        return view('schools.show', compact('id', 'school'));
    } else {
        // يمكنك إدراج رمز هنا للتعامل مع حالة عدم وجود المدرسة
        return view('schools.show')->with('error', 'School not found');
    }
}


public function control($id)
{
    $schoolid = $id;

    $teachers = DB::table('teachers')->where('school_id', $schoolid)->get();
   
    return view('schools.show',['teachers'=>$teachers],compact('id'));
}


    
    /**
     * عرض النموذج لتحرير مدرسة محددة.
     */
    public function edit(School $school)
    {
        return view('schools.edit', compact('school'));
    }

    /**
     * تحديث معلومات المدرسة في قاعدة البيانات.
     */
    public function update(Request $request, School $school)
    {
        $request->validate([
            'name' => 'required|string',
            'location' => 'required|string',
        ]);

        $school->update($request->all());

        return redirect()->route('school.index')->with('success', 'تم تحديث المدرسة بنجاح.');
    }

    /**
     * حذف مدرسة محددة من قاعدة البيانات.
     */
    public function destroy(School $school)
    {
        $school->delete();

        return redirect()->route('school.index')->with('success', 'تم حذف المدرسة بنجاح.');
    }

//api********
public function getStudentsByClass($classId)
{
    $schoolClass = SchoolClass::with('students')->find($classId);

    if (!$schoolClass) {
        return response()->json(['message' => 'لم يتم العثور على الصف'], 404);
    }

    $students = $schoolClass->students;

    return response()->json(['students' => $students], 200);
}
}
