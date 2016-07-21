
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
                <div class="form-group">
                    <label class="col-md-3 control-label">Employee Number:</label>
                    <div class="col-md-9">
                        <input type="text" name="employee_no" class="form-control"/>
                        <!-- <span class="help-block">Required, min size = 10</span> -->
                    </div>
                </div>
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
                    <label class="col-md-3 control-label">City</label>
                    <div class="col-md-9">
                        <input type="text" name="city" class="form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Province</label>
                    <div class="col-md-9">
                        <input type="text" name="province" class="form-control"/>
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
                        <input type="text" name="sss_contribution" class="form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Pag-ibig Contribution:</label>
                    <div class="col-md-9">
                        <input type="text" name="pagibig_contribution" class="form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Philhealth Contribution:</label>
                    <div class="col-md-9">
                        <input type="text" name="philhealth_contribution" class="form-control"/>
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
          $.ajax({
                    url: '../api/v1/employees',
                    type: 'POST',
                    data: $(this).serialize(),
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
          return false;
        });
      });
</script>