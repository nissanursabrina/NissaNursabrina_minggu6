@extends('layouts.app') 
   
@section('content') 
<div class="container"> 
    <div class="row justify-content-center"> 
        <div class="col-md-8"> 
            <div class="card"> 
                <div class="card-header">{{ __('STUDENT DATA') }}</div> 
   
                <div class="card-body"> 
                    @if (session('status')) 
                        <div class="alert alert-success" role="alert"> 
                            {{ session('status') }} 
                        </div> 
                    @endif 
                    <form class="form-inline my-2 my-lg-0" method="GET" action="/students">
                    <input name="cari" class="form-control mr-sm-2" type="search" placeholder="search" aria-label="Search">
                        <button type="submit" name="delete" class="btn btn-outline-success my-2 my-sm-0">Search</button>
                    </form>
                    <!-- <form action="/search" method="GET" role="search">
                        {{ csrf_field() }}
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Input student name" name="q">
                            <span class="input-group-btn">
                                <button class="btn btn-secondary" type="submit">Search</button>
                            </span>
                        </div>
                    </form> -->
                    <br>
                    <table class="table table-responsive table-striped"> 
                    <a href="/students/create" class="btn btn-primary">Add Data</a> 
                    <tab> <a href="/home" class="btn btn-primary">Home</a><br><br>
                        <thead> 
                            <tr> 
                                <th>NIM</th>  
                                <th>Name</th> 
                                <th>Class</th>
                                <th>Department</th>
                                <th>Phone_number</th>
                                <th>Action</th>
                                <th></th><th></th>
                                </tr> 
                        </thead> 
                        <tbody> 
                            @foreach($student as $s) 
                            <tr> 
                                <!-- <td>{{ $s->nim }}</td> 
                                <td>{{ $s->name }}</td> 
                                <td>{{ $s->class }}</td>
                                <td>{{ $s->department }}</td>
                                <td>{{ $s->phone_number }}</td> -->
                                
                                <td>{{ $s->nim }}</td>
                                <td>{{ $s->name }}</td>
                                <td>{{ $s->kelas->class_name }}</td>
                                <td>{{ $s->department }}</td>
                                <td>{{ $s->phone_number }}</td> 

                                <td>
                                <form action="/students/{{$s->id}}" method="post">
                                    <a href="/students/{{$s->id}}/edit" class="btn btn-warning">Edit</a>
                                    </form>
                                </td>
                                <td>
                                <form action="/students/{{$s->id}}" method="post">
                                    <a href="/students/{{$s->id}}" class="btn btn-success">View</a>
                                    </form>
                                </td>
                                <td>
                                <form action="/students/{{$s->id}}" method="post">
                                <a href="/students/{{$s->id}}/detail" class="btn btn-info">Nilai</a>
                                    </form>
                                </td>
                                <td>
                                <form action="/students/{{$s->id}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" name="delete" class="btn btn-danger">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach 
                        </tbody> 
                    </table> 
                </div> 
            </div> 
        </div> 
    </div> 
</div> 
@endsection 