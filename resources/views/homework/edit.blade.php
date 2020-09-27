
@extends('layouts.theme')

@section('title')
Edit
@endsection

@section('body')


<div class="row justify-content-center">
  <div class="col-8">
        @include('partials.homeworkForm') 
  </div>
</div>
@endsection

	@include('partials.ajax.ajaxSubject')

