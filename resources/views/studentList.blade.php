@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Student List</div>

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
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Age</th>
                                    <th>Class</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($studentList))
                                    @foreach($studentList as $key => $sl)
                                    <tr>
                                        <td>{{$key+1}}</td>
                                        <td>{{$sl->name}}</td>
                                        <td>{{$sl->email}}</td>
                                        <td>{{$sl->age}}</td>
                                        <td><strong><?php if(!empty($sl->classes->class_name)){ echo $sl->classes->class_name; } ?></strong></td>
                                        <td><a href="{{route('DeletStudent',$sl->id)}}"><i class="fa fa-trash" aria-hidden="true"></a></i></td>
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
