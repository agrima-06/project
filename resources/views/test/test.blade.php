
@extends('layouts.theme2')

@section('title')
Home Admin 
@endsection

@section('content')

THIS PAGE IS NOT YET USED ANYWHERE.
  <!--Student Content Row -->
  <div class="row">
    <button class="btn btn-primary click"  onclick="queSelected(14)">Click</button>  
    <button class="btn btn-primary click"  onclick="queSelected(15)">Click</button>
    <button class="btn btn-primary click"  onclick="queSelected(16)">Click</button>  
    <button class="btn btn-primary click"  onclick="queSelected(17)">Click</button>  
    <button class="btn btn-primary click"  onclick="queSelected(22)">Click</button>  

  </div>
  <div class="row">
    <form action="{{route('objectivetest.update', $sessionKey)}}" method="post">
      @method('put')
      @csrf
      <input id="myInput" type="text" name="practice" value="">
      <button type="submit" class="btn btn-primary click">SUBMIT</button>  
    </form>
  
  </div>



@if(Session::has($sessionKey))
<div class="alert alert-danger">
  {{Session::get($sessionKey)}}
</div>
@endif

						
@endsection 

@section('script')
<script type="text/javascript">


@if(Session::has($sessionKey))
  window.questions = {{Session::get($sessionKey)}}
@else{
  window.questions = [];
}
@endif



function queSelected(id){
  console.log('clicked');
//  var a = this.val();
$('.btn').html('Clicked');

if(!questions.includes(id)){
  questions.push(id);
}
  $('#myInput').val('['+questions+']');

//var a = $('.btn').val();
 console.log(questions);
 // $(this).css('display', 'none');
  // var a = $(this).val();
  // console.log(a);
}

  $("p").click(function(){
    $(this).hide();
  });

</script>
@endsection

