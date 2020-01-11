<?php

namespace App\Http\Controllers;

use App\Events\DeleteReplyEvent;
use App\Http\Resources\ReplyResource;
use App\Model\Question;
use App\Model\Reply;
use App\Notifications\NewReplyNotification;
use Illuminate\Http\Request;

class ReplyController extends Controller
{

    public function __construct()
    {
        $this->middleware('Jwt', ['except' => ['index','show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @param Question $question
     * @return \Illuminate\Http\Response
     */
    public function index(Question $question)
    {
        return ReplyResource::collection($question->replies);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Question $question
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Question $question,Request $request)
    {
        //

       $reply =  $question->replies()->create($request->all());

       $user = $question->user;
       if($reply->user_id !== $question->user_id)
       {
           $user->notify(new NewReplyNotification($reply));
       }

        return response(['reply' => new ReplyResource($reply)],200);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question,Reply $reply)
    {
        //
        return new ReplyResource($reply);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Reply  $reply
     * @return \Illuminate\Http\Response
     */
    public function edit(Reply $reply)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Question $question
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Model\Reply $reply
     * @return \Illuminate\Http\Response
     */
    public function update(Question $question,Request $request, Reply $reply)
    {
        $reply->update($request->all());

        return response('update');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Question $question
     * @param  \App\Model\Reply $reply
     * @return \Illuminate\Http\Response
     */
    public function destroy(Question $question,Reply $reply)
    {
       $reply->delete();

        broadcast(new DeleteReplyEvent($reply->id))->toOthers();

        return response('deleted');


    }
}
