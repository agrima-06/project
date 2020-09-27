@extends('layouts.theme')

@section('title')
Home
@endsection

@section('css')
.options {cursor: pointer;}
@endsection


@section('body')

@include('partials.practiceQuestion.questionView')

@endsection


@section('script')
<script type="text/javascript">

    $(".collapse").on('show.bs.collapse', function(){
    //alert('The collapsible content is about to be shown.');
    $(".collapse").collapse('hide');

  });

    function checkAnswer(id){
      //var className = this.id;
        

        if (id.includes("wrong")) {
                   // console.log('#'+id);

           $('#'+id).html('&#10006;');
        } 
        else{
         // console.log('#'+id);

          //console.log('right');
          //console.log(#id);

          $('#'+id).html('&#10004;');
         // $('#Explanation7').show();
        }     
     // $(.correct).html
      //$(.wrong).html
      //$('#id').css('display', '');
    }
</script>
@endsection
  @include('partials.ajax.ajaxSubject')