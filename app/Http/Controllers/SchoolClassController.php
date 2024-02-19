<?php

namespace App\Http\Controllers;
use App\Models\Student;

use App\Models\SchoolClass;
use App\Models\Teacher;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SchoolClassController extends Controller
{


    public function index2($id)
    {
       
            $schoolid = $id;
            $schoolClasses = SchoolClass::where('school_id', $schoolid)->get();


            return view('school_class.index', compact('schoolClasses','id'));
    
    }
    
    /**
     * عرض قائمة الصفوف.
     */

    /**
     * عرض النموذج لإنشاء صف جديد.
     */
    public function create($id)
    {
        $schoolid = $id;

    $teachers = DB::table('teachers')->where('school_id', $schoolid)->get();
   

    return view('school_class.create',['teachers'=>$teachers],compact('id'));


    }

    /**
     * تخزين صف جديد في قاعدة البيانات.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'school_id' => 'required|exists:schools,id',
            'teacher_id' => 'required|exists:teachers,id',
        ]);
    
        // إنشاء الصف
        SchoolClass::create($request->all());
    
        // رسالة نجاح
        return back()->with('success', 'تم إنشاء الصف بنجاح.');
    }
    
    /**
     * عرض معلومات صف محدد.
     */
    public function show($id)
    {

         
        $class = $id;
        $students = Student::where('class_id', $class)->get();

        return view('school_class.show', compact('students','id'));


    }

    /**
     * عرض النموذج لتحرير صف محدد.
     */
    public function edit(SchoolClass $schoolClass)
    {
        $teachers = Teacher::all();
        $schools = School::all();
        return view('school-classes.edit', compact('schoolClass', 'teachers', 'schools'));
    }

    /**
     * تحديث معلومات الصف في قاعدة البيانات.
     */
    public function update(Request $request, SchoolClass $schoolClass)
    {
        $request->validate([
            'name' => 'required|string',
        ]);
    
        $schoolClass->update($request->all());
    
        return back()->with('success', 'تم تحديث الصف بنجاح.');
    }
    

    /**
     * حذف صف محدد من قاعدة البيانات.
     */
    public function destroy(SchoolClass $schoolClass)
    {
        $schoolClass->delete();

        return back()->with('success', 'تم حذف بيانات المعلم بنجاح.');  
       
    
    }




    public function getStudentsByClass(Request $request, $id)
    {
        $class = $id;
        $students = Student::where('class_id', $class)->get();
    
        return response()->json(['students' => $students], 200);
    }

    }

  


