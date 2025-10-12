<?php
use App\Http\Controllers\Grades\GradeController;
use App\Http\Controllers\Classes\ClasseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Sections\SectionController;
use App\Http\Controllers\Parents\ParentController;
use App\Http\Controllers\Teachers\TeacherController;
use App\Http\Controllers\Students\StudentController;
use App\Http\Controllers\Students\PromotionController;
use App\Http\Controllers\Students\GraduatedController;
use App\Http\Controllers\Students\FeesController;
use App\Http\Controllers\Students\FeesInvoicesController;
use App\Http\Controllers\Students\ReceiptStudentsController;
use App\Http\Controllers\Students\ProcessingFeeController;
use App\Http\Controllers\Students\PaymentController;
use App\Http\Controllers\Students\AttendanceController;
use App\Http\Controllers\Subjects\SubjectController;
use App\Http\Controllers\Quizzes\QuizzController;
use App\Http\Controllers\Questions\QuestionController;
use App\Http\Controllers\Students\OnlineClasseController;
use App\Http\Controllers\Students\LibraryController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
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
Route::get('/{lang}/add_parent', function () {
    return view('livewire.show_form');
})->name('add_parent');

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath','auth:student,teacher,parent,web']
], function() {
    Route::get('/add_parent', function () {
        return view('livewire.show_form');
    })->name('add_parent');
});

Route::get('/login/{type}', [AuthenticatedSessionController::class, 'loginForm'])->name('login.show');
Route::post('/login', [AuthenticatedSessionController::class, 'login'])->name('login');
Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');
Route::group(['middleware'=>['guest']],function(){
            Route::get('/', function () {
            return view('auth.selection');
            });
})->name('selection');

Route::get('/livewire-test', function () {
    return view('livewire-test');
})->name('livewire.test');



Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect','localizationRedirect','localeViewPath','auth:student,teacher,parent,web']
    ], function(){ 
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->middleware(['auth:student,teacher,parent,web', 'verified'])->name('dashboard');
        Route::resource('Grades', GradeController::class);
        Route::delete('Classes/destroy_all', [ClasseController::class, 'destroy_all'])->name('Classes.destroy_all');
        Route::resource('Classes', ClasseController::class);
        Route::get('/classes/{grade_id}', [SectionController::class, 'getClasses']);
        Route::resource('section', SectionController::class);
        Route::resource('Teachers', TeacherController::class);
        Route::resource('Students', StudentController::class);
        Route::get('/Get_classrooms/{id}', [StudentController::class, 'Get_classrooms']);
        Route::get('/Get_Sections/{id}', [StudentController::class, 'Get_Sections']);
        Route::post('Students/Upload_attachment', [StudentController::class, 'Upload_attachment'])->name('Students.Upload_attachment');
        Route::get('Download_attachment/{studentsname}/{filename}', [StudentController::class, 'Download_attachment'])->name('Students.Download_attachment');
        Route::post('Students/Delete_attachment', [StudentController::class, 'Delete_attachment'])->name('Students.Delete_attachment');
        Route::resource('Promotion', PromotionController::class);
        Route::resource('Graduated', GraduatedController::class);
        Route::resource('Fees', FeesController::class);
        Route::resource('Fees_Invoices', FeesInvoicesController::class);
        Route::resource('receipt_students', ReceiptStudentsController::class);
        Route::resource('ProcessingFee', ProcessingFeeController::class);
        Route::resource('Payment_students', PaymentController::class);
        Route::resource('Attendance', AttendanceController::class);
        Route::resource('subjects', SubjectController::class);
        Route::resource('Quizzes', QuizzController::class);
        Route::resource('questions', QuestionController::class);
        Route::resource('online_classes', OnlineClasseController::class);
        Route::resource('library', LibraryController::class);
        Route::get('downloadAttachment/{filename}', [LibraryController::class, 'downloadAttachment'])->name('downloadAttachment');
        Route::resource('settings', SettingController::class);
        Route::middleware('auth')->group(function () {
            Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
            Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
            Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
        });
        // عرض الطلاب اللي دخلوا اختبار معيّن
        Route::get('student_quizze/{id}', [QuizzController::class, 'student_quizze'])->name('student.quizze');
        // إعادة الاختبار
        Route::post('repeat_quizze', [QuizzController::class, 'repeat_quizze'])->name('repeat.quizze');
    }
);
require __DIR__.'/auth.php';