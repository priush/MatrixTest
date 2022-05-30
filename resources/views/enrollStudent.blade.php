@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Students in Class (<strong>{{$className->class_name}}</strong>) </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <table class="table datatable-column-search-selects">
                            <thead>
                                <tr>
                                    <th>Sr. No.</th>
                                    <th>Student Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($enrolledStudents))
                                    @foreach($enrolledStudents as $key => $enstdnt)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$enstdnt->students->name}}</td>
                                        <td>
                                        <form method="POST" action="{{ route('unenrollStudent') }}">
                                            @csrf
                                            <input type="hidden" name="classId" value="{{$enstdnt->class_id}}">
                                            <input type="hidden" name="studentId" value="{{$enstdnt->students->id}}">
                                                <button type="submit" class="btn btn-primary">
                                                    <span class="glyphicon glyphicon-thumbs-up"></span> Unenroll
                                                </button>
                                        </form>
                                    </td>
                                    </tr>
                                    @endforeach
                                @endif
                            </tbody>
                           
                        </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
