@extends('layouts.index')
@section('title')
          Category
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
#display, a, span{
   box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
}

</style>
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
                                 <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#additem"><i class="fa fa-plus"></i> Add Items</a>
                           <div style ="margin-top:2%"class="table-responsive">
                              <table id="dataTableExample1" class="table table-bordered table-striped table-hover">
                                 <thead>
                                    <tr  class="info">
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
                                       <td><img  height="80" width="100" src="{{$row->image}}" alt="..."></td>
                                       <td>{{$row->CatName}}</td>
                                       <td>{{$row->CategoryType}}</td>
                                       <td>  @foreach($row->subcategory as $subcat)
                                       - {{$subcat->SubCatType}} <br>
                                       @endforeach</td>
                                       <td>{{$row->created_at}}</td>
                                       <td>{{$row->updated_at}}</td>
                                       <td><span class="label-success label label-default" >Active</span>
                                       </td>
                                       <td><a href="#" class="btn-sm btn-warning" ><i class="fa fa-edit"></i></a>
                                       <a href="#delitem" id='{{$row->CategoryID}}' data-toggle="modal" data-target="#delitem"class="del btn-sm btn-danger" ><i class="fa fa-trash"></i></a>
                                       </td>
                                    </tr>
                                   
                                    @endforeach
                                 </tbody>
                              </table> 
                             
                               {{$data[$max-1]->subcategory->links()}}
                              
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
                        <p style="color:#FFBD00;font-weight:bold;align-text:center">To add data of specific item, you must select form type</p>
                        <div class="col-md-4">
                                          <label class="control-label">Form Type</label>
                                          <select placeholder="Item type" id="formtype"class="form-control">
                                          <option value="1">Category</option>
                                          <option value="2">Subcategory</option>
                                          <option value="3">Product</option>
                                          </select>
                                       </div>
                           <div class="row">
                              <div class="col-md-12">
                                 <form id="itemform"action="{{route('additem')}}"style="margin-left:3%;margin-top:2%"class="form-horizontal" method="post" enctype="multipart/form-data" >
                                 @csrf
                                 <fieldset id="addcat">
                                       <!-- Text input-->
                                      
                                      <p style="color:blue;font-weight:bold">Enter data to add category...</p>
                                       <!-- Text input-->
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Name</label>
                                          <input type="text" placeholder="Enter category name" id='catname'name="catname" class="form-control">
                                       </div>
                                       <!-- Text input-->
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Type</label>
                                          <input type="text" placeholder="Enter category type"name="cattype" class="form-control">
                                       </div>
                                       <div class="col-md-12 form-group">
                                          <label class="control-label">Image</label><br>
                                          <input type="file" id="imgcat"name="imgcat" value="http://waar.ae/waar/img/embroidery2.jpg" >
                                       </div>
                                       <div class="col-md-12 form-group user-form-group">
                                          <div class="pull-right">
                                             <button type="button" class=" btn btn-danger btn-sm"  data-dismiss="modal">Cancel</button>
                                             <button type="submit" class="addcatbtn btn btn-add btn-sm">Save</button>
                                          </div>
                                       </div>
                                    </fieldset>


                                    <fieldset id="addsubcat">
                                    <p style="color:blue;font-weight:bold">Enter data to add subcategory...</p>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Select Category</label>
                                       <select name="catid" id="category" type="text" placeholder="Item Name" class="form-control">
                                       @foreach($data as $row)
                                       <option value="{{$row->CategoryID}}">{{$row->CategoryType}}</option>
                                       @endforeach
                                       </select>
                                       </div>
                                       <!-- Text input-->
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Type</label>
                                          <input type="text" placeholder="Enter Subcategory type" id="subcattype" name="subcattype" class="form-control">
                                       </div>
                                       <div class="col-md-12 form-group user-form-group">
                                          <div class="pull-right">
                                             <button type="button" class="btn btn-danger btn-sm"  data-dismiss="modal">Cancel</button>
                                             <button type="submit" class="btn btn-add btn-sm">Save</button>
                                          </div>
                                       </div>
                                    </fieldset>


                                    <fieldset id="addprd">
                                    <p style="color:blue;font-weight:bold">Enter data to add product...</p>
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Select Subcategory</label>
                                       <select name="subcategory" id="subcategory" type="text" placeholder="Item Name" class="form-control">
                                       <option value="0" disabled="true" selected="true">Select</option>
                                       @foreach($data as $row)
                                       <option disabled="true" style="font-weight:bold; color:blue">{{$row->CategoryType}}</option>
                                       @foreach($row->subcategory as $subcat)
                                       <option value="{{$subcat->SubCatID}}"> - {{$subcat->SubCatType}}</option>
                                       @endforeach
                                       @endforeach
                                       </select>
                                       </div>
                                       <!-- Text input-->
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
                                          <input type="hidden" name="colorarray" id="colorarray">
                                       </div>
                                     
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Price</label>
                                          <input type="number" placeholder="Enter price" name="price"class="form-control">
                                       </div>
                                       <div class="col-md-12 form-group">
                                          <label class="control-label">Description</label><br>
                                          <input type="text" class="form-control" name="desc" >
                                       </div>
                                       <div class="col-md-12 form-group">
                                          <label class="control-label">Image</label><br>
                                          <input type="file" id="imgprd"name="imgprd" value="http://waar.ae/waar/img/embroidery2.jpge" >
                                       </div>
                                       <div class="col-md-12 form-group user-form-group">
                                          <div class="pull-right">
                                             <button type="button" class="btn btn-danger btn-sm"  data-dismiss="modal">Cancel</button>
                                             <button type="submit" class="btn btn-add btn-sm">Save</button>
                                          </div>
                                       </div>
                                    </fieldset>
                                 </form>
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
   var color = [];
 $('#show').click(function(){
 var newcolor = $('#color').val();
 color.push(newcolor);
 $('#colorarray').val(color);
 $('#colorinput').append(
 '<div id="display" style="float:left;margin:2% 2% 2% 2%;background-color:'+newcolor+';height:20px;width:20px;border-radius:50px"></div>'
 );
console.log($('#colorarray').val());

 });

 $('#minus').click(function(){
 color.pop();
 $('#colorarray').val(color);
 $('#display').remove();
console.log($('#colorarray').val());

 });

$('.del').click(function(){
 var delid = $(this).attr('id');
 $('.delbtn').click(function(){
   $(".item" + delid).remove();
   $.get("{{route('delcat')}}", {id:delid}, function(data){
     
  });
 });
   
});

//form switch
$("#addsubcat").hide();
   $("#addprd").hide();
$("#formtype").on('change',function(){
var form = $("#formtype").val();
if(form == 1)
{
   $("#addcat").show();
   $("#addsubcat").hide();
   $("#addprd").hide();
}
else if(form == 2)
{
   $("#addsubcat").show();
   $("#addcat").hide();
   $("#addprd").hide();
}
else if(form == 3)
{
   $("#addprd").show();
   $("#addsubcat").hide();
   $("#addcat").hide();
} 
});

  $('#itemform').on('submit', function(event){
     if($('#subcattype').val() != null){
       $('#catname').empty();
       $('#prdname').empty();
     }
     if($('#catname').val() != null){
       $('#subcattype').empty();
       $('#prdname').empty();
     }
     if($('#prdname').val() != null){
       $('#subcattype').empty();
       $('#catname').empty();
     }
  event.preventDefault(); 
   $.ajax({
    url:"{{ route('additem') }}",
    method:"POST",
    data: new FormData(this),
    contentType: false,
    cache:false,
    processData: false,
    dataType:"json",
    success:function(data)
    { alert('success');
    }
   });});


   

});
</script>
@endsection