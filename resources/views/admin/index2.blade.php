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
                            <div class="widget-int num-count">5</div>
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
                            <div class="widget-int num-count">48</div>
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
                            <div class="widget-int num-count">2</div>
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
                <div class="col-md-6">
                    
                    <!-- START SALES BLOCK -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title-box">
                                <h3>Announcements</h3>
                                <span>Announcements that will appear to time-in/out page.</span>
                            </div>      
                            <ul class="panel-controls" style="margin-top: 2px;">
                                <li><a href="#"><span class="fa fa-plus"></span></a></li>
                                <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>                                       
                            </ul>                                   
                            
                        </div>
                        <div class="panel-body scroll">                                    
                             <div class="row">
                                <div class="col-md-12">
                                    <div class="owl-carousel" id="owl-example">
                                        <div>                                   
                                             <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut sagittis rhoncus dolor a porta. Sed fermentum tincidunt convallis. Donec magna orci, fringilla in laoreet sit amet, lobortis quis sem. Nulla lacinia suscipit lectus non convallis. Morbi in condimentum urna. Cras porta hendrerit dapibus. Sed efficitur urna in dictum luctus.</p>
                                    
                                        </div>
                                        <div>     
                                            <p>Sed sollicitudin velit vel purus finibus porttitor. Ut a felis ullamcorper, bibendum risus lobortis, bibendum ex. Nulla rutrum nunc ipsum. Nullam sed nibh non leo condimentum sollicitudin. Etiam sagittis dui sed dolor pharetra, et efficitur felis luctus. Mauris eu arcu maximus, lacinia purus quis, tempor magna. Suspendisse sit amet quam in mi aliquam hendrerit nec eget ante. Fusce bibendum imperdiet efficitur. Mauris facilisis ligula nec dolor dapibus convallis eget vitae velit. Nunc egestas metus neque, nec fermentum enim facilisis eu. Aliquam sagittis pharetra ante, sit amet luctus sem efficitur sed.</p>
                                        </div>
                                        <div>                                    
                                            <p>Sed sollicitudin velit vel purus finibus porttitor. Ut a felis ullamcorper, bibendum risus lobortis, bibendum ex. Nulla rutrum nunc ipsum. Nullam sed nibh non leo condimentum sollicitudin. Etiam sagittis dui sed dolor pharetra, et efficitur felis luctus. Mauris eu arcu maximus, lacinia purus quis, tempor magna. Suspendisse sit amet quam in mi aliquam hendrerit nec eget ante. Fusce bibendum imperdiet efficitur. Mauris facilisis ligula nec dolor dapibus convallis eget vitae velit. Nunc egestas metus neque, nec fermentum enim facilisis eu. Aliquam sagittis pharetra ante, sit amet luctus sem efficitur sed.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>                              
                        </div>
                    </div>
                    <!-- END SALES BLOCK -->
                </div>

                <div class="col-md-6">
                    
                    <!-- START PROJECTS BLOCK -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="panel-title-box">
                                <h3>Events</h3>
                                <!-- <span>Incoming Events</span> -->
                            </div>                                    
                            <ul class="panel-controls" style="margin-top: 2px;">
                                <li><a href="#"><span class="fa fa-plus"></span></a></li>
                                <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>                                       
                            </ul>
                        </div>
                        <div class="panel-body scroll">
                            <h6>Lorem ipsum dolor</h6>
                            <p>
                                Quisque ultricies turpis pulvinar lectus semper, eget fringilla purus tincidunt. 
                                <span class="text-muted"><i class="fa fa-clock-o"></i> 14:15 Today</span>
                            </p>
                            <h6>Integer finibus orci vel</h6>
                            <p>
                                Nam luctus nulla molestie nisi fermentum, ac maximus elit bibendum. 
                                <span class="text-muted"><i class="fa fa-clock-o"></i> 10:22 Today</span>
                            </p>
                            <h6>Morbi iaculis quam at eros</h6>
                            <p>
                                Fusce dictum mauris quis velit cursus, consectetur tempor justo volutpat. 
                                <span class="text-muted"><i class="fa fa-clock-o"></i> 09:58 Today</span>
                            </p>
                            
                        </div>
                    </div>
                    <!-- END PROJECTS BLOCK -->
                    
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


