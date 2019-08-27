@extends('layouts.app')

@section('content')
    <div class="col-md-8">
      
    <div class="col-auto ml-2 mt-2">
    <div class="row no-gutters">
        <div class="col-1">
        <img src="{{asset($d->user->avatar)}}" class="img-fluid img-thumbnail rounded-circle position-relative" alt="" style="width:70px; height:auto">
        </div>
        <div class="col-10 ml-4">
        <span style="font-size:24px">{{ ucfirst($d->user->name) }}</span>
        
        
        <span>
            @if($d->user->admin ==1)
                 
                @if(Auth::check())
                <i class="fa fa-circle" style="font-size:8px; color: #0750c4"></i>
                admin since {{$d->user->created_at->toFormattedDateString()}}
                @endif
            @else
                @if(Auth::check())
                <i class="fa fa-circle" style="font-size:8px; color: #0750c4"></i>
                   member since {{$d->user->created_at->toFormattedDateString()}}
                @endif
            @endif
        </span>
        
        @if($d->is_being_watched_by_auth_user())
            <span class="float-right follow">
                <a href="{{ route('discussion.unwatch', ['id' => $d->id]) }}" class="">Unfollow Discussion</a>
            </span>
        @else
            <span class="float-right follow">
                <a href="{{ route('discussion.watch', ['id' => $d->id]) }}" class="">Follow Discussion</a>
            </span>
        @endif
        <p>Experience level: <span class="badge badge-primary">{{ $d->user->points}}</span></p>
        </div>
        
    </div>
    </div>
    <div class="row no-gutters mb-3 shadow-sm p-3 bg-white rounded show-card">
        
        <div class="col-md-12">
            <h4 class="discuss-title">
            <span><i class="fa fa-quora"></i><i class="fa fa-circle" style="font-size:8px; color: #0750c4"></i></span>
                {{ $d->title }}
                
            <span class="float-right">
            @if($d->hasBestAnswer())
                    <a class="dis-close" data-toggle="tooltip" data-placement="top" title="Discussion got Best Answer!">
                    <i class="fa fa-toggle-off"></i>
                    </a>
                @else
                    <a class="dis-open" data-toggle="tooltip" data-placement="top" title="Discussion not get Best Answer yet!">
                    <i class="fa fa-toggle-on"></i>
                    </a>
                @endif
            </span>

            </h4>
            
            <hr>
            <p class="card-text">

                {!! Markdown::convertToHtml($d->content) !!}

            </p>
            <div class="qus-bottom">
                <p class="mb-0">
                    <i class="fa fa-reply-all reply"> {{ $d->replies->count() }} Reply</i>

                    @if(!$d->hasBestAnswer())
                        @if(Auth::id() == $d->user->id)
                            <span class="show-btm-1 float-right">
                                <i class="fa fa-edit"></i>
                                <a href="{{route('discussion.edit', ['slug' => $d->slug])}}">
                                     Edit
                                </a>
                            </span>
                        @endif
                    @endif
                    
                </p>
            </div>
        </div> 
    </div>
    <!-- best answer field -->
    @if($best_answer)
    <div class="card mb-3 shadow-sm p-3 bg-white rounded">
            <div class="row no-gutters">
                <div class="col-1">
                    <img src="{{$best_answer->user->avatar}}" class="img-fluid img-thumbnail rounded-circle position-relative" alt="" style="width:70px; height:auto">
                    <!-- <p class="text-center">{{$d->user->name}}</p> -->
                </div>
                <div class="col-10 comments">
                    <div class="card-block ml-3">  
                        <h5 class="card-title"><strong>{{ucfirst($best_answer->user->name)}}</strong>
                        <i class="fa fa-circle" style="font-size:8px"></i>
                            <span style="font-size:12px">{{$best_answer->created_at->diffForHumans()}}</span>
                            <span class="best-answer-slect">
                                <a href="" class="float-right btn btn-sm mr-0">Best answer</a>
                            </span>
                        </h5>
                        
                        <p>Experience level: <span class="badge badge-primary">{{ $best_answer->user->points}}</span></p>
                        
                        
                    </div>
                        <p class="card-text">
                            {!! Markdown::convertToHtml($best_answer->content) !!}
                        </p>
                </div>
            </div>
            
        </div>
    @endif

    <h4 class="text-center">Comments</h4>
    <p class="text-center"><i class="fa fa-angle-double-down fa-2x" style=""></i></p>
            <!-- Replies -->
     @foreach($d->replies as $r)
        <div class="card mb-3 shadow-sm p-3 bg-white rounded reply-cmnt">
            <div class="row no-gutters">
                <div class="col-1 ml-2 mt-2">
                    <img src="{{url($d->user->avatar)}}" class="img-fluid img-thumbnail rounded-circle position-relative" alt="" style="width:70px; height:auto">
                    <!-- <p class="text-center">{{$d->user->name}}</p> -->
                </div>
                <div class="col-10 comments">
                    <div class="card-block">  
                        <h5 class="card-title"><strong>{{ucfirst($r->user->name)}}</strong> <i class="fa fa-circle" style="font-size:8px"></i>
                            <span style="font-size:12px">{{$r->created_at->diffForHumans()}}</span>

                            <span class="best-answer">
                                @if(!$best_answer)
                                    @if(Auth::id() == $d->user->id)
                                    <a href="{{ route('discussion.best.answer', ['id'=> $r->id])}}" class="float-right btn btn-sm">Best answer</a>
                                    @endif
                                @endif
                            </span>
                        
                        </h5>
                        <p class="user-points">Experience level: <span class="badge badge-primary">{{ $r->user->points}}</span></p>
                        
                    </div>
                        <p class="card-text">
                            {!! Markdown::convertToHtml($r->content) !!}
                        </p>
                        
                        <div class="heart">
                        @if($r->is_liked_by_auth_user())
                            <a href="{{ route('reply.unlike', ['id' => $r->id]) }}"><i class="fa fa-heart" style="color:red;"></i> <span>{{ $r->likes->count()}}</span></a> 
                        @else
                            <a href="{{ route('reply.like', ['id' => $r->id]) }}"><i class="fa fa-heart"></i></a>
                            <span>{{ $r->likes->count()}}</span>
                            
                        @endif
                        <!-- edit reply as auth -->
                        @if(Auth::id() == $r->user->id)
                            @if(!$r->best_answer)
                            <span class="float-right reply-edt">
                                <i class="fa fa-edit"></i>
                                <a href="{{route('reply.edit', ['id' => $r->id]) }}">Edit</a>
                            </span>
                            @endif
                        @endif
                        </div>
                        
                </div>
            </div>
            
        </div>
        @endforeach

        @if(Auth::check())
            <span>
                <p>Leave a comment</p>
            </span>
            <div class="card shadow-lg">
                <div class="card-body">
                    <form action="{{ route('discussion.reply', ['id' =>$d->id]) }}" method="post">
                        {{ csrf_field() }}

                        <div class="form-group">
                            <textarea name="reply" id="reply" cols="10" rows="5" class="form-control" required="true"></textarea>
                        </div>

                            <button class="btn btn-dark btn-sm float-right" type="submit">Done</button>
                            <span class="float-left">Use Markdown with <a href="https://help.github.com/articles/creating-and-highlighting-code-blocks/" target="__blank">GitHub-flavored</a> code blocks.</span>
                    </form>

                    

                </div>
            </div>

        @else
            <h4 class="text-center">Please <a href="{{'/login'}}">login</a> for leave a Comment</h4>
        @endif

        
    </div>
@endsection

