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
        <!-- <div class="page-title">                    
            <h2><span class="fa fa-user"></span> Payroll Settings</h2>
        </div> -->
        <!-- END PAGE TITLE -->                
        
        <!-- PAGE CONTENT WRAPPER -->
        <div class="page-content-wrap">                
        
            <div class="row">
                <div class="col-md-12">
                    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Payroll Settings</h3>
                        </div>
                        <div class="panel-body">                                                                        
                            
                        <form role="form" id="form-payroll_settings" class="form-horizontal">
                            {{ csrf_field() }}                           
                            <?php $payroll_setting = App\PayrollSetting::where('deleted_at',null)->orderBy('created_at','DESC')->first();?>

                            <?php $start_shift = Carbon\Carbon::createFromFormat('H:i:s', $payroll_setting->daily_start_shift )->format('h:i:s A')?>
                            <?php $end_shift = Carbon\Carbon::createFromFormat('H:i:s', $payroll_setting->daily_end_shift )->format('h:i:s A')?>

                            <?php $cutoff_dates = json_decode($payroll_setting->cutoff_dates) ?>
                            <input type="hidden" name="id" value="{{ $payroll_setting->id }}">
                            <h5 class="">Time Shift</h5>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Start time shift</label>
                                        <div class="col-md-5">
                                            <div class="input-group bootstrap-timepicker">
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                                                <input type="text" name="daily_start_shift" class="form-control timepicker" value="{{ $start_shift }}"/>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">End time shift</label>
                                        <div class="col-md-5">
                                            <div class="input-group bootstrap-timepicker">
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>                                                <input type="text" name="daily_end_shift" class="form-control timepicker"  value="{{ $end_shift }}"/>

                                            </div>
                                        </div>
                                    </div>
                                <h5 class="">Cut-off dates</h5>

                                <div class="form-group">
                                    <label class="col-md-3  control-label">First Cut-off Date</label>
                                    <div class="col-md-1 col-xs-12">                                                                                            
                                        <select class="form-control select" name="first_cut_off_date">
                                            @for($a=1; $a < 30; $a++)
                                            <option @if($a == $cutoff_dates->_1 ) {{ "selected=''"}} @endif>{{ $a }}</option>
                                            @endfor
                                            <!-- <option selected="">asdasd</option> -->

                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3  control-label">Second Cut-off Date</label>
                                    <div class="col-md-1 col-xs-12">                                                                                            
                                        <select class="form-control select" name="second_cut_off_date">
                                            @for($a=1;$a<30;$a++)
                                            <option @if($a == $cutoff_dates->_2) {{ "selected=''"}} @endif>{{ $a }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>

                        </div>
                        <div class="panel-footer">        
                            <input class="btn btn-primary pull-right" type="submit" value="Save">
                        </div>
                        </form>
                    </div>
                    
                </div>
                <div class="col-md-12">
                    
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Night Differencial Settings</h3>
                        </div>
                        <div class="panel-body">                                                                        
                            
                        <form role="form" id="form-nd_settings" class="form-horizontal">
                            {{ csrf_field() }}                           
                            <?php $nd_setting = App\NightDiffSetting::where('deleted_at',null)->orderBy('created_at','DESC')->first();?>

                            <?php $start_shift = Carbon\Carbon::createFromFormat('H:i:s', $nd_setting->nd_shift_time_start )->format('h:i:s A')?>
                            <?php $end_shift = Carbon\Carbon::createFromFormat('H:i:s', $nd_setting->nd_shift_time_end )->format('h:i:s A')?>

                            <input type="hidden" name="id" value="{{ $nd_setting->id }}">
                            <h5 class="">Night Diff time Shift</h5>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">Start time shift</label>
                                        <div class="col-md-5">
                                            <div class="input-group bootstrap-timepicker">
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>
                                                <input type="text" name="nd_shift_time_start" class="form-control timepicker" value="{{ $start_shift }}"/>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label">End time shift</label>
                                        <div class="col-md-5">
                                            <div class="input-group bootstrap-timepicker">
                                                <span class="input-group-addon"><span class="glyphicon glyphicon-time"></span></span>                                                <input type="text" name="nd_shift_time_end" class="form-control timepicker"  value="{{ $end_shift }}"/>

                                            </div>
                                        </div>
                                    </div>
                                
                                <div class="form-group">
                                    <label class="col-md-3  control-label">Pay</label>
                                    <div class="col-md-5">
                                        <div class="input-group">
                                            <input type="text" name="nd_pay" class="form-control"  value="{{ $nd_setting->nd_pay }}"/><span class="input-group-addon">%</span> 

                                        </div>
                                    </div>
                                </div>

                        </div>
                        <div class="panel-footer">        
                            <input class="btn btn-primary pull-right" type="submit" value="Save">
                        </div>
                        </form>
                    </div>
                    
                </div>
                <div class="col-md-12">
                    <div class="panel panel-default">
                                                    <!-- START DEFAULT DATATABLE -->
                            <div class="panel panel-default">
                                <div class="panel-heading">                                
                                    <h3 class="panel-title">Pay Settings</h3>
                                    <ul class="panel-controls">
                                        <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                                        <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                        

                                    </ul>                                
                                </div>
                                <div class="panel-body">
                                    <table class="table datatable">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Pay Type</th>
                                                <th>First Nine Hours Pay</th>
                                                <th>Excess of Nine Hours Pay</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php $a = 1;?>
                                        @foreach(App\PaySetting::where('deleted_at',null)->get() as $key => $value)
                                            <tr>
                                                <td>{{ $a++ }}</td>
                                                <td>{{ $value->pay_type }}</td>
                                                <td>{{ $value->first_nine_hrs_pay }}%</td>
                                                <td>{{ $value->excess_of_nine_hrs_pay }}%</td>
                                                <td class="action-buttons">
                                                    <input type="hidden" name="id" value="{{ $value->id }}">
                                                    <input type="hidden" name="pay_type" value="{{ $value->pay_type }}">
                                                    <input type="hidden" name="first_nine_hrs_pay" value="{{ $value->first_nine_hrs_pay }}">
                                                    <input type="hidden" name="excess_of_nine_hrs_pay" value="{{ $value->excess_of_nine_hrs_pay }}">
                                                    <button class="btn btn-warning edit" data-toggle="modal" data-target="#modal-edit"><i class="fa fa-pencil"></i></button>
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
@include('admin.modals.settings.edit')

<script type="text/javascript">
    $(document).on('ready',function() {
        console.log("echo");
        $("#form-payroll_settings").on('submit', function(e){
          e.preventDefault();
          
          $.ajax({
                    url: '{{ URL::to('api/v1/payroll_settings') }}',
                    type: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(results){
                      console.log(results);
                      if(results.success == true)
                      {
                          $('#form-payroll_settings')[0].reset();
                          alert('Successfully editted!');
                          // location.href = window.location.href;                    
                          window.location.reload();
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
        $("#form-nd_settings").on('submit', function(e){
          e.preventDefault();
          
          $.ajax({
                    url: '{{ URL::to('api/v1/night_diff_settings') }}',
                    type: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(results){
                      console.log(results);
                      if(results.success == true)
                      {
                          $('#form-payroll_settings')[0].reset();
                          alert('Successfully editted!');
                          // location.href = window.location.href;                    
                          window.location.reload();
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
// 
      });
</script>

</body>