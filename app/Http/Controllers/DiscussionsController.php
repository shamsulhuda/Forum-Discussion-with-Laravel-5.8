<?php

namespace App\Http\Controllers;

use Auth;
use Session;
use App\User;
use App\Reply;
use Notification;
use App\Discussion;
use Illuminate\Http\Request;

class DiscussionsController extends Controller
{
    public function create()
    {
    	return view('discuss');
    }

    public function store()
    {
    	$r= request();
    	$this->validate($r, [
    		'channel_id' => 'required',
    		'content' => 'required',
    		'title' => 'required',
    	]);

    	$discussion = Discussion::create([

    		'title' => $r->title,
    		'content' => $r->content,
    		'channel_id' => $r->channel_id,
    		'user_id' => Auth::id(),
    		'slug' => str_slug($r->title)
    	]);

    	Session::flash('success', 'Discussion created!');

    	return redirect()->route('discussion', ['slug' => $discussion->slug]);
    }

    // Show discussions in details
   

    public function show($slug)
    {
		$discussion = Discussion::where('slug', $slug)->first();

       // dd($discussion);

        $best_answer = $discussion->replies()->where('best_answer', 1)->first();
        
        
        return view('discussions.show')
                        ->with('d', $discussion)
                        ->with('best_answer', $best_answer);
        
	}
	
	// Comment ssection
	public function reply($id)
	{
		$d = Discussion::find($id);

		$reply = Reply::create([

			'user_id' => Auth::id(),
			'discussion_id' => $id,
			'content' =>request()->reply
		]);

		// increment user points
		$reply->user->points +=15;
		$reply->user->save();
		

		$watchers = array();

		foreach($d->watchers as $watcher):
			array_push($watchers, User::find($watcher->user_id));
		endforeach;

		Notification::send($watchers, new \App\Notifications\NewReplyAdded($d));

		Session::flash('success', 'Reply posted!');

		return redirect()->back();
	}

	//edit update discussion

	public function edit($slug)
	{
		return view('discussions.edit', ['discussion' => Discussion::where('slug', $slug)->first()]);
	}

	public function update($id)
	{
		$this->validate(request(),[
			'title' => 'required',
			'content' => 'required'
		]);

		$d = Discussion::find($id);

		$d->title = request()->title;
		$d->content = request()->content;

		$d->save();

		Session::flash('success', 'Discussion Updated Successfully!');

		return redirect()->route('discussion', ['slug' => $d->slug]);
	}

	// search 
	public function search(Request $request){
		$search = $request->get("search");
		$discuss = Discussion::where('title', 'like', '%'.$search.'%')->paginate(5);
		if (count($discuss) > 0) {
			return view('forum', ['discussions' => $discuss]);
		}else{
			Session::flash('success', 'No Data found! Please try again!');
			return redirect()->back();
		}
		
	}
}
