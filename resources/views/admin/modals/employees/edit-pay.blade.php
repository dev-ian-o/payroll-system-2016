<div class="modal" id="modal-edit-pay" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="defModalHead">Edit</h4>
            </div>

            <form role="form" id="form-edit-pay" class="form-horizontal">
            {{ csrf_field() }}
            <input type="hidden" name="id" value="">
            <input type="hidden" name="employee_id" value="">
            <input type="hidden" name="salary_id" value="">
            <div class="modal-body">                            
                <h4>Pay Information</h4>
                <h6><span name="lastname"></span>,<span name="firstname"></span>(<span name="employee_no"></span>)</h6>
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
           $('#modal-edit-pay').find('[name='+this.name+']').val(this.value);
           if(this.name === "lastname" || this.name === "firstname" || this.name === "employee_no")
                $('#modal-edit-pay').find('[name='+this.name+']').html(this.value);
           if($('#modal-edit-pay').find('[name='+this.name+']').is('select'))
           {     
                // console.log($('#modal-edit-pay').find('[name='+this.name+']').find('option').removeAttr("selected"));
                // console.log($('#modal-edit-pay').find('[name='+this.name+']').find('option[value="'+this.value+'"]').attr("selected","selected"));
                $('.selectpicker').selectpicker('refresh');
                // $('#modal-edit-pay').find('.selectpicker.inner li').attr('class','')
                // $('#modal-edit-pay').find('.selectpicker.inner li[rel='+this.value+']').attr('class','selected')
                num = this.value - 1;
                civil_status_desc = $('#modal-edit-pay').find('.selectpicker.inner li[rel='+num+']').find('.text').html();
                $('#modal-edit-pay').find('.selectpicker').find('span.filter-option').html(civil_status_desc)
                
                // $('#modal-edit-pay').find('.selectpicker').selectpicker('val', this.value);
            }

        });
    });
  });
</script>

<script type="text/javascript">
    $(document).on('ready',function() {
        $("#form-edit-pay").on('submit', function(e){
          e.preventDefault();
          id = $(this).find('[name=id]').val();

                console.log($(this).serialize());
                // console.log($("#form-edit-pay").serialize());

            $('#modal-confirm').modal('show');
            type_of_trans = "edit_pay";
            // debugger;
          
          return false;
        });

        
      });

      function edit_pay(){
            id = $("#form-edit-pay").find('[name=id]').val();
            $.ajax({
                url: '../api/v1/salaries',
                type: 'POST',
                data: $("#form-edit-pay").serialize(),
                dataType: 'json',
                success: function(results){
                  if(results.success == true)
                  {
                      $('#modal-edit-pay').modal('hide');
                      $('#form-edit-pay')[0].reset();
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