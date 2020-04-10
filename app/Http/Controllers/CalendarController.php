<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CalendarController extends Controller
{
    public function index(){
        $events = Event::all()
            ->map(function ($event) {
                return [
                    'title' => $event->title,
                    'start' => $event->date_start,
                    'end' => $event->date_finish,
                    'url' => "/events/{$event->id}",
                ];
            });

        return view('calendar', compact('events'));
    }

    public function delete(Request $request, $eventID){
        dd($eventID);
        // return view('calendaredit', compact('events'));
    }
}
