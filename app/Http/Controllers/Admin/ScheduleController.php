<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\CsvImportTrait;
use App\Http\Requests\MassDestroyScheduleRequest;
use App\Http\Requests\StoreScheduleRequest;
use App\Http\Requests\UpdateScheduleRequest;
use App\Models\Event;
use App\Models\Schedule;
use App\Models\Speaker;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ScheduleController extends Controller
{
    use CsvImportTrait;

    public function index()
    {
        abort_if(Gate::denies('schedule_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $schedules = Schedule::all();

        $events = Event::get();

        $speakers = Speaker::get();

        return view('admin.schedules.index', compact('schedules', 'events', 'speakers'));
    }

    public function create()
    {
        abort_if(Gate::denies('schedule_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $events = Event::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $speakers = Speaker::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.schedules.create', compact('events', 'speakers'));
    }

    public function store(StoreScheduleRequest $request)
    {
        $schedule = Schedule::create($request->all());

        return redirect()->route('admin.schedules.index');
    }

    public function edit(Schedule $schedule)
    {
        abort_if(Gate::denies('schedule_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $events = Event::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $speakers = Speaker::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $schedule->load('event', 'speaker');

        return view('admin.schedules.edit', compact('events', 'speakers', 'schedule'));
    }

    public function update(UpdateScheduleRequest $request, Schedule $schedule)
    {
        $schedule->update($request->all());

        return redirect()->route('admin.schedules.index');
    }

    public function show(Schedule $schedule)
    {
        abort_if(Gate::denies('schedule_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $schedule->load('event', 'speaker');

        return view('admin.schedules.show', compact('schedule'));
    }

    public function destroy(Schedule $schedule)
    {
        abort_if(Gate::denies('schedule_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $schedule->delete();

        return back();
    }

    public function massDestroy(MassDestroyScheduleRequest $request)
    {
        Schedule::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
