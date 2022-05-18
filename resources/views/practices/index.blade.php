@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header"><span style="font-size: 20px">{{ __('Practices') }} </span><a href="{{route('practices.create')}}" class="btn btn-primary" style="float:right">Create New</a></div>

                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Url</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @php
                                    $n = 1;
                                @endphp
                                @forelse ($practices as $practice)
                                <tr>
                                    <th scope="row">{{$practice->id}}</th>
                                    <td>{{$practice->name}}</td>
                                    <td>{{$practice->email}}</td>
                                    <td>{{$practice->Url}}</td>
                                    <td>
                                        <a href="{{route('practices.edit',['id'=>$practice->id ])}}" class="btn btn-sm btn-info">Edit</a>
                                        <a  href="{{route('practices.show',['id'=>$practice->id ])}}" class="btn btn-sm btn-success" >Show</a>
                                        <a href="{{route('practices.destroy',['id'=>$practice->id ])}}" class="btn btn-sm btn-danger" onclick="return confirm('Do you want to delete this?')">Delete</a>
                                    </td>
                                </tr>
                                @empty
                                    
                                @endforelse
                            </tbody>
                        </table>
                        {{$practices->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
