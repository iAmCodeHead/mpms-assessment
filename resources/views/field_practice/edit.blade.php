@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('notification.notify')
                <div class="card mb-3">
                    <div class="card-header" style="font-size:20px">{{$f_practice->name}}</div>

                    <div class="card-body">
                        <form action="{{route('field_practice.update')}}" method="post">
                            @csrf
                            @method('put')
                            <input type="hidden" name="id" id="id" value="{{$f_practice->id}}">
                            <div class="row">
                                <div class="col-md-12 mb-3">
                                    <label for="name">Enter Name</label>
                                    <input type="text" name="name" class="form-control" id="name" value="{{$f_practice->name}}">
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
                    url:"{{route('field_practice.get')}}",
                    data:{id:id},
                    success: function(data){
                    console.log(data);
                         $('#practice_id').val(data.practice_id);
                    }
                });
            });

    </script>
@endsection
