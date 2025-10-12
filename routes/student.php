<?php
use App\Http\Controllers\Students\Dashboard\ExamsController;
use App\Http\Controllers\Student\ClassSessionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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

Route::get('exams', [ExamsController::class, 'index'])->name('student.exams.index')->middleware('auth:student');
// Student exams routes
Route::get('exams/{quizze}', [ExamsController::class, 'show'])->name('student.exams.show')->middleware('auth:student');

Route::get('/', function () {
    return view('auth.selection');
})->name('selection');

//==============================Translate all pages============================
Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth:student,teacher,parent,web']
    ], function () {

    //==============================dashboard============================
    Route::get('/student/dashboard', function () {
        return view('pages.Students.dashboard');
    })->name("dashboard.student");
    
    //==============================class sessions============================
    Route::resource('student/sessions', ClassSessionController::class)->names('student.sessions');
});