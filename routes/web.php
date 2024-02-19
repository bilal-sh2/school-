<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SchoolClassController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\AbsenceController;

use TCG\Voyager\Facades\Voyager;

use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     $ppp=Hash::make(1);
//     echo  $ppp;
//     return view('auth.login');
// });

Route::get('/', function () {
    return view('welcome');
});

Route::resource('/school',SchoolController::class)->middleware('auth');
Route::resource('/absences',AbsenceController::class)->middleware('auth');

Route::resource('/teacher',TeacherController::class)->middleware('auth');
Route::resource('/school_class',SchoolClassController::class)->middleware('auth');
Route::resource('/student',StudentController::class)->middleware('auth');

Route::resource('/subject',SubjectController::class)->middleware('auth');


Route::get('/school_class22/{id}', 'App\Http\Controllers\SchoolClassController@index2')->name('school_class22.index2')->middleware('auth');
Route::get('/school_class2/{id}', 'App\Http\Controllers\SchoolClassController@create')->name('school_class2.create')->middleware('auth');
Route::get('/teacher22/{id}', 'App\Http\Controllers\TeacherController@create')->name('teacher22.create')->middleware('auth');
Route::get('/teacher2/{id}', 'App\Http\Controllers\TeacherController@index2')->name('teacher2.index2')->middleware('auth');

Route::delete('/students/{student}/subjects/{subject}', [StudentController::class, 'deleteSubjectGrade'])->name('deleteSubjectGrade')->middleware('auth');


Route::get('/add-subject', [StudentController::class, 'showAddSubjectForm'])->name('addSubjectForm')->middleware('auth');

Route::post('/add-subject/{student}', [StudentController::class, 'addSubjectToAllStudents'])->name('addSubjectToAllStudents')->middleware('auth');
Route::get('/view-grades', [StudentController::class, 'showGrades'])->name('showGrades')->middleware('auth');
// اضافة غياب
Route::get('/add_absenceC/{item_id}/{class_id}', 'App\Http\Controllers\AbsenceController@create')->name('add_absenceC.create')->middleware('auth');


Route::get('/back', function () {
    return view('welcome');




});
Route::resource('/users',UserController::class)->middleware('isAdmin');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// 

// gdf

// 
