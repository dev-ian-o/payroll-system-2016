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
        <style type="text/css">
            .noty_message{
                z-index:1153 !important;
            }
        </style>

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
                                            
                            <div id="panel-employee" class="panel panel-default hide">
                                <div class="panel-body profile bg-info">

                                    <div class="profile-image">
                                        <img id="employee-image" src="{{ URL::to('admin-assets/assets/images/users/avatar.jpg') }}" alt="John Doe">
                                    </div>
                                    <div class="profile-data">
                                        <div class="profile-data-name" id="employee-name">Loading...</div>
                                        <!-- <div class="profile-data-title">Loading...</div> -->
                                    </div>

                                </div>

                                <div class="panel-body list-group">
                                    <li class="list-group-item"><span class="fa fa-sign-in"></span> Time-in: <span id="time-in">06/27/2016 7:58 AM</span></li>
                                    <li class="list-group-item"><span class="fa fa-sign-out"></span> Time-out: <span id="time-out"></span></li>
                                </div>

                            </div>
                            <div class="row">
                                <a href="#" class="btn btn-success" data-toggle="modal" data-target="#modal-time">Manual Time-in/out</a>
                            </div>
                            <!-- <div class="tile tile-success">
                                    <img src="{{ URL::to('admin-assets/img/fingerprint-png.png') }}" style="height:70px;"/>
                                    <p>Tap your finger on the fingerprint scanner.</p>
                            </div> -->
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

        <div class="modal" id="modal-time" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="defModalHead">Time-in/out</h4>
                    </div>

                    <form role="form" id="form-add" class="form-horizontal">
                    {{ csrf_field() }}
                    <div class="modal-body">                            
                        <div class="form-group">
                            <label class="col-md-3 control-label">Employee Number:</label>
                            <div class="col-md-9">
                                <input type="text" name="employee_no" class="form-control"/>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <input class="btn btn-primary" type="submit" value="Submit">

                    </div>

                    </form>
                </div>
            </div>
        </div>        
    <!-- START SCRIPTS -->
        <!-- START PLUGINS -->
        <script type="text/javascript" src="admin-assets/js/plugins/jquery/jquery.min.js"></script>
        <script type="text/javascript" src="admin-assets/js/plugins/jquery/jquery-ui.min.js"></script>
        <script type="text/javascript" src="admin-assets/js/plugins/bootstrap/bootstrap.min.js"></script>        
        <!-- END PLUGINS -->

        <!-- THIS PAGE PLUGINS -->
        <script type='text/javascript' src='admin-assets/js/plugins/icheck/icheck.min.js'></script>
        <script type="text/javascript" src="admin-assets/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js"></script>
        <script type='text/javascript' src="{{ URL::to('admin-assets/js/plugins/noty/jquery.noty.js') }}"></script>

        <script type='text/javascript' src="{{ URL::to('admin-assets/js/plugins/noty/layouts/topCenter.js') }}"></script>
        <script type='text/javascript' src="{{ URL::to('admin-assets/js/plugins/noty/layouts/topLeft.js') }}"></script>
        <script type='text/javascript' src="{{ URL::to('admin-assets/js/plugins/noty/layouts/topRight.js') }}"></script>
        <script type='text/javascript' src='{{ URL::to('admin-assets/js/plugins/noty/themes/default.js') }}'></script>
        <!-- START TEMPLATE -->

        
        <script type="text/javascript" src="admin-assets/js/plugins.js"></script>        
        <script type="text/javascript" src="admin-assets/js/actions.js"></script>        
        <!-- END TEMPLATE -->
    <!-- END SCRIPTS -->     

        <script type="text/javascript">
            $(document).on('ready',function() {
        // $('#modal-add').modal('show');

            $("#form-add").on('submit', function(e){
                  e.preventDefault();
                  console.log($(this).serialize());
                  $.ajax({
                      url: '../api/v1/daily_time_records',
                      type: 'POST',
                      data: $("#form-add").serialize(),
                      dataType: 'json',
                      success: function(results){
                        console.log(results);
                        if(results.success == true)
                        {
                            $('#modal-time').modal('hide');
                            $('#form-add')[0].reset();
                            debugger;
                            // location.href = window.location.href;                    
                            $("#panel-employee").removeClass('hide');
                            $("#employee-name").html(results.user_record.firstname +" "+ results.user_record.lastname);
                            $("#time-in").html(results.user_record.time_in);
                            $("#time-out").html(results.user_record.time_out);
                            $("#panel-employee").removeClass('hide');


                            window.setTimeout(hide_panel_employee, 3000);
                            // window.location.reload();
                        }
                        else
                        {
                            for( i in results.errors){ 
                              results["errors"][i].forEach(function(item){ 
                                        noty({text: item,timeout: 4000, layout: 'topRight'});
                                  }) 
                            }
                        }
                      },
                      complete:function(){
                        // $(".loader").fadeOut('slow');
                        //loader stop here.
                      }
            });
                  return false;
                });
              });
            function hide_panel_employee(){
                $("#panel-employee").addClass('hide');

            }
        </script>    
    </body>
</html>






