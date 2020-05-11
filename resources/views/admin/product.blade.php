@extends('layouts.index')
@section('title')
          Product
@endsection

@section('content')
<style>
th{
   text-align: center;
}
td {
    vertical-align: middle;
    text-align: center;
}
img{
   box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
   border-radius:10%;
}
#color, a{
   box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}
</style>
<div class="row">
                  <div class="col-sm-12">
                     <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                           <div class="btn-group" id="buttonexport">
                              <a href="#">
                                 <h4>Product details</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                           <div style ="margin-top:2%"class="table-responsive">
                              <table   id="dataTableExample1" class="table table-bordered table-striped table-hover">
                                 <thead>
                                    <tr  class="info">
                                       <th>Image</th>
                                       <th>Name</th>
                                       <th>Subcategory</th>
                                       <th>Color</th>
                                       <th>size</th>
                                       <th>yard</th>
                                       <th>Description</th>
                                       <th>Price</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                 @foreach($data as $row)
                                    <tr class='prd{{$row->ProductID}}'>
                                       <td><img  height="100" width="100" src="{{$row->Image}}" alt="..."></td>
                                       <td>{{$row->ProductName}}</td>
                                       <td>
                                       {{$row->subcategory['SubCatType']}} <br>
                                       </td>
                                       <td>
                                       @foreach($row->color as $i)
                                      <h1 id="color"style="float:left;margin:2% 2% 2% 2%;background-color:{{$i->Color}};height:20px;width:20px;border-radius:50px"></h1>
                                       @endforeach
                                       </td>
                                       <td>
                                       @foreach($row->size as $i)
                                       - {{$i->Size}} <br>
                                       @endforeach
                                       </td>
                                       <td>
                                       @if(!$row->yard == null)
                                      {{ 'Min: '.$row->yard['Min']}} <br>
                                      {{ 'Max: '.$row->yard['Max']}}
                                       @endif
                                       </td>
                                       <td>{{$row->desc}}</td>
                                       <td>{{$row->ProductPrice}}</td>
                                       <td>
                                      <a href="#" class="btn-sm btn-warning" ><i class="fa fa-edit"></i></a>
                                       <a href="#delprd" id='{{$row->ProductID}}' data-toggle="modal" data-target="#delprd"class="prddel btn-sm btn-danger" ><i class="fa fa-trash"></i></a>
                                       </td>
                                    </tr>
                                    @endforeach
                                 </tbody>
                              </table>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- items Modal1 -->
               <div class="modal fade" id="delprd" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog">
                  <div class="modal-content">
                        <div class="modal-header modal-header-primary">
                           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                           <h3><i class="fa fa-trash"></i> Delete Product</h3>
                        </div>
                        <div class="modal-body">
                           <div class="row">
                              <div class="col-md-12">
                         Are you sure you want to delete this item?
                              </div>
                           </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="delprdbtn btn btn-danger pull-left" >yes</button>
                           <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        </div>
                     </div>
                     <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
               </div>
               <!-- /.modal -->
              <!-- Modal -->
             
                 
      @endsection


@section('script')
<script>
$(document).ready(function(){
   $('.prddel').click(function(){
 var delid = $(this).attr('id');     // alert(delid);
 $('.delprdbtn').click(function(){
   $(".prd" + delid).remove();
   $.get("{{route('delprd')}}", {id:delid}, function(data){
     //alert(data);
  });
 });
   
});


});
</script>
@endsection