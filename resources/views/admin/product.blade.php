@extends('layouts.index')
@section('title')
          Product
@endsection

@section('content')
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
                              <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                                 <thead>
                                    <tr class="info">
                                       <th>Image</th>
                                       <th>Name</th>
                                       <th>Price</th>
                                       <th>Subcategory</th>
                                       <th>Color</th>
                                       <th>size</th>
                                       <th>yard</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                 @foreach($data as $row)
                                    <tr class='item{{$row->ProductID}}'>
                                       <td><img height="100" width="100" src="{{$row->Image}}" alt="..."></td>
                                       <td>{{$row->ProductName}}</td>
                                       <td>{{$row->ProductPrice}}</td>
                                       <td>
                                       {{$row->subcategory['SubCatType']}} <br>
                                       </td>
                                       <td>
                                       @foreach($row->color as $i)
                                      <h1 style="float:left;margin:2% 2% 2% 2%;background-color:{{$i->Color}};height:20px;width:20px;border-radius:50px"></h1>
                                       @endforeach
                                       </td>
                                       <td>
                                       @foreach($row->size as $i)
                                       - {{$i->Size}} <br>
                                       @endforeach
                                       </td>
                                       <td>
                                      
                                      
                                       </td>
                                       <td>
                                      <a href="#" class="btn-sm btn-warning" ><i class="fa fa-edit"></i></a>
                                       <a href="#delitem" id='{{$row->CategoryID}}' data-toggle="modal" data-target="#delitem"class="del btn-sm btn-danger" ><i class="fa fa-trash"></i></a>
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
               <div class="modal fade" id="additem" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog">
                     <div class="modal-content">
                        <div class="modal-header modal-header-primary">
                           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                           <h3><i class="fa fa-plus m-r-5"></i> Add new Item</h3>
                        </div>
                        <div class="modal-body">
                        <div class="col-md-4">
                  
                           <div class="row">
                              <div class="col-md-12">
                     
                              </div>
                           </div>
                        </div>
                     </div>
                     <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
               </div>
               <!-- /.modal -->
               <!-- delete Modal -->   
                  <div class="modal fade" id="delitem" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog">
                     <div class="modal-content">
                        <div class="modal-header modal-header-primary">
                           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                           <h3><i class="fa fa-trash"></i> Delete Item</h3>
                        </div>
                        <div class="modal-body">
                           <div class="row">
                              <div class="col-md-12">
                         Are you sure you want to delete this item?
                              </div>
                           </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="delbtn btn btn-danger pull-left" >yes</button>
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

});
</script>
@endsection