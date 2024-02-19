<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;

use App\Http\Controllers\AbsenceController;


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/teachers/{teacherId}', [TeacherController::class, 'getTeacherWithClasses']);


Route::get('/get-students/{classId}', [SchoolClassController::class, 'getStudentsByClass']);

// لجلب المواد
Route::get('/student_subject/{id}', 'App\Http\Controllers\StudentController@getAllSubjects')->name('student_subject.getAllSubjects');


// اضافة العلامة للطالب
Route::post('addSubjectToAllStudents_api/{studentId}', [StudentController::class, 'addSubjectToAllStudents_api']);

// لعرض علامات الطالب


Route::get('/student/{id}', [StudentController::class, 'getStudentGrades'])->name('student.getGrades');
// للغيابات
// اضافة
Route::post('/addAbsence/{student_id}/', [AbsenceController::class, 'addAbsence']);




// Route::post('/absences/add', 'AbsenceController@addAbsence');
// تعديل
Route::put('/absences/{id}', 'AbsenceController@updateAbsence');

// حذف
    
Route::delete('/absences-delete/{id}/', [AbsenceController::class, 'deleteAbsence']);
// عرض


Route::get('/get-absences/{student_id}/', [AbsenceController::class, 'getStudentAbsences']);


