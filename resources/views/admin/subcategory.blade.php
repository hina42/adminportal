@extends('layouts.index')
@section('title')
          Subcategory
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
                                       
                                       <th>Type</th>
                                       <th>Category</th>
                                       <th>Action</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                 @foreach($data as $row)
                                    <tr class='subcat{{$row->SubCatID}}'>
                                       <td>{{$row->SubCatType}}</td>
                                       <td>{{$row->category['CategoryType']}}</td>
                                       <td>
                                      <a href="#" class="btn-sm btn-warning" ><i class="fa fa-edit"></i></a>
                                       <a href="#delsubcat" id='{{$row->SubCatID}}' data-toggle="modal" data-target="#delsubcat"class="subcatdel btn-sm btn-danger" ><i class="fa fa-trash"></i></a>
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
               <div class="modal fade" id="delsubcat" tabindex="-1" role="dialog" aria-hidden="true">
                  <div class="modal-dialog">
                  <div class="modal-content">
                        <div class="modal-header modal-header-primary">
                           <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                           <h3><i class="fa fa-trash"></i> Delete Subcategory</h3>
                        </div>
                        <div class="modal-body">
                           <div class="row">
                              <div class="col-md-12">
                         Are you sure you want to delete this subcategory?
                              </div>
                           </div>
                        </div>
                        <div class="modal-footer">
                        <button type="button" class="delsubcatbtn btn btn-danger pull-left" >yes</button>
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
   $('.subcatdel').click(function(){
 var delid = $(this).attr('id');    //  alert(delid);
 $('.delsubcatbtn').click(function(){
   $(".subcat" + delid).remove();
   $.get("{{route('delsubcat')}}", {id:delid}, function(data){
     alert(data);
 });
 });
   
});


});
</script>
@endsection