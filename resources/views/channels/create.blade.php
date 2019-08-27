@extends('layouts.app')

@section('content')
        <div class="col-md-8">
            <div class="card shadow-sm p-3 mb-5 bg-white rounded">
                <div class="card-header">Create Channel</div>

                <div class="card-body">
                    <form action="{{ route('channels.store') }}" method="post">
                    {{ csrf_field() }}
                        <div class="form-group">
                            <input type="text" name="channel" class="form-control" placeholder="Channel name">
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
@endsection
