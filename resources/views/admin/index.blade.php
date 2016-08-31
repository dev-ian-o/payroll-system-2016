@include('admin.common.header')
<body>
<!-- START PAGE CONTAINER -->
<div class="page-container">
    
    <!-- START PAGE SIDEBAR -->
    @include('admin.common.sidebar')
    <!-- END PAGE SIDEBAR -->
    
    <!-- PAGE CONTENT -->
    <div class="page-content">
    
    @include('admin.common.navbar')    
                           
    @include('admin.common.breadcrumbs')
        
        <?php $payroll_setting = App\PayrollSetting::where('deleted_at',null)->orderBy('created_at','DESC')->first(); ?>
        <?php $date_now = Carbon\Carbon::now(new \DateTimeZone('Asia/Manila')); ?>
        <?php
            $employees_clocked_in = App\DailyTimeRecord::where( \DB::raw('MONTH(time_in)'), '=', date("m") )
                ->where( \DB::raw('DAY(time_in)'), '=', date("d") )
                ->where( \DB::raw('YEAR(time_in)'), '=', date("Y") )
                ->where('deleted_at',null)
                ->count();
        ?>
        <?php $employees_late  = App\DailyTimeRecord::where( \DB::raw('MONTH(time_in)'), '=', date("m") )
                ->where( \DB::raw('DAY(time_in)'), '=', date("d") )
                ->where( \DB::raw('YEAR(time_in)'), '=', date("Y") )
                ->where('time_in','>',date("Y-m-d ") . $payroll_setting->daily_start_shift)
                ->where('deleted_at',null)
                ->count(); 

        ?>
        <?php $employees_on_leave  = App\EmployeeLeaveRecord::where('deleted_at',null)
                        ->where('date_from', '<=', date('Y-m-d'))
                        ->Where('date_to','>=',date('Y-m-d'))
                        ->count(); 
        ?>
       
        <!-- PAGE TITLE -->
        <!-- <div class="page-title">                    
            <h2><span class="fa fa-home"></span> Home</h2>
        </div> -->
        <!-- END PAGE TITLE -->                
        
        <!-- PAGE CONTENT WRAPPER -->
        <div class="page-content-wrap">                
        
            <!-- <div class="row">
                <div class="col-xs-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                        <h1>Welcome,  !</h1>
                    
                        </div>
                        <div class="panel-body">                            
                            <p>Thank you for logging in. </p>
                        </div>
                      
                    </div>
                </div>
            </div> -->
            <!-- START WIDGETS -->                    
            <div class="row">
                <div class="col-md-3">
                    
                    <!-- START WIDGET MESSAGES -->
                    <div class="widget widget-primary widget-item-icon">
                        <div class="widget-item-left">
                            <span class="fa fa-plane"></span>
                        </div>                             
                        <div class="widget-data">
                            <div class="widget-int num-count">{{ $employees_on_leave }}</div>
                            <div class="widget-title">Employee/s on leave</div>
                            <!-- <div class="widget-subtitle">In your mailbox</div> -->
                        </div> 
                    </div>                            
                    <!-- END WIDGET MESSAGES -->
                    
                </div>
                <div class="col-md-3">
                    
                    <!-- START WIDGET MESSAGES -->
                    <div class="widget widget-success widget-item-icon">
                        <div class="widget-item-left">
                            <span class="fa fa-user"></span>
                        </div>                             
                        <div class="widget-data">
                            <div class="widget-int num-count">{{ $employees_clocked_in }}</div>
                            <div class="widget-title">Employee/s Clocked-In</div>
                        </div> 
                    </div>                            
                    <!-- END WIDGET MESSAGES -->
                    
                </div>
                <div class="col-md-3">
                    
                    <!-- START WIDGET REGISTRED -->
                    <div class="widget widget-warning widget-item-icon">
                        <div class="widget-item-left">
                            <span class="fa fa-exclamation-triangle"></span>
                        </div>
                        <div class="widget-data">
                            <div class="widget-int num-count">{{ $employees_late }}</div>
                            <div class="widget-title">Late Employee/s</div>
                        </div>                           
                    </div>                            
                    <!-- END WIDGET REGISTRED -->
                    
                </div>
                <div class="col-md-3">
                    
                    <!-- START WIDGET CLOCK -->
                    <div class="widget widget-danger widget-padding-sm">
                        <div class="widget-big-int plugin-clock">00:00:00</div>                            
                        <div class="widget-subtitle plugin-date">Loading...</div>
                        <div class="widget-buttons widget-c3"></div>                            
                    </div>                        
                    <!-- END WIDGET CLOCK -->
                    
                </div>
            </div>

            <!-- END WIDGETS --> 
            <div class="row">
                <div class="col-md-12">
                    
                    <!-- START SALES BLOCK -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title-box">
                                <h3>Announcements</h3>
                                <span>Announcements that will appear to time-in/out page.</span>
                            </div>      
                            <ul class="panel-controls" style="margin-top: 2px;">
                                <li><a href="#" data-toggle="modal" data-target="#modal-add"><span class="fa fa-plus"></span></a></li>
                                <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>                                       
                            </ul>                                   
                            
                        </div>
                        <div class="panel-body scroll">                                    
                             <div class="row">
                                <div class="col-md-12">
                                    <div class="owl-carousel" id="owl-example">
                                        
                                        @if( ! empty(App\Announcement::where('deleted_at',null)->first()) ) 

                                            @foreach(App\Announcement::where('deleted_at',null)->get() as $key => $value)                        
                                            <div>           
                                                 <p>{{ $value->announcements }}</p>
                                        
                                            </div>
                                            @endforeach
                                        @else
                                        <div>           
                                             <center><p>NO ANNOUNCEMENTS TODAY!</p></center>
                                    
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>                              
                        </div>
                    </div>
                    <!-- END SALES BLOCK -->
                </div>
            </div>


        </div>
        <!-- PAGE CONTENT WRAPPER -->                                
    </div>    
    <!-- END PAGE CONTENT -->
</div>
<!-- END PAGE CONTAINER --> 


@include('admin.common.logout')

</body>
@include('admin.common.footer')
@include('admin.modals.announcements.add')


