<?php

namespace App\Http\Controllers\patient;
use App\Http\Controllers\Controller;
use App\Models\Departments;
use Illuminate\Http\Request;
use App\Models\Appoinments;
use App\Models\Employee;
use App\Models\Test;

use Illuminate\Support\Facades\Auth;
use App\Models\Opd;
use Carbon\Carbon;
use DB;
class OpdController extends Controller
{
    public function index()
    {
        $dep=Departments::all();
        $opd=Opd::join('employees','employees.emp_id','opds.emp_id')
             ->join('departments','departments.dep_id','opds.dep_id')
             ->get();
        
       return view('admin.patients.opd.index',compact('dep','opd'));
    }
    public function serach(Request $request)
    {
     if(isset($request->phone)){
      $app=Appoinments::select(['p_f_name','p_l_name','appoinments.age as apage','appoinments.phone as appphone',
      'appoinments.date as appdate','departments.department_name','departments.dep_id',
      'employees.f_name','employees.l_name','employees.emp_id'])
        ->join('employees','employees.emp_id','appoinments.emp_id')
        ->join('departments','departments.dep_id','appoinments.dep_id')
        ->where('phone','like',$request->phone_number)
        ->groupBy('appoinments.app_id')
        ->orderBy('appoinments.created_at')->limit(1)->get();
        return response()->json($app);
      }else{
       $app=Appoinments::select(['p_f_name','p_l_name','appoinments.age as apage','appoinments.phone as appphone',
       'appoinments.date as appdate','departments.department_name','departments.dep_id',
       'employees.f_name','employees.l_name','employees.emp_id'])
       ->join('employees','employees.emp_id','appoinments.emp_id')
       ->join('departments','departments.dep_id','appoinments.dep_id')
       -> where('patient_id','like',$request->patient_number)
       ->groupBy('appoinments.app_id')
       ->orderBy('appoinments.created_at')->limit(1)->get();
       return response()->json($app); 
     }
    }
    public function store(Request $request){
      $datavalidate=$request->validate([
        'first_name'=>'required',
        'last_name'=>'required',
        'phone'=>'required',
        'age'=>'required',
        'date'=>'required',
        'department'=>'required',
        'docter'=>'required',
        'gender'=>'required',
      ]);
      $check=Opd::select(DB::raw('Max(patient_id)as max'))->get();
      $opd=new Opd;
      $opd->patient_id=$check[0]->max+1;
      $opd->o_f_name=$request->first_name;
      $opd->o_l_name=$request->last_name;
      $opd->age=$request->age;
      $opd->dep_id=$request->department;
      $opd->emp_id=$request->docter;
      $opd->date=$request->date;
      $opd->gender=$request->gender;
      $opd->phone=$request->phone;
      $opd->author=Auth::id();
      $opd->save();

      return response()->json(['success'=>"OPD Patient Created Successfully !"]);   								

    }
    public function show ($id)
    {
      
      $dep=Departments::all();
      $opd=Opd::find($id);
      
      $visit=DB::table('visit')
      ->select('*','visit.created_at as date')
      ->join('employees','employees.emp_id','visit.emp_id')
      ->join('departments','departments.dep_id','visit.dep_id')
      ->join('users','visit.author','users.id')
      ->where('opd_id',$id)->orderBy('date','DESC')->get();

      $finance=DB::table('finance')
      ->select('*','finance.created_at as date')
      ->join('departments','departments.dep_id','finance.dep_id')
      ->join('users','finance.author','users.id')
      ->where('patient_id',$id)->orderBy('finance.created_at','Desc')->get();
      
      $test=DB::table('patient_test')
      ->select('*','patient_test.created_at as date')
      ->join('departments','departments.dep_id','patient_test.dep_id')
      ->join('tests','tests.test_id','patient_test.test_id')
      ->join('users','patient_test.author','users.id')
      ->where('opd_id',$id)->orderBy('patient_test.created_at','Desc')->get();

      return view('admin.patients.opd.show',compact('opd','dep','id','visit','finance','test'));
    }
    public function revisitcreate(Request $request)
    {
      $datavalidate=$request->validate([
        'department'=>'required',
        'docter'=>'required',
        'docter_fess'=>'required',
      ]);
      if($datavalidate==true){
       $visit=DB::table('visit')->insertGetId([
          'dep_id'=>$request->department,
          'emp_id'=>$request->docter,
          'opd_id'=>$request->opd_id,
          'fees'=>$request->docter_fess,
          'description'=>$request->description,
          'status'=>"Paid",      
          'author'=>Auth::id(),   
          'created_at'=>date("Y-m-d h:i:s"),    
        ]);
      
        DB::table('finance')->insert([
          'dep_id'=>$request->department,
          'patient_id'=>$request->opd_id,
          'fees'=>$request->docter_fess,
          'relate_id'=>$visit,
          'status'=>"Paid",      
          'type_charges'=>'OPD',
          'author'=>Auth::id(),   
          'created_at'=>date("Y-m-d h:i:s"),   
        ]);
      return response()->json(['success'=>"OPD Patient Revisited  Successfully !"]);   								
      }
    }
    public function testcreate(Request $request)
    {
      $datavalidate=$request->validate([
        'department'=>'required',
        'test_type'=>'required',
        'test_fees'=>'required',
      ]);
      if($datavalidate==true){
         $test=DB::table('patient_test')->insertGetId([
          'dep_id'=>$request->department,
          'opd_id'=>$request->opd_id,
          'test_id'=>$request->test_type,
          'fees'=>$request->test_fees,
          'description'=>$request->description,
          'status'=>"Paid",      
          'author'=>Auth::id(),   
          'created_at'=>date("Y-m-d h:i:s"),    
        ]);
        DB::table('finance')->insert([
          'dep_id'=>$request->department,
          'patient_id'=>$request->opd_id,
          'fees'=>$request->test_fees,
          'relate_id'=>$test,
          'status'=>"Paid",      
          'type_charges'=>'Test',
          'author'=>Auth::id(),   
          'created_at'=>date("Y-m-d h:i:s"),   
        ]);
      return response()->json(['success'=>"OPD Patient Revisited  Successfully !"]);   					
      }
    }

    public function getEditData($id)
    {
      $visit=DB::table('visit')->where('visit_id',$id)->get();
      $emp=Employee::where('dep_id',$visit[0]->dep_id)->get();
      return Response()->json(array(
          'visit' => $visit,
          'emp' => $emp,
      ));
    }
    public function getTestEditData($id)
    {
      $p_test=DB::table('patient_test')->where('patient_test_id',$id)->get();
      $tests=Test::where('dep_id',$p_test[0]->dep_id)->get();
      return Response()->json(array(
          'p_test' => $p_test,
          'tests' => $tests,
      ));
    }

    
    public function updateopdvisit(Request $request)
    {
      $datavalidate=$request->validate([
        'department'=>'required',
        'docter'=>'required',
        'docter_fess'=>'required',
      ]);
      if($datavalidate==true){
        DB::table('visit')->where('visit_id',$request->visit_id)
        ->update([
          'dep_id'=>$request->department,
          'emp_id'=>$request->docter,
          'opd_id'=>$request->opd_id,
          'fees'=>$request->docter_fess,
          'description'=>$request->description,
          'status'=>"Paid", 
          'updated_at'=>date("Y-m-d h:i:s"), 
          ]);     
        
          DB::table('finance')
          ->where('relate_id',$request->visit_id)
          ->where('patient_id',$request->opd_id)
          ->update([
            'fees'=>$request->docter_fess,
             'dep_id'=>$request->department,
            ]);

            return response()->json(['success'=>"OPD patient record updated successfully !"]);   					
      }
    }
    
    public function updateopdtest(Request $request)
    {
      $datavalidate=$request->validate([
        'department'=>'required',
        'test_type'=>'required',
        'test_fees'=>'required',
      ]);
      if($datavalidate==true){
        DB::table('patient_test')->where('patient_test_id',$request->test_id)
        ->update([
          'dep_id'=>$request->department,
          'opd_id'=>$request->opd_id,
          'test_id'=>$request->test_type,
          'fees'=>$request->test_fees,
          'description'=>$request->description,
          'updated_at'=>date("Y-m-d h:i:s"),     
          ]);     
        
          DB::table('finance')
          ->where('relate_id',$request->test_id)
          ->where('patient_id',$request->opd_id)
          ->update([
            'dep_id'=>$request->department,
            'patient_id'=>$request->opd_id,
            'fees'=>$request->test_fees,
            'updated_at'=>date("Y-m-d h:i:s"),
            ]);

            return response()->json(['success'=>"OPD patient record updated successfully !"]);   					
      }
    }
}
