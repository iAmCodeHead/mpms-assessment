@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card mb-3">
                    <div class="card-header">{{ __('Practice Name') }}</div>
    
                    <div class="card-body">
                        <h3>{{$practice->name}}</h3>
                    </div>
    
                </div>
            </div>
            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-header">{{ __('Employees') }}</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                            </tr>
                            </thead>
                            <tbody>
                                @php
                                $n = 1;
                            @endphp
                            @foreach($practice->employees as $employee)
                                <tr>
                                    <th scope="row">{{$n++}}</th>
                                    <td>{{$employee->first_name}}</td>
                                    <td>{{$employee->last_name}}</td>
                                    <td>{{$employee->email}}</td>
                                    <td>{{$employee->phone}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">{{ __('Available Fields') }}</div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                            </tr>
                            </thead>
                            <tbody>
                                @php
                                $n = 1;
                            @endphp
                            @foreach($practice->fields as $field)
                                <tr>
                                    <th scope="row">{{$n++}}</th>
                                    <td>{{$field->name}}</td>
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
