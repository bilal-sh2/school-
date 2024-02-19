<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index2($id)
    {
        $teacherss = $id;
        $teachers = DB::table('teachers')->where('school_id', $teacherss)->get();
        return view('teachers.index', compact('teachers','id'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        return view('teachers.create', compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // قم بتنفيذ الصلاحيات والتحقق من البيانات المدخلة
        $request->validate([
            'name' => 'required|string',
            'passoward' => 'required|string',

            'Accuracy' => 'nullable|string',
            'birthdate' => 'nullable|string',
            'adress' => 'nullable|string',
            'parent_phone1' => 'nullable|string',
            'parent_phone2' => 'nullable|string',
            'school_id' => 'required|exists:schools,id',
        ]);

        // قم بإنشاء المعلم
        Teacher::create($request->all());

        // رسالة نجاح والبقاء في نفس الصفحة
        return back()->with('success', 'تم اضافة المعلم بنجاح.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Teacher $teacher)
    {
        // يمكنك تنفيذ التعليمات الخاصة بك هنا إذا لزم الأمر
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Teacher $teacher)
    {
        return view('teachers.edit', compact('teacher'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Teacher $teacher)
    {
        // قم بتنفيذ الصلاحيات والتحقق من البيانات المدخلة
        $request->validate([
            'name' => 'required|string',
            'passoward' => 'required|string',

            'Accuracy' => 'nullable|string',
            'birthdate' => 'nullable|string',
            'adress' => 'nullable|string',
            'parent_phone1' => 'nullable|string',
            'parent_phone2' => 'nullable|string',
        ]);

        $teacher->update($request->all());

        return back()->with('success', 'تم تحديث بيانات المعلم بنجاح.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Teacher $teacher)
    {
        $teacher->delete();

        return back()->with('success', 'تم حذف بيانات المعلم بنجاح.');
    }

// api"""""""""""""
public function getTeacherWithClasses(Request $request, $teacherId)
{
    // العثور على المعلم باستخدام الهوية المعرفة مع التحقق من كلمة المرور
    $teacher = Teacher::find($teacherId);

    if (!$teacher) {
        return response()->json(['message' => 'لم يتم العثور على المعلم'], 404);
    }

    // التحقق من صحة كلمة المرور
    if (!Hash::check($request->password, $teacher->password)) {
        return response()->json(['message' => 'كلمة المرور غير صحيحة'], 401);
    }

    // إذا تم التحقق بنجاح، يتم استرداد بيانات المعلم مع الصفوف
    $teacherWithClasses = Teacher::with('classes')->find($teacherId);

    return response()->json(['teacher' => $teacherWithClasses], 200);
}



}