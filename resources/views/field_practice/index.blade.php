@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mb-3">
                    <div class="card-header"><span style="font-size: 20px">{{ __('Field Practices') }} </span><a href="{{route('field_practice.create')}}" class="btn btn-primary" style="float:right">Create New</a></div>

                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">#</th>

                                <th>Practice</th>
                                <th scope="col">Name</th>
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
                                    <td>{{$practice->practice_name}}</td>
                                    <td>{{$practice->name}}</td>
                                    <td>
                                        <a href="{{route('field_practice.edit',['id'=>$practice->id ])}}" class="btn btn-sm btn-info">Edit</a>
                                        <a href="{{route('field_practice.destroy',['id'=>$practice->id ])}}" class="btn btn-sm btn-danger" onclick="return confirm('Do you want to delete this?')">Delete</a>
                                    </td>
                                </tr>
                                @empty
                                    
                                @endforelse
                            </tbody>
                        </table>
                        @if($practices)
                        {{$practices->links()}}
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
