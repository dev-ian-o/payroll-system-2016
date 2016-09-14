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
            <h2><span class="fa fa-user"></span> Payroll</h2>
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
                                    <h3 class="panel-title">Payroll</h3>
                                    <ul class="panel-controls">
                                        <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                                        <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                    </ul>                                
                                </div>
                                <div class="panel-body">
                                <form method="get" action="{{ url('computation')}}">
                                    
                                    <label>Month:</label>
                                    <select class="select" name="cutoff_month">
                                        <?php $a = 1;?>
                                        @while($a <= 12)
                                        <option value="{{$a}}" @if(isset($_GET['cutoff_month'])) @if($_GET['cutoff_month'] == $a) {{ "selected" }}  @endif @endif>{{ $a++ }}</option>
                                        @endwhile
                                    </select>
                                    <label>Year:</label>
                                    <select class="select" name="cutoff_year">
                                        <?php $a = Carbon\Carbon::now()->year;?>
                                        <?php $b = App\DailyTimeRecord::orderBy('created_at','ASC')->pluck('time_in');?>
                                        @while(Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$b[0])->year <= $a)
                                        <option value="{{$a}}" @if(isset($_GET['cutoff_year'])) @if($_GET['cutoff_year'] == $a) {{ "selected" }}  @endif @endif>{{ $a-- }}</option>
                                        @endwhile
                                    </select>
                                    <label>Cut-off:</label>
                                    <select class="select" name="place_of_cutoff">
                                        <?php $a = 1;?>
                                        @while($a <= 2)
                                        <option value="{{$a}}" @if(isset($_GET['place_of_cutoff'])) @if($_GET['place_of_cutoff'] == $a) {{ "selected" }}  @endif @endif>{{ $a++ }}</option>
                                        @endwhile
                                    </select>
                                    <input type="submit" class="btn btn-default" name="submit" value="Submit">
                                </form>      






<!--                                     <table class="table datatable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Username</th>
                                                <th>E-mail</th>
                                                <th>User Group</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $a = 1;?>
                                        @foreach(App\User::where('deleted_at',null)->get() as $key => $value)
                                            <tr>
                                                <td>{{ $a++ }}</td>
                                                <td>{{ $value->username }}</td>
                                                <td>{{ $value->email }}</td>
                                                <td>{{ App\UserGroup::where('id',$value->user_group_id)->pluck('groupname')->first() }}</td>
                                                <td class="action-buttons">
                                                    <input type="hidden" name="id" value="{{ $value->id }}">
                                                    <input type="hidden" name="username" value="{{ $value->username }}">
                                                    <input type="hidden" name="email" value="{{ $value->email }}">
                                                    <input type="hidden" name="user_group_id" value="{{ $value->user_group_id }}">
                                                    <button class="btn btn-warning edit" data-toggle="modal" data-target="#modal-edit"><i class="fa fa-pencil"></i></button>
                                                    <button class="btn btn-danger delete" data-toggle="modal" data-target="#modal-delete"><i class="fa fa-trash-o"></i></button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>

                                    </table> -->
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

</body>




<?php
