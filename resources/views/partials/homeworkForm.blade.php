@if(Auth::user()->role=="student")

<p>I dont know I am student</p>

@elseif((Auth::user()->role=="teacher"))
<div style="background-color: #fff; color: black">
{{isset($edit)? "Edit Homework" : "Create Homework"}}
</div>

<form class="border"  method="post" enctype="multipart/form-data" action= "{{isset($edit) ? route('homework.update', $homework->id) : route('homework.store')}}" style="background-color: #fff" >

  @csrf
  
  @if(isset($edit)) 
  @method('PUT')
  @endif
  <div class="form-row">
    <div class="form-group col-md-4">
      <span class="badge badge-light" style="font-size: 15px">topic</span>
      <input type="text" class="form-control" id="topic" placeholder="Homework Topic" name="topic" value="{{isset($edit)?$homework->topic: ''}}">
    </div>
   <!-- Use Ajax for selecting subject and class   -->
    <div class="form-group col-md-4">
      <span class="badge badge-light" style="font-size: 15px">Select Class:</span>
        <select class="form-control" id="sel2" name="class" onChange="getSubject(this.value);">
          <option>Select Class</option>
            @foreach(Auth::user()->teacher->sclasses as $sclass)
             <option value="{{$sclass->id}}"
               @if(isset($edit))
                  @if($sclass->id == $homework->sclass_id)
                    selected
                  @endif
                @endif
              > 
                {{$sclass->class}}{{$sclass->section}}
              </option>
            @endforeach
        </select>
    </div>

        <div class="form-group col-md-4">
          <span class="badge badge-light" style="font-size: 15px">subject</span>
            <select class="form-control" id="subject" name="subject">
              @if(isset($edit))
                @foreach(Auth::user()->teacher->sclasses as $sclass)
                  @if($sclass->id == $homework->sclass_id)
                    @foreach($sclass->subjects as $subject)
                      <option value="{{$subject->id}}" 
                          @if($subject->id == $homework->subject_id)
                            selected
                          @endif
                        >
                        {{$subject->name}}</option>
                    @endforeach
                  @endif
                @endforeach
              @else
                <option> Select a Subject</option>
              @endif
            </select>

        </div>

	<div class="form-group">
    <span class="badge badge-light" style="font-size: 15px">Question/Content:</span>
	  <textarea class="form-control" rows="9" id="inputContent" name="content" placeholder="add some Question or short note/content">{{isset($edit)?$homework->content: ''}}</textarea>
	</div>
  <div class="form-group">
    <span class="badge badge-light" style="font-size: 15px">Hint</span>
    <textarea type="text" row="6" class="form-control" id="hint" placeholder="add any reference/hint (link...)" name="hint">{{isset($edit)?$homework->hint: ''}}</textarea>
  </div>
  <div class="form-row">
    <div class="form-group row">
        <span class="badge badge-light col-md-4" style="font-size: 15px;margin-left: 20px">Attach Files</span>
        <div class="col-md-6"> 
        <input type="file" class="form-control-file" id="exampleFormControlFile1" name="file">
        </div>
    </div>
  </div>
  <button type="submit" class="btn btn-primary">send</button>
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    </div>

</form>

@endif

@csrf


