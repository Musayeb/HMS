@extends('layouts.admin')
@section('css')
    <link href="{{ asset('public/assets/plugins/datatable/dataTables.bootstrap4.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/plugins/notify/css/jquery.growl.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/plugins/sweetalert2/dist/sweetalert2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/time/bootstrap-datepicker.css') }}" rel="stylesheet" />
    <link href="{{ asset('public/assets/time/jquery.timepicker.css') }}" rel="stylesheet" />



@endsection
@section('content')
    <div class="card p-3">
        <div class="btn-list ">
            <a href="javascript:viod();" data-backdrop="static" data-toggle="modal" data-target="#create"
                class="pull-right btn btn-primary d-inline"><i class="ti-plus"></i> &nbsp;Add New Appoinments</a>

        </div>
        <div class="mt-5 table-responsive">
            <table class="table table-striped table-bordered table-sm text-nowrap w-100 dataTable no-footer" id="example">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>PID</th>
                        <th>OPP-ID</th>
                        <th>Patient </th>
                        <th>Age</th>
                        <th>Phone</th>
                        <th> Date</th>
                        <th> Time</th>
                        <th> Department</th>
                        <th> Docter</th>
                        <th>Author</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php $counter=1; @endphp
                    @foreach ($app as $row)
                        <tr id="row{{ $row->app_id }}">
                            <td>{{ $counter++ }}</td>
                            <td>{{ 'PID-T-' . $row->patient_id }}</td>
                            <td>{{ 'OPP-N-' . $row->app_number }}</td>
                            <td>{{ $row->p_f_name . ' ' . $row->p_l_name }}</td>
                            <td>{{ $row->age }}</td>
                            <td>{{ $row->phone }}</td>
                            <td>{{ $row->date }}</td>
                            <td>{{ $row->time }}</td>
                            <td>{{ $row->department_name }}</td>
                            <td>{{ $row->f_name . ' ' . $row->l_name }}</td>
                            
                            <td>{{ $row->email }}</td>
                            <td>
                                <a data-delete="{{ $row->app_id }}"
                                    class="btn btn-danger btn-sm text-white mr-2 delete">Delete</a>
                                <a data-toggle="modal" data-target="#edit" data-id="{{ $row->app_id }}"
                                    class="btn btn-info btn-sm text-white mr-2 edit">Edit</a>
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

    <div id="create" class="modal fade">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content ">
                <div class="modal-header pd-x-20">
                    <h6 class="modal-title">Add Appoinments</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pd-20">
                    <div class="alert  alert-danger">
                        <ul id="error"></ul>
                    </div>

                    <form method="post" id="createform">
                        <div class="form-group">
                            <label>Patient FirstName</label>
                            <input name="first_name" type="text" class="form-control" placeholder="First Name">
                        </div>

                        <div class="form-group">
                            <label>Patient LastName</label>
                            <input name="last_name" type="text" class="form-control" placeholder="Last Name">
                        </div>
                        <div class="form-group">
                            <label>Age</label>
                            <input name="age" type="text" class="form-control age" placeholder="Age">
                        </div>
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input name="phone" type="text" class="form-control phone" placeholder="Phone number">
                        </div>
                        <div class="form-group">
                            <label>Date</label>
                            <input name="date" type="date" class="form-control" placeholder="Date">
                        </div>
                        <div class="form-group">
                            <label>Time</label>
                            <input name="time" type="text" class="basicExample time ui-timepicker-input form-control"
                                placeholder="Time" autocomplete="off">
                        </div>

                        <div class="form-group">
                            <label>Departments</label>
                            <select name="department" class="form-control deps">
                                <option value="" disabled selected>Select Department</option>
                                @foreach ($dep as $row)
                                    <option value="{{ $row->dep_id }}">{{ $row->department_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Docter</label>
                            <select name="docters"  class="form-control pos">
                                <option value="" selected disabled>Select Docter</option>
                            </select>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Create Appoinment</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div><!-- modal-body -->
            </div>
        </div><!-- MODAL DIALOG -->
    </div>
    <button class="btn btn-danger" data-toggle="modal" data-target="#print">View modal</button>



    <!-- LARGE MODAL -->
    <div id="print" class="modal fade">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content ">
                <div class="modal-header pd-x-20">
                    <h6 class="modal-title">Message Preview</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pd-20" id="DivIdToPrint">
                   <div style="text-align: center"><img src="{{url('public/hlogo.png')}}" width="200" height="80" alt=""></div> 
                   <h4 style="text-align: center;margin-top:4px">Morwareed Medical Complex</h4>
                <div style="text-align: center;">
                    <div style="height: 80px;border-bottom:1px solid black">
                        <div style=";color: #000; width: 48%;float: left;">   
                            <div style="text-align:left">
                                   <p>Patient Name : <strong>Musayeb Afzali</strong></p>
                                   <p>Age :<strong>25</strong></p>
                                   <p>Phone Number :<strong>0782970273</strong></p>
                               </div>
                            </div>
                            <div style="color: #000;width: 48%;float: right;">
                                <div style="text-align:left">
                                       <p>Register Date :<strong>2021-12-03</strong></p>
                                       <p>Department :<strong>Patalogy</strong></p>
                                       <p>Patient Register Number :<strong>PMS-TEMP-00199</strong></p>

                                   </div>
                                </div>  
                    </div>
      
                 </div>
                 <div class="text-center" style="height:650px;border-bottom:1px solid black"><span style="margin-top:4px">Impotant Note:....</span></div>
                   <div style="height:105px;overflow: hidden;margin-top:4px">
                
                    <div style="color: #000;height: 400px; width: 48%;float: left;">   
                        <div style="">
                               <p>Address: Opposite Haji Sahib Gul Karim Center, Next to Tribal Directorate , 1st Zone, Professor Morwarid Safi Curative Hospital</p>
                               <p>Hospital No.:+93 78 55555 44</p>
                               <p>Ambulance Number: +93 74 55555 44</p>
                               <p>Email:info@pmsmedicalcomplex.com</p>
                               <p>https://pmsmedicalcomplex.com</p>
                           </div>
                        </div>
                        <div style="color: #000;height: 400px;width: 48%;float: right;text-align:right">
                            <div style="">
                                   <p> آدرس: قبایلو ریاست تر څنګ حاجی صیب ګل کریم مرکز ته مخامخ، اوله ناحیه ، پروفیسر مروارید صافی معالجوی روغتون</p>
                                   <p>0093 785555544:روغتون اړیکه</p>
                                   <p>0093 785555544:امبولانس اړیکه</p>
                                   <p>info@pmsmedicalcomplex.com :ایمیل ادرس</p>
                                   <p>https://pmsmedicalcomplex.com</p>
                               </div>
                            </div>  
                  </div> 
                </div><!-- modal-body -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div><!-- MODAL DIALOG -->
    </div>
    <!-- LARGE MODAL CLOSED -->



    <div id="edit" class="modal fade">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content ">
                <div class="modal-header pd-x-20">
                    <h6 class="modal-title">Add Appoinments</h6>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body pd-20">
                    <div class="alert alert1 alert-danger">
                        <ul id="error"></ul>
                    </div>

                    <form method="post" id="editform">
                        <div class="form-group">
                            <label>Patient FirstName</label>
                            <input name="first_name" type="text" class="form-control" placeholder="First Name"
                                id="first_name">
                                <input type="hidden" id="app_id_id" name="app_id">
                        </div>

                        <div class="form-group">
                            <label>Patient LastName</label>
                            <input name="last_name" type="text" class="form-control" placeholder="Last Name" id="last_name">
                        </div>
                        <div class="form-group">
                            <label>Age</label>
                            <input name="age" type="text" class="form-control age" placeholder="Age" id="age">
                        </div>
                        <div class="form-group">
                            <label>Phone Number</label>
                            <input name="phone" type="text" class="form-control phone" placeholder="Phone number"
                                id="phone">
                        </div>
                        <div class="form-group">
                            <label>Date</label>
                            <input name="date" type="date" class="form-control" placeholder="Date" id="date">
                        </div>
                        <div class="form-group">
                            <label>Time</label>
                            <input name="time" type="text" class="basicExample time ui-timepicker-input form-control"
                                placeholder="Time" autocomplete="off" >

                            <option>
                        </div>

                        <div class="form-group">
                            <label>Departments</label>
                            <select name="department" class="form-control deps">
                                <option value="" disabled selected>Select Department</option>
                                @foreach ($dep as $row)
                                    <option value="{{ $row->dep_id }}">{{ $row->department_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Docter</label>
                            <select name="docters"  class="form-control pos">
                                <option value="" selected disabled>Select Docter</option>
                            </select>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Create Appoinment</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </form>
                </div><!-- modal-body -->
            </div>
        </div><!-- MODAL DIALOG -->
    </div>
@endsection
@section('directory')
    <li class="breadcrumb-item active" aria-current="page">Appoinments</li>
@endsection
@section('jquery')
    <script src="{{ asset('public/assets/plugins/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/datatable/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/datatable/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/notify/js/jquery.growl.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/sweetalert2/dist/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('public/assets/time/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('public/assets/time/jquery.timepicker.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/3.3.4/jquery.inputmask.bundle.min.js"></script>

    <script>
        $('#print').on('shown.bs.modal', function () {
            printDiv();
            $('#print').modal('hide');
        });
        function printDiv() {
            var divToPrint=document.getElementById('DivIdToPrint');
            var newWin=window.open('','Print-Window');
            newWin.document.open();
            newWin.document.write('<html><head><style>@media print { body{hight: 100%;}}p, ul, ol {margin:0px}</style></head> <body onload="window.print()">'+divToPrint.innerHTML+'</body></html>');
            newWin.document.close();
            setTimeout(function(){newWin.close();},10);
            }

        $(document).ready(function() {
            $('.phone').inputmask('(0)-999-999-999');
            $('.age').inputmask('99');
        });

    </script>

    <script>
        $('#example').DataTable();
        $('.alert').hide();
        $('.basicExample').timepicker({
            minTime: '1:am',
            maxTime: '12:pm',
        });

    </script>
    <script>
        $('.deps').change(function() {
            id = ($(this).val());
            url = '{{ url('appoinments_get_position') }}/' + id;
            var Hdata = "";
            $.ajax({
                type: 'get',
                url: url,
                success: function(data) {
                    if (data != '') {
                        Hdata = '<option value="" selected disabled>Select Docter</option>';
                        for (var i = 0; i < data.length; i++) {
                            Hdata += '<option value="' + data[i].emp_id + '">' + data[i]
                                .f_name + ' ' + data[i]
                                .l_name + '</option>';
                            $(".pos").html(Hdata);
                        }
                    } else {
                        $(".pos").html(
                            '<option value="" selected disabled>No Record Found</option>');
                    }
                },
                error: function() {}
            })

        });
        $("#createform").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '@php echo csrf_token() @endphp '
                }
            });
            $.ajax({
                url: '{{ url("appoinments") }}',
                type: 'post',
                data: formData,
                success: function(data) {
                    $(".alert").css('display', 'none');
                    $('.table').load(document.URL + ' .table');
                    $('#create').modal('hide');
                    $('#createform')[0].reset();
                    return $.growl.notice({
                        message: data.success,
                        title: 'Success !',
                    });
                },
                error: function(data) {
                    $(".alert").find("ul").html('');
                    $(".alert").css('display', 'block');
                    $.each(data.responseJSON.errors, function(key, value) {
                        $(".alert").find("ul").append('<li>' + value + '</li>');
                    });
                    $('.modal').animate({
                        scrollTop: 0
                    }, '500');

                },
                cache: false,
                contentType: false,
                processData: false
            });
        });
        $('body').on('click', '.edit', function() {
            id = $(this).attr('data-id');
            url = '{{ url('appoinments') }}' + '/' + id + '/' + "edit";
            var Hdata = "";
            $.get(url, function(data) {
                if (data.pos != '') {
                    Hdata = '<option value="" selected disabled>Select Docter</option>';
                    for (let i = 0; i < data.pos.length; i++) {
                        Hdata += '<option value="' +data.pos[i].emp_id + '">' + data.pos[i]
                            .f_name + ' ' + data.pos[i]
                            .l_name + '</option>';
                        $(".pos").html(Hdata);
                    }
                }

                if (data.app != '') {
                    $('#first_name').val(data.app['p_f_name']);
                    $('#last_name').val(data.app['p_l_name']);
                    $('#age').val(data.app['age']);
                    $('#phone').val(data.app['phone']);
                    $('#date').val(data.app['date']);
                    $('.time').val(data.app['time']);
                    $('.deps').val(data.app['dep_id']);
                    $('.pos').val(data.app['emp_id']);
                    $('#app_id_id').val(data.app['app_id']);                    
                }
            });
        });
        $("#editform").submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': '@php echo csrf_token() @endphp '
                }
            });
            $.ajax({
                url: '{{ url("appoinments_update") }}',
                type: 'post',
                data: formData,
                success: function(data) {
                    $(".alert1").css('display', 'none');
                    $('.table').load(document.URL + ' .table');
                    $('#edit').modal('hide');
                    $('#editform')[0].reset();
                    return $.growl.notice({
                        message: data.success,
                        title: 'Success !',
                    });
                },
                error: function(data) {
                    $(".alert1").find("ul").html('');
                    $(".alert1").css('display', 'block');
                    $.each(data.responseJSON.errors, function(key, value) {
                        $(".alert1").find("ul").append('<li>' + value + '</li>');
                    });
                    $('.modal').animate({
                        scrollTop: 0
                    }, '500');

                },
                cache: false,
                contentType: false,
                processData: false
            });
        });

      $('body').on('click','.delete',function(){  
        var id =$(this).attr('data-delete');
        Swal.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              type: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#d33',
              cancelButtonColor: '#3085d6',
              confirmButtonText: 'Yes, delete it!'
          }).then((result) => {
              if (result.value) {
                $.ajaxSetup({headers: {'X-CSRF-TOKEN':'@php echo csrf_token() @endphp '}});  

            $.ajax({
                    type:'DELETE',
                    url:'{{url("appoinments")}}/'+id,
                    type:'Delete',
                    success:function(data){ 
                    Swal.fire(
                      'Deleted!',
                      'Your file has been deleted.',
                      'success'
                    )
                    $('#row'+id).hide(1500);
                    },
                    error:function(error){
                    Swal.fire(
                      'Faild!',
                      'Department has related data first delete departments data',
                      'error'
                    )
                    }
                });
            }
          })
              
});

    </script>
@endsection
