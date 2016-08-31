
<?php //$cities = ["Quezon City", "Makati City"] ;?>



<div class="modal" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="defModalHead">Add</h4>
            </div>

            <form role="form" id="form-add" class="form-horizontal">
            <!-- <form action="/api/v1/users" class="form-horizontal" method="post"> -->
            {{ csrf_field() }}

            <div class="modal-body">                            
                <h4>Personal Information</h4>
                <!-- <div class="form-group">
                    <label class="col-md-3 control-label">Employee Number:</label>
                    <div class="col-md-9">
                        <input type="text" name="employee_no" class="form-control"/>
                    </div>
                </div> -->
                <div class="form-group">
                    <label class="col-md-3 control-label">First Name:</label>
                    <div class="col-md-9">
                        <input type="text" name="firstname" class="form-control"/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Middle Name:</label>
                    <div class="col-md-9">
                        <input type="text" name="middlename" class="form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Last Name:</label>
                    <div class="col-md-9">
                        <input type="text" name="lastname" class="form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Birthdate:</label>
                    <div class="col-md-9">
                        <input type="text" name="birthdate" class="form-control datepicker">
                    </div>
                </div>
                <hr>
                <h4>Address Information</h4>
                <div class="form-group">
                    <label class="col-md-3 control-label">Address:</label>
                    <div class="col-md-9">
                        <input type="text" name="address" class="form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Province</label>
                    <div class="col-md-9">
                        <select class="form-control select-province" name="province">
                            @foreach($provinces_table as $key => $value)
                            <option value="{{$value['name']}}" data-code="{{$value['key']}}">{{$value['name']}}</option>
                            @endforeach
                        </select>     
                    </div>

                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">City</label>
                    <div class="col-md-9">
                        <select class="form-control select-city" name="city">
                            @foreach($cities_table as $key => $value)
                                @if($value['province'] === 'MM')<option value="{{$value['name']}}">{{$value['name']}}</option>@endif
                            @endforeach
                        </select>     
                    </div>
                </div>



                <div class="form-group">
                    <label class="col-md-3 control-label">Zip Code</label>
                    <div class="col-md-9">
                        <input type="text" name="zip_code" class="form-control"/>
                    </div>
                </div>
                <hr>
                <h4>Pay Information</h4>
                <div class="form-group">
                    <label class="col-md-3 control-label">Monthly Basic Pay:</label>
                    <div class="col-md-9">
                        <input type="text" name="basic_pay" class="form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">SSS Contribution:</label>
                    <div class="col-md-9">
                        <input type="text" name="sss_contribution" class="form-control" readonly="" />
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Pag-ibig Contribution:</label>
                    <div class="col-md-9">
                        <input type="text" name="pagibig_contribution" class="form-control" readonly=""/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Philhealth Contribution:</label>
                    <div class="col-md-9">
                        <input type="text" name="philhealth_contribution" class="form-control" readonly=""/>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-md-3 control-label">Civil Status:</label>
                    <div class="col-md-9">
                        <select class="select" name="civil_status_code_id">
                            @foreach(App\CivilStatusCode::get() as $key => $value)
                            <option value="{{$value->id}}">{{ $value->civil_status_desc }}</option>
                            @endforeach
                        </select>                           
                    </div>
                </div>    

                <!-- <div class="form-group">
                    <label class="col-md-3 control-label">Password:</label>
                    <div class="col-md-9">
                        <input type="password" name="password" class="form-control" id="password"/>
                        <span class="help-block">Required, min size = 6</span>
                    </div>
                </div>    
                                                                  
                <div class="form-group">
                    <label class="col-md-3 control-label">Confirm:</label>
                    <div class="col-md-9">
                        <input type="password" class="form-control" name="password_confirmation"/>
                        <span class="help-block">Required!</span>
                    </div>
                </div> -->                                                               
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <input class="btn btn-primary" type="submit" value="Save">

            </div>

            </form>
        </div>
    </div>
</div>


<script type="text/javascript">
    $(document).on('ready',function() {
        // $('#modal-add').modal('show');

        $("#form-add").on('submit', function(e){
          e.preventDefault();
          console.log($(this).serialize());
          $('#modal-confirm').modal('show');
          type_of_trans = "add";
          return false;
        });
      });
      $('#form-add').find('input[name=basic_pay]').on('change input',function() {
            basic_salary = $(this).val();
            pagibig_contribution = 0;
            sss_contribution = 0;
            philhealth_contribution = 0;
            period = "semimonthly";
            // $.getJSON('{{ URL::to('/admin-assets/json/philhealthtable.json') }}', function(data) {
            //     $.each( data, function( key, val ) {

            //     });
            // });
            $.getJSON('{{ URL::to('/admin-assets/json/ssscontributiontable.json') }}', function(data) {

                
                $.each( data[0]['employed'], function( key, val ) {


                    if (val['rangeofcompensationstart'] <= basic_salary && val['rangeofcompensationend'] >= basic_salary)
                    {
                        if (period === "semimonthly")
                            sss_contribution = val['ee'] / 2;
                        else
                            sss_contribution = val['ee'];
                        $('#form-add').find('input[name=sss_contribution]').val(sss_contribution);
                    }


                    if (basic_salary < 1000)
                    {
                        if (val['rangeofcompensationstart'] === 1000.00)
                        {   
                            if (period === "semimonthly")
                                sss_contribution = val['ee'] / 2;
                            else
                                sss_contribution = val['ee'];
                            $('#form-add').find('input[name=sss_contribution]').val(sss_contribution);

                        }
                    }


                    if (basic_salary > 30000)
                    {
                        if (val['rangeofcompensationend'] === 30000.00)
                        {   
                            if (period === "semimonthly")
                                sss_contribution = val['ee'] / 2;
                            else
                                sss_contribution = val['ee'];
                            $('#form-add').find('input[name=sss_contribution]').val(sss_contribution);

                        }

                    }


                });

            });

            $.getJSON('{{ URL::to('/admin-assets/json/philhealthtable.json') }}', function(data) {

                
                $.each( data[0]['philhealth'], function( key, val ) {


                    if (val['salarylowerrange'] <= basic_salary && val['salaryupperrange'] >= basic_salary)
                    {
                        if (period === "semimonthly")
                            philhealth_contribution = val['ee'] / 2;
                        else
                            philhealth_contribution = val['ee'];

                        $('#form-add').find('input[name=philhealth_contribution]').val(philhealth_contribution);
                    }


                    if (basic_salary < 8000)
                    {
                        if (val['salarylowerrange'] === 8000.00)
                        {   
                            if (period === "semimonthly")
                                philhealth_contribution = val['ee'] / 2;
                            else
                                philhealth_contribution = val['ee'];
                            $('#form-add').find('input[name=philhealth_contribution]').val(philhealth_contribution);
                        }
                    }


                    if (basic_salary > 35999.99)
                    {
                        if (val['salaryupperrange'] === 35999.99)
                        {   
                            if (period === "semimonthly")
                                philhealth_contribution = val['ee'] / 2;
                            else
                                philhealth_contribution = val['ee'];
                            $('#form-add').find('input[name=philhealth_contribution]').val(philhealth_contribution);
                        }
                    }

                


                });

            });

            //COMPUTE PAG-BIG  CONTRIBUTION
            
            MAX_MONTHLY_COMPENSATION = 5000;

            if (1500 >= basic_salary)
                pagibig_contribution = MAX_MONTHLY_COMPENSATION * 0.01;
            else 
                pagibig_contribution = MAX_MONTHLY_COMPENSATION * 0.02;

            $('#form-add').find('input[name=pagibig_contribution]').val(pagibig_contribution);
            



      });
      $('#form-add').find('.select-province').on('change input',function() {
        a = 0;
        
        data_code = $(this).find(':selected').data('code');
        console.log(data_code);
        $.getJSON('{{ URL::to('/admin-assets/json/cities.json') }}', function(data) {
            //data is the JSON string
            
            // if(data[a]['province'] == data_code)
            // {
            //     console.log(data[a]['province']);
            // }
            // else{
            //     console.log(data[a]['province']);
            // }
            $('#form-add').find('.select-city').find('option').remove();
            $.each( data, function( key, val ) {
                if(data[key]['province'] === data_code){
                    // $(ito).find('.select-city').find('option');
                    // debugge
                    if (data[key]['province'] === data_code)
                    {
                        $('#form-add').find('.select-city').append($('<option>', { value : data[key]['name'] }).text(data[key]['name'])); 
                    }
                }   
            });
        });


      });

      function add(){
        $.ajax({
                  url: '../api/v1/employees',
                  type: 'POST',
                  data: $("#form-add").serialize(),
                  dataType: 'json',
                  success: function(results){
                    console.log(results);
                    if(results.success == true)
                    {
                        $('#modal-add').modal('hide');
                        $('#form-add')[0].reset();
                        alert('Successfully added!');
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
      }
</script>