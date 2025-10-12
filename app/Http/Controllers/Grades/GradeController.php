<?php 

namespace App\Http\Controllers\Grades;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreGrades;
use App\Models\Classe;
use App\Models\Grade;

class GradeController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $grades = Grade::get();
          return view("pages.Grades.Grades", compact('grades'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
    
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(StoreGrades $request)
  {
    if(
        Grade::query()
        ->where("Name->ar", $request->input("name"))
        ->orWhere("Name->en", $request->input("name_en"))
        ->exists()){
          return redirect()->back()->withErrors(trans("Grades.Exists"));
        }
    try{
      $validated = $request->validated();
      $Grades = new Grade();
      $Grades->Name = ['en'=>$request->name_en ,'ar'=>$request->name];
      $Grades->Notes = $request->notes;
      $Grades->save();
      toastr()->success(trans('messages.success_add'));
      return redirect()->back();
    }
    catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(StoreGrades $request ,$id)
  {
    try{
      $validated = $request->validated();
      $grade = Grade::query()->where("id",$id);
      $grade->update([
          'Name' => [
              'ar' => $request->input('name'),
              'en' => $request->input('name_en'),
          ],
          'Notes' => $request->input('notes'),
      ]);
      toastr()->success(trans('messages.success_update'));
      return redirect()->back();
    }
    catch(\Exception $e){
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $
   * id
   * @return Response
   */
  public function destroy($id)
  {
    $MyClasses_id = Classe::query()->where("grade_id",$id)->pluck("grade_id");
    if ($MyClasses_id->count() == 0) {
      $Grades = Grade::findOrFail($id)->delete();
        toastr()->error(trans('messages.success_delete'));
        return redirect()->route('Classes.index');
    }else{
        toastr()->error(trans('Grades.Delete_Greade'));
        return redirect()->route('Classes.index');
    }
  }
  
}

?>