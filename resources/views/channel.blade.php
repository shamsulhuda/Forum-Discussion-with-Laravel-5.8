@extends('layouts.app')

@section('content')
<div class="col-md-8">
    @if($discussions == NULL)

    <h3>There is no post Under this channel</h3>
    @else

    @foreach($discussions as $d)
    <div class="row no-gutters mb-3 shadow-sm p-3 bg-white rounded">
        <div class="col-md-1 no-gutters justify-content-center">
            <div class="col-auto ml-2 mt-2">
                <img src="{{asset($d->user->avatar)}}" class="img-fluid img-thumbnail rounded-circle position-relative" alt="" style="width:60px; height:auto">
                <!-- <p class="text-center">{{$d->user->name}}</p> -->
            </div>
        </div>
        <div class="col-md-10">
            <h4 class="discuss-title">
                <a class="text-dark font-weight-bold" href="{{ route('discussion', ['slug' => $d->slug]) }}">{{ $d->title }}</a>                        
            </h4>
            <p class="card-text">
                {{ str_limit($d->content, 100) }}
            </p>
            
            <span style="font-size:12px">Updeted {{$d->created_at->diffForHumans()}}, by <b>{{ucfirst($d->user->name)}}</b></span>
                
            
        </div>
        <div class="col-md-1 justify-content-right text-center">
            <div class="channal-btn">
                <a href="{{ route('channel', ['slug' => $d->channel->slug]) }}" class="btn btn-sm" data-toggle="tooltip" data-placement="top" title="Category">{{$d->channel->title}}</a>
            </div><br>
            @if($d->hasBestAnswer())
                <a class="dis-close" data-toggle="tooltip" data-placement="top" title="Discussion closed">
                <i class="fa fa-toggle-off"></i>
                </a>
            @else
                <a class="dis-open" data-toggle="tooltip" data-placement="top" title="Discussion open">
                <i class="fa fa-toggle-on"></i>
                </a>
            @endif

            </a>
            <p>
            <a class="comnt-rply" data-toggle="tooltip" data-placement="top" title="This discussion have {{ $d->replies->count() }} comments">
                <i class="fa fa-comment"> {{ $d->replies->count() }}</i>
            </a>
            </p>
            <div class="channal-btn-dtls">
                <a href="{{ route('discussion', ['slug' => $d->slug]) }}" class="btn btn-sm" data-toggle="tooltip" data-placement="top" title="Tab to details">
                Details
                </a>
            </div>
        </div>
    </div>
    @endforeach

    @endif
            
        <div class="pagination justify-content-center">
            {{$discussions->links()}}
        </div>
    </div>
@endsection



    

