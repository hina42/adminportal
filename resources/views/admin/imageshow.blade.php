<html>
<body>
<style>

#cards{
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
}

.img:hover{
border:3px solid 	#DC143C;
}

</style>
@foreach($media as $row)
    <div style="float:left;">
    <div id="cards"  style="border:1px solid #A9A9A9;border-radius:6px;margin-left:30px;width:170px;height:160px;display:flex;align-items:center;justify-content:center;">
    <div class="hah123" id="non_{{$row->id}}" style="display:none">1</div>
    <a>
    <img class="img123 img" name="1" id='{{$row->id}}' src="{{$row->thumbnail}}" alt="..." />
    </a>

    </div>
    <div class="btn-primary"  onclick= "window.location='{{route('detail')}}?id={{$row->id}}'"style="margin-left:30px;width:170px;height:25px;margin-bottom:20px;border-radius:6px;">
    <center>
    <a style="margin-top:5px;color:black;">Details</a>
    </center>
    </div>
    </div>
@endforeach
<script>



function go(){
   @foreach($media as $row)
   document.getElementById('non_'+{{$row->id}}).innerHTML=2;
   @endforeach  
   $('.img123').css('border','3px solid #DC143C');
   
}

function deletes(){
   @foreach($media as $row)
   k={{$row->id}};
   l=document.getElementById('non_'+k).innerHTML;
   if(l==2){
      $.ajax({
     type: "POST",
     data: {"_token": $('meta[name="csrf-token"]').attr('content'),
     id:k,
     },
     url: "{{route('delete')}}",
     success: function(msg){
     }
     });
   }
   @endforeach  
   
   $("#item").fadeOut();
var loadname="{{route('imageshow')}}";

setTimeout(function(){
      $('#item').load(loadname).fadeIn();
}, 500);
}

function dont(){
   @foreach($media as $row)
   document.getElementById('non_'+{{$row->id}}).innerHTML=1;
   @endforeach  
   $('.img123').css('border','none');
}

$(document).ready(function(){
  $('.img123').click(function(){
   k=$(this).attr('id');
   j=document.getElementById('non_'+k).innerHTML;
   if(j==1){
   $('#'+k).css('border','3px solid #DC143C');
   document.getElementById('non_'+k).innerHTML=2;
   }
   else{
   $('#'+k).css('border','none');
   document.getElementById('non_'+k).innerHTML=1;   
   }
});
});


</script>
</body>

</html>