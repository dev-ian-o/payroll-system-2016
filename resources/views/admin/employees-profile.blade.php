@include('admin.common.header')
<body ng-controller="usersController">
<!-- START PAGE CONTAINER -->
<div class="page-container">
    
    <!-- START PAGE SIDEBAR -->
    @include('admin.common.sidebar')
    <!-- END PAGE SIDEBAR -->
    
    <!-- PAGE CONTENT -->
    <div class="page-content">
    
    @include('admin.common.navbar')    
                           
    @include('admin.common.breadcrumbs')
    
        <?php
            $employee = App\Employee::where('employees.deleted_at', '=', NULL)
                                                ->where('employees.employee_no','=',$employee_no)
                                                ->leftJoin('salaries', 'salaries.id', '=', 'employees.salary_id')
                                                ->select('*','employees.id','employees.deleted_at','employees.created_at','employees.updated_at')
                                                ->get();
            $employee = $employee[0];
        ?>
        
        <!-- PAGE TITLE -->
        <div class="page-title">                    
            <h2><span class="fa fa-user"></span> Employee's Profile</h2>
        </div>
        <!-- END PAGE TITLE -->                
        
        <!-- PAGE CONTENT WRAPPER -->
        <!-- START CONTENT FRAME -->
                <div class="content-frame">
                    
                    <!-- START CONTENT FRAME TOP -->
                    <div class="content-frame-top">                        
                        <div class="page-title">                    
                            <!-- <h2><span class="fa fa-clock-o"></span> Time-in/out</h2> -->
                        </div> 
                        <div class="pull-right">
                            <button class="btn btn-default content-frame-left-toggle"><span class="fa fa-bars"></span></button>
                        </div>   

                    </div>
                    <!-- END CONTENT FRAME TOP -->
                    
                    <!-- START CONTENT FRAME LEFT -->
                    <div class="content-frame-left">                                              
                            <div id="panel-employee" class="panel panel-default">
                                <div class="panel-body profile bg-info">
                                    <div class="pull-right">
                                        <div id="edit-info" class="btn-group">
                                            <a href="#" data-toggle="dropdown" class="btn btn-warning dropdown-toggle edit">Edit <span class="caret"></span></a>
                                            <ul class="dropdown-menu" role="menu">
                                                
                                                <li><a href="#" data-toggle="modal" data-target="#modal-edit-personal">Personal and Address Information</a></li>
                                                <li><a href="#" data-toggle="modal" data-target="#modal-edit-pay">Pay Information</a></li>                                                    
                                            </ul>
                                            <input type="hidden" name="id" value="{{ $employee['id'] }}">
                                            <input type="hidden" name="employee_no" value="{{ $employee['employee_no'] }}">
                                            <input type="hidden" name="firstname" value="{{ $employee['firstname'] }}">
                                            <input type="hidden" name="lastname" value="{{ $employee['lastname'] }}">
                                            <input type="hidden" name="middlename" value="{{ $employee['middlename'] }}">
                                            <input type="hidden" name="birthdate" value="{{ $employee['birthdate'] }}">
                                            <input type="hidden" name="address" value="{{ $employee['address'] }}">
                                            <input type="hidden" name="city" value="{{ $employee['city'] }}">
                                            <input type="hidden" name="province" value="{{ $employee['province'] }}">
                                            <input type="hidden" name="zip_code" value="{{ $employee['zip_code'] }}">
                                            <input type="hidden" name="salary_id" value="{{ $employee['salary_id'] }}">
                                            <input type="hidden" name="civil_status_code_id" value="{{ $employee['civil_status_code_id'] }}">
                                            <input type="hidden" name="basic_pay" value="{{ $employee['basic_pay'] }}">
                                            <input type="hidden" name="sss_contribution" value="{{ $employee['sss_contribution'] }}">
                                            <input type="hidden" name="pagibig_contribution" value="{{ $employee['pagibig_contribution'] }}">
                                            <input type="hidden" name="philhealth_contribution" value="{{ $employee['philhealth_contribution'] }}">
                                        </div>
                                        <div id="file-info" class="btn-group">
                                            <!-- <a href="#" data-toggle="dropdown" class="btn btn-warning dropdown-toggle edit">File OT/Leave <span class="caret"></span></a> -->
                                            <a href="#" data-toggle="dropdown" class="btn btn-warning dropdown-toggle edit">File Leave <span class="caret"></span></a>
                                            <ul class="dropdown-menu" role="menu">
                                                
                                                <li><a href="#" data-toggle="modal" data-target="#modal-file-leave">File Leave</a></li>
                                                <li><a href="#" data-toggle="modal" data-target="#modal-file-overtime">File Overtime</a></li>
                                                <li><a href="#" data-toggle="modal" data-target="#modal-file-loan">Loan</a></li>                                                    
                                            </ul>
                                            <input type="hidden" name="id" value="{{ $employee['id'] }}">
                                            <input type="hidden" name="employee_id" value="{{ $employee['id'] }}">
                                        </div>
                                    </div>

                                    <div class="profile-image">
                                        <img id="employee-image" src="{{ URL::to('admin-assets/assets/images/users/avatar.jpg') }}" alt="John Doe">
                                    </div>
                                    <div class="profile-data">
                                        <div class="profile-data-name" id="employee-name">{{ $employee['firstname']." ".$employee['lastname']}}</div>
                                        <!-- <div class="profile-data-title">Loading...</div> -->
                                    </div>

                                </div>

                                <div class="panel-body list-group">
                                    <li class="list-group-item"><span class="fa fa-sign-in"></span> Birthdate: <span id="time-in">{{  Carbon\Carbon::createFromFormat('Y-m-d', $employee['birthdate'] )->toFormattedDateString() }}</span></li>
                                    <li class="list-group-item"><span class="fa fa-sign-out"></span> Address: <span id="time-out">{{ $employee['address'] }}</span></li>
                                    <li class="list-group-item"><span class="fa fa-sign-out"></span> City: <span id="time-out">{{ $employee['city'] }}</span></li>
                                    <li class="list-group-item"><span class="fa fa-sign-out"></span> Province: <span id="time-out">{{ $employee['province'] }}</span></li>
                                    <li class="list-group-item"><span class="fa fa-sign-out"></span> Zip Code: <span id="time-out">{{ $employee['zip_code'] }}</span></li>
                                    <li class="list-group-item"><span class="fa fa-sign-out"></span> No. of leaves: <br>
                                            
                                             @foreach(App\EmployeeLeaveCount::where('leave_types.deleted_at', '=', NULL)
                                                ->where('employee_leave_counts.employee_id', '=', $employee['id'])
                                                ->where('default_no_per_employee','>',0)
                                                ->leftJoin('leave_types', 'leave_types.id', '=', 'employee_leave_counts.leave_type_id')
                                                ->select('*','employee_leave_counts.id','employee_leave_counts.deleted_at','employee_leave_counts.created_at','employee_leave_counts.updated_at')
                                                ->get() as $key => $value)
                                            {{ $value->leave_type }} : {{ $value->actual_leave_count }}<br>
                                            @endforeach
                                    </li>
                                    <li class="list-group-item"><span class="fa fa-sign-out"></span> Basic Pay: <span id="time-out">{{ number_format($employee['basic_pay'],2) }}</span></li>

                                </div>

                            </div>
                            <div class="row">
                                <!-- <a href="#" class="btn btn-success" data-toggle="modal" data-target="#modal-time">Manual Time-in/out</a> -->
                            </div>
                            <!-- <div class="tile tile-success">
                                    <img src="{{ URL::to('admin-assets/img/fingerprint-png.png') }}" style="height:70px;"/>
                                    <p>Tap your finger on the fingerprint scanner.</p>
                            </div> -->
                    </div>
                    <!-- END CONTENT FRAME LEFT -->
                    
                    <!-- START CONTENT FRAME BODY -->
                    <div class="content-frame-body">
                            <div class="row">
                                <div class="col-xs-12">
                                    <div class="panel panel-default">
                                                                    <!-- START DEFAULT DATATABLE -->
                                            <div class="panel panel-default">
                                                <div class="panel-heading">                                
                                                    <h3 class="panel-title">Daily Time Record</h3>
                                                    <ul class="panel-controls">
                                                        <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                                                        <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                                        <li><a href="#" class="panel-default" data-toggle="modal" data-target="#modal-add"><span class="fa fa-plus"></span></a></li>

                                                    </ul>                                
                                                </div>
                                                <div class="panel-body">
                                                    <table class="table datatable">
                                                        <thead>
                                                            <tr>
                                                                <th>#</th>
                                                                <th>Time-in</th>
                                                                <th>Time-out</th>
                                                                <th>Total Hours</th>
                                                                <th>Actions</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php $a = 1;?>


                <?php
                $dt_current = Carbon\Carbon::now();
                $start_date = $dt_current->startOfWeek()->toDateTimeString();
                $end_date = $dt_current->endOfWeek()->toDateString();
                // echo $start_date;

                $employee_records = App\DailyTimeRecord::where('employee_id','=',$employee['employee_id'])
                    ->whereBetween('time_in', [$start_date, $end_date])
                    ->orderBy('time_in','ASC')
                    ->get();
                   // echo Carbon\Carbon::createFromFormat('Y-m-d', $employee_records[0][time_in] )->toFormattedDateString();
                    // echo Carbon\Carbon::createFromFormat('Y-m-d H', '1975-05-21 22')->toDateTimeString(); 
// diffInHours($dtVancouver, false);
                ?>
                                                        @foreach($employee_records as $key => $value)
                                                            <?php $dt_time_in = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->time_in );?>
                                                            <?php if($value->time_out) 
                                                                    $dt_time_out = Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->time_out )
                                                            ?>
                                                            <tr>
                                                                <td>{{ $a++ }}</td>
                                                                <td>{{ $dt_time_in->toDayDateTimeString() }}</td>
                                                                <td>@if($value->time_out){{ $dt_time_out->toDayDateTimeString() }} @else {{ $value->time_out }} @endif</td>
                                                                <td>@if($value->time_out){{ $dt_time_in->diffInHours($dt_time_out,true) }} @endif</td>
                                                                <td class="action-buttons">

                                                                    <!-- <button class="btn btn-warning edit" data-toggle="modal" data-target="#modal-edit"><i class="fa fa-pencil"></i></button> -->
                                                                    <input type="hidden" name="id" value="{{ $value->id }}">
                                                                    <a href="#" class="btn btn-warning" ><!-- <i class="fa fa-eye"></i> -->Edit</a>
                                                                    <!-- <div class="btn-group">
                                                                        <a href="#" data-toggle="dropdown" class="btn btn-warning dropdown-toggle edit">Edit <span class="caret"></span></a>
                                                                        <ul class="dropdown-menu" role="menu">
                                                                            
                                                                            <li><a href="#" data-toggle="modal" data-target="#modal-edit-personal">Personal and Address Information</a></li>
                                                                            <li><a href="#" data-toggle="modal" data-target="#modal-edit-pay">Pay Information</a></li>                                                    
                                                                        </ul>
                                                                    </div>
                                                                    <button class="btn btn-danger delete" data-toggle="modal" data-target="#modal-delete"><i class="fa fa-trash-o"></i></button> -->
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                        </tbody>

                                                    </table>
                                                </div>
                                            </div>
                                            <!-- END DEFAULT DATATABLE -->
                                      
                                    </div>
                                </div>
                            </div>
                    </div>
                    <!-- END CONTENT FRAME BODY -->
                </div>
                <!-- END CONTENT FRAME -->                             
    </div>

    <!-- END PAGE CONTENT -->
</div>


<!-- END PAGE CONTAINER --> 

@include('admin.common.logout')
@include('admin.common.footer')
@include('admin.modals.employees.edit-personal')
@include('admin.modals.employees.edit-pay')
@include('admin.modals.employees.confirm')
@include('admin.modals.employees.add-leave')
@include('admin.modals.employees.add-overtime')
@include('admin.modals.employees.add-loans')

<script type="text/javascript">
  $(document).on('ready change input click',function() {
    $('#edit-info').find('.edit').on('click', function(){
        $('.datatable').dataTable(); 
        $el = $('#edit-info').find("[name]");
        $($el).each(function() {
           $('#modal-edit-personal').find('[name='+this.name+']').val(this.value);
        });
    });
  });
</script>


<script type="text/javascript">
  $(document).on('ready change input click',function() {
    $('#file-info').find('.edit').on('click', function(){
        $('.datatable').dataTable(); 
        $el = $('#file-info').find("[name]");
        $($el).each(function() {
           $('#modal-file-overtime').find('[name='+this.name+']').val(this.value);
           $('#modal-file-leave').find('[name='+this.name+']').val(this.value);
           $('#modal-file-loan').find('[name='+this.name+']').val(this.value);
        });
    });
  });
</script>
<script type="text/javascript">
  $(document).on('ready change input click',function() {
    $('#edit-info').find('.edit').on('click', function(){
        $('.datatable').dataTable(); $el = $("#edit-info").find("[name]");
        $($el).each(function() {
           $('#modal-edit-pay').find('[name='+this.name+']').val(this.value);
           if(this.name === "lastname" || this.name === "firstname" || this.name === "employee_no")
                $('#modal-edit-pay').find('[name='+this.name+']').html(this.value);
           if($('#modal-edit-pay').find('[name='+this.name+']').is('select'))
           {     
                // console.log($('#modal-edit-pay').find('[name='+this.name+']').find('option').removeAttr("selected"));
                // console.log($('#modal-edit-pay').find('[name='+this.name+']').find('option[value="'+this.value+'"]').attr("selected","selected"));
                $('.selectpicker').selectpicker('refresh');
                // $('#modal-edit-pay').find('.selectpicker.inner li').attr('class','')
                // $('#modal-edit-pay').find('.selectpicker.inner li[rel='+this.value+']').attr('class','selected')
                num = this.value - 1;
                civil_status_desc = $('#modal-edit-pay').find('.selectpicker.inner li[rel='+num+']').find('.text').html();
                $('#modal-edit-pay').find('.selectpicker').find('span.filter-option').html(civil_status_desc)
                
                // $('#modal-edit-pay').find('.selectpicker').selectpicker('val', this.value);
            }

        });
    });
  });
</script>


</body>