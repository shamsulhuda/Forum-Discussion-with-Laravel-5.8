<?php

namespace App\Http\Controllers;

use Auth;
use App\Reply;
use App\Like;
use Session;
use Illuminate\Http\Request;

class RepliesController extends Controller
{
    public function like($id)

    {
    	Like::create([

    		'reply_id' => $id,
    		'user_id' => Auth::id()
    	]);

    	Session::flash('success', 'Liked');

    	return redirect()->back();
    }

    public function unlike($id)
    {
        $like = Like::where('reply_id', $id)->where('user_id', Auth::id())->first();
        
        $like->delete();

    	Session::flash('success', 'Unliked');
    	return redirect()->back();
    }

    // best answer field

    public function best_answer($id)
    {
        $reply = Reply::find($id);

        $reply->best_answer = 1;

        $reply->save();

        // best answer points
        $reply->user->points +=50;
        $reply->user->save();

        Session::flash('success', 'Marked as best answer');

        return redirect()->back();
    }


    // edit and update reply
    public function edit($id)
    {
        return view('replies.edit', ['reply' => Reply::find($id)]);
    }

    public function update($id)
    {
        $this->validate(request(), [
            'content' => 'required'
        ]);

        $reply = Reply::find($id);

        $reply->content = request()->content;
        $reply->save();

        Session::flash('success', 'Your reply updated Successfully!');

        return redirect()->route('discussion', ['slug' => $reply->discussion->slug]);
    }
}
