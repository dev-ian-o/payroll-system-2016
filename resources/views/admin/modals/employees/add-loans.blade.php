<div class="modal" id="modal-file-loan" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="defModalHead">File Overtime</h4>
            </div>

            <form role="form" id="form-file-loan" class="form-horizontal">
            <!-- <form action="/api/v1/users" class="form-horizontal" method="post"> -->
            {{ csrf_field() }}
            <input type="hidden" name="employee_id" class="form-control"/>
            <div class="modal-body">                            
                <div class="form-group">
                    <label class="col-md-3 control-label">Loan Amount:</label>
                    <div class="col-md-9">
                        <input type="text" name="loan_total" class="form-control "/>
                    </div>
                </div>                    
                <div class="form-group">
                    <label class="col-md-3 control-label">Number of Months to Pay:</label>
                    <div class="col-md-9">
                        <input type="text" name="months_of_payment" class="form-control "/>
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
        debugger;
        $($el).each(function() {
           $('#modal-file-loan').find('[name='+this.name+']').val(this.value);
        });
    });
  });
</script>

<script type="text/javascript">
    $(document).on('ready',function() {
        $("#form-file-loan").on('submit', function(e){
          e.preventDefault();
          console.log($(this).serialize());
          $.ajax({
                    url: '{{ URL::to('api/v1/loan_records') }}',
                    type: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(results){
                      console.log(results);
                      if(results.success == true)
                      {
                          $('#modal-file-loan').modal('hide');
                          $('#form-file-loan')[0].reset();
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