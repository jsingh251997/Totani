<?php

public function store(Request $_request)
{
    $this->validate($request,[
        'title' -> 'required',
    ]);
    $events = new Event;

    $events ->title = $request->input('title');
    $events->save();
    return redirect('/events')->with('success','Events Added');
}