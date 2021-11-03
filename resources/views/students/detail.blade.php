@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('STUDENT REPORT') }}</div>

                        <div class="card-body">
                            <b>Name</b> : {{ $student->name }} <br>
                            <b>Class</b> : {{ $student->kelas->class_name }} <br>
                            <b>Department</b> : {{ $student->department }} <br>
                            <b>Phone Number</b> : {{ $student->phone_number }} <br>
                            <b>Created at</b> : {{ $student->created_at }} <br>
                            <b>Updated at</b> : {{ $student->updated_at }} <br>
                            <table class="table table-responsive table-striped">
                                <thead>
                                    <tr>
                                        <th>Course Name</th>
                                        <th>Semeter</th>  
                                        <th>SKS</th>
                                        <th>Score</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($student->courses as $sc)
                                    <tr>
                                        <td>{{ $sc->course_name }}</td>
                                        <td>{{ $sc->semester }}</td>
                                        <td>{{ $sc->sks }}</td>
                                        <td>{{ $sc->pivot->nilai }}</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <a href="/students/{{$student->id}}/report" class="btn btn-primary" target="_blank">PRINT PDF
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
