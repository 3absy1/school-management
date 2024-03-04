<?php

use Livewire\Livewire;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\FeesController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\QuizzController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\GraduatedController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\FeesInvoicesController;
use App\Http\Controllers\ProcessingFeeController;
use App\Http\Controllers\ReceiptStudentsController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

// Auth::routes();
Route::get('/', [HomeController::class,'index'])->name('selection');


Route::group(['namespace' => 'Auth'], function () {

    Route::get('/login/{type}',[LoginController::class ,'loginForm'])->middleware('guest')->name('login.show');

    Route::post('/login',[LoginController::class , 'login'])->name('login');

    Route::get('/logout/{type}', [LoginController::class,'logout'])->name('logout');



    });

// Route::group(['middleware' => ['guest']], function () {

//     Route::get('/', function () {
//         return view('auth.login');
//     });

// });


 //==============================Translate all pages============================
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']
    ], function () {

     //==============================dashboard============================
    Route::get('/dashboard', [HomeController::class,'dashboard'])->name('dashboard');

   //==============================dashboard============================
        Route::resource('Grades', GradeController::class);

    //==============================Classrooms============================
        Route::resource('Classrooms', ClassroomController::class);
        Route::post('delete_all', [ClassroomController::class,'delete_all'])->name('delete_all');
        Route::post('Filter_Classes', [ClassroomController::class,'Filter_Classes'])->name('Filter_Classes');

          //==============================Sections============================


        Route::resource('Sections', SectionController::class);
        Route::get('/classes/{id}', [SectionController::class , 'getclasses']);

        //==============================parents============================

        Route::view('add_parent','livewire.show_Form')->name('add_parent');
        // Livewire::setUpdateRoute(function ($handle) {
        //     return Route::post('/custom/livewire/update', $handle);
        // });

         //==============================Teachers============================
        Route::resource('Teachers', TeacherController::class);

        Route::get('/home', function () {
            return view('dashboard');
        });

            //==============================Students============================
        Route::resource('Students', StudentController::class);
        // Route::get('/Get_classrooms/{id}', [StudentController::class,'Get_classrooms']);
        // Route::get('/Get_Sections/{id}', [StudentController::class,'Get_Sections']);
        Route::resource('Graduated', GraduatedController::class);
        Route::resource('Promotion', PromotionController::class);
        Route::post('Upload_attachment', [StudentController::class,'Upload_attachment'])->name('Upload_attachment');
        Route::get('Download_attachment/{studentsname}/{filename}', [StudentController::class,'Download_attachment'])->name('Download_attachment');
        Route::post('Delete_attachment', [StudentController::class,'Delete_attachment'])->name('Delete_attachment');
        Route::resource('receipt_students', ReceiptStudentsController::class);
        Route::resource('ProcessingFee', ProcessingFeeController::class);
        Route::resource('Payment_students', PaymentController::class);


             //==============================Fees============================
        Route::resource('Fees', FeesController::class);
        Route::resource('Fees_Invoices', FeesInvoicesController::class);

             //==============================Attendance============================
        Route::resource('Attendance', AttendanceController::class);

        //==============================Subjects============================
        Route::resource('subjects', SubjectController::class);

          //==============================Exams============================
        Route::resource('Exams', ExamController::class);

         //==============================Quizzes============================
        Route::resource('Quizzes', QuizzController::class);

         //==============================questions============================
        Route::resource('questions', QuestionController::class);

        //==============================library============================
         Route::get('download_file/{filename}', [LibraryController::class,'downloadAttachment'])->name('downloadAttachment');
         Route::resource('library', LibraryController::class);


         //==============================Setting============================
         Route::resource('settings', SettingController::class);


        Route::get('test', [TestController::class,'generateVariations']);



});
