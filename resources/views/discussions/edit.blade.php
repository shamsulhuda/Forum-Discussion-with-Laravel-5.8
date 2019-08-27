@extends('layouts.app')

@section('content')
        <div class="col-md-7 offset-1">
            <div class="card">
                <div class="card-header font-md">Update discussion</div>

                <div class="card-body">
                <form action="{{route('discussions.update', ['id' => $discussion->id])}}" method="post" data-toggle="validator">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-8">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control" value="{{ $discussion->title }}" required="true">
                            
                        </div>
                        
                    </div>


                    <div class="form-group">
                        <label for="content">Ask Question</label>
                        <textarea name="content" id="content" cols="30" rows="10" class="form-control" required="true">{{$discussion->content }}</textarea>
                    </div>

                        <button class="btn btn-success float-right" type="submit">Update now</button>
                </form>

                </div>
            </div>
            
        </div>


        
@endsection
