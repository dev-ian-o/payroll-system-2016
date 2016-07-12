<!DOCTYPE html>
<html lang="en">
    <head>        
        <!-- META SECTION -->
        <title>Payroll System | Time-in/out</title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        
        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <!-- END META SECTION -->
        
        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" type="text/css" id="theme" href="admin-assets/css/theme-default.css"/>
        <!-- EOF CSS INCLUDE -->                                    
    </head>
    <body>
        <!-- START PAGE CONTAINER -->
        <div class="page-container page-navigation-toggled">
            
            <!-- START PAGE SIDEBAR -->
            <div class="page-sidebar">
                <!-- START X-NAVIGATION -->
                <ul class="x-navigation">
                    <li class="xn-logo">
                        <a href="/">Payroll</a>
                    </li>
                    
                </ul>
                <!-- END X-NAVIGATION -->
            </div>
            <!-- END PAGE SIDEBAR -->
            
            <!-- PAGE CONTENT -->
            <div class="page-content">
                
                <!-- START X-NAVIGATION VERTICAL -->
                <!-- <ul class="x-navigation x-navigation-horizontal x-navigation-panel">
                    
                </ul> -->
                <!-- END X-NAVIGATION VERTICAL -->                    
                               
                
                <!-- START CONTENT FRAME -->
                <div class="content-frame">
                    
                    <!-- START CONTENT FRAME TOP -->
                    <div class="content-frame-top">                        
                        <div class="page-title">                    
                            <h2><span class="fa fa-clock-o"></span> Time-in/out</h2>
                        </div> 
                        <div class="pull-right">
                            <button class="btn btn-default content-frame-left-toggle"><span class="fa fa-bars"></span></button>
                        </div>   

                    </div>
                    <!-- END CONTENT FRAME TOP -->
                    
                    <!-- START CONTENT FRAME LEFT -->
                    <div class="content-frame-left">
                            <div class="widget widget-danger widget-padding-sm">
                                <div class="widget-big-int plugin-clock">00:00:00</div>                            
                                <div class="widget-subtitle plugin-date">Loading...</div>
                                <div class="widget-buttons widget-c3"></div>                            
                            </div>  
                                            
                            <div class="panel panel-default">
                                <div class="panel-body profile bg-info">

                                    <div class="profile-image">
                                        <img src="{{ URL::to('admin-assets/assets/images/users/avatar.jpg') }}" alt="John Doe">
                                    </div>
                                    <div class="profile-data">
                                        <div class="profile-data-name">Juan Dela Cruz</div>
                                        <div class="profile-data-title">Employee</div>
                                    </div>

                                </div>

                                <div class="panel-body list-group">
                                    <li class="list-group-item"><span class="fa fa-sign-in"></span> Time-in: 06/27/2016 7:58 AM</li>
                                    <li class="list-group-item"><span class="fa fa-sign-out"></span> Time-out: </li>
                                </div>

                            </div>
                            <div class="tile tile-success">
                                    <img src="{{ URL::to('admin-assets/img/fingerprint-png.png') }}" style="height:70px;"/>
                                    <p>Tap your finger on the fingerprint scanner.</p>
                            </div>
                    </div>
                    <!-- END CONTENT FRAME LEFT -->
                    
                    <!-- START CONTENT FRAME BODY -->
                    <div class="content-frame-body">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                    <div class="panel-title-box">
                                        <h3>Announcements</h3>
                                    </div>  
                            </div>
                            <div class="panel-body">
                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut sagittis rhoncus dolor a porta. Sed fermentum tincidunt convallis. Donec magna orci, fringilla in laoreet sit amet, lobortis quis sem. Nulla lacinia suscipit lectus non convallis. Morbi in condimentum urna. Cras porta hendrerit dapibus. Sed efficitur urna in dictum luctus.</p>

                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut sagittis rhoncus dolor a porta. Sed fermentum tincidunt convallis. Donec magna orci, fringilla in laoreet sit amet, lobortis quis sem. Nulla lacinia suscipit lectus non convallis. Morbi in condimentum urna. Cras porta hendrerit dapibus. Sed efficitur urna in dictum luctus.</p>

                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                    <div class="panel-title-box">
                                        <h3>Events</h3>
                                    </div>  
                            </div>
                            <div class="panel-body">
                            
                                   <h6>Lorem ipsum dolor</h6>
                                    <p>
                                        Quisque ultricies turpis pulvinar lectus semper, eget fringilla purus tincidunt. 
                                        <span class="text-muted"><i class="fa fa-clock-o"></i> 14:15 Today</span>
                                    </p>
                                    <h6>Lorem ipsum dolor</h6>
                                    <p>
                                        Quisque ultricies turpis pulvinar lectus semper, eget fringilla purus tincidunt. 
                                        <span class="text-muted"><i class="fa fa-clock-o"></i> 14:15 Today</span>
                                    </p>
                                    

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

        
    <!-- START SCRIPTS -->
        <!-- START PLUGINS -->
        <script type="text/javascript" src="admin-assets/js/plugins/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="admin-assets/js/plugins/jquery/jquery-ui.min.js"></script>
        <script type="text/javascript" src="admin-assets/js/plugins/bootstrap/bootstrap.min.js"></script>        
        <!-- END PLUGINS -->

        <!-- THIS PAGE PLUGINS -->
        <script type='text/javascript' src='admin-assets/js/plugins/icheck/icheck.min.js'></script>
        <script type="text/javascript" src="admin-assets/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
        <!-- END PAGE PLUGINS --> 

        <!-- START TEMPLATE -->

        
        <script type="text/javascript" src="admin-assets/js/plugins.js"></script>        
        <script type="text/javascript" src="admin-assets/js/actions.js"></script>        
        <!-- END TEMPLATE -->
    <!-- END SCRIPTS -->         
    </body>
</html>






