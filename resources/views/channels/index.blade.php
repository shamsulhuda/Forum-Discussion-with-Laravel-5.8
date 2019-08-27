@extends('layouts.app')

@section('content')
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Channels</div>

                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $i=0; ?>
                        @foreach($channels as $channel)
                        <?php $i++ ?>
                            <tr>
                            <th scope="row">{{ $i }}</th>
                                <td>{{ $channel->title }}</td>
                                <td>
                                    <a href="{{ route('channels.edit', ['channel' => $channel->id])}}" class="btn btn-primary btn-sm">
                                        <i class="fa fa-pencil"></i>
                                        Edit
                                    </a>
                                </td>
                                <td>
                                <form action="{{ route('channels.destroy', ['channel' => $channel->id]) }}" method="post">
                                    {{ csrf_field() }}
                                    
                                    {{ method_field('DELETE') }}
                                    <button class="btn btn-danger btn-sm" type="submit">
                                            <i class="fa fa-trash"></i>
                                            Delete
                                    </button>
                                </form>
                                    
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
@endsection
