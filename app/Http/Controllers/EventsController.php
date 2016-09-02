<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Bar;
use Illuminate\Support\Facades\Auth;
use App\Event;

class EventsController extends Controller
{

    public function index()
    {
		$events = Event::orderDesc(10);
		$data = [
			'events' => $events
		];
		return view ('events.index', $data);
    }

    public function create()
    {
		return view('events.create');
    }

    public function store(Request $request)
    {
		session()->flash('fail', 'Your event was NOT created. Please fix errors.');
		$this->validate($request, Event::$rules);

		$event = new Event();
		// Will change based on view
		$event->bar_id = '1';
		//
		$event->title = $request->get('title');
		$event->date = $request->get('date');
		$event->content = $request->get('content');

		$imagePath = 'img/';
		$imageExtension = $request->file('image')->getClientOriginalExtension();
		$imageName = uniqid() . '.' . $imageExtension;
		$request->file('image')->move($imagePath, $imageName);
		$event->event_pic = '/img/' . $imageName;

		$event->created_by = Auth::user()->id;
		$event->save();
		session()->flash('success', 'Your event was created successfully!');
		return redirect()->action('EventsController@index');
    }

    public function show($id)
    {
		$event = Event::find($id);
		if (!$event) {
			abort(404);
		}
		$data = [
			'event' => $event
		];
		return view('events.show', $data);
    }

    public function edit($id)
    {
		$event = Event::find($id);
		if (!$event) {
			abort(404);
		}
		$data = [
			'event' => $event
		];
		return view('events.edit', $data);
    }

    public function update(Request $request, $id)
    {
		session()->flash('fail', 'Your event was NOT updated. Please fix errors.');
		$this->validate($request, Event::$rules);

		$event = Event::find($id);
		if (!$event) {
			abort(404);
		}
		$event->title = $request->get('title');
		$event->date = $request->get('date');
		$event->content = $request->get('content');
		$event->event_pic = $request->get('event_pic');
		$event->save();
		session()->flash('success', 'Your was updated successfully!');
		return redirect()->action('EventsController@show', $event->id);
    }

    public function destroy(Request $request, $id)
    {
		$event = Event::find($id);
		if (!$event) {
			abort(404);
		}
		$event->delete();
		$request->session()->flash('success', 'Your event was deleted successfully!');
		return redirect()->action('EventsController@index');
    }
}
