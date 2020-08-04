@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.event.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.events.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.id') }}
                        </th>
                        <td>
                            {{ $event->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.specialty') }}
                        </th>
                        <td>
                            {{ $event->specialty->specialty ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.title') }}
                        </th>
                        <td>
                            {{ $event->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.description') }}
                        </th>
                        <td>
                            {!! $event->description !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.start_at') }}
                        </th>
                        <td>
                            {{ $event->start_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.end_at') }}
                        </th>
                        <td>
                            {{ $event->end_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.link') }}
                        </th>
                        <td>
                            {{ $event->link }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.notification') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $event->notification ? 'checked' : '' }}>
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.event.fields.active') }}
                        </th>
                        <td>
                            {{ App\Models\Event::ACTIVE_RADIO[$event->active] ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.events.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#event_topics" role="tab" data-toggle="tab">
                {{ trans('cruds.topic.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#event_speakers" role="tab" data-toggle="tab">
                {{ trans('cruds.speaker.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#event_exhibitions" role="tab" data-toggle="tab">
                {{ trans('cruds.exhibition.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#event_event_attendees" role="tab" data-toggle="tab">
                {{ trans('cruds.eventAttendee.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#event_schedules" role="tab" data-toggle="tab">
                {{ trans('cruds.schedule.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#event_boards" role="tab" data-toggle="tab">
                {{ trans('cruds.board.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#event_organizers" role="tab" data-toggle="tab">
                {{ trans('cruds.organizer.title') }}
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#event_sponsors" role="tab" data-toggle="tab">
                {{ trans('cruds.sponsor.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="event_topics">
            @includeIf('admin.events.relationships.eventTopics', ['topics' => $event->eventTopics])
        </div>
        <div class="tab-pane" role="tabpanel" id="event_speakers">
            @includeIf('admin.events.relationships.eventSpeakers', ['speakers' => $event->eventSpeakers])
        </div>
        <div class="tab-pane" role="tabpanel" id="event_exhibitions">
            @includeIf('admin.events.relationships.eventExhibitions', ['exhibitions' => $event->eventExhibitions])
        </div>
        <div class="tab-pane" role="tabpanel" id="event_event_attendees">
            @includeIf('admin.events.relationships.eventEventAttendees', ['eventAttendees' => $event->eventEventAttendees])
        </div>
        <div class="tab-pane" role="tabpanel" id="event_schedules">
            @includeIf('admin.events.relationships.eventSchedules', ['schedules' => $event->eventSchedules])
        </div>
        <div class="tab-pane" role="tabpanel" id="event_boards">
            @includeIf('admin.events.relationships.eventBoards', ['boards' => $event->eventBoards])
        </div>
        <div class="tab-pane" role="tabpanel" id="event_organizers">
            @includeIf('admin.events.relationships.eventOrganizers', ['organizers' => $event->eventOrganizers])
        </div>
        <div class="tab-pane" role="tabpanel" id="event_sponsors">
            @includeIf('admin.events.relationships.eventSponsors', ['sponsors' => $event->eventSponsors])
        </div>
    </div>
</div>

@endsection