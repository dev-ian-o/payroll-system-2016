<div class="modal" id="modal-add" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
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
                <div class="form-group">
                    <label class="col-md-3 control-label">Holiday Description:</label>
                    <div class="col-md-9">
                        <input type="text" name="holiday" class="form-control"/>
                    </div>
                </div>    
                <div class="form-group">
                    <label class="col-md-3 control-label">Date:</label>
                    <div class="col-md-9">
                        <input type="text" name="date" class="form-control datepicker"/>
                    </div>
                </div>                         
                
                <div class="form-group">
                    <label class="col-md-3 control-label">Holiday Type:</label>
                    <div class="col-md-9">
                        <select class="select" name="holiday_type_id">
                            @foreach(App\HolidayType::get() as $key => $value)
                            <option value="{{$value->id}}">{{ $value->holiday_type }}</option>
                            @endforeach
                        </select>                           
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
    $(document).on('ready',function() {
        $("#form-add").on('submit', function(e){
          e.preventDefault();
          console.log($(this).serialize());
          $.ajax({
                    url: '../api/v1/holidays',
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