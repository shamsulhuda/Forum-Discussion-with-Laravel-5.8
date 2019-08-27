@extends('layouts.app')

@section('content')
        <div class="col-md-7 offset-1">
            <div class="card">
                <div class="card-header font-md">Update Reply</div>

                <div class="card-body">
                <form action="{{route('reply.update', ['id' => $reply->id])}}" method="post" data-toggle="validator">
                    {{ csrf_field() }}
                    
                    <div class="form-group">
                        <label for="content">Reply</label>
                        <textarea name="content" id="content" cols="30" rows="10" class="form-control" required="true">{{$reply->content }}</textarea>
                    </div>

                        <button class="btn btn-success float-right" type="submit">Update reply</button>
                </form>

                </div>
            </div>
            
        </div>


        
@endsection
