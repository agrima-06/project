<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\SchoolTeacherRelation;
use App\Teacher;
use App\Student;
use App\Defaultsubject;
use Redirect;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    
    public function assignTeacherRole(Request $request)
    {
        //This function is for AJAX for taking Subject as per the Class
        $school_id =  $request->get('school_id');
        $sclass_id = $request->get('sclass_id');    
        $section_id = $request->get('section_id');           
        $subject_id = $request->get('subject_id');           
        $teacher_id = $request->get('teacher_id');
        $reassign_role = $request->get('reassign_role');
        $delete_role = $request->get('delete_role');       

        $SchoolTeacherRelations = SchoolTeacherRelation::where([['school_id', '=', $school_id], ['sclass_id', '=', $sclass_id], ['section_id', '=', $section_id], ['subject_id', '=', $subject_id]])->first();        
        //This will update the class with teacher if that class exist and no teacher has been assigned previously
        if(isset($SchoolTeacherRelations) && $delete_role==1){
             $SchoolTeacherRelations->update([
                'teacher_id'=>null,
                'approved'=>1,
             ]);
            return response()->json(["deleted" => 'deleted']);
        }

       elseif(isset($SchoolTeacherRelations) && $SchoolTeacherRelations->teacher_id == null){
            $SchoolTeacherRelations->update([
                'teacher_id'=>$teacher_id,
                'approved'=>1,
            ]);
       }      
        //This will Return Ajax with Warning Status that already a teacher is assigned for that subject in class. If user click this will replace teacher.
       elseif(isset($SchoolTeacherRelations) && $SchoolTeacherRelations->teacher_id != null && $reassign_role==0){
            $oldteacher = $SchoolTeacherRelations->teacher->user->name;
            $oldteacher_id = $SchoolTeacherRelations->teacher_id;

            if($oldteacher_id==$teacher_id){
                return response()->json(["sameteacher" => $oldteacher]);
            }
            return response()->json(["oldteacher" => $oldteacher]);
       }

       elseif(isset($SchoolTeacherRelations) && $SchoolTeacherRelations->teacher_id != null && $reassign_role==1){
            $SchoolTeacherRelations->update([
                'teacher_id'=>$teacher_id,
                'approved'=>1,
             ]);
       }  
       //This will freshly assign subject, class as well as section. 
       else{
            $SchoolTeacherRelation = SchoolTeacherRelation::create([
            'school_id'=>$school_id,
            'sclass_id'=>$sclass_id,
            'section_id'=>$section_id,
            'subject_id'=>$subject_id,
            'teacher_id'=>$teacher_id,
         ]);
       }
       return response()->json(["data" => "role assigned"]);
    }

    public function ajaxSection(Request $request){
        $school_id =  $request->get('school_id');
        $sclass_id = $request->get('sclass_id');  
        $SchoolTeacherRelations = SchoolTeacherRelation::select('section_id')->where([['school_id', '=', $school_id],['sclass_id', '=', $sclass_id],['approved', '=', 1]])->distinct()->get(); 

        $data = [];
        foreach ($SchoolTeacherRelations as $relation) {
         array_push($data, array("id"=>$relation->section_id, "section"=>$relation->section->section));
        }  
        return response()->json(["data" => $data]);
     }


    public function ajaxSubject(Request $request){
        $school_id =  $request->get('school_id');
        $sclass_id = $request->get('sclass_id');
        $section_id = $request->get('section_id'); 
        $SchoolTeacherRelations = SchoolTeacherRelation::select('subject_id', 'teacher_id')->where([['school_id', '=', $school_id],['sclass_id', '=', $sclass_id],['section_id', '=', $section_id],['approved', '=', 1]])->get(); 
        $data = [];
        foreach ($SchoolTeacherRelations as $relation) {
            if (isset($relation->teacher)) {
                $teacher = $relation->teacher->user->name;
            }
            else{
                $teacher = 'No Teacher';
            }
         array_push($data, array("id"=>$relation->subject_id, "subject"=>$relation->subject->name));
        }
        return response()->json(["data" => $data]);

     }

    public function approvals(Request $request, $id){

        if(isset($request->student)){
            $student = Student::find($id);
            $student->update(['approved' => 1]);  
        }
        if(isset($request->studentDelete)){
            $student = Student::find($id);
            $student->update([
                'school_id'=>null,
                'sclass_id'=>null,
                'section_id'=>null,
                'approved'=>0,
            ]);  
        }
        if(isset($request->teacher)){
            $teacher = Teacher::find($id);
            $teacher->update(['approved' => 1]);  
        }
        if(isset($request->teacherDelete)){
            $teacher = Teacher::find($id);
            $teacher->update([
                'school_id'=>null,
                'approved'=>0,
            ]);  
        }
        if(isset($request->teacherRole)){
            $teacher = SchoolTeacherRelation::find($id);
            $teacher->update(['approved' => 1]);  
        }
        if(isset($request->teacherRoleDelete)){
            $teacher = SchoolTeacherRelation::find($id);
            $teacher->update([
                'teacher_id'=>null,
                'classteacher'=>null,
                'approved' => 0,
            ]);  
        }

        if(isset($request->studentDeleteClass)){
            $student = Student::find($id);
            $student->update([
                'sclass_id'=>null,
                'section_id'=>null,
                'approved' => 0,
            ]);  
        }

        if(isset($request->studentDeleteSchool)){
            $student = Student::find($id);
            $student->update([
                'school_id'=>null,
                'sclass_id'=>null,
                'section_id'=>null,
                'approved' => 0,
            ]);
        }

        return redirect()->back(); 
        //return redirect(route('home'));
     }

    public function assignStudentClass(Request $request)
    {
        //This function is for AJAX for taking Subject as per the Class
       // $school_id =  $request->get('school_id');
        $sclass_id = $request->get('sclass_id');    
        $section_id = $request->get('section_id');           
        $student_id = $request->get('student_id');
  //      $reassign_role = $request->get('reassign_role');
      //  $delete_role = $request->get('delete_role');     
        $student = Student::find($student_id);

        if(($student->sclass_id == $sclass_id) && ($student->section_id == $section_id)){
            $sameClass =["class"=>'Class: '.$student->sclass->class, "section"=>$student->section->section];
            return response()->json(["sameClass" => $sameClass]);
        }
        else{
            $student->update([
                'sclass_id'=>$sclass_id,
                'section_id'=>$section_id,
                'approved'=>1,
            ]); 

            $newClass =["class"=>'Class: '.$student->sclass->class, "section"=>$student->section->section] ;
            return response()->json(["data" => $newClass]);
        }     
    }

    public function deleteSchoolClass(Request $request)
    {
        $school_id = $request->get('school_id');
        $sclass_id = $request->get('sclass_id');    
        $section_id = $request->get('section_id');           
        //dd($school_id.$sclass_id.$section_id); 
        $SchoolTeacherRelations = SchoolTeacherRelation::where([['school_id', '=', $school_id], ['sclass_id', '=', $sclass_id], ['section_id', '=', $section_id]])->get(); 

        dd($SchoolTeacherRelations);

    }

    public function schoolClassTeacherlist(Request $request){

        $school_id = $request->get('school_id');
        $sclass_id = $request->get('sclass_id');    
        $section_id = $request->get('section_id'); 

        $SchoolTeacherRelations = SchoolTeacherRelation::where([['school_id', '=', $school_id], ['sclass_id', '=', $sclass_id], ['section_id', '=', $section_id], ['approved', '=', 1]])->get(); 

        $data = [];
        foreach ($SchoolTeacherRelations as $relation) {
            if (isset($relation->teacher)) {
                $teacher = $relation->teacher->user->name;          
            array_push($data, array("id"=>$relation->teacher_id, "teacher"=>$relation->teacher->user->name));
            }
        }
        return response()->json(["data" => $data]);
    }

    public function schoolAddClass(Request $request){

        $school_id = $request->get('school_id');
        $sclass_id = $request->get('sclass_id');    
        $section_id = $request->get('section_id'); 
        $defaultsubjects = $request->get('default_subjects');
        $board = 'CBSE'; //Please Make it variable later 
        
        //check if same class aready exist::
        $SchoolTeacherRelations = SchoolTeacherRelation::where([['school_id', '=', $school_id], ['sclass_id', '=', $sclass_id], ['section_id', '=', $section_id]])->get(); 

       // dd($SchoolTeacherRelations);

        if(count($SchoolTeacherRelations) !== 0){
                dd('exist'); // Return with message. 
        }

        if(isset($defaultsubjects)){
            $defaultsubjectlists = Defaultsubject::where([['sclass_id', '=', $sclass_id], ['board', '=', $board]])->get();            
            foreach ($defaultsubjectlists as $list) {
                $relation = SchoolTeacherRelation::create([
                    'school_id' => $school_id,
                    'sclass_id' => $sclass_id,
                    'section_id'=> $section_id,
                    'subject_id' => $list->subject->id,
                    'approved' => 1,
                ]);
            }
        }

        dd('class created');
      //  $defaultsubject = DefaultSubject::where('sclass_id', '=', $sclass_id)->get();

      //  foreach

        $SchoolTeacherRelations = SchoolTeacherRelation::where([['school_id', '=', $school_id], ['sclass_id', '=', $sclass_id], ['section_id', '=', $section_id], ['approved', '=', 1]])->get(); 

    }


}
