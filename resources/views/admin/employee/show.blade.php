@extends('layouts.admin')   
@section('content')
<div class="row">
    <div class="col-lg-3 col-md-12">
        <div class="card">
            <div class="card-body p-0">
                <div class="wideget-user text-center p-3">
                    <div class="wideget-user-desc pt-5">
                        <div class="wideget-user-img">
                            @if(!empty($emp->photo)) 
                            <img src="{{url('storage/app')}}/{{$emp->photo}}" alt="img"  style="height:100px;width:100px">
                            @else
                            <img src="{{asset('public/empty.png')}}" alt="img" style="height:100px;width:100px">
                            @endif
                        </div>
                        <div class="user-wrap">
                            <h3 class="pro-user-username text-dark">{{$emp->f_name.' '.$emp->l_name}}</h3>
                            <h6 class="text-muted mb-2">{{$emp->position}}</h6>
                            <h6 class="text-muted mb-2">{{$emp->department_name}}</h6>
                            <h6 class="text-muted mb-2">Employee ID:{{'PMS-EMP00'.$emp->emp_identify_id}}</h6>                    
                        </div>
                    </div>
                
                </div>
            </div>
        
        </div>
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Personal Info</h3>
            </div>
            <div class="card-body">
                <div class="media-list">
                    <div class="media mt-1 pb-2">
                        <div class="mediaicon">
                            <i class="fe fe-user" aria-hidden="true"></i>
                        </div>
                        <div class="media-body ml-5 mt-1">
                            <h6 class="mediafont text-dark mb-1">Full Name</h6>
                            <span class="d-block">{{$emp->f_name.' '.$emp->l_name}}</span>
                        </div>
                    </div>
                    <div class="media mt-1 pb-2">
                        <div class="mediaicon">
                            <i class="fe fe-mail" aria-hidden="true"></i>
                        </div>
                        <div class="media-body ml-5 mt-1">
                            <h6 class="mediafont text-dark mb-1">Email Address</h6>
                            <span class="d-block">{{$emp->email}}</span>
                        </div>
                    </div>
                    <div class="media mt-1 pb-2">
                        <div class="mediaicon">
                            <i class="fe fe-map-pin" aria-hidden="true"></i>
                        </div>
                        <div class="media-body ml-5 mt-1">
                            <h6 class="mediafont text-dark mb-1">Current Address</h6>
                            <span class="d-block">{{$emp->current_address}}</span>
                        </div>
                    </div>
                    <div class="media mt-1 pb-2">
                        <div class="mediaicon">
                            <i class="fe fe-phone" aria-hidden="true"></i>
                        </div>
                        <div class="media-body ml-5 mt-1">
                            <h6 class="mediafont text-dark mb-1">Phone Number</h6>
                            <span class="d-block">{{$emp->phone_number}}</span>
                        </div>
                    </div>
            
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-9 col-md-12">

        <div class="card w-100">
            <div class="card-header p-0">
                <div class="wideget-user-tab">
                    <div class="tab-menu-heading">
                        <div class="tabs-menu1">
                            <ul class="nav">
                                <li class=""><a href="#tab-61" class="active show" data-toggle="tab">Profile</a></li>
                                <li><a href="#tab-71" data-toggle="tab" class="">Payroll</a></li>
                                <li><a href="#tab-81" data-toggle="tab" class="">Document</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="border-0">
                    <div class="tab-content">
                        <div class="tab-pane active show" id="tab-61">
                            <div class="tab-pane active" id="activity">
                                <div class="tshadow mb25 bozero">
                                    <div class="table-responsive around10 pt0">
                                        <table class="table table-sm table-hover table-bordered ">
                                            <tbody>
                                                <tr>
                                                    <td>Full Name</td>
                                                    <td>{{$emp->f_name.' '.$emp->l_name}}</td>
                                                </tr>
                                                <tr>
                                                    <td>ID/Passport</td>
                                                    <td>{{$emp->passport_id}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Emergency Contact Number</td>
                                                    <td>{{$emp->emergency_contact}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Relationship</td>
                                                    <td>{{$emp->relationship}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Gender</td>
                                                    <td>{{$emp->gender}}</td>
                                                </tr>

                                                <tr>
                                                    <td>Date Of Birth</td>
                                                    <td>{{$emp->date_of_birth}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Marital Status</td>
                                                    <td>{{$emp->m_status}}</td>
                                                </tr>
                                                <tr>
                                                    <td >Father Name</td>
                                                    <td >{{$emp->father_name}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Mother Name</td>
                                                    <td>{{$emp->mother_name}}</td>
                                                </tr>                                              
                                           </tbody>
                                        </table>
                                    </div> 
                                </div> 
                                <div class="tshadow mb25 bozero">   
                                    <h3 class="pagetitleh2">Address </h6>
                                    <div class="table-responsive around10 pt0">  
                                        <table class="table table-bordered table-hover table-sm">
                                            <tbody>
                                                <tr>
                                                    <td >Current Address</td>
                                                    <td class="text-right">{{$emp->current_address}}</td>
                                                </tr>
                                                <tr>
                                                    <td>Permanent Address</td>
                                                    <td class="text-right">{{$emp->permanent_address}}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>  
                    
                            </div>
                        </div>
                        <div class="tab-pane" id="tab-71">
                            <div class="row">
                                <div class="col-md-5 col-sm-6">
                                    <div class="staffprofile">
                                        <h5>Total Net Salary Paid</h5>
                                        <h4>$45000.00</h4> 
                                        <div class="icon mt12font40">
                                            <i class="fa fa-money"></i>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-5 col-sm-6">
                                    <div class="staffprofile">
                                        <h5>Salary</h5>
                                        <h4>{{$emp->salary}}</h4> 
                                        <div class="icon mt12font40">
                                            <i class="fa fa-money"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive around10 pt0">
                                <table class="table table-hover table-sm table-bordered table-striped tmb0">
                                    <tbody>
                                        <tr>
                                            <td>Phone</td>
                                            <td>6545645645</td>
                                        </tr>
                                        <tr>
                                            <td>Emergency Contact Number</td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>superadmin@gmail.com</td>
                                        </tr>
                                        <tr>
                                            <td>Gender</td>
                                            <td>Male</td>
                                        </tr>
                                        <tr>
                                            <td>Blood Group</td>
                                            <td>B+</td>
                                        </tr>
                                        <tr>
                                            <td>Date of Birth</td>
                                            <td>21/07/1977</td>
                                        </tr>
                                        <tr>
                                            <td>Marital Status</td>
                                            <td>Married</td>
                                        </tr>
                                        <tr>
                                            <td class="col-md-4">Father Name</td>
                                            <td class="col-md-5">leonard</td>
                                        </tr>
                                        <tr>
                                            <td>Mother Name</td>
                                            <td>masenge</td>
                                        </tr>

                                      
                                        <tr>
                                            <td>Note</td>
                                            <td>Founder</td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div> 
                        </div>
                        <div class="tab-pane" id="tab-81">
                            <div class="row">
                                                                              
                                <div class="col-md-5 col-sm-6">
                                    <div class="staffprofile">
                                        <h5>CV</h5>
                                        <a href="{{url('employees/doc/download')}}/{{$emp->emp_id}}/cv_file" class="btn btn-default btn-xs" data-toggle="tooltip" title="Download">
                                            <i class="fa fa-download"></i></a>
                                        <a href="https://demo.smart-hospital.in/admin/staff/doc_delete/1/1/resume1.doc" class="btn btn-default btn-xs" data-toggle="tooltip" title="Delete" onclick="return confirm('Delete Confirm?');">
                                            <i class="fa fa-remove"></i></a>
                                        <div class="icon">
                                            <i class="fa fa-file-text-o"></i>
                                        </div>
                                    </div>
                                </div><!--./col-md-3-->
                                                                     
                                <div class="col-md-5 col-sm-6">
                                    <div class="staffprofile">
                                        <h5>Contract </h5>
                                        <a href="{{url('employees/doc/download')}}/{{$emp->emp_id}}/contract_file" class="btn btn-default btn-xs" data-toggle="tooltip" title="Download">
                                            <i class="fa fa-download"></i></a>
                                        <a href="https://demo.smart-hospital.in/admin/staff/doc_delete/1/2/joining_letter1.doc" class="btn btn-default btn-xs" data-toggle="tooltip" title="Delete" onclick="return confirm('Delete Confirm?');">
                                            <i class="fa fa-remove"></i>
                                        </a> 
                                        <div class="icon">
                                            <i class="fa fa-file-archive-o"></i>
                                        </div>
                                    </div>
                                </div><!--./col-md-3-->
                      
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- COL-END -->
</div>
</div>

@endsection