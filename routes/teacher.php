<?php

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizzController;
use App\Http\Controllers\Teacher_QuestionController;
use App\Http\Controllers\Teacher_QuizzController;
use App\Http\Controllers\Teacher_StudentController;
use App\Http\Controllers\Teacher_ProfileController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

/*
|--------------------------------------------------------------------------
| student Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//==============================Translate all pages============================
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:teacher']
    ], function () {

    //==============================dashboard============================
    Route::get('/teacher/dashboard', function () {
        $ids = Teacher::findorFail(auth()->user()->id)->Sections()->pluck('section_id');
        $data['count_sections']= $ids->count();
        $data['count_students']= \App\Models\Student::whereIn('section_id',$ids)->count();

    //    $ids = DB::table('teacher_section')->where('teacher_id',auth()->user()->id)->pluck('section_id');
//        $count_sections =  $ids->count();
//        $count_students = DB::table('students')->whereIn('section_id',$ids)->count();
        return view('pages.Teachers.dashboard.dashboard',$data);
    });


       //==============================students============================
       Route::get('student',[Teacher_StudentController::class,'index'])->name('student.index');


       Route::get('sections',[Teacher_StudentController::class,'sections'])->name('sections');
     Route::post('attendance',[Teacher_StudentController::class,'attendance'])->name('attendance');
     Route::post('edit_attendance',[Teacher_StudentController::class,'editAttendance'])->name('attendance.edit');
     Route::get('attendance_report',[Teacher_StudentController::class,'attendanceReport'])->name('attendance.report');
     Route::post('attendance_report',[Teacher_StudentController::class,'attendanceSearch'])->name('attendance.search');

     Route::resource('quizzes', Teacher_QuizzController::class);
    //  Route::get('/Get_classrooms/{id}', [Teacher_QuizzController::class,'getClassrooms']);
    //  Route::get('/Get_Sections/{id}', [Teacher_QuizzController::class,'Get_Sections']);

    //  Route::resource('questions', Teacher_QuestionController::class);

     Route::get('profile', [Teacher_ProfileController::class,'index'])->name('profile.show');
     Route::post('profile/{id}', [Teacher_ProfileController::class,'update'])->name('profile.update');


     Route::get('student_quizze/{id}',[ Teacher_QuizzController::class,'student_quizze'])->name('student.quizze');
     Route::post('repeat_quizze', [ Teacher_QuizzController::class,'repeat_quizze'])->name('repeat.quizze');

});
