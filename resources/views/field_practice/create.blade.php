@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('notification.notify')
                <div class="card mb-3">
                    <div class="card-header" style="font-size:20px">{{ __('Create Field Of Practice') }}</div>

                    <div class="card-body">
                        <form action="{{route('field_practice.store')}}" method="post">
                            @csrf
                         
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="name">Enter Name</label>
                                    <input type="text" name="name" class="form-control" id="name">
                                </div>


                                <div class="col-md-12 mb-3">
                                    <label for="phone">Select Practice</label>
                                    <select class="form-control" id="practice_id" name="practice_id">
                                        <option value="">Choose Practice</option>
                                        @forelse ($practices as $practice)
                                                <option value="{{$practice->id}}">{{$practice->name}}</option>
                                        @empty
                                            
                                        @endforelse
                                    </select>
                                </div>
                                
                                <div class="col-md-12 mb-3">
                                    <button type="submit" class="btn btn-md btn-primary">Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
