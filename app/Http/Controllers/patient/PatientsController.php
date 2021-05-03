<?php

namespace App\Http\Controllers\patient;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Patients;
use App\Models\Departments;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class PatientsController extends Controller
{
    public function index()
    {   
        $patients=Patients::join('departments','departments.dep_id','patients.dep_id')->groupBy('patients.patient_id')->get();
        return view('admin.patients.patients',compact('patients'));
    }
    public function create(){
        $dep=Departments::all();
        return view('admin.patients.patient_create',compact('dep'));
    }
    public function store (Request $request){
        $datavalide = $request->validate([
            'first_name'=>"required",
            'last_name'=>"required",
            'date_of_birth'=>"required",
            'gender'=>"required",
            'department'=>"required",
            'phone_number'=>"required",
            'blood_group'=>"required",
            'age'=>"required",
            'marital_status'=>"required",
            'occupation'=>"required",
            'address'=>"required",
            'emergency_contact'=>"required",
            'relationship'=>"required",
            ]);
            if($datavalide==true){
                $check=DB::table('patients')
                ->select(DB::raw('Max(patient_idetify_number)as max'))->get();
               $patient = new Patients;
               $patient->dep_id=$request->department;
               $patient->f_name=$request->first_name;
               $patient->l_name=$request->last_name;
               $patient->dob=$request->date_of_birth;
               $patient->gender=$request->gender;
               $patient->phone_number=$request->phone_number;
               $patient->blood_g=$request->blood_group;
               $patient->address=$request->address;
               $patient->emergency_contact=$request->emergency_contact;
               $patient->relationship=$request->relationship;
               $patient->patient_idetify_number=$check[0]->max+1;
               $patient->author=Auth::id();
               $patient->age=$request->age;
               $patient->remark=$request->remark;
               $patient->occupation=$request->occupation;
               $patient->marital_status=$request->marital_status;
               $patient->allergies=$request->marital_status;
               $patient->save();       
            }
            session()->flash('notif','Patient Registred Successfully');
            return redirect('/patients');
    }
    public function edit ($id){
        $dep=Departments::all();
        $patient=Patients::find($id);
        return view('admin.patients.patient_edit',compact('patient','dep'));
    }

    public function update(Request $request)
    {
        $datavalide = $request->validate([
            'first_name'=>"required",
            'last_name'=>"required",
            'date_of_birth'=>"required",
            'gender'=>"required",
            'department'=>"required",
            'phone_number'=>"required",
            'blood_group'=>"required",
            'age'=>"required",
            'marital_status'=>"required",
            'occupation'=>"required",
            'address'=>"required",
            'emergency_contact'=>"required",
            'relationship'=>"required",
            ]);
            if($datavalide==true){
                // $patient=
                $patient=Patients::find($request->pat_id);
                $patient->dep_id=$request->department;
                $patient->f_name=$request->first_name;
                $patient->l_name=$request->last_name;
                $patient->dob=$request->date_of_birth;
                $patient->gender=$request->gender;
                $patient->phone_number=$request->phone_number;
                $patient->blood_g=$request->blood_group;
                $patient->address=$request->address;
                $patient->emergency_contact=$request->emergency_contact;
                $patient->relationship=$request->relationship;
                $patient->age=$request->age;
                $patient->remark=$request->remark;
                $patient->occupation=$request->occupation;
                $patient->marital_status=$request->marital_status;
                $patient->allergies=$request->marital_status;
                $patient->save();      
                session()->flash('notif','Patient updated successfully');
                return redirect('/patients');

            }
    }

    public function show($id)
    {
        $patient=Patients::find($id)->join('departments','departments.dep_id','patients.dep_id')->groupBy('patients.patient_id')->get();
        return view('admin.patients.patient_show',compact('patient'));

    }


}
