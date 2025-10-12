<?php 

namespace App\Http\Controllers\Classes;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClasses;
use App\Models\Classe;
use App\Models\Grade;

class ClasseController extends Controller 
{

  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {
    $Classes = Classe::with('Grade')->get();
    $Grades = Grade::get();
    return view("pages.Classes.Classes" , compact("Classes" , "Grades"));
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
  public function store(StoreClasses $request)
  {
    $List_Classes = $request->List_Classes;
    try{
      // $List_Classes = $request->List_Classes;
      foreach($List_Classes as $List_Classe) {
        $my_class = new Classe();
        $my_class->Name_Classe = ["en"=>$List_Classe["name_classe_en"],"ar"=>$List_Classe["name"]];
        $my_class->grade_id = $List_Classe["grade_id"];
        $my_class->save();
      }
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
  public function update(StoreClasses $request, $id)
  {
    try {
        $Class = Classe::query()->where("id",$id);
        $Class->update([
            'Name_Classe' => ['ar' => $request->name, 'en' => $request->name_en],
            'grade_id' => $request->grade_id,
        ]);
        toastr()->success(trans('messages.success_update'));
        return redirect()->route('Classes.index');

    } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy($id)
  {
    try {
        $Class = Classe::query()->where("id",$id);
        $Class->delete();
        toastr()->error(trans('messages.success_delete'));
        return redirect()->route('Classes.index');
    } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
  }
  public function destroy_all(Request $request)
  {
    try {
      $delete_all_id = explode(",", $request->delete_all_id);
      $delete_all_id = array_filter($delete_all_id, function($id) {
        return is_numeric($id);
      });
      Classe::whereIn('id', $delete_all_id)->delete();
      toastr()->error(trans('messages.success_delete'));
      return redirect()->route('Classes.index');
    } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
    }
  }
  
}

?>