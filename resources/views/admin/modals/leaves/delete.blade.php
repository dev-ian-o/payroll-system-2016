<div class="modal" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="defModalHead">Delete</h4>
            </div>
            <div class="modal-body">
                Are you sure you want to delete?
            </div>
            <div class="modal-footer">
                <form id="form-delete" >
                   {{ csrf_field() }}
                    <input type="hidden" name="id"> 

                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <input class="btn btn-primary" type="submit" value="Delete">

                </form>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
  $(document).on('ready change input click',function() {
    $('.action-buttons').find('.delete').on('click', function(){
        $('.datatable').dataTable(); $el = $(this.parentElement.parentElement).find("[name]");
        $($el).each(function() {
           $('#modal-delete').find('[name='+this.name+']').val(this.value);
        });
    });
  });
</script>

<script type="text/javascript">
  
  $(document).on('ready',function() {
    $("#form-delete").on('submit', function(e){
      e.preventDefault();
      id = $(this).find('[name=id]').val();
      $.ajax({
                url: '../api/v1/leave_types/'+id,
                type: 'DELETE',
                data: $(this).serialize(),
                dataType: 'json',
                success: function(results){
                  console.log(results);
                  if(results.success == true)
                  {
                      $('#modal-delete').modal('hide');
                      alert('Successfully deleted!');
                      // location.href = window.location.href;
                      window.location.reload();
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
