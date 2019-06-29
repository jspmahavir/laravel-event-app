<?php

namespace App\Http\Controllers;

use App\Event;
use App\Ticket;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Event::all());
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $event = new Event([
            'name' => $request->get('name'),
            'ticket' => $request->get('ticket'),
            'eventdate' => $request->get('eventdate')
        ]);
        $event->save();
        $tickets = $request->get('ticket');
        for($i = 0; $i < $tickets; $i++) {
            $ticketData = Ticket::create([
                'event_id' => $event->id,
                'ticket_number' => $this->randomTicketNumber(),
            ]);
        }
        return response()->json('Successfully added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        // $data = Ticket::find($event->id);
        // dd($data);
        $data = $event->tickets;
        return response()->json($event);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //
    }

    protected function randomTicketNumber()
    {
        $alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $pass = array();
        $alphaLength = strlen($alphabet) - 1;
        for ($i = 0; $i < 8; $i++) {
            $n = rand(0, $alphaLength);
            $pass[] = $alphabet[$n];
        }
        return implode($pass);
    }

    public function eventTicketCount(Event $event) {
        $data['eventTicketCount'] = Ticket::where('event_id',$event->id)->where('is_redeem',0)->count();
        return response()->json($data);
    }
}
