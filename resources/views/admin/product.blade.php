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
#color, .btn-sm{
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
                                      <a href="#updateprd" id='{{$row->ProductID}}' data-toggle="modal" data-target="#updateprd"class="updateprd btn-sm btn-warning" ><i class="fa fa-edit"></i></a>
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
             
              <div class="modal fade" id="updateprd" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog">
                     <div class="modal-content">
                        <div class="modal-header modal-header-primary">
                           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                           <h3><i class="fa fa-edit"></i> Update product</h3>
                        </div>
                        <div class="modal-body">
                           <div class="row">
                              <div class="col-md-12">
                              
                              <form id='updateprdform' action="{{route('updateprd')}}" method="post" enctype="multipart/form-data">
                                @csrf  
                               
                                <div class="col-md-6 form-group">
                                          <label class="control-label">Subcategory</label>
                                          <input type="text" list="find" placeholder="search subcategory..." name="searchsubcat" id="searchsubcat" class="form-control">
                                          <datalist id="find">
                                   
                                          </datalist>
                                         
                                     </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Product Name</label>
                                          <input type="text" name="prdname"placeholder="Enter product name" class="form-control">
                                       </div>
                                       <!-- Text input-->
                                      
                                       <div id="colorinput"class="col-md-6 form-group">
                                          <label class="control-label">color</label>
                                          <input id="color"type="color"name="color" placeholder="Enter color" class="form-control">
                                          <div  style="margin:2% 2% 2% 2%;"id="show" class=" btn btn-sm btn-warning"><i class="fa fa-plus"></i></div>
                                          <div  style="margin:2% 2% 2% 2%;"id="minus" class=" btn btn-sm btn-danger"><i class="fa fa-minus"></i></div>
                                          <div id="insertcolor"></div>
                                          <input type="hidden" name="colorarray" id="colorarray">
                                       </div>
                                       <div id="sizeinput"class="col-md-6 form-group">
                                          <label class="control-label">Size</label>
                                          <input id="size" type="text" name="size" placeholder="Enter size" class="form-control">
                                          <div  style="margin:2% 2% 2% 2%;"id="sizeshow" class=" btn btn-sm btn-warning"><i class="fa fa-plus"></i></div>
                                          <div  style="margin:2% 2% 2% 2%;"id="sizeminus" class=" btn btn-sm btn-danger"><i class="fa fa-minus"></i></div>
                                         <div id="insertsize"></div>
                                          <input type="hidden" name="sizearray" id="sizearray">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Price</label>
                                          <input type="number" placeholder="Enter price" name="price"class="form-control">
                                       </div>
                                       <div class="col-md-3  form-group">
                                          <label class="control-label">Yard min</label>
                                        <input type="number"  placeholder="Minimum" name="min"class="form-control">
                                   
                                       </div>
                                       <div class="col-md-3  form-group">
                                          <label class="control-label">Yard max</label>
                                          <input type="number"  placeholder="Maximum" name="max"class="form-control ">
                                   
                                       </div>
                                       <div class="col-md-12 form-group">
                                          <label class="control-label">Description</label><br>
                                          <input type="text" class="form-control" name="desc" >
                                       </div>
                                       <div class="col-md-12 form-group">
                                          <label class="control-label">Image</label><br>
                                          <input type="file" id="updateprdimg"name="updateprdimg" >
                                          <img style="margin:2% 2% 2% 2%;"id="displayprdimg" src="" height="100px" width="100px" alt="">
                                       </div>
                                       <button type="submit" class="updateprdbtn btn btn-danger pull-left" >Save changes</button>
                        </form>
                              </div>
                           </div>
                        </div>
                        <div class="modal-footer">
                       
                           <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                        </div>
                     </div>
                     <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
               </div>         
      @endsection


@section('script')
<script>
$(document).ready(function(){
   $('.prddel').click(function(){
 var delid = $(this).attr('id');     // alert(delid);
 $('.delprdbtn').click(function(){
   $(".prd" + delid).remove();
   $.get("{{route('delprd')}}", {id:delid}, function(data){
  //   alert(data);
  });
 });
   
});


});
</script>
@endsection