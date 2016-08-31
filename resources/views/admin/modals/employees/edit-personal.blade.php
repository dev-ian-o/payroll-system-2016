<div class="modal" id="modal-edit-personal" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="defModalHead">Edit</h4>
            </div>

            <form role="form" id="form-edit-personal" class="form-horizontal">
            <input type="hidden" name="id" value="">
            <input type="hidden" name="salary_id" value="">
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
                        <input type="text" name="birthdate" class="form-control datepicker"/>
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
                                <option value="{{$value['name']}}">{{$value['name']}}</option>
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
                <button class="btn btn-primary" type="submit">Submit</button>

            </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript">
  $(document).on('ready change input click',function() {
    $('.action-buttons').find('.edit').on('click', function(){
        $('.datatable').dataTable(); $el = $(this.parentElement.parentElement).find("[name]");
        $($el).each(function() {
           $('#modal-edit-personal').find('[name='+this.name+']').val(this.value);
        });
    });
  });
</script>

<script type="text/javascript">
    $(document).on('ready',function() {
        $("#form-edit-personal").on('submit', function(e){
          e.preventDefault();
          id = $(this).find('[name=id]').val();
          $('#modal-confirm').modal('show');
          type_of_trans = "edit_personal";
          return false;
        });
      });

    $('#form-edit-personal').find('.select-province').on('change input',function() {
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
            $('#form-edit-personal').find('.select-city').find('option').remove();
            $.each( data, function( key, val ) {
                if(data[key]['province'] === data_code){
                    // $(ito).find('.select-city').find('option');
                    // debugge
                    if (data[key]['province'] === data_code)
                    {
                        $('#form-edit-personal').find('.select-city').append($('<option>', { value : data[key]['name'] }).text(data[key]['name'])); 
                    }
                }   
            });
        });


      });
    function edit_personal(){
        $.ajax({
                    // url: '../api/v1/employees/' + id + '/edit',
                    url: "{{ URL::to('api/v1/employees/') }}" + "/" + id + '/edit',
                    type: 'GET',
                    data: $("#form-edit-personal").serialize(),
                    dataType: 'json',
                    success: function(results){
                      if(results.success == true)
                      {
                          $('#modal-edit-personal').modal('hide');
                          $('#form-edit-personal')[0].reset();
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
    }
</script>

