<?php

namespace App\Livewire;

use App\Models\BloodType;
use App\Models\MyParent;
use Illuminate\Support\Facades\Storage;
use App\Models\Nationality;
use App\Models\ParentAttachment;
use App\Models\Religion;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;

class AddParent extends Component
{
    use WithFileUploads;
    public $successMessage = '';
    public $catchError ,$updateMode = false ,$show_table = true,$Parent_id;
    public $currentStep = 1;
    public $id,
        // Father_INPUTS
        $email, $password,$photos,
        $Name_Father, $Name_Father_en,
        $National_ID_Father, $Passport_ID_Father,
        $Phone_Father, $Job_Father, $Job_Father_en,
        $Nationality_Father_id, $Blood_Type_Father_id,
        $Address_Father, $Religion_Father_id,

        // Mother_INPUTS
        $Name_Mother, $Name_Mother_en,
        $National_ID_Mother, $Passport_ID_Mother,
        $Phone_Mother, $Job_Mother, $Job_Mother_en,
        $Nationality_Mother_id, $Blood_Type_Mother_id,
        $Address_Mother, $Religion_Mother_id;
    public function render()
    {
        return view('livewire.add-parent', [
            "Nationalities" => Nationality::all(),
            "Type_Bloods" => BloodType::all(),
            "Religions" => Religion::all(),
            "my_parents" => MyParent::all(),
        ]);
    }
    public function showformadd(){
        $this->show_table = false;
    }
    //firstStepSubmit
    public function firstStepSubmit()
    {
        $this->validate([
            'email' => 'required|email|unique:my_parents,Email,' . $this->id,
            'password' => 'required|min:8',
            'Name_Father' => 'required',
            'Name_Father_en' => 'required',
            'National_ID_Father' => 'required|unique:my_parents,National_ID_Father,' . $this->id,
            "Passport_ID_Father"=>'required|unique:my_parents,Password_ID_Father,' . $this->id,
            'Phone_Father' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'Job_Father' => 'required',
            'Job_Father_en' => 'required',
            'Nationality_Father_id' => 'required|integer',
            'Blood_Type_Father_id' => 'required|integer',
            'Religion_Father_id' => 'required|integer',
            'Address_Father' => 'required',
        ]);
        $this->currentStep = 2;
    }

    //secondStepSubmit
    public function secondStepSubmit()
    {
        $this->validate([
            'Name_Mother' => 'required',
            'Name_Mother_en' => 'required',
            'National_ID_Mother' => 'required|unique:my_parents,National_ID_Mother,' . $this->id,
            'Passport_ID_Mother' => 'required|unique:my_parents,Password_ID_Mother,' . $this->id,
            'Phone_Mother' => 'required',
            'Job_Mother' => 'required',
            'Job_Mother_en' => 'required',
            'Nationality_Mother_id' => 'required',
            'Blood_Type_Mother_id' => 'required',
            'Religion_Mother_id' => 'required',
            'Address_Mother' => 'required',
        ]);
        $this->currentStep = 3;
    }

    public function submitForm()
    {

        try {
            $My_Parent = new MyParent();
            // Father_INPUTS
            $My_Parent->email = $this->email;
            $My_Parent->password = Hash::make($this->password);
            $My_Parent->Name_Father = json_encode(['en' => $this->Name_Father_en, 'ar' => $this->Name_Father]);
            $My_Parent->National_ID_Father = $this->National_ID_Father;
            $My_Parent->Password_ID_Father = $this->Passport_ID_Father;
            $My_Parent->Phone_Father = $this->Phone_Father;
            $My_Parent->Jop_Father = json_encode(['en' => $this->Job_Father_en, 'ar' => $this->Job_Father]);
            $My_Parent->nationalities_Father_id = $this->Nationality_Father_id;
            $My_Parent->blood_types_Father_id = $this->Blood_Type_Father_id;
            $My_Parent->religions_Father_id = $this->Religion_Father_id;
            $My_Parent->Adress_Father = $this->Address_Father;

            // Mother_INPUTS
            $My_Parent->Name_Mother = json_encode(['en' => $this->Name_Mother_en, 'ar' => $this->Name_Mother]);
            $My_Parent->National_ID_Mother = $this->National_ID_Mother;
            $My_Parent->Password_ID_Mother = $this->Passport_ID_Mother;
            $My_Parent->Phone_Mother = $this->Phone_Mother;
            $My_Parent->Jop_Mother = json_encode(['en' => $this->Job_Mother_en, 'ar' => $this->Job_Mother]);
            $My_Parent->nationalities_Mother_id = $this->Nationality_Mother_id;
            $My_Parent->blood_types_Mother_id = $this->Blood_Type_Mother_id;
            $My_Parent->religions_Mother_id = $this->Religion_Mother_id;
            $My_Parent->Adress_Mother = $this->Address_Mother;
            $My_Parent->save();
            if (!empty($this->photos)){
                // Get the parent ID after saving
                $parentId = MyParent::latest()->first()->id;
                
                foreach ($this->photos as $photo) {
                    // Ensure the directory exists
                    $directory = 'parent_attachments/' . $this->National_ID_Father;
                    Storage::makeDirectory($directory, 0755, true, true);
                    
                    // Store the file
                    $path = $photo->storeAs(
                        $this->National_ID_Father, 
                        $photo->getClientOriginalName(),
                        'parent_attachments'
                    );
                    if ($path) {
                        // Save to database
                        ParentAttachment::create([
                            'file_name' => $photo->getClientOriginalName(),
                            'parent_id' => $parentId,
                        ]);
                    } else {
                        throw new \Exception('Failed to upload file: ' . $photo->getClientOriginalName());
                    }
                }
            }
            $this->successMessage = trans('messages.success_add');
            $this->clearForm();
            $this->currentStep = 1;
        }
        catch (\Exception $e) {
            $this->catchError = $e->getMessage();
        }
    }
    public function edit($id)
    {
        $this->show_table = false;
        $this->updateMode = true;
        $My_Parent = MyParent::where('id',$id)->first();
        $this->Parent_id = $id;
        $this->email = $My_Parent->email;
        $this->password = $My_Parent->password;
        $name = json_decode($My_Parent->Name_Father, true);
        $this->Name_Father = $name['ar'] ?? '';
        $this->Name_Father_en = $name['en'] ?? '';
        $jop = json_decode($My_Parent->Jop_Father, true);
        $this->Job_Father = $jop['ar'] ?? '';
        $this->Job_Father_en = $jop['en'] ?? '';
        $this->National_ID_Father =$My_Parent->Password_ID_Father;
        $this->Passport_ID_Father = $My_Parent->Password_ID_Father;
        $this->Phone_Father = $My_Parent->Phone_Father;
        $this->Nationality_Father_id = $My_Parent->nationalities_Father_id ;
        $this->Blood_Type_Father_id = $My_Parent->blood_types_Father_id ;
        $this->Address_Father =$My_Parent->Adress_Father;
        $this->Religion_Father_id =$My_Parent->religions_Father_id;

        $name = json_decode($My_Parent->Name_Mother, true);
        $this->Name_Mother = $name['ar'] ?? '';
        $this->Name_Mother_en = $name['en'] ?? '';
        $jop1 = json_decode($My_Parent->Jop_Mother, true);
        $this->Job_Mother = $jop1['ar'] ?? '';
        $this->Job_Mother_en = $jop1['en'] ?? '';
        $this->National_ID_Mother =$My_Parent->National_ID_Mother;
        $this->Passport_ID_Mother = $My_Parent->Password_ID_Mother;
        $this->Phone_Mother = $My_Parent->Phone_Mother;
        $this->Nationality_Mother_id = $My_Parent->nationalities_Mother_id ;
        $this->Blood_Type_Mother_id = $My_Parent->blood_types_Mother_id ;
        $this->Address_Mother =$My_Parent->Adress_Mother;
        $this->Religion_Mother_id =$My_Parent->religions_Mother_id ;
    }
    
    //firstStepSubmit
    public function firstStepSubmit_edit()
    {
        $this->updateMode = true;
        $this->currentStep = 2;
    }
    
    //secondStepSubmit_edit
    public function secondStepSubmit_edit()
    {
        $this->updateMode = true;
        $this->currentStep = 3;
    }

    public function submitForm_edit(){
        if ($this->Parent_id){
            $parent = MyParent::find($this->Parent_id);
            $parent->update([
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'Name_Father' => json_encode(['en' => $this->Name_Father_en, 'ar' => $this->Name_Father]),
                'Jop_Father' => json_encode(['en' => $this->Job_Father_en, 'ar' => $this->Job_Father]),
                'Password_ID_Father' => $this->Passport_ID_Father,
                'National_ID_Father' => $this->National_ID_Father,
                'Phone_Father' => $this->Phone_Father,
                'nationalities_Father_id' => $this->Nationality_Father_id,
                'blood_types_Father_id' => $this->Blood_Type_Father_id,
                'religions_Father_id' => $this->Religion_Father_id,
                'Adress_Father' => $this->Address_Father,
                'Name_Mother' => json_encode(['en' => $this->Name_Mother_en, 'ar' => $this->Name_Mother]),
                'Jop_Mother' => json_encode(['en' => $this->Job_Mother_en, 'ar' => $this->Job_Mother]),
                'Password_ID_Mother' => $this->Passport_ID_Mother,
                'National_ID_Mother' => $this->National_ID_Mother,
                'Phone_Mother' => $this->Phone_Mother,
                'nationalities_Mother_id' => $this->Nationality_Mother_id,
                'blood_types_Mother_id' => $this->Blood_Type_Mother_id,
                'religions_Mother_id' => $this->Religion_Mother_id,
                'Adress_Mother' => $this->Address_Mother,
            ]);
        }
        return redirect()->to('/add_parent');
    }
    public function delete($id){
        MyParent::findOrFail($id)->delete();
        return redirect()->to('/add_parent');
    }
    //clearForm
    public function clearForm()
    {
        $this->email = '';
        $this->password = '';
        $this->Name_Father = '';
        $this->Job_Father = '';
        $this->Job_Father_en = '';
        $this->Name_Father_en = '';
        $this->National_ID_Father = '';
        $this->Passport_ID_Father = '';
        $this->Phone_Father = '';
        $this->Nationality_Father_id = '';
        $this->Blood_Type_Father_id = '';
        $this->Address_Father = '';
        $this->Religion_Father_id = '';

        $this->Name_Mother = '';
        $this->Job_Mother = '';
        $this->Job_Mother_en = '';
        $this->Name_Mother_en = '';
        $this->National_ID_Mother = '';
        $this->Passport_ID_Mother = '';
        $this->Phone_Mother = '';
        $this->Nationality_Mother_id = '';
        $this->Blood_Type_Mother_id = '';
        $this->Address_Mother = '';
        $this->Religion_Mother_id = '';

        // Clear validation errors
        $this->resetErrorBag();
    }

    //back
    public function back($step)
    {
        $this->currentStep = $step;
    }
}