<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
Use App\Classes;
Use App\Students;
Use App\EnrolledStudents;

use Illuminate\Http\Request;

class ClassController extends Controller
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
    public function addClass()
    {
        return view('addClass');
    }

    public function saveClass(Request $request){
        $input = $request->all();
        // dd($input);
        $validator = Validator::make($request->all(), [
        'class_name' => 'required',
        ]);
       if ($validator->fails()) 
        {
        return redirect()->back()->withErrors($validator)
                        ->withInput();
        }else{
            
            $classes = new Classes;
            $classes->class_name = !empty($input['class_name']) ? $input['class_name'] : '';
            $classes->no_of_seats = !empty($input['seats']) ? $input['seats'] : '';
            $classes->description = !empty($input['description']) ? $input['description'] : '';
            $classes->save();

            return redirect()->route('classList')->with('status', 'Class Added Successfully!');
        }

    }

    public function classList()
    {
        $classList = Classes::with('enStudents')->get();
       // dd($classList);
       return view('ClassList')->with('classList',$classList);
    }

    public function enrollStudents($id){
        $className = Classes::find($id);
        $stdnts = EnrolledStudents::where('class_id',$id)->with('students')->get();
        return view('enrollStudent')->with(['className'=> $className, 'enrolledStudents' => $stdnts]);
    }

    public function unenrollStudent(Request $request){
       $input = $request->all();
       $stdnts = EnrolledStudents::where(['class_id'=> $input['classId'],'student_id' => $input['studentId']])->delete();
       $student = Students::find($input['studentId']);
       $student->class_id = '';
       $student->save();

        $classes = Classes::find($input['classId']);
        $classes->no_of_seats = $classes->no_of_seats + 1;
        $classes->save();

       return redirect()->route('enrollStudents', ['id' => $input['classId']]);
    }
}
