<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyOrganizerRequest;
use App\Http\Requests\StoreOrganizerRequest;
use App\Http\Requests\UpdateOrganizerRequest;
use App\Models\Event;
use App\Models\Organizer;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class OrganizersController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('organizer_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $organizers = Organizer::all();

        $events = Event::get();

        return view('admin.organizers.index', compact('organizers', 'events'));
    }

    public function create()
    {
        abort_if(Gate::denies('organizer_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $events = Event::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.organizers.create', compact('events'));
    }

    public function store(StoreOrganizerRequest $request)
    {
        $organizer = Organizer::create($request->all());

        if ($request->input('logo', false)) {
            $organizer->addMedia(storage_path('tmp/uploads/' . $request->input('logo')))->toMediaCollection('logo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $organizer->id]);
        }

        return redirect()->route('admin.organizers.index');
    }

    public function edit(Organizer $organizer)
    {
        abort_if(Gate::denies('organizer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $events = Event::all()->pluck('title', 'id')->prepend(trans('global.pleaseSelect'), '');

        $organizer->load('event');

        return view('admin.organizers.edit', compact('events', 'organizer'));
    }

    public function update(UpdateOrganizerRequest $request, Organizer $organizer)
    {
        $organizer->update($request->all());

        if ($request->input('logo', false)) {
            if (!$organizer->logo || $request->input('logo') !== $organizer->logo->file_name) {
                if ($organizer->logo) {
                    $organizer->logo->delete();
                }

                $organizer->addMedia(storage_path('tmp/uploads/' . $request->input('logo')))->toMediaCollection('logo');
            }
        } elseif ($organizer->logo) {
            $organizer->logo->delete();
        }

        return redirect()->route('admin.organizers.index');
    }

    public function show(Organizer $organizer)
    {
        abort_if(Gate::denies('organizer_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $organizer->load('event', 'organizerContacts');

        return view('admin.organizers.show', compact('organizer'));
    }

    public function destroy(Organizer $organizer)
    {
        abort_if(Gate::denies('organizer_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $organizer->delete();

        return back();
    }

    public function massDestroy(MassDestroyOrganizerRequest $request)
    {
        Organizer::whereIn('id', request('ids'))->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('organizer_create') && Gate::denies('organizer_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Organizer();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
