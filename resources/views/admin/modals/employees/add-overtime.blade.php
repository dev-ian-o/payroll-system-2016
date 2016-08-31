<div class="modal" id="modal-file-overtime" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="defModalHead">File Overtime</h4>
            </div>

            <form role="form" id="form-file-overtime" class="form-horizontal">
            <!-- <form action="/api/v1/users" class="form-horizontal" method="post"> -->
            {{ csrf_field() }}
            <input type="hidden" name="employee_id" class="form-control"/>
            <div class="modal-body">                            
                <div class="form-group">
                    <label class="col-md-3 control-label">Date and time from:</label>
                    <div class="col-md-9">
                        <input type="text" name="date_from" class="form-control datepicker"/>
                        <input type="text" name="time_from" value="00:00" class="form-control timepicker"/>

                    </div>
                </div>
                <div class="form-group">
                    <label class="col-md-3 control-label">Date and time to:</label>
                    <div class="col-md-9">
                        <input type="text" name="date_to" class="form-control datepicker"/>
                        <input type="text" name="time_to" value="00:00" class="form-control timepicker"/>
                    </div>
                </div>                                                               
                                                                  
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
  $(document).on('ready change input click',function() {
    $('.action-buttons').find('.edit').on('click', function(){
        $('.datatable').dataTable(); $el = $(this.parentElement.parentElement).find("[name]");
        $($el).each(function() {
           $('#modal-file-overtime').find('[name='+this.name+']').val(this.value);
        });
    });
  });
</script>

<script type="text/javascript">
    $(document).on('ready',function() {
        $("#form-file-overtime").on('submit', function(e){
          e.preventDefault();
          console.log($(this).serialize());
          $.ajax({
                    url: '{{ URL::to('api/v1/overtime_records') }}',
                    type: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(results){
                      console.log(results);
                      if(results.success == true)
                      {
                          $('#modal-file-overtime').modal('hide');
                          $('#form-file-overtime')[0].reset();
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