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
#display, span, .btn-sm, #show, #minus{
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

                        <form style="margin-top:2%" class="row"action="">
                        <div class=" col-md-4 form-group">
                           <input type="text"  placeholder="search..." name="searchcat" id="searchcat" class="form-control">
                        </div>
                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                        </form>
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
                                 @if(!$data==null)
                                 @foreach($data as $row)
                                    <tr class='item{{$row->CategoryID}}'>
                                       <td><img class="img{{$row->CategoryID}}" height="80" width="100" src="{{$row->image}}" alt="..."></td>
                                       <td class="name{{$row->CategoryID}}">{{$row->CatName}}</td>
                                       <td class="type{{$row->CategoryID}}">{{$row->CategoryType}}</td>
                                       <td>  @foreach($row->subcategory as $subcat)
                                       - {{$subcat->SubCatType}} <br>
                                       @endforeach</td>
                                       <td>{{$row->created_at}}</td>
                                       <td>{{$row->updated_at}}</td>
                                       <td><span class="label-success label label-default" >Active</span>
                                       </td>
                                       <td><a href="#updatecat" id='{{$row->CategoryID}}' data-toggle="modal" data-target="#updatecat"class="updatecat btn-sm btn-warning" ><i class="fa fa-edit"></i></a>
                                       <!-- <a href="#delitem" id='{{$row->CategoryID}}'data-toggle="modal" data-target="#delitem"class="del btn-sm btn-danger" ><i class="fa fa-trash"></i></a> -->
                                       </td>
                                    </tr>
                                   
                                    @endforeach

                                 </tbody>
                              </table> 
                             
                               {{$data[$max-1]->subcategory->links()}}
                               @endif
                              @if($data==null)
                              No data available
                              @endif
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
                        <p style="color:#ffa200;font-weight:bold;align-text:center">To add data of specific item, you must select form type</p>
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
                                       <label class="control-label">Select category</label>
                                          <input type="text" list="findcat" placeholder="search category..." name="searchcat" id="searchcat" class="form-control">
                                          <datalist id="findcat">
                                   
                                          </datalist>
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
                                     <!-- Text input-->
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
                                          <small> click the added color to remove it</small>
                                       </div>
                                       <div id="sizeinput"class="col-md-6 form-group">
                                          <label class="control-label">Size</label>
                                          <input id="size" type="text" name="size" placeholder="Enter size" class="form-control">
                                          <div  style="margin:2% 2% 2% 2%;"id="sizeshow" class=" btn btn-sm btn-warning"><i class="fa fa-plus"></i></div>
                                          <div  style="margin:2% 2% 2% 2%;"id="sizeminus" class=" btn btn-sm btn-danger"><i class="fa fa-minus"></i></div>
                                         <div id="insertsize"></div>
                                          <input type="hidden" name="sizearray" id="sizearray">
                                          <small> click the added size to remove it</small>
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


               <div class="modal fade" id="updatecat" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog">
                     <div class="modal-content">
                        <div class="modal-header modal-header-primary">
                           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                           <h3><i class="fa fa-edit"></i> Upadate category</h3>
                        </div>
                        <div class="modal-body">
                           <div class="row">
                              <div class="col-md-12">
                              <div class="col-md-6 form-group">
                              <form id='updatecatform' action="{{route('updatecat')}}" method="post" enctype="multipart/form-data">
                                @csrf  
                                          <label class="control-label">Name</label>
                                          <input type="hidden" id="updatecatid" name="updatecatid" >
                                          <input type="text" id="editcatname" value="" id='updatecatname'name="CatName" class="form-control">
                                       </div>
                                       <!-- Text input-->
                                       <div class="col-md-6 form-group">
                                          <label class="control-label">Type</label>
                                          <input type="text" value="" id="editcattype"name="CategoryType" class="form-control">
                                       </div>
                                       <div class="col-md-12 form-group">
                                          <label class="control-label">Image</label><br>
                                          <input type="file" id="editcatimg"  name="updatecatimg"  >
                                          <img style="margin:2% 2% 2% 2%;"id="displaycatimg" src="" height="100px" width="100px" alt="">
                                       </div>
                                       <button type="submit" class="updatecatbtn btn btn-danger pull-left" >Save changes</button>
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
   function removeElement(array, elem) {
    var index = array.indexOf(elem);
    if (index > -1) {
        array.splice(index, 1);
    }
}
   var color = [];
   //addcolor
 $('#show').click(function(){
 var newcolor = $('#color').val();
 color.push(newcolor);
 $('#colorarray').val(color);
 $('#insertcolor').append(
 '<div class="color btn-sm" value="'+newcolor+'" id="display" style="float:left;margin:2% 2% 2% 2%;background-color:'+newcolor+';height:20px;width:20px;border-radius:50px"></div>'
 );
 $('.color').click(function(){
   removeElement(color,$(this).attr('value'));
   console.log(color);
   $(this).remove();
 });
console.log($('#colorarray').val());

 });

//add size
var size = [];
 $('#sizeshow').click(function(){
 var newsize = $('#size').val(); 
 size.push(newsize);
 $('#sizearray').val(size);
 $('#insertsize').append(
 '<div class="size btn" id="'+size+'" style="font-weight:bold;float:left;height:20px;width:100px;border-radius:20px">'+newsize+'</div>'
 );

 $('.size').click(function(){
   removeElement(size,$(this).html());
   console.log(size);
   $(this).remove();
 });
console.log($('#sizearray').val());

 });

//remove color
 $('#minus').click(function(){
 color = [];
 $('#colorarray').val(color);
 $('#insertcolor').empty();
console.log($('#colorarray').val());

 });
//remove size
 $('#sizeminus').click(function(){
 size = [];
 $('#sizearray').val(size);
 $('#insertsize').empty();
console.log($('#sizearray').val());

 });
//delete category and its subcategories
// $('.del').click(function(){
//  var delid = $(this).attr('id');
//  $('.delbtn').click(function(){
//    $(".item" + delid).remove();
//    $.get("{{route('delcat')}}", {id:delid}, function(data){
     
//   });
//  });
   
// });

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


$('#searchsubcat').keyup(function(){
  
   var name = $('#searchsubcat').val();
$.post('searchsubcat',{name : name,  "_token": "{{ csrf_token() }}",},function(data){
$('#find').html(data);
 });

});
//search subcategory

  var name = $('#searchsubcat').val();
$.post('searchsubcat',{name : name,  "_token": "{{ csrf_token() }}",},function(data){
$('#find').html(data);
});


//search category
$('#searchcat').keyup(function(){
  
  var name = $('#searchcat').val();
$.post('searchcat',{name : name,  "_token": "{{ csrf_token() }}",},function(data){
$('#findcat').html(data);
});

});


 
 var name = $('#searchcat').val();
$.post('searchcat',{name : name,  "_token": "{{ csrf_token() }}",},function(data){
$('#findcat').html(data);
});

//update category
$('.updatecat').click(function(){
 var catid = $(this).attr('id');

   $.get("{{route('fetchcat')}}", {id:catid}, function(data){
//alert(data.image);
var img = data.image;
$('#updatecatid').val(catid);
$('#editcattype').attr('placeholder',data.CategoryType);
$('#editcatname').attr('placeholder',data.CatName);
//$('#editcatimg').val(img);
$('#displaycatimg').attr('src',img);
 });
   
});

$('.updatecatbtn').click(function(){
   $('#updatecatform').on('submit', function(event){
  event.preventDefault();
  $.ajax({
    url:"{{ route('updatecat') }}",
    method:"POST",
    data: $('form').serialize(),
    dataType:"json",
    success:function(data)
    { 
    $('.name'+data.CategoryID).html(data.CatName);
    $('.type'+data.CategoryID).html(data.CategoryType);
    $('.img'+data.CategoryID).attr('src',data.image);
   
    }
   });});
});


});
</script>
@endsection