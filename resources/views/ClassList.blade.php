@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Class List</div>

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
                                    <th>Class</th>
                                    <th>Description</th>
                                    <th>Seats</th>
                                    <th>Students</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(!empty($classList))
                                    @foreach($classList as $key => $cl)
                                        <td>{{$key+1}}</td>
                                        <td>{{$cl->class_name}}</td>
                                        <td>{{$cl->description}}</td>
                                        <td>{{$cl->no_of_seats}}</td>
                                        <td><ul>
                                            <?php  if(isset($cl->enStudents) && !empty($cl->enStudents)){
                                                $stdntDe = array();
                                                foreach($cl->enStudents as $enrlStdnt){
                                                    $stuId = $enrlStdnt->student_id;
                                                    $sdetail = App\Students::where('id',$stuId)->first();
                                                    if(!empty($sdetail)){
                                                        $stdntDe = $sdetail->name;
                                                        echo '<li>'.$stdntDe.'</li>';
                                                    }
                                                }
                                            }?>
                                            </ul>
                                        </td>
                                        <td><a href="{{route('enrollStudents', $cl->id)}}"><i class="fa fa-envelope-open" aria-hidden="true"></a></i></td>
                                    </tr>
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
