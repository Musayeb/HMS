<?php

namespace App\Http\Controllers\patient;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Appoinments;
use App\Models\Departments;
use App\Models\Employee;
use App\Models\Test;

use DB;

class AppoinmentsController extends Controller
{
    public function index()
    {
        
        $dep=Departments::all();
        $app=Appoinments::join('employees','employees.emp_id','appoinments.emp_id')->join('departments','departments.dep_id','appoinments.dep_id')->groupBy('appoinments.app_id')->orderBy('patient_id','DESC')->get();    
        return view('admin.patients.appoinments.index',compact('app','dep'));
    }
    public function getpostition($id)
    {
        $pos=Employee::where('dep_id',$id)->where('type','docter')->get();
        return response()->json($pos);
    }
    public function getdocterfee($id)
    {
        $fee=Employee::select('fees')->where('emp_id',$id)->get();
        return response()->json($fee);
    }
    public function get_test_dep($id)
    {

        $test=Test::where('dep_id',$id)->get();
        return response()->json($test);
    }
    public function get_test_fee($id)
    {
        $test=Test::select('fees')->where('test_id',$id)->get();
        return response()->json($test);
    }
    
    public function store(Request $request)
    {
        $datavalidate=$request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'age'=>'required',
            'phone'=>'required',
            'date'=>'required',
            'date'=>'required',
            'time'=>'required',
            'department'=>'required',
            'docters'=>'required',
        ]);
        $ex=explode('-',$request->date);
        $patient_number=Appoinments::select(DB::raw('Max(patient_id)as max'))->get();
        $opp_number=Appoinments::select(DB::raw('Max(app_number)as max'))->where('date',$request->date)->whereDay('date',$ex[2])->get();

         $app=new Appoinments;
         $app->p_f_name=$request->first_name;
         $app->p_l_name=$request->last_name;
         $app->age=$request->age;
         $app->phone=$request->phone;
         $app->dep_id=$request->department;
         $app->emp_id=$request->docters;
         $app->date=$request->date;
         $app->time=$request->time;
         $app->author=Auth::id();
         $app->app_number=$opp_number[0]->max+1;
         $app->patient_id=$patient_number[0]->max+1;
         $app->save();
        return response()->json(['success'=>"Appoinment Created Successfully !"]);   								
    }
    public function edit($id)
    {
        $app=Appoinments::find($id);
        $pos=Employee::where('dep_id',$app->dep_id)->get();
        return Response()->json(array(
            'app' => $app,
            'pos' => $pos,
        ));
    }
    public function update(Request $request)
    {
        $datavalidate=$request->validate([
            'first_name'=>'required',
            'last_name'=>'required',
            'age'=>'required',
            'phone'=>'required',
            'date'=>'required',
            'date'=>'required',
            'time'=>'required',
            'department'=>'required',
            'docters'=>'required',
        ]);
        if($datavalidate==true){
        $app=Appoinments::find($request->app_id);
         $app->p_f_name=$request->first_name;
         $app->p_l_name=$request->last_name;
         $app->age=$request->age;
         $app->phone=$request->phone;
         $app->dep_id=$request->department;
         $app->emp_id=$request->docters;
         $app->date=$request->date;
         $app->time=$request->time;
         $app->save();
        return response()->json(['success'=>"Appoinment Updated Successfully !"]);   								

        }
    }
    public function destroy($id)
    {
        $app=Appoinments::find($id)->delete();

    }
}
