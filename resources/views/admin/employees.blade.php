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
        

        
        <!-- PAGE TITLE -->
        <div class="page-title">                    
            <h2><span class="fa fa-group"></span> Employees</h2>
        </div>
        <!-- END PAGE TITLE -->                
        
        <!-- PAGE CONTENT WRAPPER -->
        <div class="page-content-wrap">                
        
            <div class="row">
                <div class="col-xs-12">
                    <div class="panel panel-default">
                                                    <!-- START DEFAULT DATATABLE -->
                            <div class="panel panel-default">
                                <div class="panel-heading">                                
                                    <h3 class="panel-title">Users</h3>
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
                                                <th>Employee No</th>
                                                <th>Last name</th>
                                                <th>First name</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $a = 1;?>
                                        @foreach(App\Employee::where('employees.deleted_at', '=', NULL)
                                                ->leftJoin('salaries', 'salaries.id', '=', 'employees.salary_id')
                                                ->select('*','employees.id','employees.deleted_at','employees.created_at','employees.updated_at')
                                                ->get() as $key => $value)
                                            <tr>
                                                <td>{{ $a++ }}</td>
                                                <td>{{ $value->employee_no }}</td>
                                                <td>{{ $value->lastname }}</td>
                                                <td>{{ $value->firstname }}</td>
                                                <td class="action-buttons">
                                                    <input type="hidden" name="id" value="{{ $value->id }}">
                                                    <input type="hidden" name="employee_no" value="{{ $value->employee_no }}">
                                                    <input type="hidden" name="firstname" value="{{ $value->firstname }}">
                                                    <input type="hidden" name="lastname" value="{{ $value->lastname }}">
                                                    <input type="hidden" name="middlename" value="{{ $value->middlename }}">
                                                    <input type="hidden" name="birthdate" value="{{ $value->birthdate }}">
                                                    <input type="hidden" name="address" value="{{ $value->address }}">
                                                    <input type="hidden" name="city" value="{{ $value->city }}">
                                                    <input type="hidden" name="province" value="{{ $value->province }}">
                                                    <input type="hidden" name="zip_code" value="{{ $value->zip_code }}">
                                                    <input type="hidden" name="salary_id" value="{{ $value->salary_id }}">
                                                    <input type="hidden" name="civil_status_code_id" value="{{ $value->civil_status_code_id }}">
                                                    <input type="hidden" name="basic_pay" value="{{ $value->basic_pay }}">
                                                    <input type="hidden" name="sss_contribution" value="{{ $value->sss_contribution }}">
                                                    <input type="hidden" name="pagibig_contribution" value="{{ $value->pagibig_contribution }}">
                                                    <input type="hidden" name="philhealth_contribution" value="{{ $value->philhealth_contribution }}">
                                                    <!-- <button class="btn btn-warning edit" data-toggle="modal" data-target="#modal-edit"><i class="fa fa-pencil"></i></button> -->

                                                    <a href='{{ URL::to("/admin/employees/$value->employee_no") }}' class="btn btn-success" ><!-- <i class="fa fa-eye"></i> -->View</a>
                                                    <div class="btn-group">
                                                        <a href="#" data-toggle="dropdown" class="btn btn-warning dropdown-toggle edit">Edit <span class="caret"></span></a>
                                                        <ul class="dropdown-menu" role="menu">
                                                            <!-- <li role="presentation" class="dropdown-header">Dropdown header</li> -->
                                                            <li><a href="#" data-toggle="modal" data-target="#modal-edit-personal">Personal and Address Information</a></li>
                                                            <li><a href="#" data-toggle="modal" data-target="#modal-edit-pay">Pay Information</a></li>                                                    
                                                        </ul>
                                                    </div>
                                                    <button class="btn btn-danger delete" data-toggle="modal" data-target="#modal-delete"><i class="fa fa-trash-o"></i></button>
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
    </div>

    <!-- END PAGE CONTENT -->
</div>


<!-- END PAGE CONTAINER --> 

@include('admin.common.logout')
@include('admin.common.footer')
@include('admin.modals.employees.add')
@include('admin.modals.employees.edit-personal')
@include('admin.modals.employees.edit-pay')
@include('admin.modals.employees.delete')
@include('admin.modals.employees.confirm')

</body>