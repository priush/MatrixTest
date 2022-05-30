<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
Use App\Students;
Use App\Classes;
Use App\EnrolledStudents;

use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function addStudent()
    {
        $classes = Classes::all();
        return view('addStudent')->with('classes',$classes);
    }

    public function saveStudent(Request $request){
        $input = $request->all();
        $validator = Validator::make($request->all(), [
            'stu_name' => 'required',
            'email' => 'required',
            'age' => 'required',
            'class' => 'required',
        ]);
       if ($validator->fails()) 
        {
        return redirect()->back()->withErrors($validator)
                        ->withInput();
        }else{
            
            $student = new Students;
            $student->name = !empty($input['stu_name']) ? $input['stu_name'] : '';
            $student->email = !empty($input['email']) ? $input['email'] : '';
            $student->age = !empty($input['age']) ? $input['age'] : '';
            $student->class_id = !empty($input['class']) ? $input['class'] : '';
            $student->save();

            $stuId = $student->id;

            $enrolledStudent = new EnrolledStudents;
            $enrolledStudent->class_id = !empty($input['class']) ? $input['class'] : '';
            $enrolledStudent->student_id = !empty($stuId) ? $stuId : '';
            $enrolledStudent->save();

            $classes = Classes::find($input['class']);
            if($classes->no_of_seats <= 4 && $classes->no_of_seats > 0){
                $count = $classes->no_of_seats - 1;
                $classes = Classes::find($input['class']);
                $classes->no_of_seats = $count;
                $classes->save();
            }

            return redirect()->route('students')->with('status', 'Student Added Successfully!');
        }

    }

    public function studentList()
    {
        $studentList = Students::with('classes')->get();
        return view('studentList')->with('studentList',$studentList);
    }

    public function DeletStudent($id)
    {
        Students::where('id',$id)->delete();
        return redirect()->route('students')->with('status', 'Student Deleted Successfully!');
    }
}
