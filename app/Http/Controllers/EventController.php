<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class EventController extends Controller
{
    public function index(Event $event){
        $today = Carbon::today()->toDateString();
        $user = Auth::user();
        if ($event->date_start < $today) {
            $colour = "#f54242";
            $icon = "times";
            $message = "Sorry, however this event has finished!";
        } else {
            $colour = "#42f593";
            $icon = "check";
            $message = "This event is upcoming, sign yourself up!";
        }
        return view('event', compact('event', 'colour', 'message', 'icon', 'user', 'today'));
    }

    public function attend(Event $event)
    {
        $user = Auth::user();

        if (! $event->users->contains($user)) {
            $event->users()->attach($user);
            toastr()->success("You're now attending this event!");
        } else {
            $event->users()->detach($user);
            toastr()->success("You're no longer attending this event!");
        }



        return back();
    }

    public function delete(Event $event)
    {
        toastr()->success('Event successfully deleted.');
        $event->delete();

        return redirect('/calendar');
    }

    public function create(Request $request, Event $event){

        $newEvent = new Event;

        $newEvent->title = $request->name;
        $newEvent->description = $request->description;
        $newEvent->date_start = $request->startDate;
        $newEvent->date_finish = $request->finishDate;

        $newEvent->save();

        toastr()->success("Event succesfully created!");

        return redirect('/events/'.$newEvent->id);
    }

    public function update(Request $request, Event $event)
    {

        $updateEvent = Event::find($event->id);

        $updateEvent->title = $request->name;
        $updateEvent->description = $request->description;
        $updateEvent->date_start = $request->startDate;
        $updateEvent->date_finish = $request->finishDate;

        $updateEvent->save();

        toastr()->success("Event succesfully updated!");

        return back();
    }

    public function table(){
        $events = Event::all();
        $eventsDeleted = Event::withTrashed();

        return view('eventstable', compact('events', 'eventsDeleted'));
    }
}
