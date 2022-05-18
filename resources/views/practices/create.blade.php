@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('notification.notify')
                <div class="card mb-3">
                    <div class="card-header" style="font-size:20px">{{ __('Create Practice') }}</div>

                    <div class="card-body">
                        <form action="{{route('practices.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                         
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="name">Enter Name</label>
                                    <input type="text" name="name" class="form-control" id="name">
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="email">Enter Email</label>
                                    <input type="email" name="email" class="form-control" id="email">
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="logo">Choose Logo</label>
                                   <input type="file" name="logo" class="form-control" id="logo">
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="url">Enter Url</label>
                                    <input type="text" name="url" class="form-control" id="url">
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
