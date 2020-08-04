<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyEventAttendeeRequest;
use App\Models\Event;
use App\Models\EventAttendee;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EventAttendeesController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('event_attendee_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventAttendees = EventAttendee::all();

        $events = Event::get();

        $users = User::get();

        return view('admin.eventAttendees.index', compact('eventAttendees', 'events', 'users'));
    }

    public function show(EventAttendee $eventAttendee)
    {
        abort_if(Gate::denies('event_attendee_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventAttendee->load('event', 'user');

        return view('admin.eventAttendees.show', compact('eventAttendee'));
    }

    public function destroy(EventAttendee $eventAttendee)
    {
        abort_if(Gate::denies('event_attendee_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventAttendee->delete();

        return back();
    }

    public function massDestroy(MassDestroyEventAttendeeRequest $request)
    {
        EventAttendee::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
