@section('script')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script language="JavaScript">
  function getSubject(val) {
    $.ajax({
      url: "{{route('ajax.subject')}}",
      method: 'POST',
      data:{
        class_id: val,
        _token: $('input[name=_token]').val()
      },
      beforeSend: function() {
        $("#subject").addClass("loader");
      },
      success: function(data){
        loop(data.data);
        $("#subject").removeClass("loader");
      }
    });
  }

  function loop(data){
      
      var options = '<option> Select a Subject </option>';
      for(var i = 0; i < data.length; i++) {
      var obj = data[i];
      options = options + '<option value='+obj.id+'>'+obj.name+'</option>';        
      }
      $("#subject").html(options);
  }

</script>
 
@endsection