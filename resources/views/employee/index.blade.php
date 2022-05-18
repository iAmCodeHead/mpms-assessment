@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-header"><span style="font-size: 20px">{{ __('Employees') }} </span><a href="{{route('employee.create')}}" class="btn btn-primary" style="float:right">Create New</a></div>

                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th>Practice</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @php
                                    $n = 1;
                                @endphp
                                @forelse ($employees as $employee)
                                <tr>
                                    <th scope="row">{{$employee->id}}</th>
                                    <td>{{$employee->first_name}}</td>
                                    <td>{{$employee->email}}</td>
                                    <td>{{$employee->phone}}</td>
                                    <td>{{$employee->practice_name}}</td>
                                    <td>
                                        <a href="{{route('employee.edit',['id'=>$employee->id ])}}" class="btn btn-sm btn-info">Edit</a>
                                        <a href="{{route('employee.destroy',['id'=>$employee->id ])}}" class="btn btn-sm btn-danger" onclick="return confirm('Do you want to delete this?')">Delete</a>
                                    </td>
                                </tr>
                                @empty
                                    
                                @endforelse
                            </tbody>
                        </table>
                        {{$employees->links()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
