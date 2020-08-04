<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\EventAttendeeResource;
use App\Models\EventAttendee;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EventAttendeesApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('event_attendee_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EventAttendeeResource(EventAttendee::with(['event', 'user'])->get());
    }

    public function show(EventAttendee $eventAttendee)
    {
        abort_if(Gate::denies('event_attendee_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new EventAttendeeResource($eventAttendee->load(['event', 'user']));
    }

    public function destroy(EventAttendee $eventAttendee)
    {
        abort_if(Gate::denies('event_attendee_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $eventAttendee->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
