<?php
 
use Illuminate\Support\Facades\Route; 

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great! 
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/search', 'HomeController@searchBar')->name('home.search');


Route::get('/logout1', function () {
	Session::flush();
});

// Route::get('/addClass', function () {
// 	return view('admin.addClass');
// })->name('admin.addClass');

Route::get('/staff', function () {
	return view('staff.home');
})->name('staff.home');

Route::get('/teacher', function () {
	return view('teacher');
})->name('teacher.home');

Route::get('/student', function () {
	return view('student');
})->name('student.home');

Route::get('/view', function () {
	return view('view');
})->name('homework');

//h.w. form

Route::resource('homework', 'HomeworkController');
Route::post('/homework/ajaxSubject', 'HomeworkController@ajaxSubject')->name('ajax.subject');
Route::get('/student/homework/{subject}', 'HomeworkController@studentHomework')->name('student.homework');
Route::post('homework-submit/{homework}', 'HomeworkController@homeworksubmit')->name('homework.submit');


Route::resource('submit', 'SubmitController');

Route::resource('student', 'StudentController');
Route::get('/student-teacher/{subject}', 'StudentController@myClass')->name('myClass.teacher');


Route::resource('teacher', 'TeacherController');
//Route for getting Student list of class of teacher. 
Route::get('/teacher-student/{sclass}', 'TeacherController@myClass')->name('myClass.student');

Route::resource('practiceQuestion', 'PracticeQuestionController');

Route::get('/student/practiceQuestion/{subject}', 'PracticeQuestionController@studentPracticeQuestion')->name('student.practiceQuestion');

Route::post('/ajaxSubject', 'PracticeQuestionController@ajaxSubject')->name('ajax.practice.subject');
Route::post('/ajaxTopic', 'PracticeQuestionController@ajaxTopic')->name('ajax.practice.topic');
Route::post('/ajaxSubtopic', 'PracticeQuestionController@ajaxSubtopic')->name('ajax.practice.subtopic');

//Route::get('practiceQuestion/teacher/action', 'PracticeQuestionController@action')->name('practicequestion.action');;

//slug is for SEO only
Route::get('/question/{topic_id}/{slug}', 'PracticeQuestionController@sortQuestion')->name('sort.question');

Route::resource('class', 'ClassController');
Route::get('school-class-profile/{sId}/{cId}/{secId}', 'ClassController@schoolClassProfile')->name('school.class.profile'); 


Route::resource('schoolstaff', 'SchoolstaffController');

Route::resource('school', 'SchoolController');

Route::resource('subject', 'SubjectController');

Route::resource('section', 'SectionController');

Route::resource('admin', 'AdminController');
Route::post('/roleteacher/admin', 'AdminController@assignTeacherRole')->name('ajax.teacher.role');
Route::post('/school/section/admin', 'AdminController@ajaxSection')->name('ajax.admin.section');
Route::post('/school/subject/admin', 'AdminController@ajaxSubject')->name('ajax.admin.subject');
Route::post('/admin/approvals/{id}', 'AdminController@approvals')->name('admin.approval');
Route::post('/studentclass/admin', 'AdminController@assignStudentClass')->name('ajax.student.class');

 
#TEST ROUTE DELETE THIS 


// Route::get('/test', function () { 
//     return view('test');
// })->name('test');

Route::resource('test', 'TestController');

Route::get('/teacher-schoolstaff-update/{teacher}', 'HomeController@updateTeacher')->name('home.updateTeacher');