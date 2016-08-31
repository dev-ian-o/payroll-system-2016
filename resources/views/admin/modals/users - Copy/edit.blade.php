<div class="modal" id="modal-edit" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="defModalHead">Edit</h4>
            </div>

            <form role="form" id="form-edit" class="form-horizontal">
            <input type="hidden" name="id" value="">
            <div class="modal-body">                            
                <div class="form-group">
                    <label class="col-md-3 control-label">Username:</label>
                    <div class="col-md-9">
                        <input type="text" name="username" value="" class="validate[required] form-control"/>
                        <span class="help-block">Required, max size = 5</span>
                    </div>
                </div>                            
                <div class="form-group">
                    <label class="col-md-3 control-label">Email:</label>
                    <div class="col-md-9">
                        <input type="email" name="email" value="" class="validate[required] form-control"/>
                        <!-- <span class="help-block">Required, max size = 8</span> -->
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">User Group:</label>
                    <div class="col-md-9">
                        <select class="form-control" name="user_group_id" value="">
                            @foreach(App\UserGroup::get() as $key => $value)
                                <option value="{{$value->id}}">{{ $value->groupname }}</option>
                            @endforeach
                        </select>                           
                        <span class="help-block">Required</span>
                    </div>
                </div>    

                <div class="form-group">
                    <label class="col-md-3 control-label">Password:</label>
                    <div class="col-md-9">
                        <input type="password" name="password" class="validate[required,minSize[5]] form-control" id="password"/>
                        <span class="help-block">Required, min size = 5</span>
                    </div>
                </div>    
                                                                  
                <div class="form-group">
                    <label class="col-md-3 control-label">Confirm:</label>
                    <div class="col-md-9">
                        <input type="password" class="validate[required,equals[password]] form-control" name="password_confirmation"/>
                        <span class="help-block">Required, equals Password</span>
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
  $(document).on('ready change input click',function() {
    $('.action-buttons').find('.edit').on('click', function(){
        $('.datatable').dataTable(); $el = $(this.parentElement.parentElement).find("[name]");
        $($el).each(function() {
           $('#modal-edit').find('[name='+this.name+']').val(this.value);
        });
    });
  });
</script>

<script type="text/javascript">
    $(document).on('ready',function() {
        $("#form-edit").on('submit', function(e){
          e.preventDefault();
          id = $(this).find('[name=id]').val();
          $.ajax({
                    url: '../api/v1/users/' + id + '/edit',
                    type: 'GET',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(results){
                      if(results.success == true)
                      {
                          $('#modal-edit').modal('hide');
                          $('#form-edit')[0].reset();
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
      });
</script>