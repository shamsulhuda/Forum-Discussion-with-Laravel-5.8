@extends('layouts.app')

@section('content')
        <div class="col-md-7 offset-1">
            <div class="card">
                <div class="card-header font-md">Create discussion</div>

                <div class="card-body">
                <form action="{{route('discussions.store')}}" method="post" data-toggle="validator">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-8">
                        <label for="title">Title</label>
                        <input type="text" name="title" class="form-control" value="{{old('title')}}" required="true">
                            
                        </div>
                        <div class="col-2 offset-2">
                            <span class="channel">
                                <select class="selectpicker" name="channel_id" data-style="btn btn-link" id="exampleFormControlSelect1" required="true">
                                <option value="">Channel</option>

                                @foreach($channels as $channel)
                                    <option value="{{ $channel->id }}">{{ $channel->title }}</option>
                                @endforeach
                                </select>
                            </span>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="content">Ask Question</label>
                        <textarea name="content" id="content" cols="30" rows="10" class="form-control" required="true">{{old('content')}}</textarea>
                    </div>

                        <button class="btn btn-success float-right" type="submit">Create Discussion</button>
                        <span class="float-left">Use Markdown with <a href="https://help.github.com/articles/creating-and-highlighting-code-blocks/" target="__blank">GitHub-flavored</a> code blocks.</span>
                </form>

                </div>
            </div>
            
        </div>


        
@endsection
