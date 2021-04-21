<?php

namespace App\Http\Controllers;

use App\Models\Story;
use Illuminate\Http\Request;
use App\Http\Request\StoryRequest;

class StoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $stories = Story::where('user_id',auth()->user()->id)
                            ->orderBy('id','DESC')
                            ->paginate(2);
        return view('stories.index',[
            'stories'=> $stories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $story = new Story();
        return view('stories.create',[
            'story' =>$story
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoryRequest $request)
    {
        //
        
        auth()->user()->stories()->create([
            'title' => $request->title,
            'body' => $request->body,
            'status' => $request->status,
            'type' => $request->type,
        ]);
        return redirect()->route('stories.index')->with('status','Story crée avec success');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function show(StoryRequest $story)
    {
        //
        $story1 = Story::findOrFail($story);
        
        return view('stories.show',[
            'story'=> $story1
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function edit(StoryRequest $story)
    {
        return view('stories.edit',[
            'story' => $story
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function update(StoryRequest $request, Story $story)
    {
        //
        $story->update($request->data());
        return redirect()->route('stories.index')->with('status','Story update succcessfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Story  $story
     * @return \Illuminate\Http\Response
     */
    public function destroy(Story $story)
    {
        //
    }
}
