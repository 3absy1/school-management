<?php

use App\Http\Controllers\Parent_ChildrenController;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Student_ExamsController;
use App\Http\Controllers\Student_profileController;
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
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:parent']
    ], function () {

    //==============================dashboard============================
    Route::get('/parent/dashboard', function () {
        $sons = Student::where('parent_id',auth()->user()->id)->get();
        return view('pages.parents.dashboard',compact('sons'));
    })->name('dashboard.parents');


    Route::get('children', [Parent_ChildrenController::class,'index'])->name('sons.index');
    Route::get('results/{id}', [Parent_ChildrenController::class,'results'])->name('sons.results');

    Route::get('attendances', [Parent_ChildrenController::class,'attendances'])->name('sons.attendances');
    Route::post('attendances',[Parent_ChildrenController::class,'attendanceSearch'])->name('sons.attendance.search');

    Route::get('fees', [Parent_ChildrenController::class,'fees'])->name('sons.fees');
    Route::get('receipt/{id}', [Parent_ChildrenController::class,'receiptStudent'])->name('sons.receipt');

    Route::get('profile/parent', [Parent_ChildrenController::class,'profile'])->name('profile.show.parent');
    Route::post('profile/parent/{id}', [Parent_ChildrenController::class,'update'])->name('profile.update.parent');

});
