
@extends('layouts.theme')

@section('title')
Home
@endsection

@section('body')


      <form action="{{route('ajax.student.class')}}" method="post">
        @csrf
        <input type="text" name="school_id" value='3'>
        <input type="text" name="sclass_id" value='1'>
        <input type="text" name="section_id" value='1'>
        <input type="text" name="student_id" value='1'>

        <!-- <input type="text" name="section_id" value='1'>
        <input type="text" name="subject_id" value='1'>
        <input type="text" name="teacher_id" value='1'>
        <input type="text" name="classteacher" value='1'> -->
<!--    <input type="text" name="subject_id">
 -->     
        <button type="submit" class="btn btn-primary btn-sm mr-2">Submit</button>
      </form>

      
@endsection

