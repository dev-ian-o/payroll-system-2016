<div class="modal" id="modal-confirm" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&timesp;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="defModalHead">Verification</h4>
            </div>

            <form role="form" id="form-confirm" class="form-horizontal">
            <input type="hidden" name="id" value="">
            {{ csrf_field() }}
            <div class="modal-body">
                <div class="form-group">
                    <label class="col-md-3 control-label">Username</label>
                    <div class="col-md-9">
                        <input type="text" name="username" class="form-control"/>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Password</label>
                    <div class="col-md-9">
                        <input type="password" name="password" class="form-control"/>
                    </div>
                </div>
                                                                   
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
  // $(document).on('ready change input click',function() {
  //   $('.action-buttons').find('.edit').on('click', function(){
  //       $('.datatable').dataTable(); $el = $(this.parentElement.parentElement).find("[name]");
  //       $($el).each(function() {
  //          $('#modal-edit-pay').find('[name='+this.name+']').val(this.value);
  //          if(this.name === "lastname" || this.name === "firstname" || this.name === "employee_no")
  //               $('#modal-edit-pay').find('[name='+this.name+']').html(this.value);

  //       });
  //   });
  // });
</script>

<script type="text/javascript">
    $(document).on('ready',function() {
        $("#form-confirm").on('submit', function(e){
          e.preventDefault();
          // id = $(this).find('[name=id]').val();
          confirm_auth = false;


          $.ajax({
                    url: '../api/v1/auth/confirm',
                    type: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(results){
                      
                      confirm_auth = true;
                      if(results.success == true)
                      {
                          $('#modal-confirm').modal('hide');
                          $('#form-confirm')[0].reset();
                          alert('Verified!');

                          if(type_of_trans === "edit_pay"){
                            edit_pay();
                          }else if(type_of_trans === "edit_personal"){
                            edit_personal();
                          }
                          else if(type_of_trans === "add"){
                            add();
                          }

                      }
                      else
                      {
                          for( i in results.errors){ 
                            results["errors"][i].forEach(function(item){ 
                                      noty({text: item,timeout: 4000, layout: 'topRight'});
                                }) 
                          }
                          confirm_auth = false;
                          noty({text: "Invalid username or password.",timeout: 4000, layout: 'topRight'});
                      }
                    },
                    complete:function(){
                      // $(".loader").fadeOut('slow');
                      //loader stop here.
                    }
          });
          if(confirm_auth === false)
          {
            
          }

          // debugger;
          return false;
        });
      });
</script>