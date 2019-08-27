@extends('layouts.app')

@section('content')
    <div class="col-md-8">
        <div class="col-md-6 offset-md-2 form-group has-search">
            <form action="/search" method="get">
                <span class="fa fa-search form-control-feedback"></span>
                <input type="text" class="form-control" name="search" placeholder="Search here...">
            </form>
        </div>
    @foreach($discussions as $d)
    <div class="row no-gutters mb-3 shadow-sm p-3 bg-white rounded">
        <div class="col-md-1 no-gutters justify-content-center">
            <div class="col-auto ml-2 mt-2">
            <img src="{{asset($d->user->avatar)}}" class="img-fluid img-thumbnail rounded-circle" alt="" style="width:auto; height:auto">

                <!-- <p class="text-center">{{$d->user->name}}</p> -->
            </div>
        </div>
        <div class="col-md-9 ml-2">
            <h4 class="discuss-title">
                <a class="text-dark" href="{{ route('discussion', ['slug' => $d->slug]) }}">{{ $d->title }}</a>                        
            </h4>
            <p class="card-text">
                {{ str_limit($d->content, 100) }}
            </p>
            
            <span style="font-size:13px">Updeted {{$d->created_at->diffForHumans()}}, by <strong>{{ucfirst($d->user->name)}}</strong></span>
                
            
                <span class="float-right">
                
                
            </span>
        </div>
        <div class="col-md-1 justify-content-right text-center no-gutters">
            <div class="channal-btn">
                <a href="{{ route('channel', ['slug' => $d->channel->slug]) }}" class="btn btn-sm" data-toggle="tooltip" data-placement="top" title="Category">
                {{$d->channel->title}}
                </a>
            </div><br>
            <!-- discussion open or close -->
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
            <!-- <a href="{{ route('discussion', ['slug' => $d->slug]) }}" class="btn btn-primary btn-sm">Details</a> -->
            <div class="channal-btn-dtls">
                <a href="{{ route('discussion', ['slug' => $d->slug]) }}" class="btn btn-sm" data-toggle="tooltip" data-placement="top" title="Tab to details">
                Details
                </a>
            </div>
        </div>
    </div>
    @endforeach
            
        <div class="pagination justify-content-center">
            {{$discussions->links()}}
        </div>
    </div>


    
@endsection
