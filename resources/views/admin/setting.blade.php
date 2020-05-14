@extends('layouts.index')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/dropzone.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<meta name="csrf-token" content="{!! csrf_token() !!}">
   
@section('title')
          Media
@endsection

@section('content')

<div class="row">
<div class="col-sm-12">
   <div class="panel panel-bd lobidrag">
      <div class="panel-heading">
         <div class="panel-title">
            <h4>Image Setting</h4>
            </div>
         </div>
         <div class="panel-body">
         <div style="margin-left:10px">
         <a style="font-weight:bold;font-size:15px;color:black;margin-top:20px;">THUMBNAIL SETTING : </a>
         </div>
         <hr>

         <div style="margin-left:100px;display:flex;">
         <a style="margin-right:7px;color:red">Thumbnail Width:</a>
         <input style="width:200px;height:20px;" id="thumbwid" value="{{$set->thumb_width}}"></input>
         </div>

         <div style="margin-left:100px;margin-top:30px;display:flex;margin-bottom:30px">
         <a style="margin-right:7px;color:red;">Thumbnail Height:</a>
         <input style="width:200px;height:20px;" id="thumbheight" value="{{$set->thumb_height}}"></input>
         </div>
     
         <div style="margin-left:10px">
         <a style="font-weight:bold;font-size:15px;color:black;margin-top:30px;">MEDIUM SETTING : </a>
         </div>
         <hr>

         <div style="margin-left:100px;display:flex;">
         <a style="margin-right:7px;color:red">Medium Width:</a>
         <input style="width:200px;height:20px;" id="medwidth" value="{{$set->med_width}}"></input>
         </div>

         <div style="margin-left:100px;margin-top:30px;display:flex;margin-bottom:30px">
         <a style="margin-right:7px;color:red;">Medium Height:</a>
         <input style="width:200px;height:20px;" id="medheight" value="{{$set->med_height}}"></input>
         </div>
     
         <div style="margin-left:10px">
         <a style="font-weight:bold;font-size:15px;color:black;margin-top:30px;">ICON SETTING : </a>
         </div>
         <hr>

         <div style="margin-left:100px;display:flex;">
         <a style="margin-right:7px;color:red">Icon Width:</a>
         <input style="width:200px;height:20px;" id="iconwid" value="{{$set->icon_width}}"></input>
         </div>

         <div style="margin-left:100px;margin-top:30px;display:flex;;margin-bottom:30px">
         <a style="margin-right:7px;color:red;">Icon Height:</a>
         <input style="width:200px;height:20px;" id="iconheight" value="{{$set->icon_height}}"></input>
         </div>
         <div style="display:flex;justify-content:flex-end;">     
         <button  id="sendsizes" class="btn-sm btn-success"style="width:140px;">SAVE</button>
         </div>      
         </div>   
        
    </div>
   </div>
</div>
</div>

@endsection



@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/dropzone.js"></script>
<script>
$(document).ready(function(){
  $('#sendsizes').click(function(){
   $.ajax({
     type: "POST",
     data: {"_token": $('meta[name="csrf-token"]').attr('content'),
     'thumb_width': document.getElementById('thumbwid').value,
     'thumb_height': document.getElementById('thumbheight').value,
     'med_width': document.getElementById('medwidth').value,
     'med_height': document.getElementById('medheight').value,
     'icon_width': document.getElementById('iconwid').value,
     'icon_height': document.getElementById('iconheight').value,
     },
     url: "{{route('settingchanges')}}",
     success: function(msg){
     }
   });
  });
});
</script>
@endsection