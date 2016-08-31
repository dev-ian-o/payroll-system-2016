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
                    <label class="col-md-3 control-label">Pay Type:</label>
                    <div class="col-md-9">
                        <input type="text" name="pay_type" value="" class="form-control" disabled/>
                    </div>
                </div>                            
                <div class="form-group">
                    <label class="col-md-3 control-label">First Nine Hours Pay:</label>
                    <div class="col-md-9">
                        <input type="text" name="first_nine_hrs_pay" value="" class="validate[required] form-control"/>
                        <!-- <span class="help-block">Required, max size = 8</span> -->
                    </div>
                </div>                           
                <div class="form-group">
                    <label class="col-md-3 control-label">Excess of Nine Hours Pay:</label>
                    <div class="col-md-9">
                        <input type="text" name="excess_of_nine_hrs_pay" value="" class="validate[required] form-control"/>
                        <!-- <span class="help-block">Required, max size = 8</span> -->
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
                    url: '../api/v1/pay_settings/' + id + '/edit',
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