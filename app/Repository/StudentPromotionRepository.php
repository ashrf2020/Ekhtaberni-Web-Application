<?php


namespace App\Repository;


use App\Models\Grade;
use App\Models\promotion;
use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StudentPromotionRepository implements StudentPromotionRepositoryInterface
{

    public function index()
    {
        $Grades = Grade::all();
        return view('pages.Students.promotion.index',compact('Grades'));
    }
    public function create()
    {
        $promotions = promotion::all();
        return view('pages.Students.promotion.management',compact('promotions'));
    }
    public function store($request)
    {
        DB::beginTransaction();

        try {
            // جلب الطلاب حسب المرحلة الحالية والصف والقسم
            $students = student::where('Grade_id', $request->Grade_id)
                ->where('class_id', $request->Classroom_id)
                ->where('section_id', $request->section_id)
                ->get();

            if ($students->count() < 1) {
                return redirect()->back()->with('error_promotions', __('لاتوجد بيانات في جدول الطلاب'));
            }

            foreach ($students as $student) {

                // تحقق إذا المرحلة الجديدة مختلفة عن القديمة
                $isDifferent =  $student->Grade_id != $request->Grade_id_new ||
                                $student->class_id != $request->Classroom_id_new ||
                                $student->section_id != $request->section_id_new;

                // تحديث بيانات الطالب
                $student->update([
                    'Grade_id' => $request->Grade_id_new,
                    'class_id' => $request->Classroom_id_new,
                    'section_id' => $request->section_id_new,
                    'academic_year'=>$request->academic_year_new,
                ]);

                // إضافة سجل في promotions فقط إذا مختلف
                if ($isDifferent) {
                    Promotion::updateOrCreate(
                        [
                            'student_id' => $student->id,
                            'from_grade' => $request->Grade_id,
                            'from_Classroom' => $request->Classroom_id,
                            'from_section' => $request->section_id,
                            'to_grade' => $request->Grade_id_new,
                            'to_Classroom' => $request->Classroom_id_new,
                            'to_section' => $request->section_id_new,
                            'academic_year'=>$request->academic_year,
                            'academic_year_new'=>$request->academic_year_new,
                        ],
                        [] // لا حاجة لتحديث أي حقل آخر
                    );
                }
            }

            DB::commit();
            toastr()->success(trans('messages.success_add'));
            return redirect()->back();

        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->with('error_promotions', $e->getMessage());
        }
    }
    public function destroy($request)
    {
        DB::beginTransaction();

        try {

            // التراجع عن الكل
            if($request->page_id ==1){

                $Promotions = Promotion::all();
                foreach ($Promotions as $Promotion){

                 //التحديث في جدول الطلاب
                    $ids = explode(',',$Promotion->student_id);
                    student::whereIn('id', $ids)
                    ->update([
                    'Grade_id'=>$Promotion->from_grade,
                    'class_id'=>$Promotion->from_Classroom,
                    'section_id'=> $Promotion->from_section,
                    'academic_year'=>$Promotion->academic_year,
                ]);

                 //حذف جدول الترقيات
                    Promotion::truncate();

                }
                DB::commit();
                toastr()->error(trans('messages.Delete'));
                return redirect()->back();

            }

            else{

                $Promotion = Promotion::findorfail($request->id);
                student::where('id', $Promotion->student_id)
                    ->update([
                        'Grade_id'=>$Promotion->from_grade,
                        'class_id'=>$Promotion->from_Classroom,
                        'section_id'=> $Promotion->from_section,
                        'academic_year'=>$Promotion->academic_year,
                    ]);


                Promotion::destroy($request->id);
                DB::commit();
                toastr()->error(trans('messages.success_delete'));
                return redirect()->back();

            }

        }

        catch (\Exception $e) {
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}