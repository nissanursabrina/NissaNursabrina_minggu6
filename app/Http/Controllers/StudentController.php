<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Kelas;
use App\Models\Course;
use pdf;


class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /* $students = Student::all();
        return view('students.index',['student'=>$students]); */
        /* $student = Student::with('kelas')->get();
        return view('students.index', ['student'=>$student]); */

        if($request->has('cari')){
            $students = Student::where('name', 'LIKE', '%' .$request->cari. '%')->get();
        } else {
            $students = Student::all();
        }
        return view('students.index',['student'=>$students]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        /* return view('students.create'); */

        $kelas = Kelas::all();
        return view('students.create',['kelas'=>$kelas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /* //add data
        Student::create($request->all());
        // if true, redirect to index
        return redirect()->route('students.index')
        ->with('success', 'Add data success!'); */

        $student = new Student;
        $student->nim = $request->nim;
        $student->name = $request->name;
        $student->department = $request->department;
        $student->phone_number = $request->phone_number; 
        
        $kelas = new Kelas;
        $kelas->id = $request->Kelas;
        
        $student->kelas()->associate($kelas);
        $student->save();
 
        // if true, redirect to index
        return redirect()->route('students.index')
        ->with('success', 'Add data success!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::find($id);
        return view('students.show',['student'=>$student]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /* $student = Student::find($id);
        return view('students.edit',['student'=>$student]); */

        $student = Student::find($id);
        $kelas = Kelas::all();
        return view('students.edit',['student'=>$student, 'kelas'=>$kelas]);
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
        /* $student = Student::find($id);
        $student->nim = $request->nim;
        $student->name = $request->name;
        $student->class = $request->class;
        $student->department = $request->department;
        $student->phone_number = $request->phone_number;
        $student->save();
        return redirect()->route('students.index'); */

        $student = Student::find($id);
        $student->nim = $request->nim;
        $student->name = $request->name;
        $student->department = $request->department;
        $student->phone_number = $request->phone_number;
        
        $kelas = new Kelas;
        $kelas->id = $request->Kelas;
        
        $student->kelas()->associate($kelas);
        $student->save();
        
        return redirect()->route('students.index');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::find($id);
        $student->delete();
        return redirect()->route('students.index');
    }
    
    public function detail($id)
    {
        $student = Student::find($id);
        //$student = Student::find($id);
        return view('student.detail', ['student'=>$student]);
        //dd($student->courses);
    }

    public function report($id)
    {
        $student = Student::find($id);
        $pdf = PDF::loadview('students.report', ['student'=>$student]);
        return $pdf->stream();
    }
}
