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
            <h4>Actual Image ( {{$width}} X {{$height}} )</h4>
            </div>
         </div>
         <div class="panel-body">
         <div style="margin-bottom:4px;">
         <center>
         <img  src="{{$media->image}}" alt="..." />    
         </center>
         </div>
         <div style="display:flex;margin-left:330px;margin-top:5px">
         <a style="font-size:17px;margin-top:4px;color:red;font-weight:bold;margin-right:2px;">Path : </a>
         <input type="text" value="{{$media->image}}" style="margin-top:3px;width:400px;height:27px;"/>
         </div>
         </div>   
      </div>
   </div>
</div>
</div>
@endsection



@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.7.0/dropzone.js"></script>

@endsection