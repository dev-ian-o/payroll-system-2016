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
            <h2><span class="fa fa-user"></span> Timesheet</h2>
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
                                    <h3 class="panel-title">Timesheet</h3>
                                    <ul class="panel-controls">
                                        <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                                        <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                        <li><a href="#" class="panel-default" data-toggle="modal" data-target="#modal-add"><span class="fa fa-plus"></span></a></li>

                                    </ul>                                
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12">

                                            <div class="panel panel-default">
                                                <div class="panel-body">
                                                    <h3><span class="fa fa-download"></span> Drag and drop the time sheet file</h3>
                                                    <!-- <p>Add form with class <code>dropzone</code> to get dropzone box</p> -->
                                                    <form action="#" class="dropzone">
                                                         {{ csrf_field() }}
                                                    </form>
                                                </div>
                                            </div>                        

                                        </div> 
                                    </div>
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

<script>
    $(document).on('ready',function() {

    });
</script>
</body>