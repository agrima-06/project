 @extends('layouts.theme')

@section('title')
Edit
@endsection

@section('body')

<h1>Practice Questions related to the Search Word.</h1>

      @include('partials.practiceQuestion.questionView')


<hr>
<h1>HomeWork carrying your Searched word</h1>
{{$homeworks}}
<hr>
<h1>Questions Related to Similar Topic:-</h1>
{{$topics}}

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