@extends('layouts.theme')

@section('title')
about me
@endsection

@section('body') 


<div class="row justify-content-center" style="color: black">
  	<ul class="list-group">
@foreach($classes as $class)
  
  <li class="list-group-item list-group-item-dark" style="margin-top: 15px">class{{$class->class}}</li>
  <li class="list-group-item">section-:{{$class->section}}</li>

@endforeach
    </ul>
</div>
@endsection

