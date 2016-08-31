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
            <h2><span class="fa fa-bell-o"></span> Announcements</h2>
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
                                    <h3 class="panel-title">Announcements</h3>
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
                                                <th>Announcement</th>
                                                <th>Date From</th>
                                                <th>Date to</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $a = 1;?>
                                        @foreach(App\Announcement::where('deleted_at',null)->get() as $key => $value)
                                            <tr>
                                                <td>{{ $a++ }}</td>
                                                <td><span data-toggle="tooltip" data-placement="top" title="{{ $value->announcements}} ">{{ str_limit($value->announcements, 20) }}</span></td>
                                                <td>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->date_from )->toFormattedDateString() }}</td>
                                                <td>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->date_to )->toFormattedDateString() }}</td>
                                                <td class="action-buttons">
                                                    <input type="hidden" name="id" value="{{ $value->id }}">
                                                    <input type="hidden" name="announcements" value="{{ $value->announcements }}">
                                                    <input type="hidden" name="date_from" value="{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->date_from )->format('Y-m-d') }}">
                                                    <input type="hidden" name="date_to" value="{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $value->date_to )->format('Y-m-d') }}">
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
@include('admin.modals.announcements.add')
@include('admin.modals.announcements.edit')
@include('admin.modals.announcements.delete')

</body>