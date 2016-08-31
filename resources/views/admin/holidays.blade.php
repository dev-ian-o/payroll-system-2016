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
            <h2><span class="fa fa-calendar"></span> Holidays</h2>
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
                                    <h3 class="panel-title">Holidays</h3>
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
                                                <th>Description</th>
                                                <th>Date</th>
                                                <th>Holiday Type</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $a = 1;?>
                                            @foreach(App\Holiday::where('holidays.deleted_at', '=', NULL)
                                            ->leftJoin('holiday_types', 'holiday_types.id', '=', 'holidays.holiday_type_id')
                                            ->select('*','holidays.id','holidays.deleted_at','holidays.created_at','holidays.updated_at')
                                            ->orderBy('holidays.date', 'asc')
                                            ->get() as $key => $value)
                                            <tr>
                                                <td>{{ $a++ }}</td>
                                                <td>{{ $value->holiday }}</td>
                                                <td>{{ $value->date }}</td>
                                                <td>{{ $value->holiday_type }}</td>
                                                <td class="action-buttons">
                                                    <input type="hidden" name="id" value="{{ $value->id }}">
                                                    <input type="hidden" name="holiday" value="{{ $value->holiday }}">
                                                    <input type="hidden" name="date" value="{{ $value->date }}">
                                                    <input type="hidden" name="holiday_type" value="{{ $value->holiday_type }}">
                                                    <input type="hidden" name="holiday_type_id" value="{{ $value->holiday_type_id }}">
                                                    <button class="btn btn-warning edit" data-toggle="modal" data-target="#modal-edit"><i class="fa fa-pencil"></i></button>
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
@include('admin.modals.holidays.add')
@include('admin.modals.holidays.edit')
@include('admin.modals.holidays.delete')

</body>