@extends('layouts.index')
@section('title')
          Category
@endsection

@section('content')
<div class="row">
                  <div class="col-sm-12">
                     <div class="panel panel-bd lobidrag">
                        <div class="panel-heading">
                           <div class="btn-group" id="buttonexport">
                              <a href="#">
                                 <h4>Category details</h4>
                              </a>
                           </div>
                        </div>
                        <div class="panel-body">
                           <div class="btn-group">
                              <div class="buttonexport"> 
                                 <a href="#" class="btn btn-add" data-toggle="modal" data-target="#additem"><i class="fa fa-plus"></i> Add Items</a>  
                              </div>
                              <button class="btn btn-exp btn-sm dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bars"></i> Export Table Data</button>
                              <ul class="dropdown-menu exp-drop" role="menu">
                                 <li>
                                    <a href="#" onclick="$('#dataTableExample1').tableExport({type:'pdf',pdfFontSize:'7',escape:'false'});"> 
                                    <img src="assets/dist/img/pdf.png" width="24" alt="logo"> PDF</a>
                                 </li>
                              </ul>
                           </div>
                           <!-- ./Plugin content:powerpoint,txt,pdf,png,word,xl -->
                           <div class="table-responsive">
                              <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                                 <thead>
                                    <tr class="info">
                                       <th>Image</th>
                                       <th>Name</th>
                                       <th>Type</th>
                                       <th>Subcategory</th>
                                       <th>Added</th>
                                       <th>last update</th>
                                       <th>status</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                 @foreach($data as $row)
                                    <tr class='item{{$row->CategoryID}}'>
                                       <td><img height="80" width="100" src="{{$row->image}}" alt="..."></td>
                                       <td>{{$row->CatName}}</td>
                                       <td>{{$row->CategoryType}}</td>
                                       <td>  @foreach($row->subcategory as $subcat)
                                       {{$subcat->SubCatType}} <br>
                                       @endforeach</td>
                                       <td>{{$row->created_at}}</td>
                                       <td>{{$row->updated_at}}</td>
                                       <td><span class="label-success label label-default" >Available</span>
                                       </td>
                                       <td><a href="#" class="btn-sm btn-warning" >update</a>
                                       <a href="#delitem" id='{{$row->CategoryID}}' data-toggle="modal" data-target="#delitem"class="del btn-sm btn-danger" >delete</a>
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
                           <div class="row">
                              <div class="col-md-12">
                                 <form class="form-horizontal">
                                    <fieldset>
                                       <!-- Text input-->
                                       <div class="col-md-4 form-group">
                                          <label class="control-label">Item Code</label>
                                          <input type="text" placeholder="Item Code" class="form-control">
                                       </div>
                                       <!-- Text input-->
                                       <div class="col-md-4 form-group">
                                          <label class="control-label">Item Name</label>
                                          <input type="text" placeholder="Item Name" class="form-control">
                                       </div>
                                       <!-- Text input-->
                                       <div class="col-md-4 form-group">
                                          <label class="control-label">Quantity</label>
                                          <input type="number" placeholder="Quantity" class="form-control">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Unit price</label>
                                          <input type="number" placeholder="Unit price" class="form-control">
                                       </div>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Discount</label>
                                          <input type="number" placeholder="Discount" class="form-control">
                                       </div>
                                       <div class="col-md-12 form-group">
                                          <label class="control-label">Description</label><br>
                                          <textarea name="Description" rows="3">
                                          </textarea>
                                       </div>
                                       <div class="col-md-12 form-group user-form-group">
                                          <div class="pull-right">
                                             <button type="button" class="btn btn-danger btn-sm">Cancel</button>
                                             <button type="submit" class="btn btn-add btn-sm">Save</button>
                                          </div>
                                       </div>
                                    </fieldset>
                                 </form>
                              </div>
                           </div>
                        </div>
                        <div class="modal-footer">
                           <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Close</button>
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

$('.del').click(function(){
 var delid = $(this).attr('id');
 $('.delbtn').click(function(){
   $.get("{{route('delcat')}}", {id:delid}, function(data){
    alert(data);
    $(".item"+delid).remove();
  });
 });
   
});

});

</script>
@endsection