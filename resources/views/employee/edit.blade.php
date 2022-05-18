@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('notification.notify')
                <div class="card mb-3">
                    <div class="card-header" style="font-size:20px">{{$employee->name}}</div>

                    <div class="card-body">
                        <form action="{{route('employee.update')}}" method="post">
                            @csrf
                            @method('put')
                            <input type="hidden" name="id" id="id" value="{{$employee->id}}">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="first_name">Enter First Name</label>
                                    <input type="text" name="first_name" class="form-control" id="first_name" value="{{$employee->first_name}}">
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="last_name">Enter Last Name</label>
                                    <input type="text" name="last_name" class="form-control" id="last_name" value="{{$employee->last_name}}">
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="email">Enter Email</label>
                                    <input type="email" name="email" class="form-control" id="email" value="{{$employee->email}}">
                                </div>


                                <div class="col-md-12 mb-3">
                                    <label for="phone">Enter Phone Number</label>
                                    <input type="text" name="phone" class="form-control" id="phone" value="{{$employee->phone}}">
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

@section('js')
    <script>
         $(document).ready( function(){
             var id = $('#id').val();
                $.ajax({
                    method: 'get',
                    url:"{{route('employee.get')}}",
                    data:{id:id},
                    success: function(data){
                    console.log(data);
                         $('#practice_id').val(data.practice_id);
                    }
                });
            });

    </script>
@endsection
