<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;
use App\Models\Subject;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // يمكنك عرض قائمة الطلاب هنا إذا كنت بحاجة إلى ذلك
        $students = Student::all();
        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // يمكنك عرض نموذج إنشاء طالب هنا إذا كنت بحاجة إلى ذلك
        return view('students.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // تأكيد الصحة وحفظ الطالب في قاعدة البيانات
        $request->validate([
            'name' => 'required|string',
            'passoward' => 'required|string',

            'class_id' => 'required|exists:school_classes,id',
            'parent_phone1' => 'nullable|string',
            'parent_phone2' => 'nullable|string',
            'birthdate' => 'nullable|date',
            'address' => 'nullable|string',
        ]);

        Student::create($request->all());

        return back()->with('success', 'تم إضافة طالب جديد بنجاح');
    }

    /**
     * Display the specified resource.
     */

    public function show(Student $student)
    {
        $subjects = Subject::all();
        
        // يمكنك عرض تفاصيل الطالب وجميع المواد هنا إذا كنت بحاجة إلى ذلك
        return view('students.add_grade', compact('student', 'subjects'));
    }
    // 
    public function showabseces($id)
    {
  
        $student = Student::find($id);   
        return view('absences.create', compact('student'));

    
    }


    public function edit(Student $student)
    {
        // يمكنك عرض نموذج التعديل هنا إذا كنت بحاجة إلى ذلك
        return view('students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        // تأكيد الصحة وتحديث بيانات الطالب
        $request->validate([
            'name' => 'required|string',
            'passoward' => 'required|string',

            'parent_phone1' => 'nullable|string',
            'parent_phone2' => 'nullable|string',
            'birthdate' => 'nullable|date',
            'address' => 'nullable|string',
        ]);

        $student->update($request->all());

        return back()->with('success', 'تم تعديل بيانات الطالب بنجاح.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return back()->with('success', 'تم حف بيانات الطالب  بنجاح.');
    }





    public function showAddSubjectForm()
    {
        $subjects = Subject::all();
        return view('addSubject', compact('subjects'));
    }


    public function deleteSubjectGrade($studentId, $subjectId)
    {
        $student = Student::find($studentId);
        $subject = Subject::find($subjectId);
    
        if ($student && $subject) {
            $student->subjects()->detach($subject->id);
            return back()->with('success', 'تم حذف علامة الطالب  بنجاح.');
        }
    
        return redirect()->back()->with('error', 'خطأ في العثور على الطالب أو المادة.');
    }
    

    public function addSubjectToAllStudents (Request $request, $studentId)
    {
        $subjectId = $request->input('subject');
        $grade = $request->input('grade');
    
        $subject = Subject::find($subjectId);
        $student = Student::find($studentId);
    
        if ($student && $subject) {
            $student->subjects()->attach($subject, ['grade' => $grade]);
            return redirect()->back()->with('success', 'تمت إضافة علامة للطالب بنجاح.');
        }
    
        return redirect()->back()->with('error', 'خطأ في العثور على الطالب أو المادة.');
    }



    public function showGrades()
    {
        $students = Student::all();
        return view('viewGrades', compact('students'));
    }



// api add grade subject

    public function addSubjectToAllStudents_api(Request $request, $studentId)
    {
        $subjectId = $request->input('subject');
        $grade = $request->input('grade');

        $subject = Subject::find($subjectId);
        $student = Student::find($studentId);

        if ($student && $subject) {
            $student->subjects()->attach($subject, ['grade' => $grade]);
            return response()->json(['message' => 'تمت إضافة علامة للطالب بنجاح.']);
        }

        return response()->json(['message' => 'خطأ في العثور على الطالب أو المادة.'], 404);
    }

// get data subject 
    public function getAllSubjects(Student $student)
    {
        $subjects = Subject::all();

        return response()->json(['subjects' => $subjects,'student'=>$student]);
    }

// show gradw 
public function getStudentGrades($id)
{
    $student = Student::find($id);

    if (!$student) {
        return response()->json(['error' => 'طالب غير موجود.'], 404);
    }

    $grades = $student->subjects()->withPivot('grade')->get();

    return response()->json(['student' => $student, 'grades' => $grades]);
}

}
