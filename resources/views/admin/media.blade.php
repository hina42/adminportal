@extends('layouts.index')
@section('title')
          Media
@endsection

@section('content')
               <div class="row">
                  <div class="col-sm-12">
                     <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                           <div class="panel-title">
                              <h4>Media files</h4>
                             </div>
                          </div>
                           <div class="panel-body">
                              <div style="margin-left:2%;margin-bottom:2%" class="row">
                                 <button data-toggle="modal" data-target="#add"class="btn-sm btn-primary">Add</button>
                                 <button data-toggle="modal" data-target="#add" class="btn-sm btn-danger">delete</button>
                                 <button data-toggle="modal" data-target="#add"class="btn-sm btn-warning">select</button>
                                 <br><br >
                                 <div id='item'>
                                    @foreach($media as $row)
                                    <div class="card text-center" style="float:left;padding:1%;width: 18rem;">
                                       <div class="card-body">
                                          <img height="150" width="150"  src="{{$row->image}}" alt="...">
                                          <a data-toggle="modal" data-target="#detail"  class="btn-sm btn-primary" href="#">Details</a>
                                       </div>
                                    </div>
                                    @endforeach
                                 </div>
                            </div>
                           </div>   
                        </div>
                     </div>
                  </div>
               </div>
      @endsection


<!-- Modal -->



<!-- Modal -->
<div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Add Media Files</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form id="addform"action="{{route('addmedia')}}" enctype="multipart/form-data" method='post'>
      @csrf
      <button height="300" width="200"><input type="file" id="image" name="image"></button>
      <input type="text" id="name" name="name" placeholder="Enter file name" class="form-group">
      <button type="submit" id="addfile">Add</button>
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


@section('script')
<script>
$(document).ready(function(){

   $('#addfile').click(function(){
  $('#addform').on('submit', function(event){
  event.preventDefault(); 
   $.ajax({
    url:"{{ route('addmedia') }}",
    method:"POST",
    data: new FormData(this),
    contentType: false,
    cache:false,
    processData: false,
    dataType:"json",
    success:function(data)
    { alert('success');
    $('.card').parent().append( 
     ' <div class="card text-center" style="float:left;padding:1%;width: 18rem;">'+
      '<div class="card-body">'+
         '<imgheight="150" width="150"   src="'+data.image+'" alt="...">'+
         '<a data-toggle="modal" data-target="#detail"  class="btn-sm btn-primary" href="#">Details</a>'+
      '</div>'+
      '</div>'
    );
    }
   });});});


});

</script>
@endsection