@extends('layouts.app')

@section('content')
        <div class="col-md-8">
            <div class="card shadow-sm p-3 mb-5 bg-white rounded">
                <div class="card-header">Edit Channel: {{ $channel->title }}</div>

                <div class="card-body">
                    <form action="{{ route('channels.update', ['channel' => $channel->id]) }}" method="post">
                    {{ csrf_field() }}
                    
                    {{ method_field('PUT') }}
                        <div class="form-group">
                            <input type="text" name="channel" class="form-control" value="{{ $channel->title }}" >
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Update Channel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection
